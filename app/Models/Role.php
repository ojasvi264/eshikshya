<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function staff_directories(){
        $this->hasMany(StaffDirectory::class);
    }

    public function issue_items(){
        $this->hasMany(IssueItem::class);
    }
}
