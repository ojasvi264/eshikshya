<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkSubmission extends Model
{
    use HasFactory;
    //protected $with = ['student'];
    protected $fillable = [
        'file',
        'homework_id',
        'student_id'
    ];
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id', 'id');
    }
    public function homework()
    {
        return $this->belongsTo('App\Models\Homework', 'homework_id', 'id');
    }
}
