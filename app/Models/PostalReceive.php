<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalReceive extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_title',
        'reference_no',
        'address',
        'to_title',
        'postal_receive_date',
        'note',
        'file'
    ];
}
