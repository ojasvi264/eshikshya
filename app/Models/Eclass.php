<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eclass extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];
    public function session()
    {
        return $this->hasMany(SessionClass::class);
    }

    public function section()
    {
        return $this->hasMany(Section::class);
    }

    public function group()
    {
        return $this->hasMany(Group::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function subject()
    {
        return $this->hasMany(Subject::class);
    }
    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function homework()
    {
        return $this->hasMany(Homework::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
