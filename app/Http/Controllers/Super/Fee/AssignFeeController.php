<?php

namespace App\Http\Controllers\Super\Fee;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignFeeRequest;
use App\Models\AssignFee;
use App\Models\Eclass;
use App\Models\FeeMaster;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class AssignFeeController extends Controller
{
    public function index(FeeMaster $feeMaster){
        $classes = Eclass::all();
        $sections = Section::all();
        return view('superadmin.fee.assign_fee', compact('feeMaster', 'classes', 'sections'));
    }

    public function search(Request $request){
        $feeMaster = FeeMaster::find($request->fee_master_id);
        $classes = Eclass::all();
        $sections = Section::all();
        $searchedStudents = Student::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->where('gender', $request->gender)->get();
        return view('superadmin.fee.assign_fee', compact('searchedStudents', 'classes', 'sections', 'feeMaster'));
    }
    public function store(AssignFeeRequest $request){
        foreach ($request->students as $student){
            $data = [
                'student_id' => $student,
                'fee_master_id' => $request->fee_master_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'gender' => $request->gender,
                'month_name' => $request->month_name ?? '',
            ];
        AssignFee::create($data);
        }
        return redirect()->route('assign_fee.list')->with('success', 'Fee Assigned Successfully');
    }

    public function list(){
        $classes = Eclass::all();
        $sections = Section::all();
        $assignedFeeStudents = AssignFee::with('student', 'fee_master')->latest()->get();
        return view('superadmin.fee.assign_fee_list', compact('assignedFeeStudents', 'classes', 'sections'));
    }

    public function assignedStudentSearch(Request $request){
        $classes = Eclass::all();
        $sections = Section::all();
        $assignedFeeStudents = AssignFee::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)->get();
        return view('superadmin.fee.assign_fee_list', compact('assignedFeeStudents', 'classes', 'sections'));
    }

    public function destroy($id){
        $assignedFee = AssignFee::find($id);
        $assignedFee->delete();
        return redirect()->back()->with('success', "Assigned Fee Deleted Successfully.");
    }
}
