@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Group</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit Group</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Group</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{route('group.update')}}" method="POST" id='categoryform'>
                                <input type="hidden" name='id' value={{$group['id']}}>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{$group->name}}" >
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label>
                                            <select class="form-control" name="eclasses_id" id="eclasses_id">
                                                <option value="">Select Class</option>
                                                @foreach ($class as $row)
                                                    <option value='{{ $row->id }}' {{ (collect($group->eclasses_id)->contains($row->id)) ? 'selected':'' }}>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('eclasses_id')
                                                {{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section</label>
                                            <select class="form-control" name="sections_id" id="sections_id">

                                            </select>
                                            <span class="text-danger">@error('sections_id')
                                                {{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
                                    <h4 class="card-title">Group List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($grp as $key =>$data)
                                                <tr>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->class->name}}</td>
                                                    <td>{{$data->section->name}}</td>
                                                    <td>
                                                        <div class="row">
                                                            <a href="{{route('group.edit',$group['id']) }}" class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-pencil"></i></a>
                                                            <form method="POST" action="{{route('group.destroy',$data->id)}}">
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
            $('#categoryform').validate();
        });
    </script>
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function () {
            $('#eclasses_id').on('change', function () {
                let id = $(this).val();
                $('#sections_id').empty();
                $('#sections_id').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/super/dashboard/getSections/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#sections_id').empty();
                        $('#sections_id').append(`<option value="0" disabled selected>Select Section</option>`);
                        response.forEach(element => {
                            $('#sections_id').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
    <!--**********************************
        Content body end
    ***********************************-->
@endsection
