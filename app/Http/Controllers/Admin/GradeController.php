<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\ExaminationType;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gradeCreate()
    {
        return view('superadmin.examination.marksGrade.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreGradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function gradeStore(StoreGradeRequest $request)
    {
        $grade = new Grade();
        $grade->examType_id = $request->examType_id;
        $grade->grade_name= $request->grade_name;
        $grade->percent_upto= $request->percent_upto;
        $grade->percent_from= $request->percent_from;
        $grade->grade_point= $request->grade_point;
        $grade->description= $request->description;
        $grade->save();
        return redirect()->route('admin.grade')->with('success', 'Created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade $grade
     * @return \Illuminate\Http\Response
     */
    public function dropDownShow(Grade $grade)
    {
        $types = ExaminationType::select('id','exam_type')->get();
        $grade =Grade::all();
        return view ('superadmin.examination.marksGrade.index', ['types'=> $types],compact('grade'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function gradeEdit($id)
    {
        $types = ExaminationType::select('id','exam_type')->get();
        $marks = Grade::all();
        $grade = Grade::find($id);
        return view('superadmin/examination/marksGrade/edit', ['types'=> $types,'grade' => $grade,'marks' => $marks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function gradeUpdate(UpdateGradeRequest $request)
    {
        $grade = Grade::find($request->id);
        $grade->examType_id = $request->examType_id;
        $grade->grade_name= $request->grade_name;
        $grade->percent_upto= $request->percent_upto;
        $grade->percent_from= $request->percent_from;
        $grade->grade_point= $request->grade_point;
        $grade->description= $request->description;
        $grade->update();
        return redirect()->route('admin.grade')->with('success', 'Created successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function gradeDestroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade ->delete();
        return redirect()->route('admin.grade')->with('success', 'Deleted successfully');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
    }
}
