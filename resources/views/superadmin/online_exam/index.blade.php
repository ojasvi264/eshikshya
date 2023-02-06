@extends('layouts.base_temp')
@section('dashboard.navbar')@endsection
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
                                    <h4 class="card-title">Online Exam List</h4>
                                    <a href="{{ route('online.exam.create') }}" class="btn btn-primary">Add Online Exam</a>
                                </div>
                                <div class="card-body">
                                    @include('includes.dashboard.message')
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Exam</th>
                                                <th>Quiz</th>
                                                <th>Question</th>
                                                <th>Attempt</th>
                                                <th>Exam From</th>
                                                <th>Exam To</th>
                                                <th>Duration</th>
                                                <th>Exam Publish</th>
                                                <th>Result Publish</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($online_exams as $key =>$item)
                                                <tr>
                                                    <td>{{ $item->title }}</td>
                                                    <td><input type="checkbox" {{ ($item->is_quiz == 1) ? 'checked' : '' }} disabled></td>
                                                    <td>{{ count($item->questions) }}</td>
                                                    <td>{{ $item->number_of_attempt }}</td>
                                                    <td>{{ $item->exam_from_date }} {{  $item->exam_from_time }}</td>
                                                    <td>{{ $item->exam_to_date }} {{  $item->exam_to_time }}</td>
                                                    <th>{{ $item->time_duration }}</th>
                                                    <td><input type="checkbox" {{ ($item->publish_exam == 1) ? 'checked' : '' }} disabled></td>
                                                    <td><input type="checkbox" {{ ($item->publish_result == 1) ? 'checked' : '' }} disabled></td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <span class="badge bg-success text-white">Active</span>
                                                        @else
                                                            <span class="badge bg-danger text-white">Deleted</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Options
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                @if($item->status == 1)
                                                                    <a class="dropdown-item" href="{{ route('online.exam.question', $item->id) }}">Add Question</a>
                                                                    @if($item->is_quiz == 1)
                                                                        <a class="dropdown-item" href="{{ route('online.exam.assign', $item->id) }}">Assign</a>
                                                                    @endif
                                                                    <a class="dropdown-item" href="{{ route('online.exam.edit', $item->id) }}">Edit Exam</a>
                                                                    <a class="dropdown-item" href="{{ route('online.exam.question', $item->id) }}">Exam Question List</a>
                                                                    <a class="dropdown-item" href="#">Exam Evaluation</a>
                                                                    <a class="dropdown-item" href="{{ route('online.exam.destroy', $item->id) }}">Delete</a>
                                                                @else
                                                                    <a class="dropdown-item" href="{{ route('online.exam.restore', $item->id) }}">Restore</a>
                                                                @endif
                                                            </div>
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
