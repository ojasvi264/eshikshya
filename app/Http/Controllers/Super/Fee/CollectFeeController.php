<?php

namespace App\Http\Controllers\Super\Fee;

use App\Http\Controllers\Controller;
use App\Models\AssignDiscount;
use App\Models\AssignFee;
use App\Models\CollectFee;
use App\Models\Eclass;
use App\Models\FeeGroup;
use App\Models\FeesType;
use App\Models\PaidFee;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;

class CollectFeeController extends Controller
{
    public function index(){
        $classes = Eclass::all();
        $sections = Section::all();
        return view('superadmin.fee.collect_fee', compact('classes', 'sections'));
    }
    public function search(Request $request){
        $classes = Eclass::all();
        $sections = Section::all();
        $searchedStudents = Student::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)->get();
        return view('superadmin.fee.collect_fee', compact('classes', 'sections', 'searchedStudents'));
    }

    public function collectFee($id){
        $student = Student::find($id);
//        $assignFees = AssignFee::where('student_id', $id)->get();
//        $assignDiscounts = AssignDiscount::where('student_id', $id)->get();
//        $collectFees = $assignFees->concat($assignDiscounts);
        $studentData = DB::table('students')
            ->leftJoin('assign_fees', 'assign_fees.student_id', '=', 'students.id')
            ->leftJoin('fee_masters', 'fee_masters.id', '=', 'assign_fees.fee_master_id')
            ->leftjoin('fee_groups', 'fee_groups.id', '=', 'fee_masters.fee_group_id')
            ->leftjoin('fees_types', 'fees_types.id', '=', 'fee_masters.fees_type_id')
            ->leftJoin('assign_discounts', 'assign_discounts.student_id', '=', 'students.id')
            ->leftJoin('fee_discounts', 'fee_discounts.id', '=', 'assign_discounts.fee_discount_id')
            ->where('students.id', $id)
            ->select('students.id', 'fee_masters.fee_group_id', 'fee_masters.fee_group_id', 'fee_masters.fees_type_id as fees_type_id',
                'assign_fees.month_name', 'assign_fees.previous_session_fee', 'fee_masters.due_date', 'fee_masters.fine_type', 'fee_masters.amount as fee_amount', 'fee_masters.percentage as fine_percentage',
                'fee_masters.fine_amount', 'fee_discounts.fees_type_id as discount_fee_type_id', 'fee_discounts.discount_type', 'fee_discounts.amount as discount_amount',
                'fee_discounts.percentage as discount_percentage', 'fees_types.name as fee_type_name', 'fee_groups.name as fee_group_name')
            ->get();
        return view('superadmin.fee.add_fee', compact('student','studentData'));
    }

    public function dueFees(){
        $classes = Eclass::all();
        $sections = Section::all();
        return view('superadmin.fee.due_fees', compact('classes', 'sections'));
    }

    public function paidFee(Request $request)
    {
        $paidData = [
            'date' => $request->date,
            'payment_mode' => $request->payment_mode,
            'paid_amount' => $request->paid_amount,
            'note' => $request->description,
        ];
        $paidFee = PaidFee::create($paidData);

        $remainingAmount = $request->paid_amount;

       foreach ($request->fees_type_id as $key => $fees_type){
           if ($remainingAmount == 0){
               break;
           }
           if ($remainingAmount < $request->balance[$key]){
               $status = 0;
               $payableAmount = $remainingAmount;
           }else{
               $status = 1;
               $payableAmount = $request->balance[$key];
           }
           $data = [
               'paid_fee_id' => $paidFee->id,
               'student_id' => $request->student_id,
               'fees_type_id' => $fees_type,
               'due_date' => $request->dueDate[$key],
               'fee_amount' => $request->feeAmount[$key],
               'discount' => $request->discount[$key],
               'fine' => $request->fineAmount[$key],
               'previous_session_fee' => $request->previousSessionFee[$key],
               'total_balance' => $request->balance[$key],
               'month_name' => $request->monthName[$key],
               'status' => $status,
           ];
           CollectFee::create($data);
           $remainingAmount = $remainingAmount - $payableAmount;
       }
       return redirect()->back()->with('paidFee', $paidFee)->with('success', 'Fee Stored successfully');
    }
}
