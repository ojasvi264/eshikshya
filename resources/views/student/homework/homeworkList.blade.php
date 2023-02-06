@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Homework</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Homework</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Homework List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Subject</th>
                                                <th>Assigned Date</th>
                                                <th>Submission Date</th>
                                                <th>Assigned By</th>
                                                <th>File</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($getHomework as $key =>$data)
                                                <tr>
                                                    <td>{{$data->class->name}}</td>
                                                    <td>{{$data->section->name}}</td>
                                                    <td>{{$data->subject->name}}</td>
                                                    <td>{{$data->assign}}</td>
                                                    <td>{{$data->submission}}</td>
                                                    <td>{{$data->teacher->name}}</td>
                                                    <td>
                                                        @foreach(json_decode($data->image, true) as $key => $media_gallery)
                                                            <a href="{{ url('/public/images/homework/'.$media_gallery) }}" data-toggle="lightbox" data-gallery="gallery">
                                                                <img src="{{ url('/public/images/homework/'.$media_gallery) }}" class="img-fluid mb-2" alt="file" width="50" height="50">
                                                            </a>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                        {{--    <a href="{{route('homework.upload',$data['id']) }}" class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-upload"></i>
                                                            </a>--}}
                                                            <a href="{{route('student.homework-submission.show',$data['id']) }}" class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-eye"></i>
                                                            </a>
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
