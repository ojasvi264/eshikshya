@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hostel</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Hostel</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Hostel</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Hostel</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('hostel.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $hostel->id }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Name</label>
                                            <input type="text" class="form-control" value="{{ $hostel->name }}" placeholder="Enter Hostel Name" name="name" required>
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Type</label>
                                            <select class="form-control" name="hostel_type" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($hostel_types as $hostel_type)
                                                    <option value="{{ $hostel_type }}" {{ ($hostel->hostel_type == $hostel_type) ? 'selected' : '' }}>{{ ucfirst($hostel_type) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('hostel_type'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Address</label>
                                            <input type="text" class="form-control" value="{{ $hostel->address }}" placeholder="Enter Hostel Address" name="address" required>
                                            <span class="text-danger">@error('address'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Intake</label>
                                            <input type="number" min="1" value="{{ $hostel->number_of_capacity }}" class="form-control" placeholder="Enter Hostel Intake Capacity" name="number_of_capacity" required>
                                            <span class="text-danger">@error('number_of_capacity'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" placeholder="Enter Hostel Description" name="description" required>{{ $hostel->description }}</textarea>
                                            <span class="text-danger">@error('description'){{$message}}@enderror</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">+ Update</button>
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
