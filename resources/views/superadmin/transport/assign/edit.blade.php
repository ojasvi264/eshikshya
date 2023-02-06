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
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Assign Vehicle</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Assigned Vehicle On Route</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('assign.vehicle.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $assigned_vehicle->id }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Route</label>
                                            <select class="form-control select" name="route_id" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($routes as $route)
                                                    <option value="{{ $route->id }}" {{ ($route->id == $assigned_vehicle->route_id) ? 'selected' : '' }}>{{ $route->title }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('route_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Vehicle</label>
                                            <select class="form-control select" name="vehicle_ids" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($vehicles as $vehicle)
                                                    <option value="{{ $vehicle->id }}" {{ ($vehicle->id == $assigned_vehicle->vehicle_id) ? 'selected' : '' }}>{{ $vehicle->vehicle_number }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('vehicle_id'){{$message}}@enderror</span>
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
