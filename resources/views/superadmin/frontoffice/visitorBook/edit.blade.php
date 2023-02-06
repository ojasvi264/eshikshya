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
                        <h4>Visitor Book</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Front Office</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Visitor Book</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Visitor</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{route('admin.visitor-book.update')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                        {{route('receptionist.visitor-book.update')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                        {{route('accountant.visitor-book.update')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{route('visitor-book.update')}}
                                @endif
                                " method="POST">
                                <input type="hidden" name='id' value={{$visitor['id']}}>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Purpose</label>
                                            <span style="color: red">&#42;</span>
                                            <select class="form-control" name="purpose_id">
                                                <option value="">Select Reference</option>
                                                @foreach ($purpose as $data)
                                                    <option value='{{ $data->id }}' {{ (collect($visitor->purpose_id)->contains($data->id)) ? 'selected':'' }}>{{$data->purpose}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('purpose_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Name</label>
                                            <span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="visitor_name" placeholder="Enter Visitor's Name" value="{{$visitor->visitor_name}}">
                                            <span class="text-danger">@error('visitor_name'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Phone</label>
                                            <input type="text" class="form-control" name="phone" value="{{$visitor->phone}}">
                                            <span class="text-danger">@error('phone'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >ID Card</label>
                                            <input type="text" class="form-control" name="id_card" value="{{$visitor->id_card}}">
                                            <span class="text-danger">@error('id_card'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Number Of Person</label>
                                            <input type="text" class="form-control" name="no_of_person" value="{{$visitor->no_of_person}}">
                                            <span class="text-danger">@error('no_of_person'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" name="date" value="{{$visitor->date}}">
                                            <span class="text-danger">@error('date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">In Time</label>
                                            <input type="time" class="form-control" name="in_time" value="{{$visitor->in_time}}">
                                            <span class="text-danger">@error('in_time'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Out Time</label>
                                            <input type="time" class="form-control" name="out_time" value="{{$visitor->out_time}}">
                                            <span class="text-danger">@error('out_time'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Note</label>
                                            <textarea class="form-control" name="note">{{$visitor->note}}</textarea>
                                            <span class="text-danger">@error('note'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Attach Document</label>
                                            <input class="dropify" type="file" name="file[]" value="{{$visitor->file}}" multiple="">
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
                                    <h4 class="card-title">Visitor List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 750px">
                                            <thead>
                                            <tr>
                                                <th>Purpose</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Date</th>
                                                <th>In Time</th>
                                                <th>Out Time</th>
                                                <th>File</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($visit as $key =>$item)
                                                <tr>
                                                    <td>{{$item->purpose->purpose}}</td>
                                                    <td>{{$item->visitor_name}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{$item->date}}</td>
                                                    <td>{{$item->in_time}}</td>
                                                    <td>{{$item->out_time}}</td>
                                                    <td>
                                                        @if(json_decode(($item->file))>0)
                                                            @foreach(json_decode($item->file, true) as $key => $media_gallery)
                                                                <a href="{{ url('/files/visitorBook/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">
                                                                    <img src="{{ url('/files/visitorBook/'.$media_gallery) }}" class="img-fluid mb-2" alt="white sample" width="50" height="50">
                                                                </a>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                            @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                    {{route('admin.visitor-book.edit',$item['id']) }}
                                                                @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                    {{route('receptionist.visitor-book.edit',$item['id']) }}
                                                                @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                    {{route('accountant.visitor-book.edit',$item['id']) }}
                                                                @endif
                                                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                {{route('visitor-book.edit',$item['id']) }}
                                                            @endif
                                                                " class='btn btn-sm btn-primary m-1'>
                                                                <i class="la la-pencil"></i></a>
                                                            <form method="POST" action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.visitor-book.destroy',$item->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Receptionist')
                                                                        {{route('receptionist.visitor-book.destroy',$item->id)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.visitor-book.destroy',$item->id)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('visitor-book.destroy',$item->id)}}
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

