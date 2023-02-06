<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'section_id',
        'subject_id',
        'assign',
        'submission',
        'submission_time',
        'description',
        'teacher_id',
        'image',
    ];
    public function class()
    {
        return $this->belongsTo('App\Models\Eclass', 'class_id', 'id');
    }
    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id', 'id');
    }
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id', 'id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Models\StaffDirectory', 'teacher_id', 'id');
    }
    public function homeworksubmission()
    {
        return $this->hasMany(HomeworkSubmission::class);
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFilenamesAttribute($value)
    {
        $this->attributes['image'] = json_encode($value);
    }
}
