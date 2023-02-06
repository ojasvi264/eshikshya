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
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Online Exam</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Online Exam</h4>
                                </div>
                                <div class="card-body">
                                    @include('includes.dashboard.message')
                                    <form action="{{ route('online.exam.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="checkbox-inline"><input type="checkbox" id="quiz" value="1" name="is_quiz" autocomplete="off">&nbsp;Quiz</label><br/>
                                                    <span class="text-primary mr-2">In quiz result will be display to student immediately just after exam submission (descriptive question type will be disabled).</span>
                                                </div>

                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label">Exam Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                                                    <span class="text-danger">@error('title'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Exam From Date</label>
                                                    <input type="date" class="form-control" name="exam_from_date" value="{{ old('exam_from_date') }}" required>
                                                    <span class="text-danger">@error('exam_from_date'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Exam From Time</label>
                                                    <input type="time" class="form-control" name="exam_from_time" value="{{ old('exam_from_time') }}" required>
                                                    <span class="text-danger">@error('exam_from_time'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Exam To Date</label>
                                                    <input type="date" class="form-control" name="exam_to_date" value="{{ old('exam_to_date') }}" required>
                                                    <span class="text-danger">@error('exam_to_date'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Exam To Time</label>
                                                    <input type="time" class="form-control" name="exam_to_time" value="{{ old('exam_to_time') }}" required>
                                                    <span class="text-danger">@error('exam_to_time'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Auto Result Publish Date</label>
                                                    <input type="date" class="form-control" name="auto_publis_result_date" value="{{ old('auto_publis_result_date') }}" required>
                                                    <span class="text-danger">@error('auto_publis_result_date'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Auto Result Publish Time</label>
                                                    <input type="time" class="form-control" name="auto_publis_result_time" value="{{ old('auto_publis_result_time') }}" required>
                                                    <span class="text-danger">@error('auto_publis_result_time'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Time Duration</label>
                                                    <input type="number" min="1" class="form-control" name="time_duration" value="{{ old('time_duration') }}" required>
                                                    <span class="text-danger">@error('time_duration'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Attempt</label>
                                                    <input type="number" class="form-control" name="number_of_attempt" value="{{ old('number_of_attempt') }}" required>
                                                    <span class="text-danger">@error('number_of_attempt'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label">Passing Percentage</label>
                                                    <input type="number" step="any" min="1" class="form-control" name="passing_percentage" value="{{ old('number_of_attempt') }}" required>
                                                    <span class="text-danger">@error('number_of_attempt'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <input type="checkbox" name="publish_exam" value="1"> Publish Exam
                                                <input type="checkbox" name="publish_result" id="publish_result" value="1"> Publish Result
                                                <input type="checkbox" name="negative_marking" value="1"> Negative Marking
                                                <input type="checkbox" name="display_marks_in_exam" value="1"> Display marks in Exam
                                                <input type="checkbox" name="random_question_order" value="1"> Random Question Order
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                                                <div class="form-group">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" name="description" id="editor">{{ old('description') }}</textarea>
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/admin/vendor/ckeditor/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <style>
        .ck-editor__editable_inline {
            min-height: 150px;
        }
    </style>
@endsection
