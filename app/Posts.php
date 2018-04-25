<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
    protected $fillable = ['thread-id', 'title', 'data', 'link',
                            'deal-link', 'price', 'savings', 'retailer', 'expiry'];
}
