<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffAttendanceRequest;
use App\Models\AttendanceDate;
use App\Models\Role;
use App\Models\StaffAttendance;
use Illuminate\Http\Request;

class StaffAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->get();
        return view('dashboard.pages.human_resource.staff_attendance', compact('roles'));
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
    public function store(StoreStaffAttendanceRequest $request)
    {
        $data = [
            'attendance_date' => $request->attendance_date,
            'is_holiday' => $request->is_holiday ?? 0,
        ];
        $attendanceDate = AttendanceDate::create($data);
        if (!$request->is_holiday && $request->staff_id) {
            $staffAttendanceArray = [];
            foreach ($request->staff_id as $staffId) {
                $staffAttendance = [
                    'attendance_date_id' => $attendanceDate->id,
                    'directory_id' => $staffId,
                    'attendance' => $request['attendance_'.$staffId],
                    'note' => $request['note_'.$staffId],
                ];
                array_push($staffAttendanceArray, $staffAttendance);
            }
            StaffAttendance::insert($staffAttendanceArray);
        }
        return redirect()->back()->with('success', 'Created Successfully');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
