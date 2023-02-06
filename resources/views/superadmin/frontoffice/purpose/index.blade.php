@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Purpose</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Front Office</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Setup Front Office</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Purpose</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Purpose</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                 @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                     @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{ url('admin/purpose/add') }}
                                     @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                        {{ url('receptionist/purpose/add') }}
                                     @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                        {{ url('accountant/purpose/add') }}
                                     @endif
                                 @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                        {{ url('super/purpose/add') }}
                                 @endif
                                " method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Purpose</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="purpose"
                                                   value='{{ old('purpose')}}' placeholder="Enter visitor's purpose">
                                            <span class="text-danger">@error('purpose'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description"
                                                      placeholder="Enter description for visitor's purpose">{{old('description')}}</textarea>
                                            <span class="text-danger">@error('description'){{$message}}@enderror</span>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Purpose List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Purpose</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($purpose as $key =>$item)
                                                <tr>
                                                    <td>{{$item->purpose}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.purpose.edit',$item['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                        {{route('receptionist.purpose.edit',$item['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.purpose.edit',$item['id']) }}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('purpose.edit',$item['id']) }}
                                                                @endif
                                                                "
                                                               class='btn btn-sm btn-primary m-1'><i class="la la-pencil"></i>
                                                            </a>
                                                            <form method="POST"
                                                                  action="
                                                                       @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                            @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                                {{route('admin.purpose.destroy',$item->id)}}
                                                                            @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                                {{route('receptionist.purpose.destroy',$item->id)}}
                                                                            @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                                {{route('accountant.purpose.destroy',$item->id)}}
                                                                            @endif
                                                                       @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                            {{route('purpose.destroy',$item->id)}}
                                                                       @endif
                                                                       ">
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

