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
                            <h5 class="card-title">Assign Vehicle On Route</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('assign.vehicle.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Route</label>
                                            <select class="form-control select" name="route_id" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($routes as $route)
                                                    <option value="{{ $route->id }}">{{ $route->title }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('route_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Vehicle</label>
                                            <select class="form-control select" name="vehicle_ids[]" multiple required>
                                                @foreach ($vehicles as $vehicle)
                                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('vehicle_id'){{$message}}@enderror</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">+ Add</button>
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
                                    <h4 class="card-title">Vehicle Route List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Route Title</th>
                                                <th>Vehicle</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($assigned_vehicles as $key =>$item)
                                                <tr>
                                                    <td>{{ $item->route->title }}</td>
                                                    <td>{{ $item->vehicle->vehicle_number }}</td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <span class="badge bg-success text-white">Active</span>
                                                        @else
                                                            <span class="badge bg-danger text-white">Deleted</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <a href="{{ route('assign.vehicle.edit', $item->id) }}" class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <a href="{{ route('assign.vehicle.destroy', $item->id) }}" class="btn btn-sm btn-danger m-1"><i class="la la-trash-o"></i></a>
                                                        @else
                                                            <a href="{{ route('assign.vehicle.restore', $item->id) }}" class="btn btn-sm btn-primary m-1">Restore</a>
                                                        @endif
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
