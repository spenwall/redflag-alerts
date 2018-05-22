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
    
    public function addPostAndEmail($post)
    {
        $this->posts()->attach($post);

        //email
        Mail::to('dude.wallace@gmail.com')->send(new AlertEmail($this, $post));
    }
}
