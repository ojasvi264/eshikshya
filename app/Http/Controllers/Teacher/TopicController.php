<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Eclass;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTopicRequest;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        $lessons = Lesson::all();
        $classes = Eclass::all();
        $sections = Section::with('class')->get();
        $groups = Group::all();
        $subjects = Subject::all();
        return view('dashboard.pages.lesson_plan.topic', compact('lessons', 'classes', 'sections', 'groups', 'subjects', 'topics'));
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
    public function store(StoreTopicRequest $request)
    {
        Topic::create($request->all());
        return redirect()->route('teacher.topic.index')->with('success', 'Created successfully');
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
    public function edit(Topic $topic)
    {
        $topics = Topic::whereNotIn('id', [$topic->id])->get();
        $lessons = Lesson::all();
        $classes = Eclass::all();
        $sections = Section::with('class')->get();
        $groups = Group::all();
        $subjects = Subject::all();
        return view('dashboard.pages.lesson_plan.topic', compact('topic', 'classes', 'sections', 'subjects', 'groups', 'lessons', 'topics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTopicRequest $request, Topic $topic)
    {
        $topic->update($request->all());
        return redirect()->route('teacher.topic.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function completionDate(Request $request, $id){
        $completionDate = Topic::find($id);
        $completionDate->status = 1;
        $completionDate->completion_status = 1;
        $completionDate->completion_date = $request->completion_date;
        $completionDate->save();
        return response(json_encode($completionDate));
    }

    public function removeCompletionDate($id){
        $completionDate = Topic::find($id);
        $completionDate->status = 0;
        $completionDate->completion_status = 0;
        $completionDate->completion_date = null;
        $completionDate->save();
        return response(json_encode($completionDate));
    }
}
