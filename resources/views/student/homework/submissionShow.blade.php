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
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Submission View</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Submitted Homework View</h5>
                        </div>
                        <div class="card-body">
                            @foreach($homeworkSubmissionTest as $data)
                            <div class="card" style="height: auto">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary dropdown" data-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                                            <div class="dropdown-menu" style="padding-left: 50px;">
                                            {{--    <button type="submit" class="btn btn-sm btn-primary m-1"  data-toggle="modal" data-target="#deleteModal">
                                                    <a href="{{route('homework-submission.edit',$data['id']) }}">
                                                        <i class="la la-pencil"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                </button>--}}
                                                <form method="post" action="{{route('homework-submission.destroy',$data->id)}}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger m-1"  data-toggle="modal" data-target="#deleteModal">
                                                        <i class="la la-trash-o"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Submitted Date: </label>
                                                <label class="form-label">{{($data->created_at->format('Y M d'))}} [{{($data->created_at->format('l'))}}]</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Submitted Time: </label>
                                                <label class="form-label">{{($data->created_at->format('H:i:s'))}}</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Submitted by: </label>
                                                <label class="form-label">{{ucfirst($data->user->name)}}</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Submitted Document:
                                                    <span>
                                                    @foreach(json_decode($data->file, true) as $key => $media_gallery)
                                                            <a href="{{ url('/public/images/homeworkSubmission/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">
                                                            <img src="{{ url('/public/images/homeworkSubmission/'.$media_gallery) }}" class="img-fluid mb-2" alt="image" width="50" height="50">
                                                        </a>
                                                        @endforeach
                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
