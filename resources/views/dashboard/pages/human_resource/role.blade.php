@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Role</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Human Resource</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Role</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Role</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                    {{isset($role) ? route('admin.role.update', $role) : route('admin.role.store')}}
{{--                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')--}}
{{--                                    {{isset($role) ? route('teacher.role.update', $role) : route('teacher.role.store')}}--}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{isset($role) ? route('role.update', $role) : route('role.store')}}
                                @endif
                                " method="POST">
                                @csrf
                                @if(isset($role))
                                    @method('PATCH')
                                @endif
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Name</label><span style="color: red">&#42;</span>
                                        <input type="text" class="form-control" name="name"
                                               value='{{old('name')?old('name'):(isset($role) ? $role->name : '')}}'>
                                        <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                    <button type="submit"
                                            class="btn btn-primary">{{isset($role) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Role List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($roles as $key =>$role)
                                                <tr>
                                                    <td>{{$role->name}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.role.edit', $role)}}
{{--                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')--}}
{{--                                                                        {{route('teacher.role.edit', $role)}}--}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('role.edit', $role)}}
                                                                @endif
                                                                "
                                                               class="btn btn-sm btn-primary m-1"><i
                                                                    class="la la-pencil"></i></a>
                                                            {{--                                                        <a href="{{route('role.destroy', $role)}}" class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#deleteModal"><i class="la la-trash-o"></i></a>--}}
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.role.destroy',$role)}}
{{--                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')--}}
{{--                                                                        {{route('teacher.role.destroy',$role)}}--}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('role.destroy',$role)}}
                                                                @endif
                                                                " method="post"
                                                                  onsubmit="return confirm('Are you sure?')">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger m-1"
                                                                        data-toggle="modal" data-target="#deleteModal">
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


