<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSetting extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name',
        'slogan',
        'established_year',
        'logo',
        'phone_number',
        'email_address',
        'take_late_fee',
        'type_of_late_fee',
        'late_fee_value',
        'late_fee_after',
        'session_id',
        'result_type',
        'address'
    ];
}
