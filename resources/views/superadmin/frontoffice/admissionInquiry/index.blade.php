@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Admission Inquiry</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Front Office</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Admission Inquiry</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Admission Inquiry Details</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{route('admin.admission-inquiry/add')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                        {{route('receptionist.admission-inquiry/add')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                        {{route('accountant.admission-inquiry/add')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{route('admission-inquiry/add')}}
                                @endif
                                " method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="full_name" value='{{ old('full_name') }}'>
                                            <span class="text-danger">@error('full_name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Phone</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="phone" value='{{ old('phone') }}'>
                                            <span class="text-danger">@error('phone'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Email</label>
                                            <input type="text" class="form-control" name="email" value='{{ old('email') }}'>
                                            <span class="text-danger">@error('email'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Address</label>
                                            <input type="text" class="form-control" name="address" value='{{ old('address') }}'>
                                            <span class="text-danger">@error('address'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description">{{old('description') }}</textarea>
                                            <span class="text-danger">@error('description'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Note</label>
                                            <textarea class="form-control" name="note">{{ old('note') }}</textarea>
                                            <span class="text-danger">@error('note'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" name="inquiry_date" value='{{ old('inquiry_date', Carbon\Carbon::today()->format('Y-m-d'))}}'>
                                            <span class="text-danger">@error('inquiry_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Next Follow Up Date</label>
                                            <input type="date" class="form-control" name="follow_up" value='{{ old('follow_up', Carbon\Carbon::today()->format('Y-m-d')) }}'>
                                            <span class="text-danger">@error('follow_up'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Source</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="source_id">
                                                <option value="">Select Source</option>
                                                @foreach ($source as $data)
                                                    <option value='{{ $data->id }}' {{ (collect(old('source_id'))->contains($data->id)) ? 'selected':'' }}>{{$data->source}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('source_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Reference</label>
                                            <select class="form-control" name="reference_id">
                                                <option value="0">Select Reference</option>
                                                @foreach ($reference as $ref)
                                                    <option value='{{ $ref->id }}' {{ (collect(old('reference_id'))->contains($ref->id)) ? 'selected':'' }}>{{$ref->reference}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('reference_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Assigned</label>
                                            <select class="form-control" name="teacher_id">
                                                <option value="0">Select Teacher</option>
                                                @foreach ($teacher as $data)
                                                    <option value='{{ $data->id }}'{{ (collect(old('teacher_id'))->contains($data->id)) ? 'selected':'' }}>{{$data->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('teacher_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label>
                                            <select class="form-control" name="class_id">
                                                <option value="0">Select Class</option>
                                                @foreach ($class as $data)
                                                    <option value='{{ $data->id }}' {{ (collect(old('class_id'))->contains($data->id)) ? 'selected':'' }}>{{$data->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('class_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >No of Child</label>
                                            <input type="number" class="form-control" name="no_of_child" value='{{ old('no_of_child') }}'>
                                            <span class="text-danger">@error('no_of_child'){{$message}}@enderror</span>
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
                                    <h4 class="card-title">Admission Inquiry List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Source</th>
                                                <th>Inquiry Date</th>
                                                <th>Last Follow Up Date</th>
                                                <th>Next Follow Up Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($admissionInquiry as $key =>$item)
                                                <tr>
                                                    <td>{{$item->full_name}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{$item->source->source}}</td>
                                                    <td>{{$item->inquiry_date}}</td>
                                                    <td>{{$item->inquiry_date}}</td>
                                                    <td>{{$item->follow_up}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.admission-inquiry.edit',$item['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                        {{route('receptionist.admission-inquiry.edit',$item['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.admission-inquiry.edit',$item['id']) }}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('admission-inquiry.edit',$item['id']) }}
                                                                @endif
                                                                " class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-pencil"></i></a>
                                                            <form method="POST" action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.admission-inquiry.destroy',$item->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                        {{route('receptionist.admission-inquiry.destroy',$item->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.admission-inquiry.destroy',$item->id)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('admission-inquiry.destroy',$item->id)}}
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

