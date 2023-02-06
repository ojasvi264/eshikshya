<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\ExamGrade;
use Illuminate\Http\Request;
use App\Http\Requests\ExamGradeRequest;

class ExamGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam_grades = ExamGrade::all();
        return view('superadmin.exam_grade.index', compact('exam_grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ExamGradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamGradeRequest $request)
    {
        $exam_grade = ExamGrade::create($request->all());
        if($exam_grade){
            return  redirect()->back()->with('success', 'Created successfully');
        }else{
            return  redirect()->back()->with('error', 'Whoops !! Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamGrade  $examGrade
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamGrade $examGrade)
    {
        $examGrade = $examGrade;
        return view('superadmin.exam_grade.edit', compact('examGrade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ExamGradeRequest  $request
     * @param  \App\Models\ExamGrade  $examGrade
     * @return \Illuminate\Http\Response
     */
    public function update(ExamGradeRequest $request, ExamGrade $examGrade)
    {
        $examGrade->update($request->all());
        if($examGrade){
            return  redirect()->route('exam_grade.index')->with('success', 'Updated successfully');
        }else{
            return  redirect()->back()->with('error', 'Whoops !! Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamGrade  $examGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamGrade $examGrade)
    {
        $examGrade->delete();
        return  redirect()->route('exam_grade.index')->with('success', 'Deleted successfully');
    }
}
