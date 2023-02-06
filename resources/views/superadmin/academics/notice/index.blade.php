@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Notice</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Notice</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Notice</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{route('notice/add')}}" id='sectionform' method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="class_id" id="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($class as $data)
                                                    <option value='{{ $data->id }}' {{ (collect(old('class_id'))->contains($data->id)) ? 'selected':'' }} >{{$data->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('class_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section</label>
                                            <span style="color: red">&#42;</span>
                                            <select name="section_id" id="section_id" class="form-control" >
                                            </select>
                                            <span class="text-danger">@error('section_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Title</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="title" value='{{old('title')}}'>
                                            <span class="text-danger">@error('title'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Notice Date</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="notice" value='{{old('notice')}}'>
                                            <span class="text-danger">@error('notice'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Description</label>
                                            <textarea class="form-control" name="description">{{old('description')}}</textarea>
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
                                    <h4 class="card-title">Notice List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Notice Title</th>
                                                <th>Notice Date</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($notice as $key =>$data)
                                                <tr>
                                                    <td>{{$data->class->name}}</td>
                                                    <td>{{$data->section->name}}</td>
                                                    <td>{{$data->title}}</td>
                                                    <td>{{$data->notice}}</td>
                                                    <td>{{$data->description}}</td>
                                                    <td>
                                                        <div class="row">
                                                            <a href="{{route('notice.edit',$data['id']) }}" class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-pencil"></i></a>
                                                            <form method="post" action="{{route('notice.destroy',$data->id)}}">
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
            $('#sectionform').validate();
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
                    url: '/super/dashboard/getSections/' + id,
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
