@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Upload Data</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Download Center</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Upload Data</a></li>
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
                                    <form action="{{ route('upload.content.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Content Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                                                    <span class="text-danger">@error('title'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Content Type</label>
                                                    <select class="form-control select" name="content_type" required>
                                                        <option selected disabled>Please Select</option>
                                                        @foreach($content_types as $content_type)
                                                            <option value="{{ $content_type }}">{{ ucfirst($content_type) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger">@error('title'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Available For</label>
                                                    <select class="form-control select" name="available_for" required>
                                                        <option selected disabled>Please Select</option>
                                                        @foreach($availability as $data)
                                                            <option value="{{ $data }}">{{ ucfirst($data) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger">@error('title'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Class</label>
                                                    <select class="form-control select" onchange="getClassSections(this.value)" name="class_id">
                                                        <option disabled selected>Please Select</option>
                                                        @foreach ($classes as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}</option>;
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" >Section</label>
                                                    <select class="form-control" name="section_id" id="section_holder">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" >Upload Date</label>
                                                    <input type="date" name="upload_date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" >Description</label>
                                                    <input type="text" name="description" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" >Content File</label>
                                                    <input type="file" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                                                    text/plain, application/pdf" name="content_file" class="form-control-file" required>
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
    <script>
        function getClassSections(class_id) {
            if (class_id !== '') {
                $.ajax({
                    url: '{{ url('/class/sections') }}'+'/'+ class_id ,
                    success: function(response)
                    {
                        jQuery('#section_holder').html(response);
                    }
                });
            }
        }
    </script>
@endsection
