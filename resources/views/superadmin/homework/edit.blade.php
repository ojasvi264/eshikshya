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
                        <h4>Homework</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Homework</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Homework</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{route('admin.homework.update')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        {{route('teacher.homework.update')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{route('homework.update')}}
                                @endif
                                " method="POST" enctype="multipart/form-data">
                                <input type="hidden" name='id' value={{$homework['id']}}>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($class as $row)
                                                    <option value='{{ $row->id }}' {{ (collect($homework->class_id)->contains($row->id)) ? 'selected':'' }}>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('class_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="section_id">
                                                <option value="">Select Section</option>
                                                @foreach ($section as $row)
                                                    <option value='{{ $row->id }}' {{ (collect($homework->section_id)->contains($row->id)) ? 'selected':'' }}>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('section_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Subject</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="subject_id">
                                                <option value="">Select Subject</option>
                                                @foreach ($subject as $row)
                                                    <option value='{{ $row->id }}' {{ (collect($homework->subject_id)->contains($row->id)) ? 'selected':'' }}>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('subject_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Assigned Date</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="assign" value="{{($homework->assign)}}">
                                            <span class="text-danger">@error('assign'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Submission Date</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="submission" value="{{($homework->submission)}}">
                                            <span class="text-danger">@error('submission'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Submission Time</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="time" class="form-control" name="submission_time" value="{{($homework->submission_time)}}">
                                            <span class="text-danger">@error('submission_time'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Teacher</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="teacher_id">
                                                <option value="">Select Teacher</option>
                                                @foreach ($teacher as $row)
                                                    <option value='{{ $row->id }}' {{ (collect($homework->teacher_id)->contains($row->id)) ? 'selected':'' }}>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('teacher_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" for="document">Attach Document</label>
                                            <input class="dropify" type="file" name="image[]" id="document" multiple="" data-height="100" accept="image/*">
                                            <span class="text-danger">@error('image'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description" >{{$homework->description}}</textarea>
                                            <span class="text-danger">@error('description'){{$message}}@enderror</span>
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
                                    <h4 class="card-title">Homework List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Subject</th>
                                                <th>Assigned Date</th>
                                                <th>Submission Date</th>
                                                <th>Assigned By</th>
                                                <th>File</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($home as $key =>$data)
                                                <tr>
                                                    <td>{{$data->class->name}}</td>
                                                    <td>{{$data->section->name}}</td>
                                                     <td>{{$data->subject->name}}</td>
                                                    <td>{{$data->assign}}</td>
                                                    <td>{{$data->submission}}</td>
                                                    <td>{{$data->teacher->name}}</td>
                                                    <td>
                                                        @foreach(json_decode($data->image, true) as $key => $media_gallery)
                                                            <a href="{{ url('/files/homework/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">
                                                                <img src="{{ url('/files/homework/'.$media_gallery) }}" class="img-fluid mb-2" alt="white sample" width="50" height="50">
                                                            </a>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.homework.view',$data['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.homework.view',$data['id']) }}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('homework.view',$data['id']) }}
                                                                @endif
                                                            " class='btn btn-sm btn-primary m-1'><i class="la la-eye"></i></a>
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.homework.edit',$data['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.homework.edit',$data['id']) }}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('homework.edit',$data['id']) }}
                                                                @endif
                                                                " class='btn btn-sm btn-primary m-1'><i class="la la-pencil"></i></a>
                                                            <form method="post" action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.homework.destroy',$data->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.homework.destroy',$data->id)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('homework.destroy',$data->id)}}
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
    @section('scripts')
        <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
        <script>
            $('.dropify').dropify();
        </script>
    @endsection
@endsection
