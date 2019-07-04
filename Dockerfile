FROM php:7.2-apache

RUN apt-get update && apt-get install -y \
sqlite \
zip \
unzip \
vim

RUN mkdir /var/www/html/public

RUN cd ~/
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --filename=composer
RUN mv composer /usr/local/bin/composer
RUN php -r "unlink('composer-setup.php');"

RUN a2enmod rewrite

COPY ./apache.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./ /var/www/html 

RUN cd /var/www/html
RUN composer install 

RUN php artisan key:generate