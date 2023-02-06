@extends('layouts.base_temp')
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <style>
        .request-status{
            padding-right: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Leave Request</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    @if(isset($leaveRequest))
                        <div class="pr-5">
                        </div>
                    @else
                        <div class="pr-5">
                            <button class="btn btn-primary" id="leaveRequestButton">Add Leave Request</button>
                        </div>
                    @endif
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Human Resource</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Leave Request</a></li>
                    </ol>
                </div>
            </div>

            <div class="row" id="leaveRequestForm">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Leave Request</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{isset($leaveRequest) ? route('admin.leave_request.update', $leaveRequest) : route('admin.leave_request.store')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{isset($leaveRequest) ? route('leave_request.update', $leaveRequest) : route('leave_request.store')}}
                                @endif
                                " method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($leaveRequest))
                                    @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12" id="roleSection">
                                        <div class="form-group">
                                            <label class="form-label">Role</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="role_id" id="role_id">
                                                <option value="0">Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value='{{ $role->id }}' @isset($leaveRequest)@if($leaveRequest->role != null)  @if($role->id == $leaveRequest->role->id) selected @endif @endif @endisset>{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('role_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12" id="staffSection">
                                        <div class="form-group">
                                            <label class="form-label">Staff Name</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="directory_id" id="directory_id">
                                                <option value="0">Select Staff</option>
                                                @foreach ($staffs as $staff)
                                                    <option value='{{ $staff->id }}' @isset($leaveRequest) @if($leaveRequest->staff != null)@if($staff->id == $leaveRequest->staff->id) selected @endif @endif @endisset>{{$staff->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('directory_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Apply Date<span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="apply_date" value="{{isset($leaveRequest) ? $leaveRequest->apply_date : Carbon\Carbon::now()->format('Y-m-d')}}" >
                                            <span class="text-danger">@error('apply_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Leave Type</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="leave_type_id" id="leave_type_id">
                                                <option value="">Select Leave Type</option>
                                                @foreach ($leaveTypes as $leaveType)
                                                    <option value='{{ $leaveType->id }}' @isset($leaveRequest)@if($leaveType->id == $leaveRequest->leave_type->id) selected @endif @endisset>{{$leaveType->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('leave_type_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Leave From</label><span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="leave_from" value='{{isset($leaveRequest) ? $leaveRequest->leave_from : ''}}' >
                                            <span class="text-danger">@error('leave_from'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Leave To</label><span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="leave_to" value='{{isset($leaveRequest) ? $leaveRequest->leave_to : ''}}' >
                                            <span class="text-danger">@error('leave_to'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Reason</label><span style="color: red">&#42;</span>
                                            <textarea id="mytextarea" class="form-control" name="reason">{!! isset($leaveRequest)?$leaveRequest->reason:(old('reason') ?? '') !!}</textarea>
                                            <span class="text-danger">@error('reason'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Note</label>
                                            <textarea id="mytextarea" class="form-control" name="note">{!! isset($leaveRequest)?$leaveRequest->note:(old('note') ?? '') !!}</textarea>
                                            <span class="text-danger">@error('note'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Document</label><span style="color: red">&#42;</span>
                                            <input name="document" type="file" class="dropify" data-height="100" accept=".doc,docx,.pdf,.xls,.xlsx,.ppt,.pptx" data-default-file="{{isset($leaveRequest) ? $leaveRequest->document :''}}"/>
                                            <span class="text-danger">@error('document'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Status</label><br>
                                            <div class="">
                                                <span class="request-status"><input type="radio" name="status" value = "0" class="check_in" {{ (isset($leaveRequest) && $leaveRequest->status == 0) || old('status') ? 'checked' : ''}}>Pending</span>
                                                <span class="request-status"><input type="radio" name="status" value = "1" class="check_in" {{ (isset($leaveRequest) && $leaveRequest->status == 1) || old('status') ? 'checked' : ''}}>Approve</span>
                                                <span class="request-status"><input type="radio" name="status" value = "2" class="check_in" {{ (isset($leaveRequest) && $leaveRequest->status == 2) || old('status') ? 'checked' : ''}}>Disapprove</span>
                                            </div>
                                            <span class="text-danger">@error('status'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">{{isset($leaveRequest) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Leave Request List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Role</th>
                                                <th>Name</th>
                                                <th>Leave Type</th>
                                                <th>Apply Date</th>
                                                <th>Leave From</th>
                                                <th>Leave To</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($leaveRequests as $key =>$leaveRqst)
                                                @php
                                                  $user = explode('_', $leaveRqst->user_id)
                                                @endphp
                                                <tr>
                                                    @if($leaveRqst->role)
                                                        <td>{{$leaveRqst->role->name}}</td>
                                                    @else
                                                        @if($user[0] == 'student')
                                                            <td>Student</td>
                                                        @elseif($user[0] == 'superadmin')
                                                            <td>Super Admin</td>
                                                        @endif
                                                    @endif
                                                    @if($leaveRqst->staff)
                                                        <td>{{$leaveRqst->staff->name}}</td>
                                                    @else
                                                        @if($user[0] == 'student')
                                                            @php
                                                              $studentName = \App\Models\Student::where('id', $user[1])->pluck('fname')->first();
                                                            @endphp
                                                            <td>{{$studentName}}</td>
                                                        @elseif($user[0] == 'superadmin')
                                                            @php
                                                                $adminName = \App\Models\User::where('id', $user[1])->pluck('name')->first();
                                                            @endphp
                                                            <td>{{$adminName}}</td>
                                                        @endif
                                                    @endif
                                                    <td>{{$leaveRqst->leave_type->name}}</td>
                                                    <td>{{$leaveRqst->apply_date}}</td>
                                                    <td>{{$leaveRqst->leave_from}}</td>
                                                    <td>{{$leaveRqst->leave_to}}</td>
                                                    <td>{!! $leaveRqst->reason !!}</td>
                                                    <td class="text-center">
                                                        @if($leaveRqst->status == 0)
                                                            <span class="shadow-none badge badge-warning" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#approveDisapproveModal" data-id="{{$leaveRqst->id}}">Pending</span>
                                                        @elseif($leaveRqst->status == 1)
                                                            <span class="shadow-none badge badge-success">Approved</span>
                                                        @elseif($leaveRqst->status == 2)
                                                            <span class="shadow-none badge badge-danger">Disapproved</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.leave_request.edit', $leaveRqst)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('leave_request.edit', $leaveRqst)}}
                                                                @endif
                                                                " class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.leave_request.destroy',$leaveRqst)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('leave_request.destroy',$leaveRqst)}}
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
                                            <div class="modal fade" id="approveDisapproveModal" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                <strong>Approve Disapprove Leave</strong>
                                                            </h5>
                                                            <button type="button" class="btn-close closeLibraryCard"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul>
                                                                <li>
                                                                    <div class="leaveModel">
                                                                        <input type="radio" class="form-check-input" name="status" value="1" checked>Approve
                                                                        <br>
                                                                        <br>
                                                                        <input type="radio" class="form-check-input" name="status" value="2">Disapprove
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div>
                                                                <button type="button" class="btn btn-danger" style="margin-right: 325px"
                                                                        data-bs-dismiss="modal">Close
                                                                </button>
                                                                <button type="button" class="btn btn-primary"
                                                                        id="submitLeaveApproval">Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    <script>
        $(document).ready(function () {
            @isset($leaveRequest)
                @php
                    $user = explode('_', $leaveRequest->user_id)[0];
                @endphp
                if ({{$user == "student"}}){
                    $('#roleSection').hide();
                    $('#staffSection').hide();
                }
            @endisset
            $('#role_id').on('change', function () {
                let id = $(this).val();
                $('#directory_id').empty();
                $('#directory_id').append(`<option value="0" selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/get_staffs/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#directory_id').empty();
                        $('#directory_id').append(`<option value="0" selected>Select Staff*</option>`);
                        response.forEach(element => {
                            $('#directory_id').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            @if(isset($leaveRequest))
                $('#leaveRequestForm').show()
            @else
                $('#leaveRequestForm').hide();
            @endif
            $('#leaveRequestButton').click(function (){
                $('#leaveRequestForm').toggle();
            })
        });
    </script>
    <script>
        $(document).ready(function () {
            var myModalEl = document.getElementById('approveDisapproveModal')
            myModalEl.addEventListener('shown.bs.modal', function (event) {
                const relatedTarget = $(event.relatedTarget);
                const id = relatedTarget.data('id');
                $('#submitLeaveApproval').data('id', id);
            });
            $('#submitLeaveApproval').click(function () {
                let status = $('.leaveModel input[name="status"]:checked').val();
                const id = $(this).data('id');
                // console.log(id);
                // console.log(status);
                $.ajax({
                    type: 'GET',
                    url: '/changeLeaveStatus/' + id,
                    data: {status: status},
                    dataType: "json",
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@endsection

