@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Notice Board</h4>
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
                                <div class="card-header">
                                    <h4 class="card-title">Notice List</h4>
                                    <a href="{{ route('notice.board.create') }}" class="btn btn-primary">Add Notice</a>
                                </div>
                                <div class="card-body">
                                    @include('includes.dashboard.message')
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Notice</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($noticeBoard as $key =>$notice)
                                                <tr>
                                                    <td>{{ $notice->title }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="" class="btn btn-sm btn-primary m-1"><i class="la la-edit"></i></a>
                                                            <a href="{{ route('notice.board.destroy', $notice->id) }}" class="btn btn-sm btn-danger m-1"><i class="la la-trash-o"></i></a>
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
