<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class LeaveRequest extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['role_id', 'directory_id', 'apply_date', 'leave_type_id', 'user_id', 'leave_from', 'leave_to', 'reason', 'note', 'status'];

    protected $appends = ['document'];

    public function getDocumentAttribute($value){
        return $this->hasMedia() ? $this->getMedia()[0]->getFullUrl() : '' ;
    }

    public function user_id($value){
        if (Auth::guard('staff')->check()){
            return 'staff_'.Auth::guard('staff')->user()->id;
        }else if(Auth::guard('student')->check()){
            return 'student_'.Auth::guard('student')->user()->id;
        }else{
            return Auth::user()->id;
        }
    }

    public function leave_type(){
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }

    public function staff(){
        return $this->belongsTo(StaffDirectory::class, 'directory_id', 'id');
    }

    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
