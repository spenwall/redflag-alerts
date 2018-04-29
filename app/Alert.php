<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

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
    
}
