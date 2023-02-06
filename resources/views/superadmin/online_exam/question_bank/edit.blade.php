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
                            <h5 class="card-title">Edit Question</h5>
                        </div>
                        <div class="card-body">
                            @if (session()->get('success'))
                                @include('includes.dashboard.message')
                            @endif
                            <form action="{{ route('question.bank.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $question_bank->id }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Class</label>
                                            <select class="form-control" name="class_id" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}" {{ ($class->id == $question_bank->eclasses_id) ? 'selected' : '' }}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('route_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Section</label>
                                            <select class="form-control" name="section_id" id="section_holder" required>
                                                <option>Please Select </option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}" {{ ($section->id == $question_bank->section_id) ? 'selected' : '' }}>{{ $section->name }} ({{ $section->class->name }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Subject</label>
                                            <select class="form-control" name="subject_id" id="subject_holder" required>
                                                <option>Please Select</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}" {{ ($subject->id == $question_bank->subject_id) ? 'selected' : '' }}>{{ $subject->name }} ({{ $subject->class->name }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Question Type</label>
                                            <input type="hidden" name="question_type" value="{{ $question_bank->question_type }}">
                                            <input type="text" class="form-control" value="{{ $question_bank->question_type }}" disabled>
                                            <span class="text-danger">@error('vehicle_id'){{$message}}@enderror</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Question Level</label>
                                            <select class="form-control" name="question_level" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($question_levels as $question_level)
                                                    <option value="{{ $question_level }}" {{ ($question_level == $question_bank->question_level) ? 'selected' : '' }}>{{ ucfirst($question_level) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('vehicle_id'){{$message}}@enderror</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Question</label>
                                            <input type="text" class="form-control" max="255" name="question" value="{{ $question_bank->question }}" required>
                                            <span class="text-danger">@error('question'){{$message}}@enderror</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        @if($question_bank->question_type == 'single_choice' || $question_bank->question_type == 'multiple_choice' )
                                            @include('common.answer.edit.single_multiple')
                                        @elseif($question_bank->question_type == 'true_or_false')
                                            @include('common.answer.edit.true_or_false')
                                        @endif
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">+ Update</button>
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
