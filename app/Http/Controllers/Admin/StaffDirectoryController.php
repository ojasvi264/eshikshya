<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Role;
use App\Models\StaffDirectory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStaffDirectoryRequest;

class StaffDirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $designations = Designation::all();
        $departments = Department::all();
        $staff_directories = StaffDirectory::latest()->get();
        return view('dashboard.pages.human_resource.staff_directory', compact('staff_directories', 'roles', 'designations', 'departments'));
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
    public function store(StoreStaffDirectoryRequest $request)
    {
        $request['password'] = bcrypt($request->staff_id.'_'.$request->phone);
        $staff = StaffDirectory::create($request->all());
        if ($request->file('profile_image')){
            $staff->addMedia($request->file('profile_image'))->toMediaCollection();
        }
        if ($request->file('resume')){
            $staff->addMedia($request->file('resume'))->toMediaCollection('resume');
        }
        if ($request->file('joining_letter')){
            $staff->addMedia($request->file('joining_letter'))->toMediaCollection('joining_letter');
        }
        if ($request->file('document')){
            $staff->addMedia($request->file('document'))->toMediaCollection('document');
        }

        return redirect()->route('admin.staff_directory.index')->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StaffDirectory $staffDirectory)
    {
        return view('dashboard.pages.human_resource.staff_view', compact('staffDirectory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffDirectory $staffDirectory)
    {
        $roles = Role::all();
        $designations = Designation::all();
        $departments = Department::all();
        $staff_directories = StaffDirectory::whereNotIn('id', [$staffDirectory->id])->get();
        return view('dashboard.pages.human_resource.staff_directory', compact('roles','departments', 'designations', 'staffDirectory', 'staff_directories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStaffDirectoryRequest $request, StaffDirectory $staffDirectory)
    {
        if ($request->hasFile('profile_image')){
            $staffDirectory->deleteMedia($staffDirectory->getMedia()[0]);
            $staffDirectory->addMedia($request->file('profile_image'))->toMediaCollection();
        }
        if ($request->hasFile('resume')){
            $staffDirectory->clearMediaCollection('resume');
            $staffDirectory->addMedia($request->file('resume'))->toMediaCollection('resume');
        }
        if ($request->hasFile('joining_letter')){
            $staffDirectory->clearMediaCollection('joining_letter');
            $staffDirectory->addMedia($request->file('joining_letter'))->toMediaCollection('joining_letter');
        }
        if ($request->hasFile('document')){
            $staffDirectory->clearMediaCollection('document');
            $staffDirectory->addMedia($request->file('document'))->toMediaCollection('document');
        }
        $staffDirectory->update($request->all());
        return redirect()->route('admin.staff_directory.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffDirectory $staffDirectory)
    {
        if ($staffDirectory->hasMedia()){
            $staffDirectory->deleteMedia($staffDirectory->getMedia()[0]);
        }
        if ($staffDirectory->hasMedia('resume')){
            $staffDirectory->clearMediaCollection('resume');
        }
        if ($staffDirectory->hasMedia('joining_letter')){
            $staffDirectory->clearMediaCollection('joining_letter');
        }
        if ($staffDirectory->hasMedia('document')){
            $staffDirectory->clearMediaCollection('document');
        }
        $staffDirectory->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }

    public function getStaffs($id)
    {
        return json_encode(DB::table('staff_directories')->where('status', '=', 1)->where('role_id', $id)->get());
    }
    public function disable(){
        $roles = Role::latest()->get();
        $staffs = StaffDirectory::latest()->get();
        return view('dashboard.pages.human_resource.disable_staff', compact('staffs', 'roles'));
    }

    public function searchStaff(Request $request){
        $roles = Role::latest()->get();
        $staffs = StaffDirectory::where('status', 1)->latest()->get();
        $searchedStaffs = StaffDirectory::where('status', 1)->where('role_id', $request->role_id)->get();
        if ($request->type == 'disable_staff')
            return view('dashboard.pages.human_resource.disable_staff', compact('roles', 'staffs', 'searchedStaffs'));
        else
            return view('dashboard.pages.human_resource.staff_attendance', compact('roles','searchedStaffs'));
    }

    public function disableStaff($id){
        $staff = StaffDirectory::find($id);
        $staff->status = 0;
        $staff->save();
        return response(json_encode($staff));
    }

    public function enableStaff($id){
        $staff = StaffDirectory::find($id);
        $staff->status = 1;
        $staff->save();
        return response(json_encode($staff));
    }
}
