@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Exam Schedule</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Examination</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Exam Schedule</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Select Criteria</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="#" >
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Exam Type</label>
                                            <select class="form-control select" name="exam_type_id" id="exam_type_id">
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
                                            <label class="form-label" >Exam </label>
                                            <select class="form-control select" name="exam_id" id="exam_id" required>
                                                <option value="" disabled selected>Please Select</option>
                                                @foreach($exams as $exam)
                                                    <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('exam_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" id="search">Search</button>
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
                                    <h4 class="card-title">Exam Schedule</h4>
                                </div>
                                <div class="card-body">
                                    <div id="schedule_holder"></div>
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
            $('#exam_type_id').on('change', function () {
                let id = $(this).val();
                $('#exam_id').empty();
                $('#exam_id').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/getExams/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        $('#exam_id').empty();
                        $('#exam_id').append(`<option value="0" disabled selected>Select Exam*</option>`);
                        response.forEach(element => {
                            $('#exam_id').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });

            $("#search").click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "get",
                    url: "/getSchedules/",
                    data: {
                        exam_id: $("#exam_id").val(),
                    },
                    success: function(result) {
                        $("#schedule_holder").html(result)
                    },
                    error: function(result) {
                        alert('error');
                    }
                });
            });
        });
    </script>
@endsection
