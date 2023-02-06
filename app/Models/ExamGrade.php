<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'per_from',
        'per_to',
        'grade_point',
    ];
}
