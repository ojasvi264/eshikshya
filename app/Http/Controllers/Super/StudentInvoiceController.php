<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Eclass;
use App\Models\StudentInvoice;
use Illuminate\Http\Request;
use App\Http\Requests\StudentInvoiceRequest;
use App\Models\StudentInvoiceDetail;
use Carbon\Carbon;

class StudentInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_invoices = StudentInvoice::all();
        return view('superadmin.invoice.index', compact('student_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Eclass::all();
        $months = getMonths();
        return view('superadmin.invoice.create', compact('classes', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StudentInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentInvoiceRequest $request)
    {
        $student_invoice = new StudentInvoice();
        $student_invoice->invoice_number = strtotime("now");
        $student_invoice->student_id = $request->student_id;
        $student_invoice->discount = ($request->discount) ? $request->discount : 0;
        $student_invoice->due_date = $request->due_date;
        $student_invoice->for_month = $request->for_month;
        if($student_invoice->save()){
            $fee_type_ids = $request->fee_type_ids;
            $qtys = $request->qtys;
            $invoice_amounts = array();
            foreach ($fee_type_ids as $key => $fee_type_id) {
                $student_invoice_detail = new StudentInvoiceDetail();
                $student_invoice_detail->student_invoice_id = $student_invoice->id;
                $student_invoice_detail->fee_type_id = $fee_type_id;
                $student_invoice_detail->quantity = $qtys[$key];
                $student_invoice_detail->save();
                array_push($invoice_amounts, $student_invoice_detail->quantity * $student_invoice_detail->feeType->amount);
            }
            $student_invoice->update(['total_amount' => array_sum($invoice_amounts) - $student_invoice->discount/100 * array_sum($invoice_amounts)]);
        }
        return redirect()->back()->with('success', 'Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = StudentInvoice::findOrFail($id);
        return view('superadmin.invoice.show', compact('invoice'));
    }

    public function markPaid($id){
        $invoice = StudentInvoice::findOrFail($id);
        $invoice->status = 'paid';
        $invoice->payment_date = Carbon::now();
        if($invoice->update()){
            return redirect()->back()->with('success', 'Updated successfully');
        }else{
            return redirect()->back()->with('error', 'Oops ! somthing went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = StudentInvoice::findOrFail($id);
        foreach ($invoice->invoiceDetails as $invoiceDetail) {
            $invoiceDetail->delete();
        }
        if($invoice->delete()){
            return redirect()->back()->with('success', 'Deleted successfully');
        }else{
            return redirect()->back()->with('error', 'Oops ! somthing went wrong');
        }
    }
}
