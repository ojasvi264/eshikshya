<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'item_category_id', 'unit', 'description'];

    public function item_category(){
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }

    public function item_stocks(){
        return $this->hasMany(ItemStock::class);
    }
}
