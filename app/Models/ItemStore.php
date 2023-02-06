<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStore extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'description'];

    public function item_stocks(){
        return $this->hasMany(ItemStock::class);
    }
}
