<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_name',
        'examType_id',
        'description'
    ];
    public function class()
    {
        return $this->belongsTo('App\Models\Eclass', 'class_id', 'id');
    }
    public function types()
    {
        return $this->belongsTo('App\Models\ExaminationType', 'examType_id', 'id');
    }
}
