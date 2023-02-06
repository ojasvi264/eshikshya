@extends('layouts.base_temp')
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Apply Leave</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Human Resource</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Apply Leave</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Apply Leave</h5>
                        </div>
                        <div class="card-body">
                                @include('includes.dashboard.message')
                                <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{isset($applyLeave) ? route('admin.apply_leave.update', $applyLeave) : route('admin.apply_leave.store')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                        {{isset($applyLeave) ? route('accountant.apply_leave.update', $applyLeave) : route('accountant.apply_leave.store')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Librarian')
                                        {{isset($applyLeave) ? route('librarian.apply_leave.update', $applyLeave) : route('librarian.apply_leave.store')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        {{isset($applyLeave) ? route('teacher.apply_leave.update', $applyLeave) : route('teacher.apply_leave.store')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                        {{isset($applyLeave) ? route('receptionist.apply_leave.update', $applyLeave) : route('receptionist.apply_leave.store')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::guard('student')->check())
                                    {{isset($applyLeave) ? route('student.apply_leave.update', $applyLeave) : route('student.apply_leave.store')}}
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{isset($applyLeave) ? route('apply_leave.update', $applyLeave) : route('apply_leave.store')}}
                                @endif
                                " method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($applyLeave))
                                    @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Apply Date</label>
                                            <input type="date" class="form-control" name="apply_date" value="{{isset($applyLeave) ? $applyLeave->apply_date : Carbon\Carbon::now()->format('Y-m-d')}}" >
                                            <span class="text-danger">@error('apply_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Leave Type</label>
                                            <select class="form-control" name="leave_type_id" id="leave_type_id">
                                                <option value="">Select Leave Type</option>
                                                @foreach ($leaveTypes as $leaveType)
                                                    <option value='{{ $leaveType->id }}' @isset($applyLeave)@if($leaveType->id == $applyLeave->leave_type->id) selected @endif @endisset>{{$leaveType->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('leave_type_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Leave From</label>
                                            <input type="date" class="form-control" name="leave_from" value='{{isset($applyLeave) ? $applyLeave->leave_from : ''}}' >
                                            <span class="text-danger">@error('leave_from'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Leave To</label>
                                            <input type="date" class="form-control" name="leave_to" value='{{isset($applyLeave) ? $applyLeave->leave_to : ''}}' >
                                            <span class="text-danger">@error('leave_to'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Document</label>
                                            <input name="document" type="file" class="dropify" data-height="100" accept=".doc,docx,.pdf,.xls,.xlsx,.ppt,.pptx" data-default-file="{{isset($applyLeave) ? $applyLeave->document :''}}"/>
                                            <span class="text-danger">@error('document'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Reason</label>
                                            <textarea id="mytextarea" class="form-control" name="reason">{!! isset($applyLeave)?$applyLeave->reason:(old('reason') ?? '') !!}</textarea>
                                            <span class="text-danger">@error('reason'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">{{isset($applyLeave) ? "Update" : "+ Add"}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Apply Leave List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Apply Date</th>
                                                <th>Leave Type</th>
                                                <th>Leave From</th>
                                                <th>Leave To</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($applyLeaves as $key =>$applyLeave)
                                                <tr>
                                                    <td>{{$applyLeave->apply_date}}</td>
                                                    <td>{{$applyLeave->leave_type->name}}</td>
                                                    <td>{{$applyLeave->leave_from}}</td>
                                                    <td>{{$applyLeave->leave_to}}</td>
                                                    <td>{!! $applyLeave->reason !!}</td>
                                                    <td>
                                                        @if($applyLeave->status == 0)
                                                            <span class="shadow-none badge badge-warning">Pending</span>
                                                        @elseif($applyLeave->status == 1)
                                                            <span class="shadow-none badge badge-success">Approved</span>
                                                        @elseif($applyLeave->status == 2)
                                                            <span class="shadow-none badge badge-danger">Disapproved</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.apply_leave.edit', $applyLeave)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.apply_leave.edit', $applyLeave)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Librarian')
                                                                        {{route('librarian.apply_leave.edit', $applyLeave)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.apply_leave.edit', $applyLeave)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                        {{route('receptionist.apply_leave.edit', $applyLeave)}}
                                                                    @endif
                                                                @elseif(auth()->guard('student')->check())
                                                                    {{route('student.apply_leave.edit', $applyLeave)}}
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('apply_leave.edit', $applyLeave)}}
                                                                @endif
                                                                " class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.apply_leave.destroy', $applyLeave)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.apply_leave.destroy', $applyLeave)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Librarian')
                                                                        {{route('librarian.apply_leave.destroy', $applyLeave)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.apply_leave.destroy', $applyLeave)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                        {{route('receptionist.apply_leave.destroy', $applyLeave)}}
                                                                    @endif
                                                                @elseif(auth()->guard('student')->check())
                                                                    {{route('student.apply_leave.destroy', $applyLeave)}}
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('apply_leave.destroy', $applyLeave)}}
                                                                @endif
                                                                " method="post" onsubmit="return confirm('Are you sure?')">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger m-1"  data-toggle="modal" data-target="#deleteModal">
                                                                    <i class="la la-trash-o"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
@endsection
@section('scripts')
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endsection

