<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignFee extends Model
{
    use HasFactory;
    protected $fillable = ['fee_master_id', 'class_id', 'section_id', 'student_id', 'month_name', 'gender', 'previous_session_fee'];

    public function fee_master(){
        return $this->belongsTo(FeeMaster::class, 'fee_master_id', 'id');
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
