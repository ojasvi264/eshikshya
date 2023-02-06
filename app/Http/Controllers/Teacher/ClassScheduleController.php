<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassScheduleRequest;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateClassScheduleRequest;
use App\Models\ClassSchedule;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClassScheduleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scheduleCreate()
    {
        return view('superadmin.schedule.classSchedule.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassScheduleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function scheduleStore(StoreClassScheduleRequest $request)
    {
        $classSchedule = ClassSchedule::where('class_id', '=', $request->class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('title', '=', $request->title)
            ->where('schedule', '=', $request->schedule)
            ->first();
        if($classSchedule === null){
            $classSchedule = new ClassSchedule();
            $classSchedule->class_id = $request->class_id;
            $classSchedule->section_id = $request->section_id;
            $classSchedule->title = $request->title;
            $classSchedule->schedule = $request->schedule;
            if ($request->hasFile('file')) {
                $img = $request->file('file');
                $extension = $img->getClientOriginalName();
                $filename = date('YmdHi').'.'.$extension;
                $img-> move(public_path('public/images/schedule'), $filename);
                $classSchedule['file'] = $filename;
            }
            $classSchedule->save();
            return redirect()->route('teacher.class-schedule')->with('success', 'Created successfully');
        }
        else{
            return redirect()->route('teacher.class-schedule')->with('error', 'Data already exists.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassSchedule $classSchedule
     * @return \Illuminate\Http\Response
     */
    public function dropDownShow(ClassSchedule $classSchedule)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        $classSchedule = ClassSchedule::all();
        return view ('superadmin.schedule.classSchedule.index', ['class'=> $class, 'section'=>$section],compact('classSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function scheduleEdit($id)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        $sch = ClassSchedule::all();
        $schedule = ClassSchedule::find($id);
        return view('superadmin/schedule/classSchedule/edit', ['class'=> $class,'section' => $section, 'sch' => $sch, 'schedule' => $schedule]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassScheduleRequest  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function scheduleUpdate(UpdateClassScheduleRequest $request)
    {
        $classSchedule= ClassSchedule::where('class_id', '=', $request->class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('title', '=', $request->title)
            ->where('schedule', '=', $request->schedule)
            ->first();
        if ($classSchedule === null) {
            $classSchedule = ClassSchedule::findOrFail($request->id);
            $classSchedule->class_id = $request->class_id;
            $classSchedule->section_id = $request->section_id;
            $classSchedule->title = $request->title;
            $classSchedule->schedule = $request->schedule;
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $extension = $image->getClientOriginalName();
                $filename = date('YmdHi') . '.' . $extension;
                $image->move(public_path('public/images/schedule'), $filename);
                Storage::disk('local')->put('public/images/schedule/' . $filename, 'public');
                $classSchedule['file'] = $filename;
            }
            $classSchedule->update();
            return redirect()->route('teacher.class-schedule')->with('success', 'Updated successfully');
        }
        else{
            return redirect()->route('teacher.class-schedule')->with('error', 'Data already exists.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassSchedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function scheduleDestroy(ClassSchedule $schedule, $id)
    {
        $classSchedule = ClassSchedule::findOrFail($id);
        $classSchedule ->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classSchedule = DB::table('class_schedules')
            ->join('eclasses', 'eclasses.id', '=', 'class_schedules.class_id')
            ->join('sections', 'sections.id', '=', 'class_schedules.section_id')
            ->select('class_schedules.id as schedule_id','eclasses.name as class_name', 'sections.name as section_name' ,'class_schedules.title as schedule_title','class_schedules.schedule as schedule_date','class_schedules.file as schedule_file')
            ->orderBy('class_schedules.schedule','DESC')
            ->get();
        return response()->json([
            "success" => true,
            "message" => "Class Schedule List",
            "data" => $classSchedule
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassScheduleRequest $request)
    {
        $classSchedule = new ClassSchedule();
        $classSchedule->class_id = $request->class_id;
        $classSchedule->section_id = $request->section_id;
        $classSchedule->title = $request->title;
        $classSchedule->schedule = $request->schedule;
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $extension = $image->getClientOriginalName();
            $filename = date('YmdHi') . '.' . $extension;
            $image->move(public_path('public/images/schedule'), $filename);
            Storage::disk('local')->put('public/images/schedule/' . $filename, 'public');
            $classSchedule['file'] = $filename;
        }
        $classSchedule->save();
        return response()->json([
            'success' => true,
            'message'=>'Successfully created.',
            'data'=>$classSchedule,
        ],Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassSchedule  $classSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(ClassSchedule $classSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassSchedule  $classSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classSchedule = ClassSchedule::findOrFail($id);
        return $classSchedule;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassSchedule  $classSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassScheduleRequest $request, $id)
    {
        $classSchedule= ClassSchedule::where('class_id', '=', $id)
            ->where('section_id', '=', $request->section_id)
            ->where('title', '=', $request->title)
            ->where('schedule', '=', '$extension')
            ->where('file', '=', $request->file('image'))
            ->first();
        if ($classSchedule === null) {
            $classSchedule = ClassSchedule::findOrFail($id);
            $classSchedule->class_id = $request->class_id;
            $classSchedule->section_id = $request->section_id;
            $classSchedule->title = $request->title;
            $classSchedule->schedule = $request->schedule;
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $extension = $image->getClientOriginalName();
                $filename = date('YmdHi') . '.' . $extension;
                $image->move(public_path('public/images/schedule'), $filename);
                Storage::disk('local')->put('public/images/schedule/' . $filename, 'public');
                $classSchedule['file'] = $filename;
            }
            $classSchedule->update();
            return response()->json([
                'success' => true,
                'message' => 'Successfully updated.',
                'data' => $classSchedule,
            ], Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassSchedule  $classSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = ClassSchedule::findOrFail($id);
        $schedule ->delete();
        $sch = ClassSchedule::all();
        return response()->json([
            'success' => true,
            'message'=>'Successfully deleted.',
            'data'=> $sch
        ],Response::HTTP_OK);
    }
}
