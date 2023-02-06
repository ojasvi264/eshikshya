@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Fee Type</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fee Type</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Fee Type</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('fee.type.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $fee_type->id }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Class </label>
                                            <select class="form-control select" name="eclasses_id" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}" {{ ($fee_type->eclasses_id == $class->id) ? 'selected' : '' }}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('eclasses_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Name </label>
                                            <input type="text" class="form-control" value="{{ $fee_type->name }}" placeholder="Enter Fee Type Name" name="name" required>
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Amount </label>
                                            <input type="number" step="any" class="form-control" value="{{ $fee_type->amount }}" placeholder="Enter Fee Amount" name="amount" required>
                                            <span class="text-danger">@error('amount'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Description </label>
                                            <textarea name="description" class="form-control">{{ $fee_type->description }}</textarea>
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
