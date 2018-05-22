<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Mail\PostFound;

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
    
    public function addPostAndEmail($post)
    {
        $this->posts()->attach($post);

        //email
        \Mail::to($this->user)->send(new PostFound($this, $post));
    }
}
