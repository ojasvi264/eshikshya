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
                            <h5 class="card-title">Edit Hostel Room</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('hostel.room.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $room->id }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Room Number / Name</label>
                                            <input type="text" class="form-control" value="{{ $room->room_number }}" placeholder="Enter Hostel's Room Number or Name" name="room_number" required>
                                            <span class="text-danger">@error('room_number'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Hostel</label>
                                            <select class="form-control" name="hostel_id" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($hostels as $hostel)
                                                    <option value="{{ $hostel->id }}" {{ ($room->hostel_id == $hostel->id) ? 'selected' : '' }}>{{ $hostel->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('hostel_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Room Type</label>
                                            <select class="form-control" name="room_type_id" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($room_types as $room_type)
                                                    <option value="{{ $room_type->id }}" {{ ($room->room_type_id == $room_type->id) ? 'selected' : '' }}>{{ $room_type->room_type }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('room_type_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Number Of Bed </label>
                                            <input type="number" class="form-control" value="{{ $room->number_of_bed }}" placeholder="Enter Number of beds in the room" name="number_of_bed" required>
                                            <span class="text-danger">@error('number_of_bed'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Cost Per Bed </label>
                                            <input type="number" class="form-control" value="{{ $room->cost_per_bed }}" placeholder="Enter Cost Per bed" name="cost_per_bed" required>
                                            <span class="text-danger">@error('cost_per_bed'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" placeholder="Enter Room Type Description" name="description" required>{{ $room->description }}</textarea>
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
