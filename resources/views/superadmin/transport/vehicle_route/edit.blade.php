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
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Route</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Route</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('vehicle.route.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $vehicle_route->id }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Route Title</label>
                                            <input type="text" class="form-control" value="{{ $vehicle_route->title }}" placeholder="Enter Route Name" name="title" required>
                                            <span class="text-danger">@error('title'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Fare</label>
                                            <input type="number" step="any" class="form-control" value="{{ $vehicle_route->fare }}" placeholder="Enter Route Fare(Price)" name="fare" required>
                                            <span class="text-danger">@error('fare'){{$message}}@enderror</span>
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
