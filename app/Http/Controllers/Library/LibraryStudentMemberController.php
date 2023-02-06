<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Eclass;
use App\Models\LibraryStudentMember;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class LibraryStudentMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Eclass::all();
        $sections = Section::all();
        $students = Student::with('issue_return')->latest()->get();
        return view('dashboard.pages.library.library_student_member', compact('students', 'classes', 'sections'));
    }

    public function getStudents(Request $request){
        $classes = Eclass::all();
        $sections = Section::all();
        $searchedStudents = Student::where([
            ['class_id', $request->class_id],
            ['section_id', $request->section_id],
        ])->get();
        return view('dashboard.pages.library.library_student_member', compact('classes', 'sections', 'searchedStudents'));
    }
}
