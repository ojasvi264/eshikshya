<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StaffDirectory;
use App\Models\Student;
use App\Models\TeacherRating;
use App\Http\Requests\StoreTeacherRatingRequest;

class TeacherRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = StaffDirectory::where('status', 1)->latest()->get();
        $students = Student::latest()->get();
        $teacherRatings = TeacherRating::latest()->get();
        return view('dashboard.pages.human_resource.teacher_rating', compact('staffs', 'students', 'teacherRatings'));
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
    public function store(StoreTeacherRatingRequest $request)
    {
        TeacherRating::create($request->all());
        return redirect()->route('student.teacher_rating.index')->with('success', 'Created Successfully.');
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
    public function edit(TeacherRating $teacherRating)
    {
        $staffs = StaffDirectory::where('status', 1)->latest()->get();
        $students = Student::latest()->get();
        $teacherRatings = TeacherRating::whereNotIn('id', [$teacherRating->id])->get();
        return view('dashboard.pages.human_resource.teacher_rating', compact('staffs', 'students', 'teacherRating', 'teacherRatings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTeacherRatingRequest $request, TeacherRating $teacherRating)
    {
        $teacherRating->update($request->all());
        return redirect()->route('student.teacher_rating.index')->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherRating $teacherRating)
    {
        $teacherRating->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
