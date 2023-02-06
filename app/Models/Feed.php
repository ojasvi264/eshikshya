<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;
    protected $fillable = [
        'feed',
        'feed_date',
        'feed_content',
        'image',
    ];

    /* public function user()
     {
         return $this->belongsTo('App\Models\User', 'user_id', 'id');
     }*/
}
