<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $fillable = ['designation'];

    public function staff_directories(){
        $this->hasMany(StaffDirectory::class);
    }
}
