<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use App\Alert;

class Post extends Model
{
    use Searchable;
    //
    protected $fillable = ['thread-id', 'title', 'data', 'link',
                            'deal-link', 'price', 'savings', 'retailer', 'expiry'];

    public function Alerts()
    {
        return $this->belongsToMany(Alert::class);
    }
    
}
