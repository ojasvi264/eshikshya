@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Assign Fees</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees Collection</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Assign Fees</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Assign Fees</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                    {{isset($feeMaster) ? route('admin.fee_master.update', $feeMaster) : route('admin.fee_master.store')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                {{isset($feeMaster) ? route('fee_master.update', $feeMaster) : route('fee_master.store')}}
                                @endif
                                " method="POST">
                                @csrf
                                @if(isset($feeMaster))
                                    @method('PATCH')
                                @endif
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Fees Type<span style="color: red">&#42;</span></label>
                                        <select class="form-control" name="fees_type_id" id="fees_type_id">
                                            <option value="">Select Fees Type</option>
                                            @foreach ($feesTypes as $feesType)
                                                <option value='{{ $feesType->id }}' @isset($feeMaster)@if($feesType->id == $feeMaster->fees_type->id) selected @endif @endisset>{{$feesType->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('fees_type_id'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Fee Group<span style="color: red">&#42;</span></label>
                                        <select class="form-control" name="fee_group_id" id="fee_group_id">
                                            <option value="">Select Fee Group</option>
                                            @foreach ($feeGroups as $feeGroup)
                                                <option value='{{ $feeGroup->id }}' @isset($feeMaster)@if($feeGroup->id == $feeMaster->fee_group->id) selected @endif @endisset>{{$feeGroup->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('fee_group_id'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Due Date<span style="color: red">&#42;</span></label>
                                        <input type="date" class="form-control" name="due_date"
                                               value='{{old('due_date')?old('due_date'):(isset($feeMaster) ? $feeMaster->due_date : '')}}'>
                                        <span class="text-danger">@error('due_date'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Amount<span style="color: red">&#42;</span></label>
                                        <input type="number" class="form-control" name="amount"
                                               value='{{old('amount')?old('amount'):(isset($feeMaster) ? $feeMaster->amount : '')}}' step=".001">
                                        <span class="text-danger">@error('amount'){{$message}}@enderror</span>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Fine Tye<span style="color: red">&#42;</span></label>
                                        <select class="form-control" name="fine_type" id="fine_type">
                                            <option value="">Select Fine Type</option>
                                                <option value='None' @isset($feeMaster)@if($feeMaster->fine_type == 'None') selected @endif @endisset>None</option>
                                                <option value='Percentage' @isset($feeMaster)@if($feeMaster->fine_type == 'Percentage') selected @endif @endisset>Percentage</option>
                                                <option value='Fix Amount' @isset($feeMaster)@if($feeMaster->fine_type == 'Fix Amount') selected @endif @endisset>Fix Amount</option>
\                                        </select>
                                        <span class="text-danger">@error('fine_type'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 d-none" id="fineAmount">
                                    <div class="form-group">
                                        <label class="form-label">Fine Amount</label>
                                        <input type="number" class="form-control" name="fine_amount" id="fineAmt"
                                               value='{{old('fine_amount')?old('fine_amount'):(isset($feeMaster) ? $feeMaster->fine_amount : '')}}' step=".001">
                                        <span class="text-danger">@error('fine_amount'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 d-none" id="percentage">
                                    <div class="form-group">
                                        <label class="form-label">Percentage</label>
                                        <input type="number" class="form-control" name="percentage" id="per"
                                               value='{{old('percentage')?old('percentage'):(isset($feeMaster) ? $feeMaster->percentage : '')}}' step=".001">
                                        <span class="text-danger">@error('percentage'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                    <button type="submit"
                                            class="btn btn-primary">{{isset($feeMaster) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Assign Fees List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Fees Type</th>
                                                <th>Fee Group</th>
                                                <th>Due Date</th>
                                                <th>Amount</th>
                                                <th>Fine Type</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($feeMasters as $key =>$feeMaster)
                                                <tr>
                                                    <td>{{$feeMaster->fees_type->name}}</td>
                                                    <td>{{$feeMaster->fee_group->name}}</td>
                                                    <td>{{$feeMaster->due_date}}</td>
                                                    <td>{{$feeMaster->amount}}</td>
                                                    <td>{{$feeMaster->fine_type}}
                                                        @if($feeMaster->fine_amount)
                                                            ({{$feeMaster->fine_amount}})
                                                        @elseif($feeMaster->percentage)
                                                            ({{$feeMaster->percentage}}%)
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                            @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                            {{route('admin.assign_fee.index', $feeMaster)}}
                                                            @endif
                                                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                            {{route('assign_fee.index', $feeMaster)}}
                                                            @endif
                                                                "
                                                               class="btn btn-sm btn-primary m-1"><i
                                                                    class="la la-tag"></i></a>
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                    {{route('admin.fee_master.edit', $feeMaster)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                {{route('fee_master.edit', $feeMaster)}}
                                                                @endif
                                                                "
                                                               class="btn btn-sm btn-warning m-1"><i
                                                                    class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.fee_master.destroy',$feeMaster)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('fee_master.destroy',$feeMaster)}}
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
    <script>

        $('#fine_type').change(function (){
           let fineType = $('#fine_type option:selected').val();
           if (fineType == "Percentage"){
               $('#percentage').removeClass('d-none').addClass('d-block');
               $('#fineAmount').addClass('d-none');
               $('#fineAmt').val('');
           }else if(fineType == "Fix Amount"){
               $('#fineAmount').removeClass('d-none').addClass('d-block');
               $('#percentage').addClass('d-none');
               $('#per').val('');
           }else {
               $('#per').val('');
               $('#fineAmt').val('');
               $('#fineAmount').addClass('d-none');
               $('#percentage').addClass('d-none');
               // $('#percentage').addClass('d-none');
           }
        });
    </script>
    <!--**********************************
        Content body end
    ***********************************-->
@endsection


