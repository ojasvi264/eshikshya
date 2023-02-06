<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolSettingRequest;
use App\Models\SchoolSetting;
use App\Models\Session;

class SchoolSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $school_setting = SchoolSetting::findOrFail(1);
            view()->share('school_setting', $school_setting);
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::all();
        return view('superadmin.setting.school', compact('sessions'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SchoolSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolSettingRequest $request)
    {
        if (!empty($request->logo)) {
            $file =$request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/'), $filename);
            $file_name = 'uploads/'.$filename;
        }
        $school_setting = SchoolSetting::find(1);
        $school_setting->name = $request->name;
        $school_setting->slogan = $request->slogan;
        $school_setting->established_year = $request->established_year;
        $school_setting->phone_number = $request->phone_number;
        $school_setting->email_address = $request->email_address;
        $school_setting->take_late_fee = $request->take_late_fee;
        $school_setting->type_of_late_fee = $request->type_of_late_fee;
        $school_setting->late_fee_value = $request->late_fee_value;
        $school_setting->late_fee_after = $request->late_fee_after;
        $school_setting->session_id = $request->session_id;
        $school_setting->result_type = $request->result_type;
        $school_setting->address = $request->address;
        $school_setting->logo = ($request->logo) ? $file_name : $school_setting->logo;
        if($school_setting->update()){
            return redirect()->back()->with('success', 'Updated successfully');
        }else{
            return  redirect()->back()->with('error', 'Opps! Something went wrong');
        }
    }
}
