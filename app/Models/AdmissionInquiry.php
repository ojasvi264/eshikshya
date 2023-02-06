<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionInquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'address',
        'description',
        'note',
        'inquiry_date',
        'follow_up',
        'source_id',
        'reference_id',
        'teacher_id',
        'class_id',
        'no_of_child',
    ];
    public function source()
    {
        return $this->belongsTo('App\Models\Source', 'source_id', 'id');
    }
    public function reference()
    {
        return $this->belongsTo('App\Models\Reference', 'reference_id', 'id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Models\StaffDirectory', 'teacher_id', 'id');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\Class', 'source_id', 'id');
    }
}
