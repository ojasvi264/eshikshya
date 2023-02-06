@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Homework Submission</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Homework Submission</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Submit Homework</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class : </label>
                                            <label class="form-label">{{($homework->class->name)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section : </label>
                                            <label class="form-label">{{($homework->section->name)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Subject : </label>
                                            <label class="form-label">{{($homework->subject->name)}} ({{($homework->subject->code)}})</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Assigned Date : </label>
                                            <label class="form-label">{{($homework->assign)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Submission Date : </label>
                                            <label class="form-label">{{($homework->submission)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Submission Time : </label>
                                            <label class="form-label">{{($homework->submission_time)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Teacher : </label>
                                            <label class="form-label">{{($homework->teacher->fname)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="row pl-3">
                                                <label class="form-label">Description : </label>
                                                <p>{{$homework->description}}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->get('success'))
                                @include('includes.dashboard.message')
                            @endif
                            @if (Auth::check())
                                @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{route('admin.homework.submit')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::guard('student')->check())
                                {{route('student.homework.submit')}}
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{route('homework.submit')}}
                                @endif
                                " method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Attach Document</label>
                                        <span style="color: red">&#42;</span>
                                        <input class="form-control" type="file" name="file[]" multiple="">
                                        <span class="text-danger">@error('file'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" type="hidden" name="homework_id" value="{{ $homework->id }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <hr />
                    <h4>Display Submitted Homework</h4>
                    @foreach($homework->homeworksubmission as $data)
                        <div class="card" style="height: auto">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary dropdown" data-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                                        <div class="dropdown-menu" style="padding-left: 50px;">
                                            <button type="submit" class="btn btn-sm btn-primary m-1"  data-toggle="modal" data-target="#deleteModal">
                                                <a href="
                                                    @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                        @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                            {{route('admin.homework-submission',$data['id']) }}
                                                        @endif
                                                    @elseif(\Illuminate\Support\Facades\Auth::guard('student')->check())
                                                        {{route('student.homework-submission',$data['id']) }}
                                                    @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                        {{route('homework-submission',$data['id']) }}
                                                    @endif
                                                    ">
                                                    <i class="la la-pencil"></i>
                                                    <span>Edit</span>
                                                </a>
                                            </button>
                                                <form method="post" action="
                                                    @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                        @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                            {{route('admin.homework-submission.destroy',$data->id)}}
                                                        @endif
                                                    @elseif(\Illuminate\Support\Facades\Auth::guard('student')->check())
                                                        {{route('student.homework-submission.destroy',$data->id)}}
                                                    @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                        {{route('homework-submission.destroy',$data->id)}}
                                                    @endif
                                                    ">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger m-1"  data-toggle="modal" data-target="#deleteModal">
                                                        <i class="la la-trash-o"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Submitted Date: </label>
                                            <label class="form-label">{{($data->created_at->format('Y M d'))}} [{{($data->created_at->format('l'))}}]</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Submitted Time: </label>
                                            <label class="form-label">{{($data->created_at->format('H:i:s'))}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Submitted by: </label>
                                            <label class="form-label">{{ucfirst($data->user->name)}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Submitted Document: <span><img style="height: 75px; width: 100px;" alt="img" src="{{url('/public/images/homeworkSubmission/'.$data->file,) }}" /></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <hr />
                </div>
            </div>
        </div>
    </div>
@endsection
