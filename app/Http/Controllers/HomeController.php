<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $client = new Client();
        // $crawler = $client->request('GET', 'https://forums.redflagdeals.com/hot-deals-f9/?st=1&rfd_sk=tt');
        // $nodes = $crawler->filter('.topictitle');
        // $values = $nodes->each( 
        //     function ($node, $i) {
        //         if (stripos($node->text(), 'burnout')) {
        //             var_dump($node->text());
        //         }
        //         // var_dump($node->children()->last()->link()->getUri());
        //     }
        // );
        // dd('end');
        return view('home');
    }
}
