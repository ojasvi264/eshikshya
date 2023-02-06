@extends('layouts.base_temp')
@section('styles')
    <style>
        .manage-syllabus-switch input[type="checkbox"]:after {
            display: none;
        }

        .closeCompletionDate {
            margin-right: 335px;
        }

        .attendance {
            margin-right: 10px;
        }

        .holiday-button {
            margin: 10px 20px 0 20px;
        }

        .save-button {
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Staff Attendance</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lesson Plans</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Staff Attendance</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Select required fields</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                            @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                    {{route('admin.disable_staff.search')}}
                                @endif
                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                {{route('staff.search')}}
                            @endif
                                " method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Role</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="role_id" id="role_id">
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value='{{ $role->id }}'
                                                            @if($role->id == request()->role_id ) selected @endif>{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('role_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Attendance Date</label><span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="attendance_date"
                                                   value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                                            <span
                                                class="text-danger">@error('attendance_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @isset($searchedStaffs)
                    <div class="col-lg-12">
                        <div class="row tab-content">
                            <div id="list-view" class="tab-pane fade active show col-lg-12">
                                <div class="card">
                                    <form action="
                                        @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                            @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                {{route('admin.staff_attendance.store')}}
                                            @endif
                                        @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                            {{route('staff_attendance.store')}}
                                        @endif
                                        " method="post">
                                        @csrf
                                        <input type="hidden" name="attendance_date" value="{{request()->attendance_date}}">
                                        <div class="card-header">
                                            <h4 class="card-title">Staff Attendance List</h4>
                                        </div>
                                        <div class="d-flex">
                                            <div class="holiday-button">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="is_holiday">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Mark as holiday
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="save-button">
                                                <button type="submit" class="btn btn-primary">Save Attendance</button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example3" class="display" style="min-width: 845px">
                                                    <thead>
                                                    <tr>
                                                        <th>Staff ID</th>
                                                        <th>Name</th>
                                                        <th>Role</th>
                                                        <th>Attendance</th>
                                                        <th>Note</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($searchedStaffs as $staff)
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="staff_id[]" value="{{$staff->id}}">
                                                                {{$staff->staff_id}}</td>
                                                            <td>{{$staff->name}}</td>
                                                            <td>{{$staff->role->name}}</td>
                                                            <td>
                                                                <input type="radio" value="Present" name="attendance_{{$staff->id}}"
                                                                       class="attendance" checked>Present<br>
                                                                <input type="radio" value="Late" name="attendance_{{$staff->id}}"
                                                                       class="attendance">Late<br>
                                                                <input type="radio" value="Half Day" name="attendance_{{$staff->id}}"
                                                                       class="attendance">Half Day<br>
                                                                <input type="radio" value="Absent" name="attendance_{{$staff->id}}"
                                                                       class="attendance">Absent
                                                            </td>
                                                            <td>
                                                                <textarea name="note_{{$staff->id}}"></textarea>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection




