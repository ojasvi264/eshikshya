@extends('layouts.base_temp')
@section('dashboard.navbar')@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <style>
        .accordion-button{
            border: 1px solid #6673fd;
        }
        .detail-header{
            background-color: #e7f1ff;
            padding: 10px;
            color: #0c63e4;
            border-radius: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Staff Directory</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Human Resource</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Staff Directory</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Staff <Directory></Directory></h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{isset($staffDirectory) ? route('admin.staff_directory.update', $staffDirectory) : route('admin.staff_directory.store')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{isset($staffDirectory) ? route('staff_directory.update', $staffDirectory) : route('staff_directory.store')}}
                                @endif
                                " method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($staffDirectory))
                                    @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Staff ID</label><span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="staff_id" value="{{old('staff_id')?old('staff_id'):(isset($staffDirectory) ? $staffDirectory->staff_id : '')}}" >
                                            <span class="text-danger">@error('staff_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Name</label><span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="name" value='{{old('name')?old('name'):(isset($staffDirectory) ? $staffDirectory->name : '')}}' >
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Profile Image</label>
                                            <input name="profile_image" type="file" class="dropify" data-height="100" accept="image/*" data-default-file="{{isset($staffDirectory) ? $staffDirectory->profile_image :''}}"/>
                                            <span class="text-danger">@error('profile_image'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Gender</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="">Select Gender</option>
                                                <option value="male" @isset($staffDirectory)@if('male' == $staffDirectory->gender) selected @endif @endisset>Male</option>
                                                <option value="female" @isset($staffDirectory)@if('female' == $staffDirectory->gender) selected @endif @endisset>Female</option>
                                                <option value="others" @isset($staffDirectory)@if('others' == $staffDirectory->gender) selected @endif @endisset>Others</option>
                                            </select>
                                            <span class="text-danger">@error('gender'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label><span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="phone" value='{{old('phone')?old('phone'):(isset($staffDirectory) ? $staffDirectory->phone : '')}}' >
                                            <span class="text-danger">@error('phone'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Email</label><span style="color: red">&#42;</span>
                                            <input type="email" class="form-control" name="email" value='{{old('email')?old('email'):(isset($staffDirectory) ? $staffDirectory->email : '')}}' >
                                            <span class="text-danger">@error('email'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Date Of Birth</label><span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="dob" value='{{old('dob')?old('dob'):(isset($staffDirectory) ? $staffDirectory->dob : '')}}' >
                                            <span class="text-danger">@error('dob'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Marital Status</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="marital_status" id="marital_status">
                                                <option value="">Select Marital Status</option>
                                                <option value="single" @isset($staffDirectory)@if('single' == $staffDirectory->marital_status) selected @endif @endisset>Single</option>
                                                <option value="married" @isset($staffDirectory)@if('married' == $staffDirectory->marital_status) selected @endif @endisset>Married</option>
                                                <option value="separated" @isset($staffDirectory)@if('separated' == $staffDirectory->marital_status) selected @endif @endisset>Separated</option>
                                                <option value="widowed" @isset($staffDirectory)@if('widowed' == $staffDirectory->marital_status) selected @endif @endisset>Widowed</option>
                                                <option value="not-specified" @isset($staffDirectory)@if('not-specified' == $staffDirectory->marital_status) selected @endif @endisset>Not Specified</option>
                                            </select>
                                            <span class="text-danger">@error('marital_status'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Permanent Address</label><span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="permanent_address" value='{{old('permanent_address')?old('permanent_address'):(isset($staffDirectory) ? $staffDirectory->permanent_address : '')}}' >
                                            <span class="text-danger">@error('permanent_address'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Current Address</label><span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="current_address" value='{{old('current_address')?old('current_address'):(isset($staffDirectory) ? $staffDirectory->current_address : '')}}' >
                                            <span class="text-danger">@error('current_address'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Qualification</label><span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="qualification" value='{{old('qualification')?old('qualification'):(isset($staffDirectory) ? $staffDirectory->qualification : '')}}' >
                                            <span class="text-danger">@error('qualification'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Work Experience</label><span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="work_experience" value='{{old('work_experience')?old('work_experience'):(isset($staffDirectory) ? $staffDirectory->work_experience : '')}}' >
                                            <span class="text-danger">@error('work_experience'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Father's Name</label>
                                            <input type="text" class="form-control" name="father_name" value='{{old('father_name')?old('father_name'):(isset($staffDirectory) ? $staffDirectory->father_name : '')}}' >
                                            <span class="text-danger">@error('father_name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Mother's Name</label>
                                            <input type="text" class="form-control" name="mother_name" value='{{old('mother_name')?old('mother_name'):(isset($staffDirectory) ? $staffDirectory->mother_name : '')}}' >
                                            <span class="text-danger">@error('mother_name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Emergency Phone Number</label><span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="emergency_phone" value='{{old('emergency_phone')?old('emergency_phone'):(isset($staffDirectory) ? $staffDirectory->emergency_phone : '')}}' >
                                            <span class="text-danger">@error('emergency_phone'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Role</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="role_id" id="role_id">
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value='{{ $role->id }}' @isset($staffDirectory)@if($role->id == $staffDirectory->role->id) selected @endif @endisset>{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('role_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Designation</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="designation_id" id="designation_id">
                                                <option value="">Select Designation</option>
                                                @foreach ($designations as $designation)
                                                    <option value='{{ $designation->id }}' @isset($staffDirectory)@if($designation->id == $staffDirectory->designation->id) selected @endif @endisset>{{$designation->designation}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('designation_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Department</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="department_id" id="department_id">
                                                <option value="">Select Department</option>
                                                @foreach ($departments as $department)
                                                    <option value='{{ $department->id }}' @isset($staffDirectory)@if($department->id == $staffDirectory->department->id) selected @endif @endisset>{{$department->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('department_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Date Of Joining</label><span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="date_of_joining" value='{{old('date_of_joining')?old('date_of_joining'):(isset($staffDirectory) ? $staffDirectory->date_of_joining : '')}}' >
                                            <span class="text-danger">@error('date_of_joining'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Add Staff Details
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-12"><h4 class="detail-header">Payroll</h4></div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Pan Number</label>
                                                                <input type="text" class="form-control" name="pan_number" value='{{old('pan_number')?old('pan_number'):(isset($staffDirectory) ? $staffDirectory->pan_number : '')}}' >
                                                                <span class="text-danger">@error('pan_number'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Contract Type</label>
                                                                <select class="form-control" name="contract_type" id="contract_type">
                                                                    <option value="">Select Contract Type</option>
                                                                    <option value="permanent" @isset($staffDirectory)@if('permanent' == $staffDirectory->contract_type) selected @endif @endisset>Permanent</option>
                                                                    <option value="probation" @isset($staffDirectory)@if('probation' == $staffDirectory->contract_type) selected @endif @endisset>Probation</option>
                                                                </select>
                                                                <span class="text-danger">@error('contract_type'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Basic Salary</label>
                                                                <input type="number" class="form-control" name="basic_salary" value='{{old('basic_salary')?old('basic_salary'):(isset($staffDirectory) ? $staffDirectory->basic_salary : '')}}' >
                                                                <span class="text-danger">@error('basic_salary'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Work Shift</label>
                                                                <input type="text" class="form-control" name="work_shift" value='{{old('work_shift')?old('work_shift'):(isset($staffDirectory) ? $staffDirectory->work_shift : '')}}' >
                                                                <span class="text-danger">@error('work_shift'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
{{--                                                        @isset($staffDirectory)--}}
{{--                                                        <div class="col-12"><h4 class="detail-header">Leaves</h4></div>--}}
{{--                                                        @foreach($staffDirectory->leave_requests as $leaveType)--}}
{{--                                                            <div class="col-lg-6 col-md-6 col-sm-12">--}}
{{--                                                                <div class="form-group">--}}
{{--                                                                    <label class="form-label">{{$leaveType->name}}</label>--}}
{{--                                                                    <input type="number" class="form-control" name="bank_name" value='{{isset($staffDirectory) ? $staffDirectory->bank_name : ''}}' >--}}
{{--                                                                    <span class="text-danger">@error('bank_name'){{$message}}@enderror</span>--}}
{{--                                                                </div>--}}
{{--                                                        </div>--}}
{{--                                                        @endforeach--}}
{{--                                                        @endisset--}}

                                                        <div class="col-12"><h4 class="detail-header">Bank Account Details</h4></div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Bank Name</label>
                                                                <input type="text" class="form-control" name="bank_name" value='{{old('bank_name')?old('bank_name'):(isset($staffDirectory) ? $staffDirectory->bank_name : '')}}' >
                                                                <span class="text-danger">@error('bank_name'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Account Holder's Name</label>
                                                                <input type="text" class="form-control" name="bank_account_name" value='{{old('bank_account_name')?old('bank_account_name'):(isset($staffDirectory) ? $staffDirectory->bank_account_name : '')}}' >
                                                                <span class="text-danger">@error('bank_account_name'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Bank Account Number</label>
                                                                <input type="text" class="form-control" name="bank_account_number" value='{{old('bank_account_number')?old('bank_account_number'):(isset($staffDirectory) ? $staffDirectory->bank_account_number : '')}}' >
                                                                <span class="text-danger">@error('bank_account_number'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Bank Branch Name</label>
                                                                <input type="text" class="form-control" name="bank_branch_name" value='{{old('bank_branch_name')?old('bank_branch_name'):(isset($staffDirectory) ? $staffDirectory->bank_branch_name : '')}}' >
                                                                <span class="text-danger">@error('bank_branch_name'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-12"><h4 class="detail-header">Social Media Links</h4></div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Facebook Link</label>
                                                                <input type="text" class="form-control" name="facebook_link" value='{{old('facebook_link')?old('facebook_link'):(isset($staffDirectory) ? $staffDirectory->facebook_link : '')}}' >
                                                                <span class="text-danger">@error('facebook_link'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Instagram Link</label>
                                                                <input type="text" class="form-control" name="instagram_link" value='{{old('instagram_link')?old('instagram_link'):(isset($staffDirectory) ? $staffDirectory->instagram_link : '')}}' >
                                                                <span class="text-danger">@error('instagram_link'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Twitter Link</label>
                                                                <input type="text" class="form-control" name="twitter_link" value='{{old('twitter_link')?old('twitter_link'):(isset($staffDirectory) ? $staffDirectory->twitter_link : '')}}' >
                                                                <span class="text-danger">@error('twitter_link'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Linkedin Link</label>
                                                                <input type="text" class="form-control" name="linkedin_link" value='{{old('linkedin_link')?old('linkedin_link'):(isset($staffDirectory) ? $staffDirectory->linkedin_link : '')}}' >
                                                                <span class="text-danger">@error('linkedin_link'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-12"><h4 class="detail-header">Upload Documents</h4></div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Resume</label>
                                                                <input name="resume" type="file" class="dropify" data-height="100" accept=".doc,docx,.pdf,.xls,.xlsx,.ppt,.pptx" data-default-file="{{isset($staffDirectory) ? $staffDirectory->resume :''}}"/>
                                                                <span class="text-danger">@error('resume'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Joining Letter</label>
                                                                <input name="joining_letter" type="file" class="dropify" data-height="100" accept=".doc,docx,.pdf,.xls,.xlsx,.ppt,.pptx" data-default-file="{{isset($staffDirectory) ? $staffDirectory->joining_letter :''}}"/>
                                                                <span class="text-danger">@error('joining_letter'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Other Documents</label>
                                                                <input name="document" type="file" class="dropify" data-height="100" accept=".doc,docx,.pdf,.xls,.xlsx,.ppt,.pptx" data-default-file="{{isset($staffDirectory) ? $staffDirectory->document :''}}"/>
                                                                <span class="text-danger">@error('document'){{$message}}@enderror</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">{{isset($staffDirectory) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Complain List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Profile Image</th>
                                                <th>Staff ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($staff_directories as $key =>$item)
                                                <tr>
                                                    <td><img src="{{$item->profile_image}}" alt="" style="height: 50px; width: 50px;"></td>
                                                    <td>{{$item->staff_id}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{$item->gender}}</td>
                                                    <td>{{$item->current_address}}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.staff_directory.show', $item)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('staff_directory.show', $item)}}
                                                                @endif
                                                                " class="btn btn-sm btn-primary m-1"><i class="la la-eye"></i></a>
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.staff_directory.edit', $item)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('staff_directory.edit', $item)}}
                                                                @endif
                                                                " class="btn btn-sm btn-warning m-1"><i class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.staff_directory.destroy',$item)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('staff_directory.destroy',$item)}}
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
@endsection
@section('scripts')
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endsection


