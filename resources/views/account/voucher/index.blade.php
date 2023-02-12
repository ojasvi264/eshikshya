@extends('layouts.base_temp')

@section('content')
<style>
    .box.box-primary{
        margin-bottom: 12px;
        border-radius: 4px;
        box-shadow: 0 7px 9px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
        border-top-color: transparent;
        padding:20px;
        background: #f6f6f6;
    }
    .box-header{
        border-bottom: 1px solid;
        padding-bottom: 6px;
        margin-bottom: 15px;
    }
    table.dataTable th{
        background-color: #aaaaaa;
        color: #fff !important;
    }
</style> 
<div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                	<div class="box box-primary">

                    <div class="box-header ptbnull with-border">
                        <h4 class="box-title titlefix" style="display: inline-block;" id="headtitle">{{$title}}</h4>
                            <small class="pull-right">
                                <a href="" class="btn btn-primary btn-sm">
                                 <i class="fa fa-plus"></i> Add Journal</a>
                             </small>
                         </div><!-- /.box-header -->
                         <div class="box-body">
                            <div class="filter-box">
                            <form action="" action="GET">
                                @csrf
                                <div class="box-body row">
                                <div class="col-md-4">
                                    <label>From date</label>
                                    <input type="date" autocomplete="off" name="FromDate" class="form-control date" value="{{old('FromDate',$request->FromDate)}}" required>
                                </div>
                                <div class="col-md-4">
                                    <label>To date</label>
                                    <input type="date" autocomplete="off" name="ToDate" class="form-control date" value="{{old('ToDate',$request->ToDate)}}" required>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label class="d-block">&nbsp;</label>
                                    <input type="submit" class="form-control btn btn-primary" placeholder="Find user here" name="search" style="width: 60%">
                                </div>
                                </div>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="col-sm-12">
                    @include('includes.dashboard.message')
                    <div class="box box-primary" style="margin-top: 20px">
                        @if($title=="Unapproved Vouchers")
                        <div class="col-sm-12">
                            <a onclick="approveall()" title="Approve" class="btn btn-success btn-xs pull-right" style="margin-bottom: 20px" data-toggle="modal" data-target="#approveallmodal">Approve All</a>
                        </div>
                        @endif
                    	<table class="table display" id="example3">
                    		<thead>
                    			<tr>
                    				<th>S No</th>
                    				<th>Created Date</th>
                    				<th>Journal No</th>
                    				<th>Title</th>
                    				<th>Balance</th>
                    				<th>Action</th>
                    			</tr>
                    		</thead>
                    		<tbody>
                                @if($result !== "")
                    			@foreach($result['Data'] as $key => $value)
                    			<tr>
                    				<td>{{$key + 1}}</td>
                    				<td><?php echo date("Y-m-d",strtotime($value['Date'])); ?></td>
                    				<td>{{$value['VoucherNo']}}</td>
                    				<td>{{$value['Narration']}}</td>
                    				<td>{{$value['Balance']}}</td>
                    				<td>
                                        <a class="btn btn-success voucher_popup" data-toggle="tooltip" data-id="{{$value['Id']}}"  data-number="{{$value['VoucherNo']}}">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        @if($title=="Unapproved Vouchers")
                                        <a onclick="approve('{{$value['Id']}}','{{$value['VoucherNo']}}')" title="Approve" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#approvemodal"><i class="fa fa-check" aria-hidden="true"></i></a>

                                        <a onclick="reject('{{$value['Id']}}','{{$value['VoucherNo']}}')" title="Reject" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#rejectmodal"><i class="fa fa-remove"></i></a>  
                                        @endif         
                                    </td>
                    			</tr>
                    			@endforeach
                                @else
                                <tr>
                                    <td colspan="6">No Data Found</td>
                                </tr>
                                @endif
                    		</tbody>
                    	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-FV-Details" role="dialog" data-backdrop="">
        <div class="modal-dialog" style="max-width: 80%">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Voucher Details</h4>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="position: static;color: #fff">&times;</button>
                </div>
                <div class="modal-body voucher_body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="approvemodal" role="dialog" data-backdrop="">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Approve</h4>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="position: static;color: #fff">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure you want to approve this voucher?
                </div>
                <div class="modal-footer">
                    <form method="post" action="" id="approveform">
                        @csrf
                        <input type="hidden" name="voucherno" id="valvoucerno">
                        <input type="hidden" name="voucherid" id="valvoucerid">
                        <button type="submit" class="btn btn-secondary approvebody" >Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="rejectmodal" role="dialog" data-backdrop="">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Reject</h4>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="position: static;color: #fff">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure you want to reject this voucher?
                </div>
                <div class="modal-footer">
                    <form method="post" action="" id="rejectform">
                        @csrf
                        <input type="hidden" name="voucherno" id="rejvoucerno">
                        <input type="hidden" name="voucherid" id="rejvoucerid">
                        <button type="submit" class="btn btn-secondary approvebody" >Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="approveallmodal" role="dialog" data-backdrop="">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Approve All ? </h4>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="position: static;color: #fff">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure you want to approve all voucher?
                </div>
                <div class="modal-footer">
                    <form method="post" action="" id="approveallform">
                        @csrf
                        <input type="hidden" name="trans_id" value="<?php $guid= new App\Models\AccountCategory(); echo $guid->GUID(); ?>">
                        <input type="hidden" name="voucherid" id="rejvoucerid">
                        <button type="submit" class="btn btn-secondary approvebody" >Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

<script type="text/javascript">
    $(document).on("click",".voucher_popup",function () {
        var base_url = '{{url('/voucherdetails')}}';
        var voucherno = $(this).data('number');
        var voucherid = $(this).data('id');
        var title     = $('#headtitle').text();
        $('#modal-FV-Details').modal('show');
        $.ajax({
            type: "POST",
            url: base_url,
            data: {'voucher_id': voucherid, 'voucher_no': voucherno,'_token': '{{ csrf_token() }}','title':title},
            dataType: "json",
            beforeSend: function () {
                $('.voucher_body').html();
            },
            success: function (response) {
                $('.voucher_body').html(response);
            },
            complete: function () {
            }
        });
    });

    function approve(voucehrid,voucherno){
        $('#approvemodal').modal('show');
        var form=$('#approveform');
        $('#valvoucerno').val(voucherno);
        $('#valvoucerid').val(voucehrid);
        var address='{{ route('account.voucher.approve') }}';
        
        form.prop('action',address);
    }


    function reject(voucehrid,voucherno){
        $('#rejectmodal').modal('show');
        var form=$('#rejectform');
        $('#rejvoucerno').val(voucherno);
        $('#rejvoucerid').val(voucehrid);
        var address='{{ route('account.voucher.reject') }}';
        
        form.prop('action',address);
    }

    function approveall(){
        $('#approveallmodal').modal('show');
        var form=$('#approveallform');
        var address='{{ route('account.voucher.approveall') }}';
        form.prop('action',address);
    }

</script>
    
@endsection