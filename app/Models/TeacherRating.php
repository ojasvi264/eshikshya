<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherRating extends Model
{
    use HasFactory;
    protected $fillable = ['directory_id', 'rating', 'comment', 'status', 'student_id'];

    public function staff(){
        return $this->belongsTo(StaffDirectory::class, 'directory_id', 'id');
    }
    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
