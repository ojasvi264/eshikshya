<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectFee extends Model
{
    use HasFactory;
    protected $fillable = ['paid_fee_id','student_id','fees_type_id','due_date', 'fee_amount', 'discount', 'fine', 'previous_session_fee', 'total_balance', 'month_name', 'status'];

    public function fees_type(){
        return $this->belongsTo(FeesType::class, 'fees_type_id', 'id');
    }
    public function paid_fee(){
        return $this->belongsTo(PaidFee::class);
    }
}
