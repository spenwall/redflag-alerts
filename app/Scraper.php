<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Goutte\Client;
use App\User;
use PHPUnit\Framework\Constraint\IsNull;
use App\Post;
use App\Alert;

class Scraper extends Model
{
    //
    const HOT_DEALS = 'https://forums.redflagdeals.com/hot-deals-f9/';
    const QUERRY = '?rfd_sk=tt';

    public function storeNewPosts()
    {
        for ($i = 1; $i < 5; $i++) {
            $pageNumber = '';
            if ($i > 1) {
                $pageNumber = $i .'/';
            }
            $page = self::HOT_DEALS . $pageNumber . self::QUERRY;
            $client = new Client();
            $pageCrawler = $client->request('GET', $page);
            $linkNodes = $pageCrawler->filter('.row.topic');
            $posts = $this->getPostInfo($linkNodes);
            foreach ((array)$posts as $post) {
                $found = Post::FirstOrCreate(['threadId' => $post['threadId']], $post);
            }
        }
        return true;
    }

    private function getPostInfo($nodes)
    {
        if ($nodes->count() < 1) {
            return null;
        }

        $posts = $nodes->each(function ($node) {
            $moved = $node->filter('.moved')->count();
            $sticky = $node->filter('.sticky')->count();
            $result = Post::where('threadId', $node->extract(['data-thread-id'])[0])->first();
            if ($result || $moved || $sticky) {
                return;
            }
            $link = $node->filter('.topic_title_link')->link();
            $info = $this->postInfo($link);
            return $info;
        });
        return array_filter($posts);
    }
    
    protected function postInfo($link)
    {
        $client = new Client();
        $post = $client->click($link);
        if (!$post) {
            return null;
        }
        $info = [];
        $info['threadId'] = $post->filter('#thread')->extract(['data-thread-id'])[0];
        $info['title'] = $post->filter('.thread_title')->text();
        $info['postDate'] = $post->filter('.dateline_timestamp')->text();
        $info['link'] = $post->getUri();

        $infoTitles = $post->filter('.post_offer_fields dt');
        $infoTags = $post->filter('.post_offer_fields dd');

        $count = $infoTitles->count();
        for ($i = 0; $i < $count; $i++) {
            $title = $infoTitles->getNode($i);
            $tag = $infoTags->getNode($i);       
            $info = $this->seperateInfo($title, $tag, $info);     
        }
        return $info;
    }

    protected function seperateInfo($title, $tag, $info)
    {
        switch ($title->textContent) {
            case 'Deal Link:':
                $info['dealLink'] = $tag->firstChild->getAttribute('href');
                break;
            case 'Price:':
                $info['price'] = $tag->textContent;
                break;
            case 'Savings:':
                $info['savings'] = $tag->textContent;
                break;
            case 'Retailer:':
                $info['retailer'] = $tag->textContent;
                break;
            case 'Expiry:':
                $info['expiry'] = $tag->textContent;
                break;
            default:
                break;
        }
        return $info;
    }
}
