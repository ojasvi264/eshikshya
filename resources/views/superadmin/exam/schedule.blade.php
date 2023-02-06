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
                            <h5 class="card-title">Add Exam Schedule</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('exam_schedule.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <th>Subject Name</th>
                                    <th>Exam Date</th>
                                    <th>Exam Time</th>
                                    <th>Total Hour</th>
                                    <th>Room Number</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <input type="hidden" name="subject_ids[]" value="{{ $subject->id }}">
                                            <td>{{ $subject->name }} ({{ $subject->code }})</td>
                                            <td><input type="date" name="exam_dates[]" class="form-control"></td>
                                            <td><input type="time" name="times[]" class="form-control"></td>
                                            <td><input type="number" min="1" name="total_hors[]" class="form-control"></td>
                                            <td><input type="number" min="1" name="room_numbers[]" class="form-control"></td>
                                            <td><input type="button" class="btn btn-sm btn-rounded btn-outline-danger" value="Delete" onclick="deleteRow(this.parentNode.parentNode.rowIndex)"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
        function deleteRow(i){
            document.getElementById('myTable').deleteRow(i)
        }
    </script>
@endsection
