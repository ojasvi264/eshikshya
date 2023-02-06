@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Teacher Rating</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Human Resource</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Teacher Rating</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Lesson</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{isset($teacherRating) ? route('admin.teacher_rating.update', $teacherRating) : route('admin.teacher_rating.store')}}
                                    @endif
                                @elseif(auth()->guard('student')->check())
                                    {{isset($teacherRating) ? route('student.teacher_rating.update', $teacherRating) : route('student.teacher_rating.store')}}
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{isset($teacherRating) ? route('teacher_rating.update', $teacherRating) : route('teacher_rating.store')}}
                                @endif
                                " method="POST">
                                @csrf
                                @if(isset($teacherRating))
                                    @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Staff's Name</label>
                                            <select class="form-control" name="directory_id" id="directory_id">
                                                <option value="">Select Staff</option>
                                                @foreach ($staffs as $staff)
                                                    <option value='{{ $staff->id }}' @isset($teacherRating)@if($staff->id == $teacherRating->staff->id) selected @endif @endisset>{{$staff->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('directory_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Student's Name</label>
                                            <select class="form-control" name="student_id" id="student_id">
                                                <option value="">Select Student</option>
                                                @foreach ($students as $student)
                                                    <option value='{{ $student->id }}' @isset($teacherRating)@if($student->id == $teacherRating->student->id) selected @endif @endisset>{{$student->fname}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('student_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Rating</label>
                                            <input type="number" class="form-control" name="rating"
                                                   value='{{old('rating')?old('rating'):(isset($teacherRating) ? $teacherRating->rating : '')}}' min="1" max="5">
                                            <span class="text-danger">@error('rating'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                         <span class="d-flex" style="margin-top: 40px">
                                            <div class="custom-control">
                                            <input type="hidden" name="status" value="0">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch"
                                                   name="status"
                                                   value="1" {{ (isset($teacherRating) && $teacherRating->status == 1) || old('status') ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="customSwitch">Is Active</label>
                                            </div>
                                         </span>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Comment</label>
                                            <textarea id="mytextarea" class="form-control"
                                                      name="comment">{!! isset($teacherRating)?$teacherRating->comment:(old('comment') ?? '') !!}</textarea>
                                            <span class="text-danger">@error('comment'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">{{isset($teacherRating) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Teacher Rating List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Staff ID</th>
                                                <th>Staff Name</th>
                                                <th>Rating</th>
                                                <th>Comment</th>
                                                <th>Student Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($teacherRatings as $key =>$teacherRating)
                                                <tr>
                                                    <td>{{$teacherRating->staff->staff_id}}</td>
                                                    <td>{{$teacherRating->staff->name}}</td>
                                                    <td>
                                                        @for($i = 1; $i <= $teacherRating->rating; $i++)
                                                            <span><i class="fa fa-star"></i></span>
                                                        @endfor
                                                    </td>
                                                    <td>{!! $teacherRating->comment !!}</td>
                                                    <td>{{$teacherRating->student->fname}}</td>
                                                    <td class="text-center">
                                                        @if($teacherRating->status==1)
                                                            <span class="shadow-none badge badge-success">Active</span>
                                                        @else
                                                            <span class="shadow-none badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.teacher_rating.edit', $teacherRating)}}
                                                                    @endif
                                                                @elseif(auth()->guard('student'))
                                                                    {{route('student.teacher_rating.edit', $teacherRating)}}
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('teacher_rating.edit', $teacherRating)}}
                                                                @endif
                                                                " class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.teacher_rating.destroy',$teacherRating)}}
                                                                    @endif
                                                                @elseif(auth()->guard('student'))
                                                                    {{route('student.teacher_rating.destroy', $teacherRating)}}
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('teacher_rating.destroy',$teacherRating)}}
                                                                @endif
                                                                " method="post" onsubmit="return confirm('Are you sure?')">
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

