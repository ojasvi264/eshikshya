@extends('layouts.base_temp')
@section('styles')
    <style>
        .manage-syllabus-switch input[type="checkbox"]:after {
            display: none;
        }
        .closeCompletionDate {
            margin-right: 335px;
        }
    </style>
@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Manage Syllabus Status</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lesson Plans</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Manage Syllabus Status</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Select required fields</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{route('admin.get_lessons.search')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        {{route('teacher.get_lessons.search')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{route('get_lessons.search')}}
                                @endif
                                " method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="class_id" id="class_id" required>
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value='{{ $class->id }}'
                                                            @if($class->id == request()->class_id ) selected @endif>{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('class_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="section_id" id="section_id">
                                                <option value="">Select Section</option>
                                                @foreach ($sections as $section)
                                                    <option value='{{ $section->id }}'
                                                            @if($section->id == request()->section_id) selected @endif>{{$section->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('section_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Subject</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="subject_id" id="subject_id">
                                                <option value="">Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option value='{{ $subject->id }}'
                                                            @if($subject->id == request()->subject_id) selected @endif>{{$subject->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('subject_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @isset($searchedLessons)
                    <div class="col-lg-12">
                        <div class="row tab-content">
                            <div id="list-view" class="tab-pane fade active show col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Role List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                <tr>
                                                    <th>Lesson - Topic</th>
                                                    <th>Status</th>
                                                    <th>Topic Completion Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach($searchedLessons as $lesson)
                                                    @php
                                                        $j = 1;
                                                    @endphp

                                                    <tr>
                                                        <td>{{$i++}}. {{$lesson->name}}</td>
                                                    </tr>
                                                    @foreach($lesson->topics as $key =>$topic)
                                                        <tr>
                                                            <td style="padding-left: 40px">{{$i-1}}
                                                                .{{$j++}} {{$topic->name}}</td>
                                                            <td>
                                                                @if($topic->status==1)
                                                                    <span class="badge bg-success">Completed</span>
                                                                @else
                                                                    <span class="badge bg-danger">Incomplete</span>
                                                                @endif
                                                            </td>
                                                            <td>{{$topic->completion_date}}</td>
                                                            <td>
                                                                <div class="form-check form-switch manage-syllabus-switch">
                                                                    @if($topic->completion_status == 1)
                                                                    <input class="form-check-input" type="radio"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#closeSyllabusModel"
                                                                           data-id="{{$topic->id}}"
                                                                           checked>
                                                                    @else
                                                                        <input class="form-check-input" type="radio"
                                                                               data-bs-toggle="modal"
                                                                               data-bs-target="#manageSyllabusModel"
                                                                               data-id="{{$topic->id}}">
                                                                    @endif
                                                                    <label class="form-check-label"
                                                                           for="flexSwitchCheckDefault">Completion
                                                                        Status</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                <div class="modal fade" id="manageSyllabusModel" tabindex="-1"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    <strong>Have you completed the topic?</strong>
                                                                </h5>
                                                                <button type="button" class="btn-close closeCompletionDate"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul>
                                                                    <li>
                                                                        <strong>Topic Completion Date</strong>
                                                                        <input type="date" class="form-control"
                                                                               id="completion_date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}"
                                                                               name="completion_date" required>
                                                                        <span id="date_error_msg"></span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="d-flex">
                                                                    <button type="button" class="btn btn-danger closeCompletionDate"
                                                                            data-bs-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary"
                                                                            id="submitCompletionDate">Save
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="closeSyllabusModel" tabindex="-1"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    <strong>Are you sure you haven't completed the topic?</strong>
                                                                </h5>
                                                                <button type="button" class="btn-close closeCompletionDate"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger closeCompletionDate"
                                                                        data-bs-dismiss="modal">No
                                                                </button>
                                                                <button type="button" class="btn btn-primary"
                                                                        id="changeCompletionDate">Yes
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
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
            var myModalEl = document.getElementById('manageSyllabusModel')
            myModalEl.addEventListener('shown.bs.modal', function (event) {
                const relatedTarget = $(event.relatedTarget);
                const id = relatedTarget.data('id');
                $('#submitCompletionDate').data('id', id);
                $('.closeCompletionDate').click(function (){
                    window.location.reload();
                })
            });

            $('#submitCompletionDate').click(function () {
                let completion_date = $('#completion_date').val();
                if (!completion_date){
                    $('#date_error_msg').append(`<span class="text-danger">Completion Date is Required</span>`)
                    return;
                }
                const id = $(this).data('id');
                console.log(completion_date);
                $.ajax({
                    type: 'GET',
                    url: '/completion_date/' + id,
                    data: {completion_date: completion_date},
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        window.location.reload();
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var myModalEl = document.getElementById('closeSyllabusModel')
            myModalEl.addEventListener('shown.bs.modal', function (event) {
                const relatedTarget = $(event.relatedTarget);
                const id = relatedTarget.data('id');
                $('#changeCompletionDate').data('id', id);
                // $('.closeCompletionDate').click(function (){
                //     window.location.reload();
                // })
            });

            $('#changeCompletionDate').click(function(){
                const id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: 'GET',
                    url: '/remove_completion_date/' + id,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        window.location.reload();
                    }
                });
            });
        });

    </script>


@endsection



