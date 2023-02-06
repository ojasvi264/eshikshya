<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
        'eclasses_id',
        'section_id',
        'credit_hour',
        'type',
        'theory_full_marks',
        'practical_full_marks',
        'theory_pass_marks',
        'practical_pass_marks',
    ];

    public function class()
    {
        return $this->belongsTo('App\Models\Eclass', 'eclasses_id', 'id');
    }
    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id', 'id');
    }

    public function category_user()
    {
        return $this->belongsTo(User::class);
    }

    public function teacher_subject()
    {
        return $this->hasMany(Teach::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
