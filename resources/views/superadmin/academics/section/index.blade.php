@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Section</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Section</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Section</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{route('admin.section/add')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        {{route('teacher.section/add')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{route('section/add')}}
                                @endif
                                " method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="name" value='{{ old('name') }}'>
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="eclasses_id" >
                                                <option value="">Select Class</option>
                                                @foreach ($class as $row)
                                                    {{-- <option value='{{ $row->id }}' {{ (collect(old('eclasses_id'))->contains($row->id)) ? 'selected':'' }}>{{$row->name}}</option>--}}
                                                    <option value='{{ $row->id }}' {{ old('eclasses_id', $row->id) == 0 ? 'selected' : '' }} >{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('eclasses_id')
                                                {{ $message }}
                                                @enderror</span>
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
                                    <h4 class="card-title">Section List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Class</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($section as $key =>$data)
                                                <tr>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->class->name}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                            @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                    {{route('admin.section.edit',$data['id']) }}
                                                                @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                    {{route('teacher.section.edit',$data['id']) }}
                                                                @endif
                                                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                {{route('section.edit',$data['id']) }}
                                                            @endif
                                                                " class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-pencil"></i></a>
                                                            <form method="POST" action="
                                                            @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                    {{route('admin.section.destroy',$data->id)}}
                                                                @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                    {{route('teacher.section.destroy',$data->id)}}
                                                                @endif
                                                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                {{route('section.destroy',$data->id)}}
                                                            @endif
                                                                ">
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
