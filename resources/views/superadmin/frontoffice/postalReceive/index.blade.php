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
                        <h4>Postal Receive</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Front Office</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Postal Receive</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Postal Receive</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{ route('admin.postal-receive/add') }}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                        {{ route('receptionist.postal-receive/add') }}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                        {{ route('accountant.postal-receive/add') }}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{ route('postal-receive/add') }}
                                @endif
                                " method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >From Title</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="from_title" value='{{ old('from_title') }}'>
                                            <span class="text-danger">@error('from_title'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Reference No</label>
                                            <input type="text" class="form-control" name="reference_no" value='{{ old('reference_no') }}'>
                                            <span class="text-danger">@error('reference_no'){{$message}}@enderror</span>
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
                                            <label class="form-label" >To Title</label>
                                            <input type="text" class="form-control" name="to_title" value='{{ old('to_title') }}'>
                                            <span class="text-danger">@error('to_title'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Date</label>
                                            <input type="date" class="form-control" name="postal_receive_date" value='{{ old('postal_receive_date', Carbon\Carbon::today()->format('Y-m-d')) }}'>
                                            <span class="text-danger">@error('postal_receive_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="file">Attach Document:</label>
                                            <input class="dropify" type="file" id="file" name="file[]" multiple="" data-height="100">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Note</label>
                                            <textarea class="form-control" name="note">{{ old('note') }}</textarea>
                                            <span class="text-danger">@error('note'){{$message}}@enderror</span>
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
                                    <h4 class="card-title">Postal Receive List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>From Title</th>
                                                <th>To Title</th>
                                                <th>Reference No.</th>
                                                <th>Address</th>
                                                <th>Note</th>
                                                <th>Date</th>
                                                <th>File</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($postalReceive as $key =>$item)
                                                <tr>
                                                    <td>{{$item->from_title}}</td>
                                                    <td>{{$item->to_title}}</td>
                                                    <td>{{$item->reference_no}}</td>
                                                    <td>{{$item->address}}</td>
                                                    <td>{{$item->note}}</td>
                                                    <td>{{$item->postal_receive_date}}</td>
                                                    <td>
                                                        @if(json_decode(($item->file))>0)
                                                            @foreach(json_decode($item->file, true) as $key => $media_gallery)
                                                                <a href="{{ url('/files/postalReceive/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">
                                                                    <img src="{{ url('/files/postalReceive/'.$media_gallery) }}" class="img-fluid mb-2" alt="white sample" width="50" height="50">
                                                                </a>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                    {{route('admin.postal-receive.edit',$item['id']) }}
                                                                @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                    {{route('receptionist.postal-receive.edit',$item['id']) }}
                                                                @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                    {{route('accountant.postal-receive.edit',$item['id']) }}
                                                                @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('postal-receive.edit',$item['id']) }}
                                                                @endif
                                                                " class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-pencil"></i></a>
                                                            <form method="POST" action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.postal-receive.destroy',$item->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                        {{route('receptionist.postal-receive.destroy',$item->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.postal-receive.destroy',$item->id)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('postal-receive.destroy',$item->id)}}
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
