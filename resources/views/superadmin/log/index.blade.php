@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Email / SMS Log</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Communicate</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Email / SMS Log</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="log" class="display" style="min-width: 750px">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Email</th>
                                        <th>SMS</th>
                                        <th>Type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->created_at }}</td>
                                            <td>
                                                @if($data instanceof App\Models\Email)
                                                    <i class="fa fa-check-square-o"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data instanceof App\Models\SMS)
                                                    <i class="fa fa-check-square-o"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ ucfirst($data->type) }}
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
@endsection
