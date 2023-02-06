<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subjectCreate()
    {
        return redirect('subject');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function subjectStore(StoreSubjectRequest $request)
    {
        foreach ($request->eclasses_ids as $eclasses_id) {
            $subject = Subject::where('code', '=', $request->code)
                ->where('name', '=', $request->name)
                ->where('description', '=', $request->description)
                ->where('eclasses_id', '=', $request->eclasses_id)
                ->where('type', '=', $request->type)
                ->first();
            if ($subject === null) {
                $subject = new Subject();
                $subject->code = $request->code . '-' . $eclasses_id;
                $subject->name = $request->name;
                $subject->description = $request->description;
                $subject->eclasses_id = $eclasses_id;
                $subject->type = $request->type;
                $subject->credit_hour = $request->credit_hour;
                $subject->theory_full_marks = $request->theory_full_marks;
                $subject->practical_full_marks = ($request->practical_full_marks) ? $request->practical_full_marks : 0;
                $subject->theory_pass_marks = ($request->theory_pass_marks) ? $request->theory_pass_marks : 0;
                $subject->practical_pass_marks = ($request->practical_pass_marks) ? $request->practical_pass_marks : 0;
                $subject->save();
            }
        }
        return redirect()->route('subject')->with('success', 'Created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function classDropDownShow(Subject $subject)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        $subject = Subject::all();
        return view ('superadmin.academics.subject.index', ['class'=> $class, 'section'=>$section],compact('subject'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function subjectEdit($id)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        $sub = Subject::all();
        $subject = Subject::find($id);
        return view('superadmin/academics/subject/edit', ['class'=> $class,'section'=>$section,'sub' => $sub, 'subject' => $subject]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function subjectUpdate(UpdateSubjectRequest $request)
    {
        /*     $subject = Subject::where('code', '=', $request->code)
                 ->where('name', '=', $request->name )
                 ->where('description', '=', $request->description)
                 ->where('eclasses_id', '=', $request->eclasses_id)
                 ->where('section_id', '=', $request->section_id)
                 ->first();
             if ($subject === null) {
                 $subject = Subject::find($request->id);
                 $subject->code = $request->code;
                 $subject->name = $request->name;
                 $subject->description = $request->description;
                 $subject->eclasses_id = $request->eclasses_id;
                 $subject->section_id = $request->section_id;
                 $subject->update();
                 return redirect('subject/view')->with('success', 'Updated successfully');
             }
             else{
                 return redirect('subject/view')->with('error', 'Data already exists.');
             }*/
        $subject = Subject::find($request->id);
        $subject->code = $request->code;
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->eclasses_id = $request->eclasses_id;
        $subject->type = $request->type;
        $subject->credit_hour = $request->credit_hour;
        $subject->practical_full_marks = ($request->practical_full_marks) ? $request->practical_full_marks : 0;
        $subject->theory_pass_marks = ($request->theory_pass_marks) ? $request->theory_pass_marks : 0;
        $subject->practical_pass_marks = ($request->practical_pass_marks) ? $request->practical_pass_marks : 0;
        $subject->update();
        return redirect()->route('subject')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function subjectDestroy(Subject $subject, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject ->delete();
        return redirect()->route('subject')->with('success', 'Deleted successfully');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject= DB::table('subjects')
            ->join('eclasses', 'eclasses.id', '=', 'subjects.eclasses_id')
            ->select('subjects.id as subject_id','subjects.code as subject_code','subjects.name as subject_name','subjects.description as subject_description','eclasses.name as class_name')
            ->get();
        return response()->json($subject);
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
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectRequest $request)
    {
        $subject = new Subject();
        $subject->code = $request->code;
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->eclasses_id = $request->eclasses_id;
        $subject->type = $request->type;
        $subject->credit_hour = $request->credit_hour;
        $subject->theory_full_marks = $request->theory_full_marks;
        $subject->practical_full_marks = $request->practical_full_marks;
        $subject->theory_pass_marks = $request->theory_pass_marks;
        $subject->practical_pass_marks = $request->practical_pass_marks;
        $subject->save();
        return response()->json([
            'success' => true,
            'message'=>'Successfully created.',
            'data'=>$subject,
        ],Response::HTTP_OK);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject ->delete();
        return $subject;
    }

    public function getSubjects($id)
    {
        return json_encode(DB::table('subjects')->where('eclasses_id', $id)->get());
    }
}
