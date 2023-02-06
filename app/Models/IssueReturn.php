<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueReturn extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'library_member_id', 'issue_date', 'return_date'];

    public function book(){
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function issueReturn(){
        return $this->belongsTo(LibraryMember::class, 'library_member_id', 'id');
    }
}
