<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_quiz',
        'title',
        'exam_from_date',
        'exam_from_time',
        'exam_to_date',
        'exam_to_time',
        'auto_publis_result_date',
        'auto_publis_result_time',
        'time_duration',
        'number_of_attempt',
        'passing_percentage',
        'publish_exam',
        'publish_result',
        'negative_marking',
        'display_marks_in_exam',
        'random_question_order',
        'description',
        'status'
    ];

    public function questions()
    {
        return $this->hasMany(OnlineExamQuestion::class);
    }
}
