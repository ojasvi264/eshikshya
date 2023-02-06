<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_invoice_id',
        'fee_type_id',
        'quantity',
        'is_hostel',
        'is_transporation'
    ];

    public function invoice()
    {
        return $this->belongsTo(StudentInvoice::class);
    }

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }
}
