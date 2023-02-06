<?php

namespace App\Http\Controllers\Super\Fee;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignDiscountRequest;
use App\Models\AssignDiscount;
use App\Models\Category;
use App\Models\Eclass;
use App\Models\FeeDiscount;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class AssignDiscountController extends Controller
{
    public function index(FeeDiscount $feeDiscount){
        $classes = Eclass::all();
        $sections = Section::all();
        $categories = Category::all();
        return view('superadmin.fee.assign_discount', compact('feeDiscount', 'classes', 'sections', 'categories'));
    }

    public function search(Request $request){
        $feeDiscount = FeeDiscount::find($request->fee_discount_id);
        $classes = Eclass::all();
        $sections = Section::all();
        $categories = Category::all();
        $searchedStudents = Student::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->where('category_id', $request->category_id)
            ->where('gender', $request->gender)->get();
        return view('superadmin.fee.assign_discount', compact('searchedStudents', 'classes', 'sections', 'feeDiscount', 'categories'));
    }
    public function store(AssignDiscountRequest $request){
        foreach ($request->students as $student){
            $data = [
                'student_id' => $student,
                'fee_discount_id' => $request->fee_discount_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'gender' => $request->gender,
                'category_id' => $request->category_id,
            ];
            AssignDiscount::create($data);
        }
        return redirect()->route('assigned_discount.list')->with('success', 'Discount Assigned Successfully');
    }

    public function list(){
        $classes = Eclass::all();
        $sections = Section::all();
        $assignedDiscountStudents = AssignDiscount::with('student', 'fee_discount')->latest()->get();
        return view('superadmin.fee.assign_discount_list', compact('assignedDiscountStudents', 'classes', 'sections'));
    }

    public function assignedDiscountStudentSearch(Request $request){
        $classes = Eclass::all();
        $sections = Section::all();
        $assignedDiscountStudents = AssignDiscount::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)->get();
        return view('superadmin.fee.assign_discount_list', compact('assignedDiscountStudents', 'classes', 'sections'));
    }

    public function destroy($id){
        $assignedFee = AssignDiscount::find($id);
        $assignedFee->delete();
        return redirect()->back()->with('success', "Assigned Discount Deleted Successfully.");
    }

}
