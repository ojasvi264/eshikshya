<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ApplyLeave;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Http\Requests\StoreApplyLeaveRequest;
use Illuminate\Support\Facades\Auth;

class ApplyLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $leaveTypes = LeaveType::latest()->get();
        $applyLeaves = LeaveRequest::where('user_id', 'student_'.Auth::guard('student')->user()->id)->latest()->get();
        return view('dashboard.pages.human_resource.apply_leave', compact('leaveTypes', 'applyLeaves'));
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
    public function store(StoreApplyLeaveRequest $request)
    {
        $request['user_id'] = 'student_'.Auth::guard('student')->user()->id;
        $applyLeave = LeaveRequest::create($request->all());
        if ($request->file('document')){
            $applyLeave->addMedia($request->file('document'))->toMediaCollection();
        }
        return redirect()->route('student.leave_request.index')->with('success', 'Created successfully');
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
    public function edit(LeaveRequest $applyLeave)
    {
        $applyLeaves = LeaveRequest::whereNotIn('id', [$applyLeave->id])->get();
        $leaveTypes = LeaveType::latest()->get();
        return view('dashboard.pages.human_resource.apply_leave', compact('applyLeave', 'applyLeaves', 'leaveTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreApplyLeaveRequest $request, ApplyLeave $applyLeave)
    {
        if ($request->hasFile('document')){
            $applyLeave->deleteMedia($applyLeave->getMedia()[0]);
            $applyLeave->addMedia($request->file('document'))->toMediaCollection();
        }
        $applyLeave->update($request->all());
        return redirect()->route('student.leave_request.index')->with('success', 'Updated successfully');
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
}
