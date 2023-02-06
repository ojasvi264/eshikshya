<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'student_id',
        'discount',
        'due_date',
        'payment_date',
        'total_amount',
        'for_month',
        'late_amount',
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function invoiceDetails()
    {
        return $this->hasMany(StudentInvoiceDetail::class);
    }
}
