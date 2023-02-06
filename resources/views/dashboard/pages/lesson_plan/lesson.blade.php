@extends('layouts.base_temp')
{{--@section('styles')--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/amsify.suggestags.css')}}">--}}
{{--    <style>--}}
{{--        span.fa.fa-times.amsify-remove-tag:hover {--}}
{{--            color: red;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endsection--}}
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Lesson</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lesson</a></li>
                    </ol>g
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Lesson</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{isset($lesson) ? route('admin.lesson.update', $lesson) : route('admin.lesson.store')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        {{isset($lesson) ? route('teacher.lesson.update', $lesson) : route('teacher.lesson.store')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{isset($lesson) ? route('lesson.update', $lesson) : route('lesson.store')}}
                                @endif
                                " method="POST">
                                @csrf
                                @if(isset($lesson))
                                    @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="class_id" id="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value='{{ $class->id }}' @isset($lesson)@if($class->id == $lesson->class->id) selected @endif @endisset>{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('class_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="section_id" id="section_id">
                                                <option value="">Select Section</option>
                                                @foreach ($sections as $section)
                                                    <option value='{{ $section->id }}' @isset($lesson)@if($section->id == $lesson->section->id) selected @endif @endisset>{{$section->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('section_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Subject</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="subject_id" id="subject_id">
                                                <option value="">Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option value='{{ $subject->id }}' @isset($lesson)@if($subject->id == $lesson->subject->id) selected @endif @endisset>{{$subject->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('subject_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Name</label><span style="color: red">&#42;</span>
                                                <input class="form-control" id="lessons" type="text" name="name" value="{{old('name')?old('name'):(isset($lesson) ? $lesson->name : '')}}" placeholder="Your Lesson Name">
{{--                                                <span style="color: #7356f1"> (Insert "," after each lessons)</span>--}}
                                            </div>
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">{{isset($lesson) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Lesson List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Subject</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($lessons as $key =>$lesson)
                                                <tr>
                                                    <td>{{$lesson->name}}</td>
                                                    <td>{{$lesson->class->name}}</td>
                                                    <td>{{$lesson->section->name}}</td>
                                                    <td>{{$lesson->subject->name}}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.lesson.edit', $lesson)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.lesson.edit', $lesson)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('lesson.edit', $lesson)}}
                                                                @endif
                                                                " class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.lesson.destroy',$lesson)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.lesson.destroy',$lesson)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('lesson.destroy',$lesson)}}
                                                                @endif
                                                                " method="post" onsubmit="return confirm('Are you sure?')">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger m-1"  data-toggle="modal" data-target="#deleteModal">
                                                                    <i class="la la-trash-o"></i>
                                                                </button>
                                                            </form>
                                                        </div>
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
{{--    <script type="text/javascript" src="{{asset('admin/js/jquery.amsify.suggestags.js')}}"></script>--}}
{{--    <script type="text/javascript">--}}
{{--        $('#lessons').amsifySuggestags({--}}
{{--        });--}}
{{--    </script>--}}
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
    <script>
        $(document).ready(function () {
            $('#class_id').on('change', function () {
                let id = $(this).val();
                $('#subject_id').empty();
                $('#subject_id').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/getSubjects/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#subject_id').empty();
                        $('#subject_id').append(`<option value="0" disabled selected>Select Subjects*</option>`);
                        response.forEach(element => {
                            $('#subject_id').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#class_id').on('change', function () {--}}
{{--                let id = $(this).val();--}}
{{--                $('#group_id').empty();--}}
{{--                $('#group_id').append(`<option value="0" disabled selected>Processing...</option>`);--}}
{{--                $.ajax({--}}
{{--                    type: 'GET',--}}
{{--                    url: '/super/dashboard/getGroups/' + id,--}}
{{--                    success: function (response) {--}}
{{--                        var response = JSON.parse(response);--}}
{{--                        console.log(response);--}}
{{--                        $('#group_id').empty();--}}
{{--                        $('#group_id').append(`<option value="0" disabled selected>Select Groups*</option>`);--}}
{{--                        response.forEach(element => {--}}
{{--                            $('#group_id').append(`<option value="${element['id']}">${element['name']}</option>`);--}}
{{--                        });--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection


