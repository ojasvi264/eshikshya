<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveRequestRequest;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\Role;
use App\Models\StaffDirectory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaveTypes = LeaveType::latest()->get();
        $leaveRequests = LeaveRequest::latest()->get();
        $roles = Role::latest()->get();
        $staffs = StaffDirectory::where('status', 1)->latest()->get();
        return view('dashboard.pages.human_resource.leave_request', compact('leaveTypes', 'leaveRequests', 'roles', 'staffs'));
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
    public function store(StoreLeaveRequestRequest $request)
    {
        if ($request->role_id == 0  && $request->staff_id == 0) {
            $request['user_id'] = 'superadmin_' . auth()->user()->id;
        }
        $leaveRequest = LeaveRequest::create($request->all());
        if ($request->file('document')){
            $leaveRequest->addMedia($request->file('document'))->toMediaCollection();
        }
        return redirect()->route('leave_request.index')->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveRequest $leaveRequest)
    {
        $leaveRequests = LeaveRequest::whereNotIn('id', [$leaveRequest->id])->get();
        $leaveTypes = LeaveType::latest()->get();
        $roles = Role::latest()->get();
        $staffs = StaffDirectory::where('status', 1)->latest()->get();
        return view('dashboard.pages.human_resource.leave_request', compact('leaveRequest', 'leaveRequests', 'leaveTypes', 'roles', 'staffs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLeaveRequestRequest $request, LeaveRequest $leaveRequest)
    {
        if ($request->role_id == 0  && $request->staff_id == 0) {
            $request['user_id'] = 'superadmin_' . auth()->user()->id;
        }
        if ($request->hasFile('document')){
            $leaveRequest->deleteMedia($leaveRequest->getMedia()[0]);
            $leaveRequest->addMedia($request->file('document'))->toMediaCollection();
        }
        $leaveRequest->update($request->all());
        return redirect()->route('leave_request.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->hasMedia()){
            $leaveRequest->deleteMedia($leaveRequest->getMedia()[0]);
        }
        $leaveRequest->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function changeStatus(Request $request, $id)
    {
        $leave = LeaveRequest::find($id);
        $leave->status = $request->status;
        $leave->save();
        return json_encode($leave);
    }
}
