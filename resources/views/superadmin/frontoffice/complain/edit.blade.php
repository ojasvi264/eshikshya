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
                        <h4>Complain</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Front Office</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Complain</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Complain</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{route('admin.complain.update')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                        {{route('receptionist.complain.update')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                        {{route('accountant.complain.update')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{route('complain.update')}}
                                @endif
                                " method="POST" enctype="multipart/form-data">
                                <input type="hidden" name='id' value={{$complain['id']}}>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Complain Type</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="complainType_id" >
                                                <option value="">Select Complain Type</option>
                                                @foreach ($complainType as $row)
                                                    <option value='{{ $row->id }}' {{ (collect($complain->complainType_id)->contains($row->id)) ? 'selected':'' }}>{{$row->complain_type}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('complainType_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Source</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="source_id" >
                                                <option value="">Select Source</option>
                                                @foreach ($source as $row)
                                                    <option value='{{ $row->id }}' {{ (collect($complain->source_id)->contains($row->id)) ? 'selected':'' }}>{{$row->source}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('source_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Complain by</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="complain_by" value="{{$complain->complain_by}}">
                                            <span class="text-danger">@error('complain_by'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="phone" value="{{$complain->phone}}">
                                            <span class="text-danger">@error('phone'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Complain Date</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="complain_date" value="{{$complain->complain_date}}">
                                            <span class="text-danger">@error('complain_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Action taken</label>
                                            <input type="text" class="form-control" name="action_taken" value="{{$complain->action_taken}}">
                                            <span class="text-danger">@error('action_taken'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Assigned</label>
                                            <input type="text" class="form-control" name="assigned" value="{{$complain->assigned}}" placeholder="Assigned to">
                                            <span class="text-danger">@error('assigned'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description" >{{ $complain->description}}</textarea>
                                            <span class="text-danger">@error('description'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Note</label>
                                            <textarea class="form-control" name="note">{{$complain->note}}</textarea>
                                            <span class="text-danger">@error('note'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Attach Document</label>
                                            <input class="dropify" type="file" name="file[]" value="{{$complain->file}}" multiple="">
                                            <span class="text-danger">@error('file'){{$message}}@enderror</span>
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
                                                <th>Complain Type</th>
                                                <th>Source</th>
                                                <th>Complain By</th>
                                                <th>Phone</th>
                                                <th>Complain Date</th>
                                                <th>File</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($comp as $key =>$item)
                                                <tr>
                                                    <td>{{$item->complain->complain_type}}</td>
                                                    <td>{{$item->source->source}}</td>
                                                    <td>{{$item->complain_by}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{$item->complain_date}}</td>
                                                    <td>
                                                        @foreach(json_decode($item->file, true) as $key => $media_gallery)
                                                            <a href="{{ url('/files/complain/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">
                                                                <img src="{{ url('/files/complain/'.$media_gallery) }}" class="img-fluid mb-2" alt="file" width="50" height="50">
                                                            </a>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.complain.edit',$item['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                        {{route('receptionist.complain.edit',$item['id']) }}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.complain.edit',$item['id']) }}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('complain.edit',$item['id']) }}
                                                                @endif
                                                                " class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-pencil"></i></a>
                                                            <form method="POST" action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.complain.destroy',$item->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                        {{route('receptionist.complain.destroy',$item->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.complain.destroy',$item->id)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('complain.destroy',$item->id)}}
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
    @section('scripts')
        <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
        <script>
            $('.dropify').dropify();
        </script>
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'note');
        </script>
    @endsection
@endsection
