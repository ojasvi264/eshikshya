<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineExamQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'online_exam_id',
        'question_bank_id'
    ];

    public function onlineExam()
    {
        return $this->belongsTo(OnlineExam::class);
    }

    public function questionBank()
    {
        return $this->belongsTo(QuestionBank::class);
    }
}
