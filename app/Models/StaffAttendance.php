<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
    use HasFactory;
    protected $fillable = ['attendance_date_id', 'directory_id', 'attendance', 'note'];
}
