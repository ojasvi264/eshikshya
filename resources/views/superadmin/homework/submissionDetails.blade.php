@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Submission Details</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Homework</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Homework Submission</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Submission Details</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Submitted Homework Detail View</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name='id' value={{$homeworkSub['id']}}>
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-12 col-sm-12">
                                        <hr />
                                        <div class="card" style="height: auto">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Submitted Date: </label>
                                                            <label class="form-label">{{($homeworkSub->created_at->format('Y M d'))}} [{{($homeworkSub->created_at->format('l'))}}]</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Submitted Time: </label>
                                                            <label class="form-label">{{$homeworkSub->created_at->format('H:i:s')}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Submitted By: </label>
                                                            <label class="form-label">{{ucfirst($homeworkSub->user->name)}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Submitted Document:
                                                                <span>
                                                                     @foreach(json_decode($homeworkSub->file, true) as $key => $media_gallery)
                                                                        <a href="{{ url('/files/homeworkSubmission/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">
                                                                            <img src="{{ url('/files/homeworkSubmission/'.$media_gallery) }}" class="img-fluid mb-2" alt="file" width="50" height="50">
                                                                        </a>
                                                                    @endforeach
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
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
