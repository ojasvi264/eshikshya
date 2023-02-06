@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Student Details</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Student Information</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Student Details</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('student.search')}} " method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label>
                                            <select class="form-control" id="class_id" name="class_id">
                                                <option>Select Class</option>
                                                @foreach ($class as $data)
                                                    <option value='{{ $data->id }}'>{{$data->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section</label>
                                            <select name="section_id" id="section_id" class="form-control" ></select>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Student List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Admission</th>
                                                <th>Roll</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Bloodgroup</th>
                                                <th>Gender</th>
                                                <th>DOB</th>
                                                <th>Phone</th>
                                                <th>Caste</th>
                                                <th>Religion</th>
                                                <th>Current address</th>
                                                <th>Permanent address</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($students as $key =>$student)
                                                <tr>
                                                    <td>{{$student->fname}}</td>
                                                    <td>{{$student->email}}</td>
                                                    <td>{{$student->admission}}</td>
                                                    <td>{{$student->roll}}</td>
                                                    <td>{{$student->class_id}}</td>
                                                    <td>{{$student->section_id}}</td>
                                                    <td>{{$student->bloodgroup}}</td>
                                                    <td>{{$student->gender}}</td>
                                                    <td>{{$student->dob}}</td>
                                                    <td>{{$student->phone}}</td>
                                                    <td>{{$student->caste}}</td>
                                                    <td>{{$student->religion}}</td>
                                                    <td>{{$student->caddress}}</td>
                                                    <td>{{$student->paddress}}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                        <a href="href = 'class/{{ $student->id }}'" class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#deleteModal"><i class="la la-trash-o"></i></a>
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

    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function () {
            $('#class_id').on('change', function () {
                let id = $(this).val();
                $('#section_id').empty();
                $('#section_id').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/getSections/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#section_id').empty();
                        $('#section_id').append(`<option value="0" disabled selected>Select Sections*</option>`);
                        response.forEach(element => {
                            $('#section_id').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
@endsection
