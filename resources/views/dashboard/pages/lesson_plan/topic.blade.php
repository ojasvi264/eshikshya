@extends('layouts.base_temp')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/amsify.suggestags.css')}}">
    <style>
        span.fa.fa-times.amsify-remove-tag:hover {
            color: red;
        }
    </style>
@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Topic</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Topic</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Topic</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{isset($topic) ? route('admin.topic.update', $topic) : route('admin.topic.store')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        {{isset($topic) ? route('teacher.topic.update', $topic) : route('teacher.topic.store')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{isset($topic) ? route('topic.update', $topic) : route('topic.store')}}
                                @endif
                                " method="POST">
                                @csrf
                                @if(isset($topic))
                                    @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class </label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="class_id" id="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value='{{ $class->id }}' @isset($topic)@if($class->id == $topic->class->id) selected @endif @endisset>{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('class_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section </label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="section_id" id="section_id">
                                                <option value="">Select Section</option>
                                                @foreach ($sections as $section)
                                                    <option value='{{ $section->id }}' @isset($topic)@if($section->id == $topic->section->id) selected @endif @endisset>{{$section->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('section_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Subject </label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="subject_id" id="subject_id">
                                                <option value="">Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option value='{{ $subject->id }}' @isset($topic)@if($subject->id == $topic->subject->id) selected @endif @endisset>{{$subject->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('subject_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
{{--                                    <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="form-label">Group </label><span style="color: red">&#42;</span>--}}
{{--                                            <select class="form-control" name="group_id" id="group_id">--}}
{{--                                                <option value="">Select Group</option>--}}
{{--                                                @foreach ($groups as $group)--}}
{{--                                                    <option value='{{ $group->id }}' @isset($topic)@if($group->id == $topic->group->id) selected @endif @endisset>{{$group->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <span class="text-danger">@error('group_id'){{$message}}@enderror</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Lesson </label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="lesson_id" id="lesson_id">
                                                <option value="">Select Lessons</option>
                                                @foreach ($lessons as $lesson)
                                                    <option value='{{ $lesson->id}}' @isset($topic)@if($lesson->id == $topic->lesson->id) selected @endif @endisset>{{$lesson->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('lesson_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Name</label><span style="color: red">&#42;</span>
                                                <input class="form-control" id="topics" type="text" name="name" value="{{old('name')?old('name'):(isset($topic) ? $topic->name : '')}}" placeholder="Your Topic Names">
                                                <span style="color: #7356f1"> (Insert "," after each topics)</span>
                                            </div>
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">{{isset($topic) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Topic List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Subject</th>
                                                <th>Lesson</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                            $i = 1;
                                            @endphp
                                            @foreach($topics as $key =>$topic)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$topic->class->name}}</td>
                                                    <td>{{$topic->section->name}}</td>
                                                    <td>{{$topic->subject->name}}</td>
                                                    <td>{{$topic->lesson->name}}</td>
                                                    <td>{{$topic->name}}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.topic.edit', $topic)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.topic.edit', $topic)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('topic.edit', $topic)}}
                                                                @endif
                                                                " class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.topic.destroy',$topic)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.topic.destroy',$topic)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('topic.destroy',$topic)}}
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
    <script type="text/javascript" src="{{asset('admin/js/jquery.amsify.suggestags.js')}}"></script>
    <script type="text/javascript">
    $('#topics').amsifySuggestags({
    });
    </script>

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
    <script>
        $(document).ready(function () {
            $('#subject_id').on('change', function () {
                let id = $(this).val();
                $('#lesson_id').empty();
                $('#lesson_id').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/getSubjectLessons/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#lesson_id').empty();
                        $('#lesson_id').append(`<option value="0" disabled selected>Select Lessons*</option>`);
                        response.forEach(element => {
                            $('#lesson_id').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
@endsection


