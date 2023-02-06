<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateHomeworkRequest;
use App\Http\Requests\StoreHomeworkRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeworkController extends Controller
{

    /*   public function show($id)
       {
           $homework = Homework::find($id);

           return view('homeworkSubmission', compact('homework'));
       }*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function homeworkCreate()
    {
        return view('superadmin.homework.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHomeworkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function homeworkStore(Request $request)
    {
        $homework = Homework::where('class_id', '=', $request->class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('subject_id', '=', $request->subject_id)
            ->where('assign', '=', $request->assign)
            ->where('submission', '=', $request->submission)
            ->where('submission_time', '=', $request->submission_time)
            ->where('teacher_id', '=', $request->teacher_id)
            ->first();
        if ($homework === null) {
            $homework = new Homework();
            $homework->class_id = $request->class_id;
            $homework->section_id = $request->section_id;
            $homework->subject_id = $request->subject_id;
            $homework->assign = $request->assign;
            $homework->submission = $request->submission;
            $homework->submission_time = $request->submission_time;
            $homework->description = $request->description;
            $homework->teacher_id = $request->teacher_id;
            if($request->hasfile('image'))
            {
                $img = $request->file('image');
                $extension = $img->getClientOriginalName();
                $filename = date('YmdHi').'.'.$extension;
                $img-> move(public_path('public/images/homework'), $filename);
                $homework['image'] = $filename;
            }
            $homework->save();
            return redirect()->back()->with('success', 'Created successfully');
        }
        else{
            return redirect()->back()->with('error', 'Data already exists.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function homeworkDropDownShow(Homework $homework)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        $subject= DB::table('subjects')->select('id','name')->get();
        $teacher= DB::table('users')->select('id','name')->where('user_type', '=','teacher')->get();
        $homework = Homework::all();
        return view ('superadmin.homework.index', ['class'=> $class, 'section'=>$section, 'subject'=>$subject, 'teacher'=>$teacher],compact('homework'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function homeworkSubmissionView($id)
    {
        $user= DB::table('users')->select('id','name')->get();
        $homework = Homework::findorFail($id);
        return view ('superadmin/homework/view', ['user'=> $user],compact('homework'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function submittedHomeworkView($id)
    {
        $user= DB::table('users')->select('id','name')->get();
        //$homeworkSubmission= DB::table('homework_submissions')->select('id','created_at')->get();
        //$homeworkSubmission = Homework::all();
        $homeworkSub = HomeworkSubmission::findorFail($id);
        return view ('superadmin/homework/show', ['user'=> $user],compact('homeworkSub'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function homeworkEdit($id)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        $subject= DB::table('subjects')->select('id','name')->get();
        $teacher= DB::table('users')->select('id','name')->where('user_type', '=','teacher')->get();
        $home = Homework::all();
        $homework = Homework::find($id);
        return view('superadmin/homework/edit', ['class'=> $class,'section' => $section,'subject' => $subject,'teacher'=>$teacher, 'home' => $home, 'homework' => $homework]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHomeworkRequest  $request
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function homeworkUpdate(UpdateHomeworkRequest $request)
    {
        $homework = Homework::findorFail($request->id);
        $homework->class_id = $request->class_id;
        $homework->section_id = $request->section_id;
        $homework->subject_id = $request->subject_id;
        $homework->assign = $request->assign;
        $homework->submission = $request->submission;
        $homework->submission_time = $request->submission_time;
        $homework->description = $request->description;
        $homework->teacher_id = $request->teacher_id;
        if($request->hasfile('image'))
        {
            $img = $request->file('image');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('public/images/homework'), $filename);
            Storage::disk('local')->put('public/images/homework/'.$filename,'public');
            $homework['image'] = $filename;
        }

        $homework->update();
        return redirect()->route('teacher.homework')->with('success', 'Updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function homeworkDestroy(Homework $homework, $id)
    {
        $homework = Homework::findOrFail($id);
        $homework ->delete();
        return redirect()->route('teacher.homework')->with('success', 'Deleted successfully');
    }
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
            ->join('teachers', 'teachers.id', '=', 'homework.teacher_id')
            ->select('homework.id as homework_id', 'eclasses.name as class_name', 'sections.name as section_name' ,'subjects.name as subject_name', 'teachers.fname as teacher_name', 'homework.assign as assign_date','homework.submission as submission_date', 'homework.submission_time as submission_time', 'homework.image as homework', 'homework.description as homework_description')
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
        $homework = Homework::where('class_id', '=', $request->class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('subject_id', '=', $request->subject_id)
            ->where('assign', '=', $request->assign)
            ->where('submission', '=', $request->submission)
            ->where('description', '=', $request->description)
            ->where('submission_time', '=', $request->submission_time)
            ->where('teacher_id', '=', $request->teacher_id)
            ->first();
        if ($homework === null) {
            $homework = new Homework();
            $homework->class_id = $request->class_id;
            $homework->section_id = $request->section_id;
            $homework->subject_id = $request->subject_id;
            $homework->assign = $request->assign;
            $homework->submission = $request->submission;
            $homework->submission_time = $request->submission_time;
            $homework->description = $request->description;
            $homework->teacher_id = $request->teacher_id;
            if($request->hasfile('image'))
            {
                $img = $request->file('image');
                $extension = $img->getClientOriginalName();
                $filename = date('YmdHi').'.'.$extension;
                $img-> move(public_path('public/images/homework'), $filename);
                Storage::disk('local')->put('public/images/homework/'.$filename,'public');
                $homework['image'] = $filename;
            }
            $homework->save();
            return response()->json([
                'success' => true,
                'message'=>'Successfully created.',
                'data'=>$homework,
            ],Response::HTTP_OK);
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
            if($request->hasfile('image'))
            {
                $img = $request->file('image');
                $extension = $img->getClientOriginalName();
                $filename = date('YmdHi').'.'.$extension;
                $img-> move(public_path('public/images/homework'), $filename);
                Storage::disk('local')->put('public/images/homework/'.$filename,'public');
                $homework['image'] = $filename;
            }
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
