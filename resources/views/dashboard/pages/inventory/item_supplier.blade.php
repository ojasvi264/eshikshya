@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Item Supplier</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-swm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Academics</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Item Supplier</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Item Supplier</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                            @if(auth()->guard('staff')->user()->role->name == 'Admin')
                            {{isset($itemSupplier) ? route('admin.item_supplier.update', $itemSupplier) : route('admin.item_supplier.store')}}
                            @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                            {{isset($itemSupplier) ? route('accountant.item_supplier.update', $itemSupplier) : route('accountant.item_supplier.store')}}
                            @endif
                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                            {{isset($itemSupplier) ? route('item_supplier.update', $itemSupplier) : route('item_supplier.store')}}
                            @endif
                                " method="POST">
                                @csrf
                                @if(isset($itemSupplier))
                                    @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Supplier Name</label><span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="name"
                                                   value='{{old('name')?old('name'):(isset($itemSupplier) ? $itemSupplier->name : '')}}'>
                                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Email</label><span style="color: red">&#42;</span>
                                            <input type="email" class="form-control" name="email"
                                                   value='{{old('email')?old('email'):(isset($itemSupplier) ? $itemSupplier->email : '')}}'>
                                            <span class="text-danger">@error('email'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Phone</label><span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="phone"
                                                   value='{{old('phone')?old('phone'):(isset($itemSupplier) ? $itemSupplier->phone : '')}}'>
                                            <span class="text-danger">@error('phone'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Address</label><span
                                                style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="address"
                                                   value='{{old('address')?old('address'):(isset($itemSupplier) ? $itemSupplier->address : '')}}'>
                                            <span class="text-danger">@error('address'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Contact Person Name</label><span
                                                style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="contact_person_name"
                                                   value='{{old('contact_person_name')?old('contact_person_name'):(isset($itemSupplier) ? $itemSupplier->contact_person_name : '')}}'>
                                            <span
                                                class="text-danger">@error('contact_person_name'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Contact Person Email</label><span
                                                style="color: red">&#42;</span>
                                            <input type="email" class="form-control" name="contact_person_email"
                                                   value='{{old('contact_person_email')?old('contact_person_email'):(isset($itemSupplier) ? $itemSupplier->contact_person_email : '')}}'>
                                            <span
                                                class="text-danger">@error('contact_person_email'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Contact Person Phone</label><span
                                                style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="contact_person_phone"
                                                   value='{{old('contact_person_phone')?old('contact_person_phone'):(isset($itemSupplier) ? $itemSupplier->contact_person_phone : '')}}'>
                                            <span
                                                class="text-danger">@error('contact_person_phone'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea id="mytextarea" class="form-control"
                                                      name="description">{!! isset($itemSupplier)?$itemSupplier->description:(old('description') ?? '') !!}</textarea>
                                            <span class="text-danger">@error('description'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                    <button type="submit"
                                            class="btn btn-primary">{{isset($itemSupplier) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Item Supplier List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Contact Person Name</th>
                                                <th>Contact Person Phone</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($itemSuppliers as $key =>$itemSupplier)
                                                <tr>
                                                    <td>{{$itemSupplier->name}}</td>
                                                    <td>{{$itemSupplier->email}}</td>
                                                    <td>{{$itemSupplier->phone}}</td>
                                                    <td>{{$itemSupplier->address}}</td>
                                                    <td>{{$itemSupplier->contact_person_name}}</td>
                                                    <td>{{$itemSupplier->contact_person_phone}}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                            @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                            {{route('admin.item_supplier.edit', $itemSupplier)}}
                                                            @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                            {{route('accountant.item_supplier.edit', $itemSupplier)}}
                                                            @endif
                                                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                            {{route('item_supplier.edit', $itemSupplier)}}
                                                            @endif
                                                                " class="btn btn-sm btn-primary m-1"><i
                                                                    class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                            @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                            {{route('admin.item_supplier.destroy', $itemSupplier)}}
                                                            @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                            {{route('accountant.item_supplier.destroy', $itemSupplier)}}
                                                            @endif
                                                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                            {{route('item_supplier.destroy', $itemSupplier)}}
                                                            @endif
                                                                " method="post"
                                                                  onsubmit="return confirm('Are you sure?')">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger m-1"
                                                                        data-toggle="modal" data-target="#deleteModal">
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


