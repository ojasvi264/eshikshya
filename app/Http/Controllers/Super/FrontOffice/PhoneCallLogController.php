<?php

namespace App\Http\Controllers\Super\FrontOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhoneCallLogRequest;
use App\Http\Requests\UpdatePhoneCallLogRequest;
use App\Models\PhoneCallLog;
use Illuminate\Http\Request;

class PhoneCallLogController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function phoneCallLogCreate()
    {
        return view('superadmin.frontoffice.phoneCallLog.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function phoneCallLogStore(StorePhoneCallLogRequest $request)
    {
        $phoneCallLog = new PhoneCallLog();
        $phoneCallLog->name= $request->name;
        $phoneCallLog->phone= $request->phone;
        $phoneCallLog->date= $request->date;
        $phoneCallLog->follow_up_date= $request->follow_up_date;
        $phoneCallLog->description= $request->description;
        $phoneCallLog->call_duration= $request->call_duration;
        $phoneCallLog->note= $request->note;
        $phoneCallLog->call_type= $request->call_type;
        $phoneCallLog->save();
        return redirect()->route('phone-call-log')->with('success', 'Created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhoneCallLog  $phoneCallLog
     * @return \Illuminate\Http\Response
     */
    public function phoneCallLogShow(PhoneCallLog $phoneCallLog)
    {
        $phoneCallLog = PhoneCallLog::all();
        return view ('superadmin.frontoffice.phoneCallLog.index', compact('phoneCallLog'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhoneCallLog  $phoneCallLog
     * @return \Illuminate\Http\Response
     */
    public function phoneCallLogEdit($id)
    {
        $phoneLog = PhoneCallLog::all();
        $phoneCallLog = PhoneCallLog::find($id);
        return view('superadmin/frontoffice/phoneCallLog/edit', [ 'phoneLog'=>$phoneLog,'phoneCallLog'=> $phoneCallLog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhoneCallLog  $phoneCallLog
     * @return \Illuminate\Http\Response
     */
    public function phoneCallLogUpdate(UpdatePhoneCallLogRequest $request)
    {
        $phoneCallLog = PhoneCallLog::find($request->id);
        $phoneCallLog->name= $request->name;
        $phoneCallLog->phone= $request->phone;
        $phoneCallLog->date= $request->date;
        $phoneCallLog->follow_up_date= $request->follow_up_date;
        $phoneCallLog->description= $request->description;
        $phoneCallLog->call_duration= $request->call_duration;
        $phoneCallLog->note= $request->note;
        $phoneCallLog->call_type= $request->call_type;
        $phoneCallLog->update();
        return redirect()->route('phone-call-log')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhoneCallLog  $phoneCallLog
     * @return \Illuminate\Http\Response
     */
    public function phoneCallLogDestroy($id)
    {
        $phoneCallLog = PhoneCallLog::findOrFail($id);
        $phoneCallLog->delete();
        return redirect()->route('phone-call-log')->with('success', 'Deleted successfully');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhoneCallLog  $phoneCallLog
     * @return \Illuminate\Http\Response
     */
    public function show(PhoneCallLog $phoneCallLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhoneCallLog  $phoneCallLog
     * @return \Illuminate\Http\Response
     */
    public function edit(PhoneCallLog $phoneCallLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhoneCallLog  $phoneCallLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhoneCallLog $phoneCallLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhoneCallLog  $phoneCallLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhoneCallLog $phoneCallLog)
    {
        //
    }
}
