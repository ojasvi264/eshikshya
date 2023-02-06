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
                            <h5 class="card-title">Add Vehicle</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('vehicle.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Vehicle Number </label>
                                            <input type="text" class="form-control" value="{{ old('vehicle_number') }}" placeholder="Enter Vehicle Number" name="vehicle_number" required>
                                            <span class="text-danger">@error('vehicle_number'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Vehicle Model </label>
                                            <input type="text" class="form-control" value="{{ old('vehicle_model') }}" placeholder="Enter Vehicle Model" name="vehicle_model" required>
                                            <span class="text-danger">@error('vehicle_model'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Year Made </label>
                                            <input type="text" class="form-control" value="{{ old('year') }}" placeholder="Enter Vehicle's Manufacture Year" name="year" required>
                                            <span class="text-danger">@error('year'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Driver Name </label>
                                            <input type="text" class="form-control" value="{{ old('driver_name') }}" placeholder="Enter Driver Name" name="driver_name" required>
                                            <span class="text-danger">@error('driver_name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Driver License </label>
                                            <input type="text" class="form-control" value="{{ old('driver_license') }}" placeholder="Enter Driver's License Number" name="driver_license" required>
                                            <span class="text-danger">@error('driver_license'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Driver Contact </label>
                                            <input type="text" class="form-control" value="{{ old('driver_contact') }}" placeholder="Enter Driver's Contact Number" name="driver_contact" required>
                                            <span class="text-danger">@error('driver_contact'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Note </label>
                                            <input type="text" class="form-control" value="{{ old('note') }}" placeholder="Enter Additional Information" name="note" required>
                                            <span class="text-danger">@error('note'){{$message}}@enderror</span>
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
                                    <h4 class="card-title">Vehicle List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Vehicle Number</th>
                                                <th>Vehicle Model</th>
                                                <th>Year Made</th>
                                                <th>Driver License</th>
                                                <th>Driver Contact</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($vehicles as $key =>$item)
                                                <tr>
                                                    <td>{{ $item->vehicle_number }}</td>
                                                    <td>{{ $item->vehicle_model }}</td>
                                                    <td>{{ $item->year }}</td>
                                                    <td>{{ $item->driver_license }}</td>
                                                    <td>{{ $item->driver_contact }}</td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <span class="badge bg-success text-white">Active</span>
                                                        @else
                                                            <span class="badge bg-danger text-white">Deleted</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <a href="{{ route('vehicle.edit', $item->id) }}" class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <a href="{{ route('vehicle.destroy', $item->id) }}" class="btn btn-sm btn-danger m-1"><i class="la la-trash-o"></i></a>
                                                        @else
                                                            <a href="{{ route('vehicle.restore', $item->id) }}" class="btn btn-sm btn-primary m-1">Restore</a>
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
