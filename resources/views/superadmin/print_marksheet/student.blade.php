@extends('layouts.base_temp')
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
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Print Marksheet</a></li>
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
                            <form action="{{ route('print.mark.sheet.student') }}" method="get">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" >Exam Type </label>
                                            <select class="form-control" name="exam_type_id" onchange="getExams(this.value)" required>
                                                <option value="" disabled selected>Please Select</option>
                                                @foreach($exam_types as $exam_type)
                                                    <option value="{{ $exam_type->id }}" {{ ($selected_exam_type->id == $exam_type->id) ? 'selected' : '' }}>{{$exam_type->exam_type}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('exam_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" >Exam </label>
                                            <select class="form-control" name="exam_id" id="exam_id" required>
                                                <option value="" disabled selected>Please Select</option>
                                                @foreach($exams as $exam)
                                                    <option value="{{ $exam->id }}" {{ ($selected_exam->id == $exam->id) ? 'selected' : '' }}>{{$exam->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('exam_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <form method="post" action="{{ route('print.mark.sheet.generate') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Student List</h5>
                                    </div>
                                    <div class="col-md-6" style="float: right">
                                        <input type="hidden" name="class_id" value="{{ $selected_class->id }}">
                                        <input type="hidden" name="exam_id" value="{{ $selected_exam->id }}">
                                        <button type="submit" class="pull-right btn btn-success text-white">Generate</button>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <td><input type="checkbox" id="checkAll" > Select All</td>
                                                <th>Admission No</th>
                                                <th>Roll No.</th>
                                                <th>Student Name</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($datas)
                                                @foreach($datas as $data)
                                                    <tr>
                                                        <td><input type="checkbox" class="form-conrole" name="studentids[]" value="{{ $data->id }}"></td>
                                                        <td>{{ $data->admission }}</td>
                                                        <td>{{ $data->roll }}</td>
                                                        <td>{{ $data->fname }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr colspan="3">No Data</tr>
                                            @endif
                                            </tbody>
                                        </table>
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
        function getExams(exam_type_id) {
            if (exam_type_id !== '') {
                $.ajax({
                    url: '{{ url('/get/exams') }}'+'/'+ exam_type_id ,
                    success: function(response)
                    {
                        jQuery('#exam_id').html(response);
                    }
                });
            }
        }
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
