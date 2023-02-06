@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>School Setting</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">School Setting</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('school.setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $school_setting->name }}" required>
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Slogan</label>
                                            <input type="text" class="form-control" name="slogan" value="{{ $school_setting->slogan }}" required>
                                            <span class="text-danger">@error('slogan'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Established Year</label>
                                            <input type="number" class="form-control" name="established_year" value="{{ $school_setting->established_year }}" required>
                                            <span class="text-danger">@error('established_year'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" name="phone_number" value="{{ $school_setting->phone_number }}" required>
                                            <span class="text-danger">@error('phone_number'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" name="email_address" value="{{ $school_setting->email_address }}" required>
                                            <span class="text-danger">@error('email_address'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" value="{{ $school_setting->address }}" required>
                                            <span class="text-danger">@error('address'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Take Late Fee</label>
                                            <select class="form-control" name="take_late_fee" required>
                                                <option disabled selected>Please Select</option>
                                                <option value="1" {{ ($school_setting->take_late_fee == 1) ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ ($school_setting->take_late_fee == 0) ? 'selected' : '' }}>No</option>
                                            </select>
                                            <span class="text-danger">@error('take_late_fee'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Type of Late Fee</label>
                                            <select class="form-control" name="type_of_late_fee" required>
                                                <option disabled selected>Please Select</option>
                                                <option value="percentage" {{ ($school_setting->type_of_late_fee == 'percentage') ? 'selected' : '' }}>Percentage</option>
                                                <option value="amount" {{ ($school_setting->type_of_late_fee == 'amount') ? 'selected' : '' }}>Amount</option>
                                            </select>
                                            <span class="text-danger">@error('type_of_late_fee'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Late Fee Value</label>
                                            <input type="number" step="any" class="form-control" name="late_fee_value" value="{{ $school_setting->late_fee_value }}" required>
                                            <span class="text-danger">@error('late_fee_value'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Late Fee After</label>
                                            <input type="number" class="form-control" name="late_fee_after" value="{{ $school_setting->late_fee_after }}" required>
                                            <span class="text-danger">@error('late_fee_after'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Logo</label>
                                            <input type="file" accept="image/*" class="form-control-file" name="logo">
                                            <span class="text-danger">@error('logo'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Session</label>
                                            <select class="form-control select" name="session_id" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach($sessions as $session)
                                                    <option value="{{ $session->id }}" {{ ($school_setting->session_id == $session->id) ? 'selected' : '' }}>{{ $session->session_year }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('session_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Result Type</label>
                                            <select class="form-control select" name="result_type" required>
                                                <option disabled selected>Please Select</option>
                                                <option value="percentage" {{ ($school_setting->result_type == 'percentage') ? 'selected' : '' }}>Percentage</option>
                                                <option value="grade" {{ ($school_setting->result_type == 'grade') ? 'selected' : '' }}>Grade</option>
                                            </select>
                                            <span class="text-danger">@error('result_type'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
