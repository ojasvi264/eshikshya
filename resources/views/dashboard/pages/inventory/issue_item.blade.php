@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Issue Item</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Inventory</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Issue Item</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Issue Item</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{isset($issueItem) ? route('admin.issue_item.update', $issueItem) : route('admin.issue_item.store')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                        {{isset($issueItem) ? route('accountant.issue_item.update', $issueItem) : route('accountant.issue_item.store')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{isset($issueItem) ? route('issue_item.update', $issueItem) : route('issue_item.store')}}
                                @endif
                                " method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($issueItem))
                                    @method('PATCH')
                                @endif

                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Role</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="role_id" id="role_id">
                                                <option value="">Select User Role</option>
                                                @foreach ($roles as $role)
                                                    <option value='{{ $role->id }}'
                                                            @isset($issueItem)@if($role->id == $issueItem->role->id) selected @endif @endisset>{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('role_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Issue To</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="issue_to" id="issue_to">
                                                <option value="">Select Issue To</option>
                                                @foreach ($issueTos as $issueTo)
                                                    <option value='{{ $issueTo->id }}'
                                                            @isset($issueItem)@if($issueTo->id == $issueItem->staff_directory->id) selected @endif @endisset>{{$issueTo->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('issue_to'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Issue By</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="issue_by" id="issue_by">
                                                <option value="">Select Issue By</option>
                                                @foreach ($issueBys as $issueBy)
                                                    <option value='{{ $issueBy->id }}'
                                                            @isset($issueItem)@if($issueBy->id == $issueItem->staff_dir->id) selected @endif @endisset>{{$issueBy->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('issue_by'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Item Category</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="item_category_id" id="item_category_id">
                                                <option value="">Select Item Category</option>
                                                @foreach ($itemCategories as $itemCategory)
                                                    <option value='{{ $itemCategory->id }}'
                                                            @isset($issueItem)@if($itemCategory->id == $issueItem->item_category->id) selected @endif @endisset>{{$itemCategory->name}}</option>
                                                @endforeach
                                            </select>
                                            <span
                                                class="text-danger">@error('item_category_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Item</label><span style="color: red">&#42;</span>
                                            <select class="form-control" name="item_id" id="item_id">
                                                <option value="">Select Item</option>
                                                @foreach ($items as $item)
                                                    <option value='{{ $item->id }}'
                                                            @isset($issueItem)@if($item->id == $issueItem->item->id) selected @endif @endisset>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('item_id'){{$message}}@enderror</span>

                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Issue Date</label><span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="issue_date"
                                                   value='{{old('issue_date')?old('issue_date'):(isset($issueItem) ? $issueItem->issue_date : '')}}'>
                                            <span class="text-danger">@error('issue_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Return Date</label><span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="return_date"
                                                   value='{{old('return_date')?old('return_date'):(isset($issueItem) ? $issueItem->return_date : '')}}'>
                                            <span class="text-danger">@error('return_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Quantity</label><span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="quantity"
                                                   value='{{old('quantity')?old('quantity'):(isset($issueItem) ? $issueItem->quantity : '')}}'>
                                            <span id="itemQuantity"></span>
                                            <span class="text-danger">@error('quantity'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Note</label>
                                            <textarea id="mytextarea" class="form-control"
                                                      name="note">{!! isset($issueItem)?$issueItem->note:(old('note') ?? '') !!}</textarea>
                                            <span class="text-danger">@error('note'){{$message}}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit"
                                                class="btn btn-primary">{{isset($issueItem) ? "Update" : "+ Add"}}</button>
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
                                                <th>Role</th>
                                                <th>Issue To</th>
                                                <th>Issue By</th>
                                                <th>Item Category</th>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Issue Date</th>
                                                <th>Return Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($issueItems as $key => $issueItm)
                                                <tr>
                                                    <td>{{$issueItm->role->name}}</td>
                                                    <td>{{$issueItm->staff_directory->name}}</td>
                                                    <td>{{$issueItm->staff_dir->name}}</td>
                                                    <td>{{$issueItm->item_category->name}}</td>
                                                    <td>{{$issueItm->item->name}}</td>
                                                    <td>{{$issueItm->quantity}}</td>
                                                    <td>{{$issueItm->issue_date}}</td>
                                                    <td>{{$issueItm->return_date}}</td>
                                                    <td class="text-center">
                                                        @if($issueItm->status==1)
                                                            <span id="itemReturned" class="shadow-none badge badge-success">Returned</span>
                                                        @else
                                                                <span class="shadow-none badge badge-danger" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#issueReturnModal"
                                                                      data-category="{{$issueItm->item_category->name}}" data-item="{{$issueItm->item->name}}" data-quantity="{{$issueItm->quantity}}" data-id="{{$issueItm->id}}">Click To Return
                                                                </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.issue_item.edit', $issueItm)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.issue_item.edit', $issueItm)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('issue_item.edit', $issueItm)}}
                                                                @endif
                                                                "
                                                               class="btn btn-sm btn-primary m-1"><i
                                                                    class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.issue_item.destroy',$issueItm)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Accountant')
                                                                        {{route('accountant.issue_item.destroy',$issueItm)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('issue_item.destroy',$issueItm)}}
                                                                @endif
                                                                "
                                                                  method="post" onsubmit="return confirm('Are you sure?')">
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

                                                <div class="modal fade" id="issueReturnModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to return this item?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <ul>
                                                                   <li>
                                                                        <strong>Item Category: </strong>
                                                                       <span id="item-category"></span>
                                                                   </li>
                                                                   <li>
                                                                       <strong>Item Name: </strong>
                                                                       <span id="item-name"></span>
                                                                   </li>
                                                                   <li>
                                                                       <strong>Item Quantity: </strong>
                                                                       <span id="item-quantity"></span>
                                                                   </li>

                                                               </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary" id="submitReturn">Return</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

    <script>
        $(document).ready(function () {
            $('#role_id').on('change', function () {
                let id = $(this).val();
                $('#issue_to').empty();
                $('#issue_to').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/get_staffs/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#issue_to').empty();
                        $('#issue_to').append(`<option value="0" disabled selected>Select Issue To User*</option>`);
                        response.forEach(element => {
                            $('#issue_to').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#item_id').on('change', function () {
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/item_quantity/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response[0].quantity);
                        $('#itemQuantity').append(`<span style="color: #7356f1">Available Quantity: ${response[0].quantity}</span>`)
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var myModalEl = document.getElementById('issueReturnModal')
            myModalEl.addEventListener('shown.bs.modal', function (event) {
                const relatedTarget = $(event.relatedTarget);
                const id = relatedTarget.data('id');
                const category = relatedTarget.data('category');
                const item = relatedTarget.data('item');
                const quantity = relatedTarget.data('quantity');
                $('#submitReturn').data('id', id);
                $('#item-category').html(category);
                $('#item-name').html(item);
                $('#item-quantity').html(quantity);
            });

            $('#submitReturn').click(function (){
                const id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/return_item/' + id,
                    success: function (response) {
                        window.location.reload();
                        // var response = JSON.parse(response);
                        $('#itemReturned').append(`<span  class="shadow-none badge badge-success">Returned</span>`)
                    }
                });
            });
        });
    </script>
@endsection



