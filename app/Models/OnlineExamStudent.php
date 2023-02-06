<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineExamStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'online_exam_id',
        'student_id'
    ];

    public function onlineExam()
    {
        return $this->belongsTo(OnlineExam::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
