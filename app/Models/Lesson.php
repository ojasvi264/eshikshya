<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['class_id', 'section_id', 'group_id', 'subject_id', 'name'];
    protected $casts = [
        'name' => 'array',
    ];

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
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
