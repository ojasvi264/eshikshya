@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Upload Content</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Download</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Upload Content</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Content List</h4>
                                    <a href="{{ route('upload.content.create') }}" class="btn btn-primary">Add Content</a>
                                </div>
                                <div class="card-body">
                                    @include('includes.dashboard.message')
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Content Title</th>
                                                <th>Type</th>
                                                <th>Available For</th>
                                                <th>Class</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($upload_contents as $key =>$upload_content)
                                                <tr>
                                                    <td>{{ $upload_content->title }}</td>
                                                    <td>{{ ucfirst($upload_content->content_type) }}</td>
                                                    <td>{{ ucfirst($upload_content->available_for) }}</td>
                                                    <td>
                                                        @if($upload_content->available_for == 'student')
                                                            {{ @$upload_content->class->name }}({{ @$upload_content->section->name }})
                                                        @else
                                                            N/a
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ asset($upload_content->content_file) }}" target="_blank" class="btn btn-sm btn-primary m-1"><i class="fa fa-download"></i></a>
                                                        <a href="{{ route('upload.content.destroy', $upload_content->id) }}" class="btn btn-sm btn-danger m-1"><i class="la la-trash-o"></i></a>
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
