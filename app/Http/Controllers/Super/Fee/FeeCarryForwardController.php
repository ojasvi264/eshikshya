<?php

namespace App\Http\Controllers\Super\Fee;

use App\Http\Controllers\Controller;
use App\Models\AssignFee;
use App\Models\Eclass;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeCarryForwardController extends Controller
{
    public function index(){
        $classes = Eclass::all();
        $sections = Section::all();
        return view('superadmin.fee.fee_carry_forward', compact('classes', 'sections'));
    }

    public function search(Request $request){
        $classes = Eclass::all();
        $sections = Section::all();
        $assignedStudents = AssignFee::where('class_id', $request->class_id)->where('section_id', $request->section_id)->with('student')->get();
        return view('superadmin.fee.fee_carry_forward', compact('classes', 'sections', 'assignedStudents'));
    }

    public function store(Request $request){
        foreach ($request->assign_fee_id as $key => $assign_id) {
            $previousFee = AssignFee::find($assign_id);
            $previousFee->previous_session_fee = $request->balance[$key];
            $previousFee->update();
        }
        return redirect()->back()->with('success', 'Previous Session Fee Stored Successfully.');
    }
}
