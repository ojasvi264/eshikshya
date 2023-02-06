@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Subject</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Subject</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Subject</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{route('admin.subject/add')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        {{route('teacher.subject/add')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{route('subject/add')}}
                                @endif
                                " method="POST" id="subjectform">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Code</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="code" value='{{ old('code') }}' required>
                                            <span class="text-danger">@error('code'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="name" value='{{ old('name') }}' required>
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control select" multiple name="eclasses_ids[]" required style="width: 100%">
                                                @foreach ($class as $data)
                                                    <option value='{{ $data->id }}' {{ (collect(old('eclasses_id'))->contains($data->id)) ? 'selected':'' }}  >{{$data->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('eclasses_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                            {{--        <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="section_id" id="section_id">
                                            </select>
                                            <span class="text-danger">@error('section_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>--}}
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Credit Hour</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="number" min="1" class="form-control" name="credit_hour" value='{{ old('credit_hour') }}' required>
                                            <span class="text-danger">@error('credit_hour'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label class="form-label">Type</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" id="type" onchange="showOrHide(this.value);" name="type" required>
                                                <option selected disabled>Select Type</option>
                                                <option value="has_theory_practical">Has Theory and Practical</option>
                                                <option value="is_theory">Is Theory Only</option>
                                            </select>
                                            <span class="text-danger">@error('type'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12" id="theory_full_marks" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Theory Full Marks</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="theory_full_marks" value='{{ old('theory_full_marks') }}'>
                                            <span class="text-danger">@error('theory_full_marks'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12" id="theory_pass_marks" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Theory Pass Marks</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="theory_pass_marks" value='{{ old('theory_pass_marks') }}'>
                                            <span class="text-danger">@error('theory_pass_marks'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12" id="practical_full_marks" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Practical Full Marks</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="practical_full_marks" value='{{ old('practical_full_marks') }}'>
                                            <span class="text-danger">@error('practical_full_marks'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12" id="practical_pass_marks" style="display: none">
                                        <div class="form-group">
                                            <label class="form-label">Practical Pass Marks</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="practical_pass_marks" value='{{ old('practical_pass_marks') }}'>
                                            <span class="text-danger">@error('practical_pass_marks'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12">
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
                                    <h4 class="card-title">Subject List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Code</th>
                                                <th>Subject Name</th>
                                                <th>Credit Hour</th>
                                                <th>Has Theory and Practical</th>
                                                <th>Is Theory Only</th>
                                                <th>Full Marks</th>
                                                <th>Pass Marks</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($subject as $key =>$data)
                                                <tr>
                                                    <td>{{$data->class->name}}</td>
                                                    <td>{{$data->code}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->credit_hour}}</td>
                                                    <td>
                                                        @if($data->type == 'has_theory_practical')<i class="fa fa-check-square-o"></i></td>@endif
                                                    <td>
                                                        @if($data->type == 'is_theory')
                                                            <i class="fa fa-check-square-o"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $data->theory_full_marks }} / {{ $data->practical_full_marks }}
                                                    </td>
                                                    <td>
                                                        {{ $data->theory_pass_marks }} / {{ $data->practical_pass_marks }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.subject.edit',$data['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.subject.edit',$data['id']) }}
                                                                    @endif
                                                                    @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                        {{route('subject.edit',$data['id']) }}
                                                                    @endif
                                                                " class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-pencil"></i></a>
                                                            <form method="POST" action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.subject.destroy',$data->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.subject.destroy',$data->id)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('subject.destroy',$data->id)}}
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
            $('#subjectform').validate();
        });
    </script>
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function () {
            $('#eclasses_id').on('change', function () {
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@endsection
@section('scripts')
    <script>
        function showOrHide(type){
            if (type == 'is_theory') {
                var theory_full_marks = document.getElementById('theory_full_marks');
                theory_full_marks.setAttribute("style","display:block");
                var theory_pass_marks = document.getElementById('theory_pass_marks');
                theory_pass_marks.setAttribute("style","display:block");
                var practical_full_marks = document.getElementById('practical_full_marks');
                practical_full_marks.setAttribute("style","display:none");
                var practical_pass_marks = document.getElementById('practical_pass_marks');
                practical_pass_marks.setAttribute("style","display:none");
            }else{
                var theory_full_marks = document.getElementById('theory_full_marks');
                theory_full_marks.setAttribute("style","display:block");
                var theory_pass_marks = document.getElementById('theory_pass_marks');
                theory_pass_marks.setAttribute("style","display:block");
                var practical_full_marks = document.getElementById('practical_full_marks');
                practical_full_marks.setAttribute("style","display:block");
                var practical_pass_marks = document.getElementById('practical_pass_marks');
                practical_pass_marks.setAttribute("style","display:block");
            }
        }
    </script>
@endsection
