<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'examType_id',
        'grade_name',
        'percent_upto',
        'percent_from',
        'grade_point',
        'description',
    ];

    public function types()
    {
        return $this->belongsTo('App\Models\ExaminationType', 'examType_id', 'id');
    }
}
