<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalDispatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'to_title',
        'reference_no',
        'address',
        'from_title',
        'date',
        'note',
        'file',
    ];
}
