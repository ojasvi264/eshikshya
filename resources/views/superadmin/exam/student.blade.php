@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Exam Student</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Examination</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Exam Student</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Exam Student List</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('exam.student.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <td><input type="checkbox" id="checkAll" > Select All</td>
                                    <th>Admission Number</th>
                                    <th>Roll Number</th>
                                    <th>Student Name</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $key => $student)
                                        <tr>
                                            <td><input type="checkbox" class="form-conrol" name="studentids[]" {{ ($student->id == @$datas[$key]->id) ? 'checked' : '' }} value="{{ $student->id }}"></td>
                                            <td>{{ $student->admission }} </td>
                                            <td>{{ $student->roll }} </td>
                                            <td>{{ $student->fname }} </td>
                                            <td><input type="button" class="btn btn-sm btn-rounded btn-outline-danger" value="Delete" onclick="deleteRow(this.parentNode.parentNode.rowIndex)"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="col-md-6" style="float: right">
                                    <button type="submit" class="pull-right btn btn-success text-white">Submit</button>
                                </div>
                            </form>
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
        function deleteRow(i){
            document.getElementById('myTable').deleteRow(i)
        }
    </script>
@endsection
