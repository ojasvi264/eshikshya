<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected  $fillable = ['title', 'book_number', 'isbn_number', 'publisher', 'author', 'subject', 'rack_number', 'quantity', 'book_price', 'post_date', 'description'];
}
