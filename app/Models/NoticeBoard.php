<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeBoard extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'notice_date',
        'published_on',
        'message_to',
        'message',
        'is_published'
    ];
}
