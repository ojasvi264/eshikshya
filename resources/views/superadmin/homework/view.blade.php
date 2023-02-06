@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Homework Submission</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Homework</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Homework Submission</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Homework Detail</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class : </label>
                                            <label class="form-label">{{($homework->class->name)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section : </label>
                                            <label class="form-label">{{($homework->section->name)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Subject : </label>
                                            <label class="form-label">{{($homework->subject->name)}} ({{($homework->subject->code)}})</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Assigned Date : </label>
                                            <label class="form-label">{{($homework->assign)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Submission Date : </label>
                                            <label class="form-label">{{($homework->submission)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Submission Time : </label>
                                            <label class="form-label">{{($homework->submission_time)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Teacher : </label>
                                            <label class="form-label">{{ucfirst($homework->teacher->name)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">File : </label>
                                            @foreach(json_decode($homework->image, true) as $key => $media_gallery)
                                                <a href="{{ url('/files/homework/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">
                                                    <img src="{{ url('/files/homework/'.$media_gallery) }}" class="img-fluid mb-2" alt="white sample" width="50" height="50">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="row pl-3">
                                                <label class="form-label">Description : {{$homework->description}}</label>
                                            </div>
                                        </div>
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
                                    <h4 class="card-title">Display Submitted Homework</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Submitted By</th>
                                                <th>Submitted Date</th>
                                                <th>Submitted Time</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($homework->homeworksubmission as $data)
                                                <tr>
                                                    <td>{{ucfirst($data->student->fname)}}</td>
                                                    <td>{{($data->created_at->format('Y M d'))}} [{{($data->created_at->format('l'))}}]</td>
                                                    <td>{{($data->created_at->format('H:i:s'))}}</td>
                                                    <td>
                                                        @foreach(json_decode($data->file, true) as $key => $media_gallery)
                                                            <a href="{{ url('/files/homeworkSubmission/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">
                                                                <img src="{{ url('/files/homeworkSubmission/'.$media_gallery) }}" class="img-fluid mb-2" alt="white sample" width="50" height="50">
                                                            </a>
                                                        @endforeach
                                                    </td>
                                            {{--        <td>
                                                        <a href="{{route('homework.sub',$data['id']) }}" class='btn btn-sm btn-primary m-1'><i class="la la-eye"></i></a>
                                                    </td>--}}
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
