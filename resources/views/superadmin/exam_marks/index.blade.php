@extends('layouts.base_temp')
@section('dashboard.navbar')@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Manage Marks</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Examination</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Manage Marks</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Manage Mark</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('exam_mark.create') }}" method="get">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" >Exam </label>
                                            <select class="form-control select" name="exam_id" id="exam_id" required>
                                                <option value="" disabled selected>Please Select</option>
                                                @foreach($exams as $exam)
                                                    <option value="{{ $exam->id }}">{{$exam->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('exam_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" >Class</label>
                                            <select class="form-control" name="class_id" onchange="getClassSections(this.value);getClassSubject(this.value);" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('route_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" >Section</label>
                                            <select class="form-control" name="section_id" id="section_holder" required>
                                                <option>Please Select Class First</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" >Subject</label>
                                            <select class="form-control" name="subject_id" id="subject_holder" required>
                                                <option>Please Select Class First</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Manage</button>
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
@section('scripts')
    <script>
        function getClassSections(class_id) {
            if (class_id !== '') {
                let exam_id = $('#exam_id').find(":selected").val();
                $.ajax({
                    url: '{{ url('/class/sections') }}'+'/'+ class_id + '/' + exam_id ,
                    success: function(response)
                    {
                        jQuery('#section_holder').html(response);
                    }
                });
            }
        }

        function getClassSubject(class_id) {
            if (class_id !== '') {
                let exam_id = $('#exam_id').find(":selected").val();
                $.ajax({
                    url: '{{ url('/class/subjects') }}'+'/'+ class_id + '/' + exam_id ,
                    success: function(response)
                    {
                        jQuery('#subject_holder').html(response);
                    }
                });
            }
        }
    </script>
@endsection
