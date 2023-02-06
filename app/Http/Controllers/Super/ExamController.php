<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Eclass;
use App\Models\Exam;
use App\Models\ExaminationType;
use App\Models\ExamStudent;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\ExamRequest;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Exam::all();
        $classes = Eclass::all();
        $sections = Section::all();
        $exam_types = ExaminationType::all();
        return view('superadmin.exam.index', compact('datas', 'classes', 'sections', 'exam_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        $exam = Exam::where('date_from', '=', $request->date_from)
            ->where('date_to', '=', $request->date_to )
            ->first();
        if ($exam === null) {
            Exam::create($request->all());
            return redirect()->back()->with('success', 'Added successfully.');
        }else{
            return redirect()->back()->with('error', 'Data already exists.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        $classes = Eclass::all();
        $sections = Section::all();
        $exam_types = ExaminationType::all();
        return view('superadmin.exam.edit', compact('exam', 'classes', 'sections', 'exam_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ExamRequest  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, Exam $exam)
    {
        $exam->update($request->all());
        return redirect()->route('exam.index')->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->update(['status' => 0]);
        return redirect()->route('exam.index')->with('success', 'Deleted successfully.');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function restore(Exam $exam)
    {
        $exam->update(['status' => 1]);
        return redirect()->route('exam.index')->with('success', 'Restored successfully.');
    }


    /**
     * @param $exam_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function student($exam_id){
        $exam = Exam::findOrFail($exam_id);
        $datas = ExamStudent::whereExamId($exam->id)->get();
        $students = Student::where('class_id',$exam->eclasses_id)->where('section_id',$exam->section_id)->orderBy('roll', 'asc')->get();
        return view('superadmin.exam.student', compact('datas', 'exam', 'students'));
    }


    /**
     * @param Request $request
     * @return void
     */
    public function studentStore(Request $request){
        foreach ($request->studentids as $studentid){
            if(is_null(ExamStudent::where('student_id', $studentid)->where('exam_id', $request->exam_id)->first())){
                $exam_student = new ExamStudent();
                $exam_student->student_id = $studentid;
                $exam_student->exam_id = $request->exam_id;
                $exam_student->save();
            }
        }

        return redirect()->back()->with('success', 'Added successfully.');
    }
}
