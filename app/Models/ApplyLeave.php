<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ApplyLeave extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['apply_date', 'leave_type_id', 'leave_from', 'leave_to', 'reason'];

    protected $appends = ['document', 'user_id'];

    public function getDocumentAttribute($value){
        return $this->hasMedia() ? $this->getMedia()[0]->getFullUrl() : '' ;
    }

    public function leave_type(){
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }


}
