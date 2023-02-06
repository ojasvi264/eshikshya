@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Session Class</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Session Class</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Class for Session</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{ route('admin.session-class/add') }}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        {{ route('teacher.session-class/add') }}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{ route('session-class/add') }}
                                @endif
                                " method="POST" id="sessionform">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Session</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="session_id">
                                                <option value="">Select Session</option>
                                                @foreach ($session as $row)
                                                    <option value='{{ $row->id }}' {{ old('session_id', $row->id) == 0 ? 'selected' : '' }} >{{$row->session_year}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('session_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="class_id" id="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($class as $row)
                                                    <option value='{{ $row->id }}' {{ old('class_id', $row->id) == 0 ? 'selected' : '' }} >{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('class_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="section_id" id="section_id"></select>
                                            <span class="text-danger">@error('section_id'){{ $message }}@enderror</span>
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
                                    <h4 class="card-title">Session Class List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Session</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sessionClass as $key =>$item)
                                                <tr>
                                                    <td>{{$item->session->session_year}}</td>
                                                    <td>{{$item->class->name}}</td>
                                                    <td>{{$item->section->name}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.session-class.edit',$item['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.session-class.edit',$item['id']) }}
                                                                    @endif
                                                                    @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                        {{route('session-class.edit',$item['id']) }}
                                                                    @endif
                                                                " class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-pencil"></i></a>
                                                            <form method="POST" action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.session-class.destroy',$item->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.session-class.destroy',$item->id)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('session-class.destroy',$item->id)}}
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
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#sessionform').validate();
        });
    </script>
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function () {
            $('#class_id').on('change', function () {
                let id = $(this).val();
                $('#section_id').empty();
                $('#section_id').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/getSections/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#section_id').empty();
                        $('#section_id').append(`<option value="0" disabled selected>Select Section</option>`);
                        response.forEach(element => {
                            $('#section_id').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
@endsection

