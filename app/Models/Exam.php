<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'session_id',
        'date_from',
        'date_to',
        'description',
        'result_date',
        'status',
        'eclasses_id',
        'section_id',
        'exam_type_id',
    ];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function examType()
    {
        return $this->belongsTo(ExaminationType::class);
    }

    public function class()
    {
        return $this->belongsTo('App\Models\Eclass', 'eclasses_id', 'id');
    }
}
