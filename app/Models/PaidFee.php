<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidFee extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'paid_amount', 'payment_mode', 'note'];

    public function collect_fees(){
        return $this->hasMany(CollectFee::class);
    }
}
