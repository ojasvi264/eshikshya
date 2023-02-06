@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Exam Grade</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Examination</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Exam Grade</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Exam Grade</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('exam_grade.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Grade Name </label>
                                            <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Enter Grade Name" name="name" required>
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Percent From </label>
                                            <input type="number" step="any" class="form-control" value="{{ old('per_from') }}" placeholder="Enter lowest percentage limit" name="per_from" required>
                                            <span class="text-danger">@error('per_from'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Percent To </label>
                                            <input type="number" step="any" class="form-control" value="{{ old('per_to') }}" placeholder="Enter highest percentage limit" name="per_to" required>
                                            <span class="text-danger">@error('per_to'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Grade Point </label>
                                            <input type="text" class="form-control" value="{{ old('grade_point') }}" placeholder="Enter point for this grade" name="grade_point" required>
                                            <span class="text-danger">@error('per_from'){{$message}}@enderror</span>
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
                                    <h4 class="card-title">Exam Grade List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="grade" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Percent From / Upto</th>
                                                <th>Grade Point</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($exam_grades as $key =>$item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->per_from }} - {{ $item->per_to }}</td>
                                                    <td>{{ $item->grade_point }}</td>
                                                    <td>
                                                        <a href="{{ route('exam_grade.edit', $item) }}" class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                        <a href="{{ route('exam_grade.delete', $item) }}" class="btn btn-sm btn-danger m-1"><i class="la la-trash-o"></i></a>
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
