<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Eclass;
use App\Models\Exam;
use App\Models\ExaminationType;
use App\Models\ExamSchedule;
use App\Models\ExamStudent;
use App\Models\SchoolSetting;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class PrintMarksheetController extends Controller
{
    public function index(){
        $exam_types = ExaminationType::all();
        return view('superadmin.print_marksheet.index', compact( 'exam_types'));
    }

    public function getStudent(Request $request){
        $exam_types = ExaminationType::all();
        $selected_exam = Exam::findOrFail($request->exam_id);
        $selected_class = Eclass::findOrFail($selected_exam->eclasses_id);
        $exams = Exam::whereStatus('1')->where('exam_type_id', $request->exam_type_id)->get();
        $selected_exam_type = ExaminationType::find($request->exam_type_id);
        $student_ids = ExamStudent::where('exam_id', $selected_exam->id)->pluck('id')->toArray();
        $datas = Student::where('class_id', $selected_class->id)->where('section_id', $selected_exam->section_id)->whereIn('id', $student_ids)->get();
        return view('superadmin.print_marksheet.student', compact( 'exams', 'selected_class', 'datas', 'selected_exam_type', 'exam_types', 'selected_exam'));
    }

    public function generate(Request $request){
        $school = SchoolSetting::find(1);
        $student_ids = $request->studentids;
        $exam = Exam::find($request->exam_id);
        $class = Eclass::find($request->class_id);
        $subject_ids = ExamSchedule::where('exam_id', $exam->id)->where('eclasses_id', $class->id)->pluck('id')->toArray();
        $subjects = Subject::where('eclasses_id', $class->id)->whereIn('id', $subject_ids)->get();
        if($school->result_type == 'grade') {
            return view('superadmin.print_marksheet.print_grade', compact('school' , 'student_ids', 'subjects' , 'class', 'exam'));
        }else{
            return view('superadmin.print_marksheet.print_percentage', compact('school', 'student_ids', 'subjects' , 'class', 'exam'));
        }
    }
}
