<?php

namespace App\Http\Controllers\Teacher;

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
        $applyLeaves = LeaveRequest::where('directory_id', auth()->guard('staff')->user()->id)->latest()->get();
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
        $applyLeave = ApplyLeave::create($request->all());
        if ($request->file('document')){
            $applyLeave->addMedia($request->file('document'))->toMediaCollection();
        }
        return redirect()->route('teacher.apply_leave.index')->with('success', 'Created successfully');
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
    public function edit(ApplyLeave $applyLeave)
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
        return redirect()->route('teacher.apply_leave.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplyLeave $applyLeave)
    {
        if ($applyLeave->hasMedia()){
            $applyLeave->deleteMedia($applyLeave->getMedia()[0]);
        }
        $applyLeave->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
