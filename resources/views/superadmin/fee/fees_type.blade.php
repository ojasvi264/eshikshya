@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Fees Type</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees Collection</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees Type</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Fees Type</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                    {{isset($feesType) ? route('admin.fees_type.update', $feesType) : route('admin.fees_type.store')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                {{isset($feesType) ? route('fees_type.update', $feesType) : route('fees_type.store')}}
                                @endif
                                " method="POST">
                                @csrf
                                @if(isset($feesType))
                                    @method('PATCH')
                                @endif
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name"
                                               value='{{old('name')?old('name'):(isset($feesType) ? $feesType->name : '')}}'>
                                        <span class="text-danger">@error('name'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Fee Code</label>
                                        <input type="text" class="form-control" name="fee_code"
                                               value='{{old('fee_code')?old('fee_code'):(isset($feesType) ? $feesType->fee_code : '')}}'>
                                        <span class="text-danger">@error('fee_code'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Account Ledger<span class="required">*</span></label>
                                        <select class="form-control" name="account_category_id" id="account_category_id">
                                            <option value="">Select Account Ledger</option>
                                            @foreach ($accountLedgers as $accountLedger)
                                                <option value='{{ $accountLedger->id }}' @isset($feesType)@if($accountLedger->id == $feesType->account_category->id) selected @endif @endisset>{{$accountLedger->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('account_category_id'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Submission Tye<span class="required">*</span></label>
                                        <select class="form-control" name="submission_type" id="submission_type">
                                            <option value="">Select Submission Type</option>
                                                <option value='Yearly' @isset($feesType)@if($feesType->submission_type == 'Yearly') selected @endif @endisset>Yearly</option>
                                                <option value='Monthly' @isset($feesType)@if($feesType->submission_type == 'Monthly') selected @endif @endisset>Monthly</option>
                                                <option value='As Required' @isset($feesType)@if($feesType->submission_type == 'As Required') selected @endif @endisset>As Required</option>
\                                        </select>
                                        <span class="text-danger">@error('submission_type'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" >Description</label>
                                        <textarea id="mytextarea" class="form-control" name="description">{!! isset($feesType)?$feesType->description:(old('description') ?? '') !!}</textarea>
                                        <span class="text-danger">@error('description'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                    <button type="submit"
                                            class="btn btn-primary">{{isset($feesType) ? "Update" : "+ Add"}}</button>
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
                                    <h4 class="card-title">Fees Type List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Fee Code</th>
                                                <th>Account Ledger</th>
                                                <th>Submission Type</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($feesTypes as $key =>$feesType)
                                                <tr>
                                                    <td>{{$feesType->name}}</td>
                                                    <td>{{$feesType->fee_code}}</td>
                                                    <td>{{$feesType->account_category->name}}</td>
                                                    <td>{{$feesType->submission_type}}</td>
                                                    <td>{!! $feesType->description !!}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                    {{route('admin.fees_type.edit', $feesType)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                {{route('fees_type.edit', $feesType)}}
                                                                @endif
                                                                "
                                                               class="btn btn-sm btn-primary m-1"><i
                                                                    class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.fees_type.destroy',$feesType)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('fees_type.destroy',$feesType)}}
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
    <!--**********************************
        Content body end
    ***********************************-->
@endsection


