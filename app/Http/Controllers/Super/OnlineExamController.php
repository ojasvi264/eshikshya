<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\OnlineExam;
use Illuminate\Http\Request;
use App\Http\Requests\OnlineExamRequest;
use App\Models\Eclass;
use App\Models\QuestionBank;
class OnlineExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $online_exams = OnlineExam::all();
        return view('superadmin.online_exam.index', compact('online_exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.online_exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\OnlineExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OnlineExamRequest $request)
    {
        $online_exam = new OnlineExam();
        $online_exam->is_quiz = ($request->is_quiz) ? $request->is_quiz : 0;
        $online_exam->title = $request->title;
        $online_exam->exam_from_date = $request->exam_from_date;
        $online_exam->exam_from_time = $request->exam_from_time;
        $online_exam->exam_to_date = $request->exam_to_date;
        $online_exam->exam_to_time = $request->exam_to_time;
        $online_exam->auto_publis_result_date = $request->auto_publis_result_date;
        $online_exam->auto_publis_result_time = $request->auto_publis_result_time;
        $online_exam->time_duration = $request->time_duration;
        $online_exam->number_of_attempt = $request->number_of_attempt;
        $online_exam->passing_percentage = $request->passing_percentage;
        $online_exam->publish_exam = $request->publish_exam;
        $online_exam->publish_result = ($request->is_quiz) ? '1' : '0';
        $online_exam->negative_marking = ($request->negative_marking) ? $request->negative_marking : 0;
        $online_exam->display_marks_in_exam = ($request->display_marks_in_exam) ? $request->display_marks_in_exam : 0;
        $online_exam->random_question_order = ($request->random_question_order) ? $request->random_question_order : 0;
        $online_exam->description = $request->description;

        if($online_exam->save()){
            return redirect()->route('online.exam.index')->with('success', 'Created successfully');
        }else{
            return redirect()->route('online.exam.index')->with('error', 'Opps!! somthing went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $online_exam = OnlineExam::findOrFail($id);
        return view('superadmin.online_exam.edit', compact('online_exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\OnlineExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(OnlineExamRequest $request)
    {
        $online_exam = OnlineExam::findOrFail($request->id);
        $online_exam->is_quiz = ($request->is_quiz) ? $request->is_quiz : 0;
        $online_exam->title = $request->title;
        $online_exam->exam_from_date = $request->exam_from_date;
        $online_exam->exam_from_time = $request->exam_from_time;
        $online_exam->exam_to_date = $request->exam_to_date;
        $online_exam->exam_to_time = $request->exam_to_time;
        $online_exam->auto_publis_result_date = $request->auto_publis_result_date;
        $online_exam->auto_publis_result_time = $request->auto_publis_result_time;
        $online_exam->time_duration = $request->time_duration;
        $online_exam->number_of_attempt = $request->number_of_attempt;
        $online_exam->passing_percentage = $request->passing_percentage;
        $online_exam->publish_exam = $request->publish_exam;
        $online_exam->publish_result = ($request->is_quiz) ? '1' : '0';
        $online_exam->negative_marking = ($request->negative_marking) ? $request->negative_marking : 0;
        $online_exam->display_marks_in_exam = ($request->display_marks_in_exam) ? $request->display_marks_in_exam : 0;
        $online_exam->random_question_order = ($request->random_question_order) ? $request->random_question_order : 0;
        $online_exam->description = $request->description;

        if($online_exam->update()){
            return redirect()->route('online.exam.index')->with('success', 'Updated successfully');
        }else{
            return redirect()->route('online.exam.index')->with('error', 'Opps!! somthing went wrong');
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
        $online_exam = OnlineExam::findOrFail($id);
        $online_exam->update(array('status' => 0));
        if($online_exam){
            return redirect()->route('online.exam.index')->with('success', 'Deleted successfully');
        }else{
            return redirect()->route('online.exam.index')->with('error', 'Opps!! somthing went wrong');
        }
    }


    /**
     * Restre the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $online_exam = OnlineExam::findOrFail($id);
        $online_exam->update(array('status' => 1));
        if($online_exam){
            return redirect()->route('online.exam.index')->with('success', 'Restored successfully');
        }else{
            return redirect()->route('online.exam.index')->with('error', 'Opps!! somthing went wrong');
        }
    }

    public function addQuestion($id){
        $online_exam = OnlineExam::findOrFail($id);
        $classes = Eclass::all();
        $question_types = array('single_choice','multiple_choice','true_or_false','descriptive');
        $question_levels = array('low','medium','high');
        $questions = $online_exam->questions;
        if($online_exam->is_quiz != 1){
            $question_banks = QuestionBank::whereStatus('1')->get();
        }else{
            $question_banks = QuestionBank::where('question_type', '!=', 'descriptive')->whereStatus('1')->get();
        }
        return view('superadmin.online_exam.add_question', compact('online_exam', 'classes', 'question_types', 'question_levels', 'question_banks', 'questions'));
    }

    public function assign($id){
        $online_exam = OnlineExam::findOrFail($id);
        $classes = Eclass::all();
        return view('superadmin.online_exam.assign',compact('online_exam','classes'));
    }
}
