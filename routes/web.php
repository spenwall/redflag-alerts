<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Route::get('/somethingelse', function () {
    // $feed = new Feeds();
    // $feed->set_feed_url('https://gizmodo.com/rss');
    // dd($feed);
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
    $newFeed->init();
    $item = $newFeed->get_items()[0];
    $tag = $item->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'category');
    dd($tag, $item->get_author(), $item->get_title(), $item->get_date(), $item->get_content());
    return view('welcome');
});
