@extends('layouts.base_temp')
@section('styles')
    <style>
        .manage-syllabus-switch input[type="checkbox"]:after {
            display: none;
        }
        .closeCompletionDate {
            margin-right: 335px;
        }
    </style>
@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Disable Staff</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Human Resource</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Disable Staff</a></li>
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
                                {{route('disable_staff.search')}}
                            @endif
                                " method="get">
                                @csrf
                                <input type="hidden" name="type" value="disable_staff">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Role</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="role_id" id="role_id" required>
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value='{{ $role->id }}'
                                                            @if($role->id == request()->role_id ) selected @endif>{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('role_id'){{$message}}@enderror</span>
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
                <!-- <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab" class="nav-link btn-primary mr-1 show active">List View</a></li>
                        <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid View</a></li>
                    </ul>
                </div> -->
                @isset($searchedStaffs)
                    <div class="col-lg-12">
                        <div class="row tab-content">
                            <div id="list-view" class="tab-pane fade active show col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Role List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                <tr>
                                                    <th>Staff ID</th>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Department</th>
                                                    <th>Designation</th>
                                                    <th>Mobile number</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($searchedStaffs as $staff)
                                                            <tr>
                                                                <td>{{$staff->staff_id}}</td>
                                                                <td>{{$staff->name}}</td>
                                                                <td>{{$staff->role->name}}</td>
                                                                <td>{{$staff->department->name}}</td>
                                                                <td>{{$staff->designation->designation}}</td>
                                                                <td>{{$staff->phone}}</td>
                                                                <td>
                                                                    <div class="form-check form-switch manage-syllabus-switch">
                                                                        @if($staff->status == 1)
                                                                            <input class="form-check-input" type="radio"
                                                                                   data-bs-toggle="modal"
                                                                                   data-bs-target="#disableStaffModal"
                                                                                   data-id="{{$staff->id}}"
                                                                                   checked>
                                                                        @else
                                                                            <input class="form-check-input" type="radio"  data-bs-toggle="modal"
                                                                                   data-bs-target="#enableStaffModal"
                                                                                   data-id="{{$staff->id}}">
                                                                        @endif
                                                                        <label class="form-check-label"
                                                                               for="flexSwitchCheckDefault">Click to Disable Staff</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                <div class="modal fade" id="disableStaffModal" tabindex="-1"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                   <strong>Are you sure you want to disable this staff?</strong>
                                                                </h5>
                                                                <button type="button" class="btn-close closeDisableStaff"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger closeDisableStaff" style="margin-right: 325px;"
                                                                        data-bs-dismiss="modal">No
                                                                </button>
                                                                <button type="button" class="btn btn-primary"
                                                                        id="changeStaffStatus">Yes
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    <div class="modal fade" id="enableStaffModal" tabindex="-1"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        <strong>Are you sure you want to enable this staff?</strong>
                                                                    </h5>
                                                                    <button type="button" class="btn-close closeDisableStaff"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close">
                                                                    </button>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger closeDisableStaff" style="margin-right: 325px;"
                                                                            data-bs-dismiss="modal">No
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary"
                                                                            id="enableStaff">Yes
                                                                    </button>
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
                @endisset
            </div>

        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var myModalEl = document.getElementById('disableStaffModal')
            myModalEl.addEventListener('shown.bs.modal', function (event) {
                const relatedTarget = $(event.relatedTarget);
                const id = relatedTarget.data('id');
                $('#changeStaffStatus').data('id', id);
            });

            $('#changeStaffStatus').click(function(){
                const id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: 'GET',
                    url: '/disable_staff_status/' + id,
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        window.location.reload();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            var myModalEl = document.getElementById('enableStaffModal')
            myModalEl.addEventListener('shown.bs.modal', function (event) {
                const relatedTarget = $(event.relatedTarget);
                const id = relatedTarget.data('id');
                $('#enableStaff').data('id', id);
            });

            $('#enableStaff').click(function(){
                const id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: 'GET',
                    url: '/enable_staff_status/' + id,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        window.location.reload();
                    }
                });
            });
        });
    </script>


@endsection



