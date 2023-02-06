<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamMark extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'eclasses_id',
        'subject_id',
        'student_id',
        'theory_mark',
        'practical_mark',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function class()
    {
        return $this->belongsTo('App\Models\Eclass', 'eclasses_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
