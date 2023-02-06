<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHomeworkSubmissionRequest;
use App\Http\Requests\UpdateHomeworkSubmissionRequest;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\User;

class HomeworkSubmissionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHomework()
    {
        $homework = Homework::all();
        return view ('student.homework',compact('homework'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeworkSubmission  $homeworkSubmission
     * @return \Illuminate\Http\Response
     */
    public function homeworkDetail($id)
    {
        $homework = Homework::findorFail($id);
        return view ('student.homework.submission', compact('homework'));
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
        if($request->hasfile('file'))
        {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('public/images/homeworkSubmission'), $filename);
            // Storage::disk('local')->put('public/images/homeworkSubmission/'.$filename,'public');
            $homeworkSubmission['file'] = $filename;
        }
        $homework = Homework::findOrFail($request->homework_id);
        $homeworkSubmission = HomeworkSubmission::create([
            'file' => $filename,
            'student_id'=> $request->user()->id,
            'homework_id' => $homework->id,
        ]);
        $homeworkSubmission->save();
        return redirect()->back()->with('success', 'Submitted successfully');

        /*     if ($homework->user_id != $homeworkSubmission->user_id) {
                 $user = User::find($post->user_id);
                 $user->notify(new NewCommentPost($comment));
             }*/
    }
    public function submissionShow(HomeworkSubmission $homeworkSubmission, $id)
    {
        $user = Auth::user();
        //$homeworkSubmission = Homework::find($homeworkSubmission->student_id);
        $homeworkSubmission = DB::table('homework_submissions')
            ->where('student_id', '=', Auth::id())
            ->get();
        return view ('student.homework.submission',['user'=>$user],compact('homeworkSubmission'));
    }
    public function submittedHomeworkView($id)
    {
        $submission = HomeworkSubmission::all();
        $homeworkSubmission = HomeworkSubmission::find($id);
        return view('superadmin/homework/show', [ 'submission' => $submission, 'homeworkSubmission' => $homeworkSubmission]);
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
        if($request->hasfile('file'))
        {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('public/images/homeworkSubmission'), $filename);
            // Storage::disk('local')->put('public/images/homeworkSubmission/'.$filename,'public');
            $homeworkSubmission['file'] = $filename;
        }
        $homework = Homework::findOrFail($request->homework_id);
        $homeworkSubmission->update();
        return redirect()->route('admin.homework-submission')->with('success', 'Updated successfully');
    }
    public function submissionDestroy($id)
    {
        $homeworkSubmission = HomeworkSubmission::findOrFail($id);
        $homeworkSubmission ->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeworksubmission= DB::table('homework_submissions')
            ->join('homework', 'homework.id', '=', 'homework_submissions.homework_id')
            ->join('students', 'users.id', '=', 'homework_submissions.student_id')
            ->select('homework_submissions.id as submission_id','homework_submissions.homework_id as homework_id', 'homework_submissions.student_id as student_id', 'homework_submissions.file as homework')
            ->get();
        return response()->json($homeworksubmission);
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
            $img-> move(public_path('public/images/homework'), $filename);
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
        /*   if ($request->hasFile('file')) {
                if ($homeworksubmission->file) {
                      unlink(storage_path('users/homeworksubmission/'.$homeworksubmission->file));
                  }

               $image = $request->file('file');
               $fileName = time().'.'.$image->getClientOriginalExtension();
               $img = Image::make($image->getRealPath())
                   ->resize(160, 160);
               $img->stream();
               Storage::disk('local')->put('users/homeworksubmission/'.$fileName, $img, 'public');
               $validated['file'] = 'users/homeworksubmission/'.$fileName;
           }
           $homeworksubmission->file = $validated['file'] ;
           $homeworksubmission->homework()->associate($homework);*/
        if($request->hasfile('file'))
        {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('public/images/homework'), $filename);
            $homeworkSubmission->file = $filename;
        }
        // $homework->homeworksubmissions()->save($homeworksubmission);
        $homework = Homework::findorFail($id);
        $homeworkSubmission->save();
        return $homeworkSubmission;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeworkSubmission  $homeworkSubmission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $homework = Homework::findorFail($id);
        return $homework;
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
    public function destroy(HomeworkSubmission $homeworkSubmission)
    {
        //
    }
}
