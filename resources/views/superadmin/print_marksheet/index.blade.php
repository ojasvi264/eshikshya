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
                                                    <option value="{{ $exam_type->id }}">{{$exam_type->exam_type}}</option>
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
                                            </select>
                                            <span class="text-danger">@error('exam_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Search</button>
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
    </script>
@endsection
