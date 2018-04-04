<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;

class HomeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index()
    {
        // $cacheFile = __DIR__ . '\\..\\cache\\';
        // $newFeed = new SimplePie();
        // $newFeed->set_curl_options(
        //     array(
        //         CURLOPT_SSL_VERIFYHOST => false,
        //         CURLOPT_SSL_VERIFYPEER => false
        //     )
        // );
        // $newFeed->set_cache_location($cacheFile);
        // $newFeed->set_feed_url('https://forums.redflagdeals.com/feed/forum/9');
        // $newFeed->init();
        // $item = $newFeed->get_items()[0];
        // $tag = $item->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'category');
        // dd($tag, $item->get_author(), $item->get_title(), $item->get_date(), $item->get_content());
        return view('home');
    }
}
