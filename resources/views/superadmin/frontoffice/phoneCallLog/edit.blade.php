@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Phone Call Log</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Front Office</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Phone Call Log</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Phone Call Log</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{route('admin.phone-call-log.update')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                        {{route('receptionist.phone-call-log.update')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                        {{route('accountant.phone-call-log.update')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{route('phone-call-log.update')}}
                                @endif
                                " method="POST">
                                <input type="hidden" name='id' value={{$phoneCallLog['id']}}>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Name</label>
                                            <input type="text" class="form-control" name="name" value="{{$phoneCallLog->name}}">
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Phone</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="phone" value="{{$phoneCallLog->phone}}">
                                            <span class="text-danger">@error('phone'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Date</label>
                                            <input type="date" class="form-control" name="date" value="{{$phoneCallLog->date}}">
                                            <span class="text-danger">@error('date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Next Follow Up Date</label>
                                            <input type="date" class="form-control" name="follow_up_date" value="{{$phoneCallLog->follow_up_date}}">
                                            <span class="text-danger">@error('follow_up_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description">{{$phoneCallLog->description}}</textarea>
                                            <span class="text-danger">@error('description'){{$message}}@enderror</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Note</label>
                                            <textarea class="form-control" name="note">{{$phoneCallLog->note}}</textarea>
                                            <span class="text-danger">@error('note'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Call Duration</label>
                                            <input type="text" class="form-control" name="call_duration" value="{{$phoneCallLog->call_duration}}">
                                            <span class="text-danger">@error('call_duration'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Call Type</label>
                                            <span style="color: red">&#42;</span>
                                            <br/>
                                            <div>
                                                <input name="call_type" type="radio" value="incoming" @if ($phoneCallLog->call_type == 'incoming') checked @endif>
                                                <label for="male">
                                                    Incoming
                                                </label>
                                                <input name="call_type" type="radio" value="outgoing" @if ($phoneCallLog->call_type == 'outgoing') checked @endif>
                                                <label for="female">
                                                    Outgoing
                                                </label>
                                            </div>
                                            <span class="text-danger">@error('call_type'){{$message}}@enderror</span>
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
                                    <h4 class="card-title">Complain List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Date</th>
                                                <th>Next Follow Up Date</th>
                                                <th>Call Type</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($phoneLog as $key =>$item)
                                                <tr>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{$item->date}}</td>
                                                    <td>{{$item->follow_up_date}}</td>
                                                    <td>{{$item->call_type}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                            @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                    {{route('admin.phone-call-log.edit',$item['id']) }}
                                                                @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                    {{route('receptionist.phone-call-log.edit',$item['id']) }}
                                                                @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                    {{route('accountant.phone-call-log.edit',$item['id']) }}
                                                                @endif
                                                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                {{route('phone-call-log.edit',$item['id']) }}
                                                            @endif
                                                                " class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-pencil"></i></a>
                                                            <form method="POST" action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.phone-call-log.destroy',$item->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                        {{route('receptionist.phone-call-log.destroy',$item->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.phone-call-log.destroy',$item->id)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('phone-call-log.destroy',$item->id)}}
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
