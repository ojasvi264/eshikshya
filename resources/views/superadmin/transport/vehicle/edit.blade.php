@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Transport</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Transport</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Vehicle</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Vehicle</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('vehicle.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $vehicle->id }}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Vehicle Number </label>
                                            <input type="text" class="form-control" value="{{ $vehicle->vehicle_number }}" placeholder="Enter Vehicle Number" name="vehicle_number" required>
                                            <span class="text-danger">@error('vehicle_number'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Vehicle Model </label>
                                            <input type="text" class="form-control" value="{{ $vehicle->vehicle_model }}" placeholder="Enter Vehicle Model" name="vehicle_model" required>
                                            <span class="text-danger">@error('vehicle_model'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Year Made </label>
                                            <input type="text" class="form-control" value="{{ $vehicle->year }}" placeholder="Enter Vehicle's Manufacture Year" name="year" required>
                                            <span class="text-danger">@error('year'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Driver Name </label>
                                            <input type="text" class="form-control" value="{{ $vehicle->driver_name }}" placeholder="Enter Driver Name" name="driver_name" required>
                                            <span class="text-danger">@error('driver_name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Driver License </label>
                                            <input type="text" class="form-control" value="{{ $vehicle->driver_license }}" placeholder="Enter Driver's License Number" name="driver_license" required>
                                            <span class="text-danger">@error('driver_license'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Driver Contact </label>
                                            <input type="text" class="form-control" value="{{ $vehicle->driver_contact }}" placeholder="Enter Driver's Contact Number" name="driver_contact" required>
                                            <span class="text-danger">@error('driver_contact'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Note </label>
                                            <input type="text" class="form-control" value="{{ $vehicle->note }}" placeholder="Enter Additional Information" name="note" required>
                                            <span class="text-danger">@error('note'){{$message}}@enderror</span>
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
