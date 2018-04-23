<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Goutte\Client;
use App\User;
use PHPUnit\Framework\Constraint\IsNull;
use App\Posts;

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
        $nodes = $pageCrawler->filter('.row.topic');
        $posts = $this->getPostInfo($nodes);
        foreach ($posts as $post) {
            $found = Posts::FirstOrCreate(['thread-id' => $post['thread-id']], $post);
        }
        dd(Posts::all());
    }

    private function getPostInfo($nodes)
    {
        if (is_null($nodes)) {
            return null;
        }

        $posts = $nodes->each(function ($node) {
            $info = [];
            $info['thread-id'] = $node->extract(['data-thread-id'])[0];
            $info['title'] = str_replace("\n", "", $node->filter('.topic_title_link')->text());
            $info['post-date'] = $node->filter('.first-post-time')->text();
            $link = $node->filter('.topic_title_link')->link();
            $info['link'] = $link->getUri();
            $info = $this->linkInfo($link, $info);
            return $info;
            // $post = $this->scraperClient->click($link);
            // $this->getPostInfo($post);
        });

        return $posts;
    }
    
    protected function linkInfo($link, $info)
    {
       $page = $this->scraperClient->click($link);
       $postInfo = $page->filter('.post_offer_fields');
       dd(strip_tags(str_replace("\n", "", $postInfo->html())));
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
