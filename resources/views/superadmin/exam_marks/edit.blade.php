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
                            <form action="{{ route('exam_mark.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="class_id" value="{{ $class->id }}">
                                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                <input type="hidden" name="section" value="{{ $section->id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Exam</th>
                                                <th>{{ $exam->name }}</th>
                                            </tr>
                                            <tr>
                                                <th>Class</th>
                                                <th>{{ $class->name }} ({{ $section->name }})</th>
                                            </tr>
                                            <tr>
                                                <th>Subject</th>
                                                <th>{{ $subject->name }}</th>
                                            </tr>
                                            <tr>
                                                <th>Theory Full Marks</th>
                                                <th>{{ $subject->theory_full_marks }}</th>
                                            </tr>
                                            <tr>
                                                <th>Practical Full Marks</th>
                                                <th>{{ $subject->practical_full_marks }}</th>
                                            </tr>
                                        </table>
                                        <hr>
                                        <table class="table table-bordered">
                                            <thead>
                                            <th>Roll Number</th>
                                            <th>Student</th>
                                            <th>Mark</th>
                                            </thead>
                                            <tbody>
                                            @foreach($datas as $data)
                                                <input type="hidden" name="student_ids[]" value="{{ $data->student->id }}">
                                                <tr>
                                                    <td>{{ $data->student->roll }}</td>
                                                    <td>{{ $data->student->fname }}</td>
                                                    <td>
                                                        @if($subject->type == 'is_theory')
                                                            <label>Theory Mark</label><input type="number" class="form-control" step="any" min="0" max="{{ $subject->theory_full_marks }}" value="{{ $data->theory_mark }}" name="theory_marks[]">
                                                        @elseif($subject->type == 'has_theory_practical')
                                                            <label>Theory Mark</label><input type="number" class="form-control" step="any" min="0" max="{{ $subject->theory_full_marks }}" value="{{ $data->theory_mark }}" name="theory_marks[]"><br/>
                                                            <label>Practical Mark</label><input type="number" class="form-control" step="any" min="0" max="{{ $subject->practical_full_marks }}" value="{{ $data->practical_mark }}" name="practical_marks[]">
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
