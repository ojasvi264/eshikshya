<?php

namespace App\Http\Controllers\Homework;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeworkSubmissionRequest;
use App\Http\Requests\UpdateHomeworkSubmissionRequest;
use App\Models\Eclass;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeworkSubmissionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHomework()
    {
        $getHomework = Homework::all();
        return view ('student.homework.homeworkList',compact('getHomework'));
          /*  $getHomework = DB::table('eclasses')
                ->join('homework', 'homework.class_id', '=', 'eclasses.id')
                ->join('students', 'students.class_id', '=', 'eclasses.id')
                ->where(['students.class_id' => 'homework.class_id'])
                ->get();
            return view ('student.homework.homeworkList',compact('getHomework'));*/
     /*   $homework = Homework::join('eclasses', 'eclasses.id', '=', 'homework.class_id')
            ->where('class_id', '=', Auth::user()->class_id)
            ->get();*/

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeworkSubmission  $homeworkSubmission
     * @return \Illuminate\Http\Response
     */
    public function submissionUpload($id)
    {
        $homework = Homework::findorFail($id);
        //return view ('student.homework.submission', compact('homework'));
        return view('student/homework/submission', ['homework' => $homework]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreHomeworkSubmissionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function homeworkSubmit(Request $request)
    {
        $this->validate($request,[
            'file'=>'required',
            'homework_id'=>'required|exists:homework,id'
        ]);
        foreach ($request->file('file') as $image){
            $imageName = $image->getClientOriginalName();
            $filename = date('YmdHi').'.'.$imageName;
            $image->move(public_path('files/homeworkSubmission') ,$filename);
            $fileNames[] = $filename;
        }
        $homework = Homework::findOrFail($request->homework_id);
        $homeworkSubmission = HomeworkSubmission::create([
            'file' => json_encode($fileNames),
            'student_id'=> $request->student()->id,
            'homework_id' => $homework->id,
        ]);
        $homeworkSubmission->save();
        return redirect()->back()->with('success', 'Submitted successfully');
    }
    public function userSubmissionView($id)
    {
        $homework = Homework::findorFail($id);
        return view ('student.homework.submissionShow', compact('homework'));
    }
    public function userSubmissionShow()
    {
       // $homework = Homework::findorFail($request->id);
        $user = Auth::user();
        $homeworkSubmissionTest = HomeworkSubmission::where('student_id', Auth::id())
            ->orderBy('created_at','desc')
            ->get();
        $homeworkSubmission = HomeworkSubmission::join('homework', 'homework.id', '=', 'homework_submissions.homework_id')
            ->where('homework.id', '=' ,'homework_submissions.homework_id')
            ->where('student_id', '=', Auth::id())
            ->get();
        return view ('student.homework.submissionShow', ['user'=> $user], compact('homeworkSubmissionTest'));
    }
    public function submissionEdit($id)
    {
        $submission = HomeworkSubmission::all();
        $homeworkSubmission = HomeworkSubmission::find($id);
        return view('student/homework/submissionEdit', [ 'submission' => $submission, 'homeworkSubmission' => $homeworkSubmission]);
    }
    public function submissionUpdate(UpdateHomeworkSubmissionRequest $request)
    {
        $homeworkSubmission = HomeworkSubmission::find($request->id);
        foreach ($request->file('file') as $image){
            $imageName = $image->getClientOriginalName();
            $filename = date('YmdHi').'.'.$imageName;
            $image->move(public_path('files/homeworkSubmission') ,$filename);
            $fileNames[] = $filename;
        }
        $homeworkSubmission->file=json_encode($fileNames);
        //$homework = Homework::findOrFail($request->homework_id);
        $homeworkSubmission->update();
        return redirect()->route('homework-submission')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeworkSubmission  $homeworkSubmission
     * @return \Illuminate\Http\Response
     */
    public function submissionDestroy($id)
    {
        $homeworkSubmission = HomeworkSubmission::findOrFail($id);
        $homeworkSubmission ->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreHomeworkSubmissionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHomeworkSubmissionRequest $request, Homework $homework, $id)
    {
        $homeworkSubmission = new HomeworkSubmission();
        $homeworkSubmission->homewrok_id = $request->homework_id;
        $homeworkSubmission->student_id = $request->student_id;
        if($request->hasfile('file'))
        {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('files/homeworkSubmission'), $filename);
            $homeworkSubmission->file = $filename;
        }
        $homework = Homework::findorFail($id);
        $homeworkSubmission->save();
        return $homeworkSubmission;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreHomeworkSubmissionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request, Homework $homework, $id)
    {
        $this->validate($request,[
            'file'=>'required',
        ]);
        $homeworkSubmission = new HomeworkSubmission();
        $homeworkSubmission->homework_id = $request->homework_id;
        $homeworkSubmission->student_id = $request->student_id;
        if($request->hasfile('file'))
        {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('files/homeworkSubmission'), $filename);
            $homeworkSubmission->file = $filename;
        }
        // $homework->homeworksubmissions()->save($homeworksubmission);
        $homework = Homework::findorFail($id);
        $homeworkSubmission->save();
        return $homeworkSubmission;
    }


}
