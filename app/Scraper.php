<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Goutte\Client;
use App\User;
use PHPUnit\Framework\Constraint\IsNull;

class Scraper extends Model
{
    //
    const HOT_DEALS = 'https://forums.redflagdeals.com/hot-deals-f9/?st=0&rfd_sk=tt&sd=d';

    protected $mainPage;

    protected $scraperClient;

    public function __construct($page = SELF::HOT_DEALS)
    {
        $this->mainPage = $page;
        $this->scraperClient = new Client();
    }
    
    public function storeNewPosts()
    {
        $pageCrawler = $this->scraperClient->request('GET', $this->mainPage);
        $posts = $pageCrawler->filter('.row.topic')->extract(['data-thread-id']);
        dd($posts);
    }
    
    public function searchPageForKeywords($words, $page = null)
    {
        if (is_null($page)) {
            $page = $this->mainPage;
        }

        $pageCrawler = $this->scraperClient->request('GET', $page);
        $allTitles = $pageCrawler->filter('.topictitle');

        $values = $allTitles->each( 
            function ($node, $i) use ($words) {
                $searchTerms = explode(" ", $words);
                foreach ($searchTerms as $search) {
                    if (!preg_match("/\b".$search."\b/i", $node->text())) {
                        return null;
                    }
                }
                // dd($node->children()->last()->text());
                return $node;
            }
        );
        return array_filter($values);
    }

    public function searchUserAlerts(User $user)
    {
        $alerts = $user->alerts;

        $results = [];
        foreach($alerts as $alert) {
            $results[$alert->id] = $this->searchPageForKeywords($alert->keywords);
        }
        return $results;
    }

    protected function getMainPage()
    {
        return $this->mainPage;
    }
}
