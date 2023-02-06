<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Models\Eclass;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\Subject;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::latest()->get();
        $classes = Eclass::all();
        $sections = Section::with('class')->get();
        $groups = Group::all();
        $subjects = Subject::all();
        return view('dashboard.pages.lesson_plan.lesson', compact('lessons', 'classes', 'sections', 'groups', 'subjects'));
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
    public function store(StoreLessonRequest $request)
    {
        Lesson::create($request->all());
        return redirect()->route('admin.lesson.index')->with('success', 'Created successfully');

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
    public function edit(Lesson $lesson)
    {
        $lessons = Lesson::whereNotIn('id', [$lesson->id])->get();
        $classes = Eclass::all();
        $sections = Section::with('class')->get();
        $groups = Group::all();
        $subjects = Subject::all();
        return view('dashboard.pages.lesson_plan.lesson', compact('lesson', 'classes', 'sections', 'subjects', 'groups', 'lessons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->all());
        return redirect()->route('admin.lesson.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
    public function getSubjectLessons($id)
    {
        return json_encode(Lesson::where('subject_id', $id)->get());
    }
}
