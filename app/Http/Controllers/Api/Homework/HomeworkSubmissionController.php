<?php

namespace App\Http\Controllers\APi\Homework;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeworkSubmissionRequest;
use App\Http\Requests\UpdateHomeworkSubmissionRequest;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeworkSubmissionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Models\Homework $homework
     * @return \Illuminate\Http\Response
     */
    public function homeworkSearch(Homework $homework, Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'assign' => 'required|date',
        ]);
        $homework = DB::table('homework')
            ->join('eclasses', 'eclasses.id', '=', 'homework.class_id')
            ->join('sections', 'sections.id', '=', 'homework.section_id')
            ->join('subjects', 'subjects.id', '=', 'homework.subject_id')
            ->select('homework.id as homework_id', 'eclasses.name as class_name', 'sections.name as section_name', 'subjects.name as subject_name',
                'homework.assign as assign_date', 'homework.submission as submission_date', 'homework.image as homework', 'homework.description as homework_description')
            ->where('class_id', '=', $request->class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('subject_id', '=', $request->subject_id)
            ->where('assign', '=', $request->assign)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Homework List.',
            'data' => $homework,
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreHomeworkSubmissionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function homeworkSubmission(StoreHomeworkSubmissionRequest $request, Homework $homework)
    {
        $fileNames = [];
        if($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $imageName = $image->getClientOriginalName();
                $filename = date('YmdHi') . '.' . $imageName;
                $image->move(public_path('files/homeworkSubmission'), $filename);
                $fileNames[] = $filename;
            }
        }
        $homework = Homework::findOrFail($request->homework_id);
        $homeworkSubmission = HomeworkSubmission::create([
            'file' => json_encode($fileNames),
            'student_id'=> Auth::id(),
            'homework_id' => $homework->id,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Sucessfully submitted.',
            'data' => $homeworkSubmission,
        ], Response::HTTP_OK);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UpdateHomeworkSubmissionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function homeworkSubmissionUpdate(UpdateHomeworkSubmissionRequest $request,Homework $homework, $id)
    {
        $homework = Homework::findOrFail($request->homework_id);
        $homeworkSubmission = HomeworkSubmission::findOrFail($id);
        $fileNames = [];
        if($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $imageName = $image->getClientOriginalName();
                $filename = date('YmdHi') . '.' . $imageName;
                $image->move(public_path('files/homeworkSubmission'), $filename);
                $fileNames[] = $filename;
            }
        }
        $homeworkSubmission->file = json_encode($fileNames);
        $homeworkSubmission->student_id = Auth::id();
        $homeworkSubmission->homework_id = $homework->id;
        $homeworkSubmission->update();
        return response()->json([
            'success' => true,
            'message' => 'Sucessfully submitted.',
            'data' => $homeworkSubmission,
        ], Response::HTTP_OK);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $homeworkSubmission= DB::table('homework_submissions')
            ->join('homework', 'homework.id', '=', 'homework_submissions.homework_id')
            ->join('students', 'students.id', '=', 'homework_submissions.student_id')
            ->select('homework_submissions.id as submission_id','homework_submissions.homework_id as homework_id',
                'students.fname as student_name', '','homework_submissions.file as homework')
            ->where('homework.id','=', $request->homework_id)
            ->get();
        return response()->json($homeworkSubmission);
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
     * Display the specified resource.
     *
     * @param  \App\Models\HomeworkSubmission  $homeworkSubmission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $homeworkSubmission = HomeworkSubmission::findorFail($id);
        return $homeworkSubmission;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeworkSubmission  $homeworkSubmission
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeworkSubmission $homeworkSubmission)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeworkSubmission  $homeworkSubmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeworkSubmission $homeworkSubmission)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeworkSubmission  $homeworkSubmission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $homeworkSubmission = HomeworkSubmission::findOrFail($id);
        $homeworkSubmission ->delete();
        return response()->json([
            'success' => true,
            'message'=>'Successfully deleted.',
        ],Response::HTTP_OK);
    }
}
