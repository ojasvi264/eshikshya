@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Online Exam</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Online Exam</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Question</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Question</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('question.bank.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
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
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Section</label>
                                            <select class="form-control" name="section_id" id="section_holder" required>
                                                <option>Please Select Class First</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Subject</label>
                                            <select class="form-control" name="subject_id" id="subject_holder" required>
                                                <option>Please Select Class First</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Question Type</label>
                                            <select class="form-control" name="question_type" onchange="getAnswerField(this.value)" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($question_types as $question_type)
                                                    <option value="{{ $question_type }}">{{ ucfirst($question_type) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('question_type'){{$message}}@enderror</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Question Level</label>
                                            <select class="form-control" name="question_level" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($question_levels as $question_level)
                                                    <option value="{{ $question_level }}">{{ ucfirst($question_level) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('question_level'){{$message}}@enderror</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Question</label>
                                            <input type="text" class="form-control" max="255" name="question" value="{{ old('question') }}" required>
                                            <span class="text-danger">@error('question'){{$message}}@enderror</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div id="answer_holder">

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
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function getClassSections(class_id) {
            if (class_id !== '') {
                $.ajax({
                    url: '{{ url('/class/sections') }}'+'/'+ class_id ,
                    success: function(response)
                    {
                        jQuery('#section_holder').html(response);
                    }
                });
            }
        }

        function getClassSubject(class_id) {
            if (class_id !== '') {
                $.ajax({
                    url: '{{ url('/class/subjects') }}'+'/'+ class_id ,
                    success: function(response)
                    {
                        jQuery('#subject_holder').html(response);
                    }
                });
            }
        }

        function getAnswerField(question_type){
            if (question_type !== '') {
                $.ajax({
                    url: '{{ url('/answer/field') }}'+'/'+ question_type ,
                    success: function(response)
                    {
                        jQuery('#answer_holder').html(response);
                    }
                });
            }
        }
    </script>
@endsection
