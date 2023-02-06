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
                        <h4>Item Stock</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Inventory</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Item Stock</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Item Stock</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                            @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                    {{isset($itemStock) ? route('admin.item_stock.update', $itemStock) : route('admin.item_stock.store')}}
                                @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                    {{isset($itemStock) ? route('accountant.item_stock.update', $itemStock) : route('accountant.item_stock.store')}}
                                @endif
                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                {{isset($itemStock) ? route('item_stock.update', $itemStock) : route('item_stock.store')}}
                            @endif
                                " method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($itemStock))
                                    @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Item Category</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="item_category_id" id="item_category_id">
                                                <option value="">Select Item Category</option>
                                                @foreach ($itemCategories as $itemCategory)
                                                    <option value='{{ $itemCategory->id }}' @isset($itemStock)@if($itemCategory->id == $itemStock->item_category->id) selected @endif @endisset>{{$itemCategory->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('item_category_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Item</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="item_id" id="item_id">
                                                <option value="">Select Item</option>
                                                @foreach ($items as $item)
                                                    <option value='{{ $item->id }}' @isset($itemStock)@if($item->id == $itemStock->item->id) selected @endif @endisset>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('item_id'){{$message}}@enderror</span>

                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Item Supplier</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="item_supplier_id" id="item_supplier_id">
                                                <option value="">Select Item Supplier</option>
                                                @foreach ($itemSuppliers as $itemSupplier)
                                                    <option value='{{ $itemSupplier->id }}' @isset($itemStock)@if($itemSupplier->id == $itemStock->item_supplier->id) selected @endif @endisset>{{$itemSupplier->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('item_supplier_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Item Store</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="item_store_id" id="item_store_id">
                                                <option value="">Select Item Store</option>
                                                @foreach ($itemStores as $itemStore)
                                                    <option value='{{ $itemStore->id }}' @isset($itemStock)@if($itemStore->id == $itemStock->item_store->id) selected @endif @endisset>{{$itemStore->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('item_store_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Quantity</label><span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="quantity" value='{{old('quantity')?old('quantity'):(isset($itemStock) ? $itemStock->quantity : '')}}' min="0">
                                            <span class="text-danger">@error('quantity'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Purchase Price</label><span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="purchase_price" value='{{old('purchase_price')?old('purchase_price'):(isset($itemStock) ? $itemStock->purchase_price : '')}}' min="0">
                                            <span class="text-danger">@error('purchase_price'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Date</label><span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="date" value='{{old('date')?old('date'):(isset($itemStock) ? $itemStock->date : '')}}' >
                                            <span class="text-danger">@error('date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Documents</label><span style="color: red">&#42;</span>
                                            <input name="document" type="file" class="dropify" data-height="100" accept=".doc,docx,.pdf,.xls,.xlsx,.ppt,.pptx" data-default-file="{{isset($itemStock) ? $itemStock->document :''}}"/>
                                            <span class="text-danger">@error('document'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Description</label>
                                            <textarea id="mytextarea" class="form-control" name="description">{!! isset($itemStock)?$itemStock->description:(old('description') ?? '') !!}</textarea>
                                            <span class="text-danger">@error('description'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">{{isset($itemStock) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Item List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Item Category</th>
                                                <th>Item</th>
                                                <th>Item Supplier</th>
                                                <th>Item Store</th>
                                                <th>Quantity</th>
                                                <th>Purchase Price</th>
                                                <th>Document</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($itemStocks as $key =>$itemStock)
                                                <tr>
                                                    <td>{{$itemStock->item_category->name}}</td>
                                                    <td>{{$itemStock->item->name}}</td>
                                                    <td>{{$itemStock->item_supplier->name}}</td>
                                                    <td>{{$itemStock->item_store->name}}</td>
                                                    <td>{{$itemStock->quantity}}</td>
                                                    <td>{{$itemStock->purchase_price}}</td>
                                                    <td>{{$itemStock->getMedia()[0]->file_name}}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.item_stock.edit', $itemStock)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.item_stock.edit', $itemStock)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('item_stock.edit', $itemStock)}}
                                                                @endif
                                                                " class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.item_stock.destroy', $itemStock)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.item_stock.destroy', $itemStock)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('item_stock.destroy', $itemStock)}}
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
@section('scripts')
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
    <script>
        $(document).ready(function () {
            $('#item_category_id').on('change', function () {
                let id = $(this).val();
                $('#item_id').empty();
                $('#item_id').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/item_categories/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#item_id').empty();
                        $('#item_id').append(`<option value="0" disabled selected>Select Items*</option>`);
                        response.forEach(element => {
                            $('#item_id').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
@endsection



