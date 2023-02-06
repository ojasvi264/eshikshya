<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Eclass;
use App\Models\Exam;
use App\Models\ExamMark;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;;

class ExamMarkController extends Controller
{
    public function index(){
        $classes = Eclass::all();
        $exams = Exam::whereStatus('1')->get();
        return view('superadmin.exam_marks.index', compact( 'classes','exams'));
    }

    public function create(Request $request){
        //dd($request->all());
        $students = Student::all('id', 'fname');
        $exist = ExamMark::where('exam_id', $request->exam_id)->where('eclasses_id', $request->class_id)->where('subject_id', $request->subject_id)->whereIn('student_id', Student::pluck('id')->toArray())->count();
        if($exist == 0){
            foreach ($students as $student){
                $exam_mark = new ExamMark();
                $exam_mark->exam_id = $request->exam_id;
                $exam_mark->eclasses_id = $request->class_id;
                $exam_mark->subject_id = $request->subject_id;
                $exam_mark->student_id = $student->id;
                $exam_mark->save();
            }
        }

        $exam = Exam::findOrFail($request->exam_id);
        $class = Eclass::findOrFail($request->class_id);
        $section = Section::findOrFail($request->section_id);
        $subject = Subject::findOrFail($request->subject_id);

        return redirect()->route('exam_mark.edit', [$exam->id, $class->id, $section->id, $subject->id]);
        //$exam_mark = ExamMark::where('')->
    }

    public function edit(Request $request){
        $exam = Exam::findOrFail($request->exam_id);
        $class = Eclass::findOrFail($request->class_id);
        $section = Section::findOrFail($request->section_id);
        $subject = Subject::findOrFail($request->subject_id);
        $classes = Eclass::all();
        $exams = Exam::whereStatus('1')->get();
        $datas =  ExamMark::where('exam_id', $request->exam_id)->where('eclasses_id', $request->class_id)->where('subject_id', $request->subject_id)->get();
        return view('superadmin.exam_marks.edit', compact( 'classes','exams', 'exam', 'class', 'section', 'subject','classes', 'datas'));
    }

    public function update(Request $request){
        $student_ids = $request->student_ids;
        $theory_marks = $request->theory_marks;
        $practical_marks = $request->practical_marks;

        foreach ($student_ids as $key => $student_id){
            $exam_mark = ExamMark::where('exam_id', $request->exam_id)->where('eclasses_id', $request->class_id)->where('subject_id', $request->subject_id)->where('student_id', $student_id)->first();
            $exam_mark->theory_mark = $theory_marks[$key];
            $exam_mark->practical_mark = ($request->practical_marks) ? $practical_marks[$key] : 0;
            $exam_mark->update();
        }

        return redirect()->route('exam_mark.index')->with('success', 'Added Successfully.');
    }
}
