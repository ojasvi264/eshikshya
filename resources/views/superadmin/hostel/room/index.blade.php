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
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Hostel Room</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Hostel Room</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('hostel.room.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Room Number / Name</label>
                                            <input type="text" class="form-control" value="{{ old('room_number') }}" placeholder="Enter Hostel's Room Number or Name" name="room_number" required>
                                            <span class="text-danger">@error('room_number'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Hostel</label>
                                            <select class="form-control select" name="hostel_id" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($hostels as $hostel)
                                                    <option value="{{ $hostel->id }}">{{ $hostel->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('hostel_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Room Type</label>
                                            <select class="form-control select" name="room_type_id" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($room_types as $room_type)
                                                    <option value="{{ $room_type->id }}">{{ $room_type->room_type }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('room_type_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Number Of Bed </label>
                                            <input type="number" class="form-control" value="{{ old('number_of_bed') }}" placeholder="Enter Number of beds in the room" name="number_of_bed" required>
                                            <span class="text-danger">@error('number_of_bed'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Cost Per Bed </label>
                                            <input type="number" class="form-control" value="{{ old('cost_per_bed') }}" placeholder="Enter Cost Per bed" name="cost_per_bed" required>
                                            <span class="text-danger">@error('cost_per_bed'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" placeholder="Enter Room Type Description" name="description" required>{{ old('description') }}</textarea>
                                            <span class="text-danger">@error('description'){{$message}}@enderror</span>
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
                                    <h4 class="card-title">Hostel Room List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Room Number / Name</th>
                                                <th>Hostel</th>
                                                <th>Room Type</th>
                                                <th>Number Of Bed</th>
                                                <th>Cost Per Bed</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($hostel_rooms as $key =>$item)
                                                <tr>
                                                    <td>{{ $item->room_number }}</td>
                                                    <td>{{ $item->hostel->name }}</td>
                                                    <td>{{ $item->room_type->room_type }}</td>
                                                    <td>{{ $item->number_of_bed }}</td>
                                                    <td>NPR {{ $item->cost_per_bed }}</td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <span class="badge bg-success text-white">Active</span>
                                                        @else
                                                            <span class="badge bg-danger text-white">Deleted</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <a href="{{ route('hostel.room.edit', $item->id) }}" class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <a href="{{ route('hostel.room.destroy', $item->id) }}" class="btn btn-sm btn-danger m-1"><i class="la la-trash-o"></i></a>
                                                        @else
                                                            <a href="{{ route('hostel.room.restore', $item->id) }}" class="btn btn-sm btn-primary m-1">Restore</a>
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
