<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = ['lesson_id', 'class_id', 'section_id', 'subject_id', 'name', 'completion_date', 'status', 'completion_status'];
    public function class()
    {
        return $this->belongsTo(Eclass::class, 'class_id', 'id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }
    public function manageSyllabusStatus(){
        return $this->belongsTo(ManageSyllabusStatus::class);
    }
}
