<?php

namespace App\Http\Controllers\StudentInformation;

use App\Http\Controllers\Controller;
use App\Models\StudentInfoCategory;
use Illuminate\Http\Request;

class StudentInfoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentInfoCategory = StudentInfoCategory::all();
        return response()->json($studentInfoCategory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.student_information.studentInfoCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $studentinfocategory = new StudentInfoCategory();
        $studentinfocategory->name = $request->name;
        $studentinfocategory->save();
        return redirect('studentinfocategory/view')->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentInfoCategory  $studentInfoCategory
     * @return \Illuminate\Http\Response
     */
    public function show(studentInfoCategory $studentInfoCategory)
    {
        $studentInfoCategory = StudentInfoCategory::all();
        return view('dashboard.pages.studentinfocategory',compact('studentInfoCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentInfoCategory  $studentInfoCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentInfoCategory $studentInfoCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentInfoCategory  $studentInfoCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentInfoCategory $studentInfoCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentInfoCategory  $studentInfoCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentInfoCategory $studentInfoCategory, $id)
    {
        $studentInfoCategory = StudentInfoCategory::findOrFail($id);
        $studentInfoCategory->delete();
        return redirect('studentInfoCategory')->with('success', 'Deleted successfully');
    }
}
