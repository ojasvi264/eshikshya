<?php

namespace App\Http\Controllers\Super\Academics;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use App\Models\Calendar;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CalendarController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendarCreate()
    {
        return view('superadmin.academics.calendar.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCalendarRequest $request
     * @return \Illuminate\Http\Response
     */
    public function calendarStore(StoreCalendarRequest $request)
    {
        $calendar = new Calendar();
        $calendar->title = $request->title;
        $calendar->event = $request->event;
        $calendar->description = $request->description;
        $fileNames = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $imageName = $image->getClientOriginalName();
                $filename = date('YmdHi') . '.' . $imageName;
                $image->move(public_path('files/calendar'), $filename);
                $fileNames[] = $filename;
            }
        }
        $calendar->file=json_encode($fileNames);
        $calendar->save();
        return redirect()->route('academic-calendar')->with('success', 'Created successfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function calendarShow(Calendar  $calendar)
    {
        $calendar= Calendar::all();
        return view('superadmin.academics.calendar.index',compact('calendar'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function calendarEdit($id)
    {
        $cal = Calendar::all();
        $calendar = Calendar::find($id);
        return view('superadmin/academics/calendar/edit', ['cal' => $cal, 'calendar' => $calendar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCalendarRequest  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function calendarUpdate(UpdateCalendarRequest $request)
    {
        $calendar = Calendar::findorFail($request->id);
        $calendar->title = $request->title;
        $calendar->event = $request->event;
        $calendar->description = $request->description;
        $fileNames = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $imageName = $image->getClientOriginalName();
                $filename = date('YmdHi') . '.' . $imageName;
                $image->move(public_path('files/calendar'), $filename);
                $fileNames[] = $filename;
            }
        }
        $calendar->file=json_encode($fileNames);
        $calendar->update();
        return redirect()->route('academic-calendar')->with('success', 'Updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function calendarDestroy(Calendar  $calendar, $id)
    {
        $calendar = Calendar::findOrFail($id);
        $calendar ->delete();
        return redirect()->route('academic-calendar')->with('success', 'Deleted successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendar= DB::table('calendars')
            ->select('calendars.id as calendar_id', 'calendars.title as event_title' ,'calendars.event as event_date','calendars.file as event_file','calendars.description as event_description')
            ->orderBy('calendars.event','DESC')
            ->get();
        return response()->json([
            "success" => true,
            "message" => "Calendar List",
            "data" => $calendar
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
     * @param  \App\Http\Requests\StoreCalendarRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalendarRequest $request)
    {
        $calendar = new Calendar();
        $calendar->title = $request->title;
        $calendar->event = $request->event;
        $calendar->description = $request->description;
        $fileNames = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image){
                $extension = $image->getClientOriginalName();
                $filename = date('YmdHi').'.'.$extension;
                $image-> move(public_path('files/calendar'), $filename);
                Storage::disk('local')->put('files/calendar/'.$filename,'public');
                $fileNames[] = $filename;
            }
        }
        $calendar->file=json_encode($fileNames);
        $calendar->save();
        return response()->json([
            'success' => true,
            'message'=>'Successfully created.',
            'data'=>$calendar,
        ],Response::HTTP_OK);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar  $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calendar = Calendar::findOrFail($id);
        return $calendar;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCalendarRequest  $request
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCalendarRequest $request, Calendar  $calendar, $id)
    {
        $calendar = Calendar::where('id', '=', $id)
            ->where('title', '=', $request->title)
            ->where('event', '=', $request->event)
            ->where('description','=', $request->description)
            ->where('file','=', $request->file)
            ->first();
        if($calendar === null){
            $calendar = Calendar::findorFail($id);
            $calendar->title = $request->title;
            $calendar->event = $request->event;
            $calendar->description = $request->description;
            $fileNames = [];
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $image){
                    $extension = $image->getClientOriginalName();
                    $filename = date('YmdHi').'.'.$extension;
                    $image-> move(public_path('files/calendar'), $filename);
                    Storage::disk('local')->put('files/calendar/'.$filename,'public');
                    $fileNames[] = $filename;
                }
            }
            $calendar->file=json_encode($fileNames);
            $calendar ->update();
            return response()->json([
                'success' => true,
                'message'=>'Successfully updated.',
                'data'=>$calendar,
            ],Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar, $id)
    {
        $calendar = Calendar::findOrFail($id);
        $calendar ->delete();
        return response()->json([
            'success' => true,
            'message'=>'Successfully deleted.',
        ],Response::HTTP_OK);
    }

}
