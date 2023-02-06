<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'eclasses_id'
    ];

    public function class()
    {
        return $this->belongsTo('App\Models\Eclass', 'eclasses_id', 'id');
    }
    public function student()
    {
        return $this->hasMany(Student::class);
    }
    public function session()
    {
        return $this->hasMany(SessionClass::class);
    }
    public function group_section()
    {
        return $this->hasMany(Group::class);
    }

    public function category_section()
    {
        return $this->hasMany(Category::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
