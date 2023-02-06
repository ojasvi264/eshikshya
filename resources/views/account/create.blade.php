@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Add Category</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Account</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Categories</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Category</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Category</h4>
                                </div>
                                <div class="card-body">
                                    @include('includes.dashboard.message')
                                    <form action="{{ route('account.category.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" >Parent </label>
                                                    <select class="form-control select" name="parent_id" required>
                                                        <option value="0" selected>Please Select</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger">@error('parent_id'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" >Name </label>
                                                    <input type="text" name="name" placeholder="Name" class="form-control">
                                                    <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" >Type </label>
                                                    <select class="form-control select" name="type">
                                                        <option disabled selected>Please Select</option>
                                                        <option value="group">Group</option>
                                                        <option value="final_ledger">Final Ledger</option>
                                                    </select>
                                                    <span class="text-danger">@error('type'){{$message}}@enderror</span>
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
