<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \SimplePie;

class Feed extends Model
{
    //
    protected $items;

    public function __construct()
    {
        $cacheFile = __DIR__ . '\\..\\cache\\';
        $newFeed = new SimplePie();
        $newFeed->set_curl_options(
            array(
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false
            )
        );
        $newFeed->set_cache_location($cacheFile);
        $newFeed->set_feed_url('https://forums.redflagdeals.com/feed/forum/9');
        $newFeed->set_item_limit(20);
        $newFeed->init();
        $this->items = $newFeed->get_items();
    }

    public function getItems()
    {
        return $this->items;
    }
}
