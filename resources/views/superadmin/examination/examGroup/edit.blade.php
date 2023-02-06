@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Exam Group</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Examination</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Exam Group</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Exam Group</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{route('admin.exam-group.update')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                        {{route('teacher.exam-group.update')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{route('exam-group.update')}}
                                @endif
                                " method="POST">
                                <input type="hidden" name='id' value={{$examinationGroup['id']}}>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Exam Name</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="exam_name" value='{{ $examinationGroup->exam_name }}'>
                                            <span class="text-danger">@error('exam_name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Exam Type</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="examType_id" >
                                                <option value="">Select Exam Type</option>
                                                @foreach ($type as $row)
                                                    <option value='{{ $row->id }}' {{ (collect($examinationGroup->examType_id)->contains($row->id)) ? 'selected':'' }}>{{$row->exam_type}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('examType_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description">{{$examinationGroup->description }}</textarea>
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
                                    <h4 class="card-title">Exam Group List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Exam Name</th>
                                                <th>Exam Type</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($examinationGrp as $key =>$item)
                                                <tr>
                                                    <td>{{$item->exam_name}}</td>
                                                    <td>{{$item->types->exam_type}}</td>
                                                    <td>{{$item->description}}</td>
                                                    <td>
                                                     <td>
                                                          <div class="d-flex">
                                                              <a href="
                                                                  @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                      @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.exam-group.edit',$item['id']) }}
                                                                      @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.exam-group.edit',$item['id']) }}
                                                                      @endif
                                                                  @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('exam-group.edit',$item['id']) }}
                                                                  @endif
                                                                  " class='btn btn-sm btn-primary m-1'>
                                                                  <i class="la la-pencil"></i></a>
                                                              <form method="POST" action="
                                                                  @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                      @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.exam-group.destroy',$item->id)}}
                                                                      @elseif(auth()->guard('staff')->user()->role->name == 'Teacher')
                                                                        {{route('teacher.exam-group.destroy',$item->id)}}
                                                                      @endif
                                                                  @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('exam-group.destroy',$item->id)}}
                                                                  @endif
                                                                  "> @method('delete')
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
