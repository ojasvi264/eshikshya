<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeReminder extends Model
{
    use HasFactory;
    protected $fillable = ['reminder_type', 'days', 'status'];

}
