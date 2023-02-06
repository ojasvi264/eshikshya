@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Fee Discount</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees Collection</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fee Discount</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Fee Discount</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                    {{isset($feeDiscount) ? route('admin.fee_discount.update', $feeDiscount) : route('admin.fee_discount.store')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                {{isset($feeDiscount) ? route('fee_discount.update', $feeDiscount) : route('fee_discount.store')}}
                                @endif
                                " method="POST">
                                @csrf
                                @if(isset($feeDiscount))
                                    @method('PATCH')
                                @endif
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Name<span style="color: red">&#42;</span></label>
                                        <input type="text" class="form-control" name="name"
                                               value='{{old('name')?old('name'):(isset($feeDiscount) ? $feeDiscount->name : '')}}'>
                                        <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Discount Code<span style="color: red">&#42;</span></label>
                                        <input type="text" class="form-control" name="discount_code"
                                               value='{{old('discount_code')?old('discount_code'):(isset($feeDiscount) ? $feeDiscount->discount_code : '')}}'>
                                        <span class="text-danger">@error('discount_code'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Fees Type<span style="color: red">&#42;</span></label>
                                        <select class="form-control" name="fees_type_id" id="fees_type_id">
                                            <option value="">Select Fees Type</option>
                                            @foreach ($feesTypes as $feesType)
                                                <option value='{{ $feesType->id }}' @isset($feeDiscount)@if($feesType->id == $feeDiscount->fees_type->id) selected @endif @endisset>{{$feesType->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('fees_type_id'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Discount Type<span class="required">*</span></label>
                                        <select class="form-control" name="discount_type" id="discount_type">
                                            <option value="">Select Discount Type</option>
                                            <option value='Amount' @isset($feeDiscount)@if($feeDiscount->discount_type == 'Amount') selected @endif @endisset>Amount</option>
                                            <option value='Percentage' @isset($feeDiscount)@if($feeDiscount->discount_type == 'Percentage') selected @endif @endisset>Percentage</option>
                                        </select>
                                        <span class="text-danger">@error('discount_type'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 d-none" id="amount">
                                    <div class="form-group">
                                        <label class="form-label">Discount Amount</label>
                                        <input type="number" class="form-control" name="amount" id="amt"
                                               value='{{old('amount')?old('amount'):(isset($feeDiscount) ? $feeDiscount->amount : '')}}' step=".001">
                                        <span class="text-danger">@error('amount'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                @isset($feeDiscount)
                                    @if($feeDiscount->amount != '')
                                    <div class="col-lg-12 col-md-12 col-sm-12 d-block" id="editAmount">
                                        <div class="form-group">
                                            <label class="form-label">Discount Amount</label>
                                            <input type="number" class="form-control" name="amount" id="editAmt"
                                                   value='{{old('amount')?old('amount'):(isset($feeDiscount) ? $feeDiscount->amount : '')}}' step=".001">
                                            <span class="text-danger">@error('amount'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    @endif
                                @endisset
                                <div class="col-lg-12 col-md-12 col-sm-12 d-none" id="percentage">
                                    <div class="form-group">
                                        <label class="form-label">Discount Percentage</label>
                                        <input type="number" class="form-control" name="percentage" id="editPer"
                                               value='{{old('percentage')?old('percentage'):(isset($feeDiscount) ? $feeDiscount->percentage : '')}}' step=".001">
                                        <span class="text-danger">@error('percentage'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                @isset($feeDiscount)
                                    @if($feeDiscount->percentage != '')
                                    <div class="col-lg-12 col-md-12 col-sm-12 d-block" id="editPercentage">
                                        <div class="form-group">
                                            <label class="form-label">Discount Percentage</label>
                                            <input type="number" class="form-control" name="percentage" id="per"
                                                   value='{{old('percentage')?old('percentage'):(isset($feeDiscount) ? $feeDiscount->percentage : '')}}' step=".001">
                                            <span class="text-danger">@error('percentage'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    @endif
                                @endisset
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" >Description</label>
                                        <textarea id="mytextarea" class="form-control" name="description">{!! isset($feeDiscount)?$feeDiscount->description:(old('description') ?? '') !!}</textarea>
                                        <span class="text-danger">@error('description'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                    <button type="submit"
                                            class="btn btn-primary">{{isset($feeDiscount) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Fee Master List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Discount Code</th>
                                                <th>Fees Type</th>
                                                <th>Amount</th>
                                                <th>Percentage</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($feeDiscounts as $key =>$feeDiscount)
                                                <tr>
                                                    <td>{{$feeDiscount->name}}</td>
                                                    <td>{{$feeDiscount->discount_code}}</td>
                                                    <td>{{$feeDiscount->fees_type->name}}</td>
                                                    <td>{{$feeDiscount->amount}}</td>
                                                    <td>{{$feeDiscount->percentage}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                            @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                            {{route('admin.assign_discount.index', $feeDiscount)}}
                                                            @endif
                                                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                            {{route('assign_discount.index', $feeDiscount)}}
                                                            @endif
                                                                "
                                                               class="btn btn-sm btn-primary m-1"><i
                                                                    class="la la-tag"></i></a>
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                    {{route('admin.fee_discount.edit', $feeDiscount)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                {{route('fee_discount.edit', $feeDiscount)}}
                                                                @endif
                                                                "
                                                               class="btn btn-sm btn-warning m-1"><i
                                                                    class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.fee_discount.destroy',$feeDiscount)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('fee_discount.destroy',$feeDiscount)}}
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
    <script>
        $(document).ready(function(){

        });
    </script>
    <script>
        $('#discount_type').change(function (){
            let discountType = $('#discount_type option:selected').val();
            if (discountType == "Amount"){
                $('#amount').removeClass('d-none').addClass('d-block');
                $('#percentage').addClass('d-none');
                $('#editPercentage').addClass('d-none');
                $('#per').val('');
                $('#editPer').val('');
            }else if(discountType == "Percentage"){
                $('#percentage').removeClass('d-none').addClass('d-block');
                $('#amount').addClass('d-none');
                $('#editAmount').addClass('d-none');
                $('#amt').val('');
                $('#editAmt').val('');
            }else {
                $('#amount').addClass('d-none');
                $('#percentage').addClass('d-none');
            }
        });
    </script>
    <!--**********************************
        Content body end
    ***********************************-->
@endsection


