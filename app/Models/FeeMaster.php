<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeMaster extends Model
{
    use HasFactory;
    protected $fillable = ['fee_group_id', 'fees_type_id', 'due_date', 'amount', 'fine_type', 'percentage', 'fine_amount'];

    public function fee_group(){
        return $this->belongsTo(FeeGroup::class, 'fee_group_id', 'id');
    }
    public function fees_type(){
        return $this->belongsTo(FeesType::class, 'fees_type_id', 'id');
    }
    public function assign_fees(){
        return $this->hasMany(AssignFee::class);
    }
}
