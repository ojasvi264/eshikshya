@extends('layouts.base_temp')
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Student</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Student</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Student</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{ route('admin.student.update') }}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        {{ route('teacher.student.update') }}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{ route('student.update') }}
                                @endif
                                " method="POST" id="categoryform" enctype="multipart/form-data">
                                <input type="hidden" name='id' value={{$student['id']}}>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Full Name</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="fname" placeholder="UserName" value="{{$student->fname}}">
                                            <span class="text-danger">@error('fname'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="email"  placeholder="Email"  value="{{$student->email}}" >
                                            <span class="text-danger">@error('email'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="password" class="form-control" name="password" id="" placeholder="Password" >
                                            <span class="text-danger">@error('password'){{$message}} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Confirm Password</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="password" class="form-control" name="password_confirmation" id="" placeholder="Confirm Your Password">
                                            <span class="icon"><i class="fa-solid fa-lock"></i></span>
                                            <span class="text-danger">@error('password'){{$message}} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Profile Image</label>
                                            <input name="profile_image" type="file" class="dropify" data-height="100" accept="image/*" data-default-file="{{$student->profile_image}}"/>
                                            <span class="text-danger">@error('profile_image'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Category</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option value="">Select Category</option>
                                                @foreach ($category as $data)
                                                    <option value="{{ $data->id }}" {{ (collect($student->category_id)->contains($data->id)) ? 'selected':'' }} >{{$data->category_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('category_id') {{ $message }}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="class_id" id="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($class as $row)
                                                    <option value='{{ $row->id }}'{{ (collect($student->class_id)->contains($row->id)) ? 'selected':'' }}>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('class_id') {{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="section_id" id="section_id">
                                            </select>
                                            <span class="text-danger">@error('section_id') {{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Admission No</label>
                                            <input type="text" class="form-control" name="admission" value='{{ $student->admission }}'>
                                            <span class="text-danger">@error('admission'){{$message}} @enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Roll No</label>
                                            <input type="text" class="form-control" name="roll" value='{{ $student->roll }}'>
                                            <span class="text-danger">@error('roll'){{$message}} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Blood Group</label>
                                            <select class="form-control" id="bloodgrop" name="bloodgroup">
                                                <option value="0" >Select</option>
                                                <option value="A+"{{ old('bloodgroup')=='A+' ? 'selected' : ''  }}>A+</option>
                                                <option value="A-"{{ old('bloodgroup')=='A-' ? 'selected' : ''  }}>A-</option>
                                                <option value="B+"{{ old('bloodgroup')=='B+' ? 'selected' : ''  }}>B+</option>
                                                <option value="B-"{{ old('bloodgroup')=='B-' ? 'selected' : ''  }}>B-</option>
                                                <option value="O+"{{ old('bloodgroup')=='O+' ? 'selected' : ''  }}>O+</option>
                                                <option value="AB+"{{ old('bloodgroup')=='AB+' ? 'selected' : ''  }}>AB+</option>
                                            </select>
                                            <span class="text-danger">@error('bloodgroup')
                                            {{ $message }}
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Gender</label>
                                        <select class="form-control" name="gender" >
                                            <option>Select</option>
                                            <option value="Male" {{ old('gender')=='Male' ? 'selected' : ''  }}>Male</option>
                                            <option value="Female"  {{ old('gender')=='Female' ? 'selected' : ''  }}>Female</option>
                                            <option value="Other"  {{ old('gender')=='Other' ? 'selected' : ''  }}>Other</option>
                                        </select>
                                        <span class="text-danger">@error('gender')
                                            {{ $message }}
                                            @enderror</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Date Of Birth</label>
                                            <input type="date" class="date form-control" name="dob" value='{{ $student->dob, Carbon\Carbon::today()->format('Y-m-d')}}'>
                                            <span class="text-danger">@error('dob'){{$message}} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Contact</label>
                                            <input type="text" class="form-control" name="phone" value='{{ $student->phone }}'>
                                            <span class="text-danger">@error('phone'){{$message}} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Current Address</label>
                                            <input type="text" class="form-control" name="caddress" value='{{$student->caddress }}'>
                                            <span class="text-danger">@error('caddress'){{$message}} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Permanent Address</label>
                                            <input type="text" class="form-control" name="paddress" value='{{ $student->paddress }}'>
                                            <span class="text-danger">@error('paddress'){{$message}} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label"> Parent Email Address</label>
                                            <input type="email" class="form-control" name="parent_email"  value="{{$student->parent->parent_email}}">
                                            <span class="text-danger">@error('parent_email'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Father's Name</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="fathername"  value="{{$student->parent->father_name}}">
                                            <span class="text-danger">@error('fathername'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Father's ContactNo</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="fathercontact"  value="{{$student->parent->father_contact}}">
                                            <span class="text-danger">@error('fathercontact'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Father's Job</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="fatherjob" value="{{$student->parent->father_job}}">
                                            <span class="text-danger">@error('fatherjob'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Mother's Name</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="mothername"  value="{{$student->parent->mother_name}}">
                                            <span class="text-danger">@error('mothername'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Mother's ContactNo</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="mothercontact"  value="{{$student->parent->mother_contact}}">
                                            <span class="text-danger">@error('mothercontact'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Mother's Job</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="motherjob" value="{{$student->parent->mother_job}}">
                                            <span class="text-danger">@error('motherjob'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Guardian Name</label>
                                            <input type="text" class="form-control" name="guardname" value="{{$student->parent->guardian_name}}">
                                            <span class="text-danger">@error('guardname'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Guardian's Email</label>
                                            <input type="text" class="form-control" name="guardemail"  placeholder="Email"  value="{{$student->parent->guardian_email}}">
                                            <span class="text-danger">@error('guardemail'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Guardian Relation</label>
                                            <input type="text" class="form-control" name="guardrelation"  value="{{$student->parent->guardian_relation}}">
                                            <span class="text-danger">@error('guardrelation'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Gurdian's Job</label>
                                            <input type="text" class="form-control" name="guardjob"  value="{{$student->parent->guardian_job}}">
                                            <span class="text-danger">@error('guardjob'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Guardian's ContactNo</label>
                                            <input type="text" class="form-control" name="guardcontact" value="{{$student->parent->guardian_contact}}">
                                            <span class="text-danger">@error('guardcontact'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Guardian's Address</label>
                                            <input type="text" class="form-control" name="guardaddress" value="{{$student->parent->guardian_address}}">
                                            <span class="text-danger">@error('guardaddress'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Caste</label>
                                            <input type="text" class="form-control" name="caste" value='{{ $student->caste }}'>
                                            <span class="text-danger">@error('caste'){{$message}} @enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Religion</label>
                                            <input type="text" class="form-control" name="religion" value='{{ $student->religion}}'>
                                            <span class="text-danger">@error('religion'){{$message}} @enderror</span>
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
                                                <th>Email Address</th>
                                                <th>Admission No</th>
                                                <th>Roll No</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Blood Group</th>
                                                <th>Gender</th>
                                                <th>Date of Birth</th>
                                                <th>Phone</th>
                                                <th>Caste</th>
                                                <th>Religion</th>
                                                <th>Current Address</th>
                                                <th>Permanent Address</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($std as $key =>$data)
                                                <tr>
                                                    <td>{{$data->fname}}</td>
                                                    <td>{{$data->email}}</td>
                                                    <td>{{$data->admission}}</td>
                                                    <td>{{$data->roll}}</td>
                                                    <td>{{$data->class_id}}</td>
                                                    <td>{{$data->section_id}}</td>
                                                    <td>{{$data->bloodgroup}}</td>
                                                    <td>{{$data->gender}}</td>
                                                    <td>{{$data->dob}}</td>
                                                    <td>{{$data->phone}}</td>
                                                    <td>{{$data->caste}}</td>
                                                    <td>{{$data->religion}}</td>
                                                    <td>{{$data->caddress}}</td>
                                                    <td>{{$data->paddress}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.student.edit',$data['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.student.edit',$data['id']) }}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('student.edit',$data['id']) }}
                                                                @endif
                                                                " class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <form method="post" action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.student.destroy',$data->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.student.destroy',$data->id)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('student.destroy',$data->id)}}
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>--}}
{{--    <script type="text/javascript">--}}
{{--        $('.date').datepicker({--}}
{{--            format: 'yyyy-mm-dd',--}}
{{--            changeMonth:true,--}}
{{--            changeYear:true,--}}
{{--        });--}}
{{--    </script>--}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#categoryform').validate();
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
                            $('#section_id').append(`<option value="${element['id']} ">${element['name']}</option>`);
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
@section('scripts')
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endsection
