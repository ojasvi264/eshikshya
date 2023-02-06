@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Class</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Student Information</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Bulk Delete</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Bulk Delete</h4>
                                </div>
                                <div class="card-body">
                                    @include('includes.dashboard.message')
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <td><input type="checkbox" id="checkAll" > Select All</td>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Admission</th>
                                                <th>Roll</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($students as $key =>$student)
                                                <tr>
                                                    <td><input type="checkbox" class="form-conrol" name="studentids[]" {{ ($student->id == @$datas[$key]->id) ? 'checked' : '' }} value="{{ $student->id }}"></td>
                                                    <td>{{$student->fname}}</td>
                                                    <td>{{$student->email}}</td>
                                                    <td>{{$student->admission}}</td>
                                                    <td>{{$student->roll}}</td>
                                                    <td>{{$student->class_id}}</td>
                                                    <td>{{$student->section_id}}</td>
                                                    <td>
                                                        <a href="href = 'class/{{ $student->id }}'" class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#deleteModal"><i class="la la-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Delete</button>
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
@section('scripts')
    <script>
        function deleteRow(i){
            document.getElementById('myTable').deleteRow(i)
        }
    </script>
@endsection
