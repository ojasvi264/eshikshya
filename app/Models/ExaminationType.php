<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationType extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_type',
        'description',
    ];
    public function exam()
    {
        return $this->hasMany(ExaminationGroup::class);
    }
}
