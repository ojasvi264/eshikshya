<?php

namespace App\Http\Controllers\APi\Homework;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeworkRequest;
use App\Http\Requests\UpdateHomeworkRequest;
use App\Models\Homework;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homework= DB::table('homework')
            ->join('eclasses', 'eclasses.id', '=', 'homework.class_id')
            ->join('sections', 'sections.id', '=', 'homework.section_id')
            ->join('subjects', 'subjects.id', '=', 'homework.subject_id')
            ->join('staff_directories', 'staff_directories.id', '=', 'homework.teacher_id')
            ->select('homework.id as homework_id', 'eclasses.name as class_name', 'sections.name as section_name' ,'subjects.name as subject_name',
                'staff_directories.name as teacher_name', 'homework.assign as assign_date','homework.submission as submission_date', 'homework.submission_time as submission_time',
                'homework.image as homework', 'homework.description as homework_description')
            ->orderBy('homework.assign','DESC')
            ->get();
        return response()->json([
            "success" => true,
            "message" => "Homework List",
            "data" => $homework
        ]);

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
     * @param  \App\Http\Requests\StoreHomeworkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHomeworkRequest $request)
    {
        $homework = new Homework();
        $homework->class_id = $request->class_id;
        $homework->section_id = $request->section_id;
        $homework->subject_id = $request->subject_id;
        $homework->assign = $request->assign;
        $homework->submission = $request->submission;
        $homework->submission_time = $request->submission_time;
        $homework->description = $request->description;
        $homework->teacher_id = $request->teacher_id;
        $fileNames = [];
        if($request->hasFile('image')){
            foreach ($request->file('image') as $image){
                $imageName = $image->getClientOriginalName();
                $filename = date('YmdHi').'.'.$imageName;
                $image-> move(public_path('files/homework'), $filename);
                Storage::disk('local')->put('files/homework/'.$filename,'public');
                $fileNames[] = $filename;
            }
        }
        $homework->image=json_encode($fileNames);
        if ($homework->save()){
            return response()->json([
                'success' => true,
                'message'=>'Successfully created.',
                'data'=>$homework,
            ],Response::HTTP_OK);
        }
        else{
            return response()->json([
                'success' => false,
                'message'=>'Something wrong.',
            ],Response::HTTP_BAD_REQUEST);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function show(Homework $homework, Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required',
            'assign' => 'required|date',
        ]);
        $homework= DB::table('homework')
            ->join('eclasses', 'eclasses.id', '=', 'homework.class_id')
            ->join('sections', 'sections.id', '=', 'homework.section_id')
            ->join('subjects', 'subjects.id', '=', 'homework.subject_id')
            ->select('homework.id as homework_id', 'eclasses.name as class_name', 'sections.name as section_name' ,'subjects.name as subject_name', 'homework.assign as assign_date','homework.submission as submission_date', 'homework.image as homework', 'homework.description as homework_description')
            ->where('class_id', '=',$request->class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('subject_id', '=', $request->subject_id)
            ->where('assign', '=', $request->assign)
            ->get();
        $test = ($request->class_id != null) || ($request->section_id != null) || ($request->subject_id != null) || ($request->assign != null);
        $home=Homework::where('class_id', '=', $request->class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('subject_id', '=', $request->subject_id)
            ->where('assign', '=', $request->assign)
            ->exists();
        if($test && $home){
            return response()->json([
                'success' => true,
                'data'=>$homework,
            ],Response::HTTP_OK);
        }
        else{
            return response()->json([
                'success' => false,
                'message'=>'No data found.',
                'data'=>null,
            ],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $homework= Homework::findOrFail($id);
        return $homework;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \App\Http\Requests\UpdateHomeworkRequest  $request
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeworkRequest $request, Homework $homework, $id)
    {
        $homework = Homework::where('id', '=', $id)
            ->where('class_id', '=', $request->class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('subject_id', '=', $request->subject_id)
            ->where('assign', '=', $request->assign)
            ->where('submission', '=', $request->submission)
            ->where('submission_time', '=', $request->submission_time)
            ->where('description', '=', $request->description)
            ->where('teacher_id', '=', $request->teacher_id)
            ->first();
        if ($homework === null) {
            $homework = Homework::findorFail($id);
            $homework->class_id = $request->class_id;
            $homework->section_id = $request->section_id;
            $homework->subject_id = $request->subject_id;
            $homework->assign = $request->assign;
            $homework->submission = $request->submission;
            $homework->submission_time = $request->submission_time;
            $homework->description = $request->description;
            $homework->teacher_id = $request->teacher_id;
            $fileNames = [];
            if($request->hasFile('image')){
                foreach ($request->file('image') as $image){
                    $imageName = $image->getClientOriginalName();
                    $filename = date('YmdHi').'.'.$imageName;
                    $image-> move(public_path('files/homework'), $filename);
                    Storage::disk('local')->put('files/homework/'.$filename,'public');
                    $fileNames[] = $filename;
                }
            }
            $homework->image=json_encode($fileNames);
            $homework->update();
            return response()->json([
                'success' => true,
                'message'=>'Successfully updated.',
                'data'=>$homework,
            ],Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $homework = Homework::findOrFail($id);
        $homework ->delete();
        return response()->json([
            'success' => true,
            'message'=>'Successfully deleted.',
        ],Response::HTTP_OK);
    }
}
