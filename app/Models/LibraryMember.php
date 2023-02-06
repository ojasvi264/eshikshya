<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryMember extends Model
{
    use HasFactory;
    protected $fillable = ['directory_id', 'student_id', 'library_card_number', 'member_type', 'status'];

    public function staff(){
        return $this->belongsTo(StaffDirectory::class, 'directory_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
