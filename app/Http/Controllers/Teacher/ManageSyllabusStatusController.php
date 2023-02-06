<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Eclass;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\Subject;

class ManageSyllabusStatusController extends Controller
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
        $subjects = Subject::all();
        return view('dashboard.pages.lesson_plan.manage_syllabus_status', compact('classes', 'sections', 'subjects'));
    }


    public function getLessons(Request $request){
        $classes = Eclass::all();
        $sections = Section::all();
        $subjects = Subject::all();
        $searchedLessons = Lesson::where([
            ['class_id', $request->class_id],
            ['section_id', $request->section_id],
            ['subject_id', $request->subject_id],
        ])->with('topics')->get();
//        dd($searchedLessons);
        return view('dashboard.pages.lesson_plan.manage_syllabus_status', compact('classes', 'sections', 'subjects', 'searchedLessons'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
