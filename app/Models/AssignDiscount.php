<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignDiscount extends Model
{
    use HasFactory;
    protected $fillable = ['fee_discount_id', 'class_id', 'section_id', 'student_id', 'category_id', 'gender'];

    public function fee_discount(){
        return $this->belongsTo(FeeDiscount::class, 'fee_discount_id', 'id');
    }
    public function class(){
        return $this->belongsTo(Eclass::class, 'class_id', 'id');
    }
    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
