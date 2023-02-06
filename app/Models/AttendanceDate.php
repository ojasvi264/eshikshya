<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceDate extends Model
{
    use HasFactory;
    protected $fillable = ['attendance_date', 'is_holiday'];
}
