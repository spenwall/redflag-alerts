<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Redflag Deals Alerts</title>
        
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    </head>

    <body>

      <div id="app">
        @include ('layout.nav')

        <div class="container"> 
          @yield('content')
        </div>
        
      </div>

      <script src="/js/app.js"></script>

    </body>

</html>