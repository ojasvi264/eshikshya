<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'message_to',
        'attachment',
        'message',
        'message_to_type'
    ];
}
