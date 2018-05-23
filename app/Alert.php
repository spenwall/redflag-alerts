<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Mail\AlertEmail;
use Illuminate\Support\Facades\Mail;

class Alert extends Model
{
    protected $fillable = ['name', 'user_id', 'keywords'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
    

    protected function postExists($postId)
    {
        return $this->posts->where('id', $postId)->isNotEmpty();
    }

    public function addPost($post)
    {
        if (!$this->postExists($post->id)) {
            $this->posts()->attach($post);
        }
    }

    public function emailPost($post)
    {
        Mail::to($this->user->email)->send(new AlertEmail($this, $post));
    }

    public function searchForNewPosts($date)
    {
        $results = Post::search($this->keywords)->get(); 
        $filtered = $results->where('created_at', '>', $date);

        foreach ($filtered as $post) {
                $this->addPost($post);
                $this->emailPost($post);
            }
        
    }
}
