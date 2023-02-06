<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeDiscount extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'discount_code', 'fees_type_id', 'discount_type', 'amount', 'percentage', 'description'];

    public function fees_type(){
        return $this->belongsTo(FeesType::class, 'fees_type_id', 'id');
    }
}
