@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Marks Grade</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Examination</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Marks Grade</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Marks Grade</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{ route('admin.grade/add') }}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        {{ route('teacher.grade/add') }}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{ route('grade/add') }}
                                @endif
                                " method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Exam Type</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="examType_id" >
                                                <option value="">Select Exam Type</option>
                                                @foreach ($types as $row)
                                                    <option value='{{ $row->id }}' {{ (collect(old('examType_id'))->contains($row->id)) ? 'selected':'' }}>{{$row->exam_type}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('examType_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Grade Name</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="grade_name" value='{{old('grade_name')}}' placeholder="Enter Grade Name">
                                            <span class="text-danger">@error('grade_name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Percent Upto</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="percent_upto" value='{{old('percent_upto"')}}' placeholder="Enter highest percentage limit for this grade">
                                            <span class="text-danger">@error('percent_upto"'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Percent From</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="percent_from" value='{{old('percent_from')}}' placeholder="Enter lowest percentage limit for this grade">
                                            <span class="text-danger">@error('percent_from'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Grade Point</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="grade_point" value='{{old('grade_point')}}' placeholder="Enter grade point for this grade">
                                            <span class="text-danger">@error('grade_point'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description">{{ old('description') }}</textarea>
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
                                    <h4 class="card-title">Marks Grade List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Exam Type</th>
                                                <th>Grade Name</th>
                                                <th>Percent From/Upto</th>
                                                <th>Grade Point</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($grade as $key =>$data)
                                                <tr>
                                                    <td>{{$data->types->exam_type}}</td>
                                                    <td>{{$data->grade_name}}</td>
                                                    <td>{{$data->percent_from}} To {{$data->percent_upto}}</td>
                                                    <td>{{$data->grade_point}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.grade.edit',$data['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.grade.edit',$data['id']) }}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('grade.edit',$data['id']) }}
                                                                @endif
                                                                " class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-pencil"></i></a>
                                                            <form method="POST" action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.grade.destroy',$data->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.grade.destroy',$data->id)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('grade.destroy',$data->id)}}
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
