@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Compose New Message</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Communicate</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Notice Board</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    @include('includes.dashboard.message')
                                    <form action="{{ route('notice.board.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                                                    <span class="text-danger">@error('title'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Notice Date</label>
                                                    <input type="date" class="form-control" name="notice_date" value="{{ old('notice_date') }}" required>
                                                    <span class="text-danger">@error('notice_date'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Publish On</label>
                                                    <input type="date" class="form-control" name="published_on" value="{{ old('published_on') }}" required>
                                                    <span class="text-danger">@error('published_on'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label">Message To</label>
                                                    <select class="form-control select" name="receivers[]" required multiple>
                                                        <?php foreach ($receivers as $receiver):?>
                                                        <option value="{{ $receiver }}">{{ ucfirst($receiver) }}</option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <span class="text-danger">@error('message_to'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label">Message</label>
                                                    <textarea name="message">{!! old('message') !!}</textarea>
                                                </div>
                                            </div>
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
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'message' );
    </script>
@endsection
