<?php

namespace App\Http\Controllers\Homework;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeworkRequest;
use App\Http\Requests\UpdateHomeworkRequest;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\StaffDirectory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeworkController extends Controller
{
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
        if($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = $image->getClientOriginalName();
                $filename = date('YmdHi') . '.' . $imageName;
                $image->move(public_path('files/homework'), $filename);
                $fileNames[] = $filename;
            }
        }
        $homework->image=json_encode($fileNames);
        $homework->save();
        return redirect()->back()->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function homeworkDropDownShow(Homework $homework)
    {
        $section = DB::table('sections')->select('id', 'name')->get();
        $class = DB::table('eclasses')->select('id', 'name')->get();
        $subject = DB::table('subjects')->select('id', 'name')->get();
        $staffs = new StaffDirectory();
        $teacher = $staffs->whereHas('role', function ($query){
            $query->where('name', 'Teacher');
        });
        $homework = Homework::all();
        return view ('superadmin.homework.index', ['class'=> $class, 'section'=>$section, 'subject'=>$subject, 'teacher'=>$teacher->get()],compact('homework'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function homeworkSubmissionView($id)
    {
        $staffs = new StaffDirectory();
        $teacher = $staffs->whereHas('role', function ($query){
            $query->where('name', 'Teacher');
        });
        $homework = Homework::findorFail($id);
        return view ('superadmin/homework/view', ['teacher'=> $teacher->get()],compact('homework'));
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
        $homework = Homework::findorFail($id);
        return view ('superadmin/homework/view', ['user'=> $user],compact('homework'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function submissionDetailView($id)
    {
        $user= DB::table('users')->select('id','name')->get();
        $homeworkSub = HomeworkSubmission::findorFail($id);
        return view ('superadmin/homework/submissionDetails', ['user'=> $user],compact('homeworkSub'));
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
        $staffs = new StaffDirectory();
        $teacher = $staffs->whereHas('role', function ($query){
            $query->where('name', 'Teacher');
        });
        $home = Homework::all();
        $homework = Homework::find($id);
        return view('superadmin/homework/edit', ['class'=> $class,'section' => $section,'subject' => $subject,'teacher'=>$teacher->get(), 'home' => $home, 'homework' => $homework]);
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
        foreach ($request->file('image') as $image){
            $imageName = $image->getClientOriginalName();
            $filename = date('YmdHi').'.'.$imageName;
            $image->move(public_path('files/homework') ,$filename);
            $fileNames[] = $filename;
        }
        $homework->image=json_encode($fileNames);
        $homework->update();
        return redirect()->route('homework')->with('success', 'Updated successfully');
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
        return redirect()->route('homework')->with('success', 'Deleted successfully');
    }
}
