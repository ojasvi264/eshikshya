@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Categories</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Account</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Categories</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Categories</h4>
                                    <div class="card-tools">
                                        <a href="{{ route('account.category.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;Add Category</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @include('includes.dashboard.message')
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Category</th>
                                                <th>Parent</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($categories as $key =>$item)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ ($item->getParentCategory) ? $item->getParentCategory->name : '---' }}</td>
                                                        <td>
                                                            <a href="{{ route('account.category.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
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
