<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueItem extends Model
{
    use HasFactory;
    protected $fillable = ['role_id', 'issue_to', 'issue_by', 'issue_date', 'return_date', 'item_category_id', 'item_id', 'quantity', 'note', 'status'];

    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function staff_directory(){
        return $this->belongsTo(StaffDirectory::class, 'issue_to', 'id');
    }
    public function staff_dir(){
        return $this->belongsTo(StaffDirectory::class, 'issue_by', 'id');
    }

    public function item_category(){
        return $this->belongsTo(ItemCategory::class, 'item_category_id', 'id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
