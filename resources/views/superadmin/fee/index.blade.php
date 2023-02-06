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
                            <h5 class="card-title">Add Fee Type</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('fee.type.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Class </label>
                                            <select class="form-control select" multiple name="eclasses_ids[]" required>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('eclasses_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Name </label>
                                            <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Enter Fee Type Name" name="name" required>
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Amount </label>
                                            <input type="number" step="any" class="form-control" value="{{ old('amount') }}" placeholder="Enter Fee Amount" name="amount" required>
                                            <span class="text-danger">@error('amount'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Description </label>
                                            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
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
                                    <h4 class="card-title">Fee Type List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($fee_types as $key =>$item)
                                                <tr>
                                                    <td>{{ $item->class->name }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>NPR {{ $item->amount }}</td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <span class="badge bg-success text-white">Active</span>
                                                        @else
                                                            <span class="badge bg-danger text-white">Deleted</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <a href="{{ route('fee.type.edit', $item->id) }}" class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <a href="{{ route('fee.type.destroy', $item->id) }}" class="btn btn-sm btn-danger m-1"><i class="la la-trash-o"></i></a>
                                                        @else
                                                            <a href="{{ route('fee.type.restore', $item->id) }}" class="btn btn-sm btn-primary m-1">Restore</a>
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
