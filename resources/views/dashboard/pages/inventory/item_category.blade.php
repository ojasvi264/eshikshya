@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Item Category</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Item Category</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Item Category</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{isset($itemCategory) ? route('admin.item_category.update', $itemCategory) : route('admin.item_category.store')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                        {{isset($itemCategory) ? route('accountant.item_category.update', $itemCategory) : route('accountant.item_category.store')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{isset($itemCategory) ? route('item_category.update', $itemCategory) : route('item_category.store')}}
                                @endif
                                " method="POST">
                                @csrf
                                @if(isset($itemCategory))
                                    @method('PATCH')
                                @endif
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" >Name</label><span style="color: red">&#42;</span>
                                        <input type="text" class="form-control" name="name" value='{{old('name')?old('name'):(isset($itemCategory) ? $itemCategory->name : '')}}' >
                                        <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" >Description</label>
                                        <textarea id="mytextarea" class="form-control" name="description">{!! isset($itemCategory)?$itemCategory->description:(old('description') ?? '') !!}</textarea>
                                        <span class="text-danger">@error('description'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">{{isset($itemCategory) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Item Category List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($itemCategories as $key =>$itemCategory)
                                                <tr>
                                                    <td>{{$itemCategory->name}}</td>
                                                    <td>{!! $itemCategory->description !!}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="
                                                            @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                    {{route('admin.item_category.edit', $itemCategory)}}
                                                                @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                    {{route('accountant.item_category.edit', $itemCategory)}}
                                                                @endif
                                                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                {{route('item_category.edit', $itemCategory)}}
                                                            @endif
                                                                " class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.item_category.destroy', $itemCategory)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.item_category.destroy', $itemCategory)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('item_category.destroy', $itemCategory)}}
                                                                @endif
                                                                " method="post" onsubmit="return confirm('Are you sure?')">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger m-1"  data-toggle="modal" data-target="#deleteModal">
                                                                    <i class="la la-trash-o"></i>
                                                                </button>
                                                            </form>
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


