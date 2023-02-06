@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Exam</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Examination</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Exam</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Exam</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('exam.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="session_id" value="{{ $school_setting->session_id }}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Exam Type</label>
                                            <select class="form-control" name="exam_type_id">
                                                <option value="">Select Exam Type</option>
                                                @foreach ($exam_types as $exam_type)
                                                    <option value='{{ $exam_type->id }}'>{{$exam_type->exam_type}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('class_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label" >Name </label>
                                            <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Enter  Name" name="name" required>
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Class</label>
                                            <select class="form-control" name="eclasses_id" id="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value='{{ $class->id }}' @isset($lesson)@if($class->id == $lesson->class->id) selected @endif @endisset>{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('class_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Section</label>
                                            <select class="form-control" name="section_id" id="section_id">
                                                <option value="">Select Section</option>
                                                @foreach ($sections as $section)
                                                    <option value='{{ $section->id }}' @isset($lesson)@if($section->id == $lesson->section->id) selected @endif @endisset>{{$section->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('section_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label" >Date From </label>
                                            <input type="date" class="form-control" value="{{ old('date_from') }}" name="date_from" required>
                                            <span class="text-danger">@error('date_from'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label" >Date To </label>
                                            <input type="date" class="form-control" value="{{ old('date_to') }}" name="date_to" required>
                                            <span class="text-danger">@error('per_to'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label" >Result Date </label>
                                            <input type="date" class="form-control" value="{{ old('result_date') }}" name="result_date" required>
                                            <span class="text-danger">@error('result_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label" >Description </label>
                                            <input type="text" class="form-control" value="{{ old('description') }}" name="description">
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
                                    <h4 class="card-title">Exam List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="grade" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Name</th>
                                                <th>Class / Section</th>
                                                <th>Session</th>
                                                <th>Date From-To</th>
                                                <th>Result Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($datas as $key =>$item)
                                                <tr>
                                                    <td>{{ $item->examType->exam_type }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->class->name }} ({{ $item->section->name }})</td>
                                                    <td>{{ $item->session->session_year }}</td>
                                                    <td>{{ $item->date_from }} - {{ $item->date_to }}</td>
                                                    <td>{{ $item->result_date }}</td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <span class="badge bg-success text-white">Active</span>
                                                        @else
                                                            <span class="badge bg-danger text-white">Deleted</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <a href="{{ route('exam_schedule.create.exam', $item) }}" class="btn btn-sm btn-primary m-1" data-toggle="tooltip" data-placement="top" title="Add Exam Schedule"><i class="fa fa-plus"></i></a>
                                                            <a href="{{ route('exam.student', $item) }}" class="btn btn-sm btn-primary m-1" data-toggle="tooltip" data-placement="top" title="Assign Student"><i class="fa fa-plus"></i></a>
                                                            <a href="{{ route('exam.edit', $item) }}" class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <a href="{{ route('exam.delete', $item) }}" class="btn btn-sm btn-danger m-1"><i class="la la-trash-o"></i></a>
                                                        @else
                                                            <a href="{{ route('exam.restore', $item) }}" class="btn btn-sm btn-primary m-1">Restore</a>
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
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#class_id').on('change', function () {
                let id = $(this).val();
                $('#section_id').empty();
                $('#section_id').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/getSections/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#section_id').empty();
                        $('#section_id').append(`<option value="0" disabled selected>Select Sections*</option>`);
                        response.forEach(element => {
                            $('#section_id').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
@endsection
