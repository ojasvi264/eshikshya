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

    .switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
	}

	.switch input { 
		opacity: 0;
		width: 0;
		height: 0;
	}

	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ad0f0f;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 26px;
		width: 26px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	input:checked + .slider {
		background-color: #0f9e5c;
	}

	input:focus + .slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
		border-radius: 34px;
	}

	.slider.round:before {
		border-radius: 50%;
	}
	.double-underline {
		border-top: 1px solid;
		border-bottom: 3px double;
		padding: 4px;
	}
	.badge-secondary {
		color: #fff;
		background-color: rgba(0, 0, 0, 0.33);
	}

	.bg-success{
		background-color: #52e3a0 !important;
	}
	.bg-warning{
		background-color: #dab955 !important;
	}
	.bg-secondary{
		background-color: #adb8c2 !important;
	}
	th{
		background-color: #504a4a !important;
    color: #fff;
	}
	.display{
		box-shadow: 0 7px 9px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
	}
	.display th,.display td{
		padding-left:10px;
	}
	thead,tfoot{
		border-top: 4px solid;
    	border-bottom: 4px solid;
	}
</style> 

<div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                	<div class="box box-primary">

                    <div class="box-header ptbnull with-border">
                        <h4 class="box-title titlefix" style="display: inline-block;" id="headtitle">Day Book</h4>
                         </div><!-- /.box-header -->
                         <div class="box-body">
                            <div class="filter-box">
                            <form action="" action="GET">
                                @csrf
                                <div class="box-body row">
                                <div class="col-md-2">
                                    <label>From date</label>
                                    <input type="date" autocomplete="off" name="FromDate" class="form-control date" value="{{ old('FromDate', $request->FromDate) }}" required>
                                </div>
                                <div class="col-md-2">
                                    <label>To date</label>
                                    <input type="date" autocomplete="off" name="ToDate" class="form-control date" value="{{ old('FromDate', $request->ToDate) }}" required>
                                </div>
                                <div class="col-md-3">
                                	<div class="row">
										<div class="col-md-4">
											<label>&nbsp;</label><br>
											<input type="checkbox" id="cashflag" class="check" name="cashflag" <?php if(old('cashflag', $request->cashflag)=="on"){ echo "checked"; } ?>>&nbsp;
											<label>Cash</label>
										</div>
										<div class="col-md-8">
											<label>Cash Ledger</label>
											<select class="select selectopt form-control" id="cash-ledger" name="cashledger">
												<option value="">Select Ledger</option>
												<?php foreach ($cash['Data'] as $key => $value) : ?>
													<option value="<?php echo $value['Id']?>" <?php if(old('cashledger', $request->cashledger)==$value['Id']){ echo "selected"; } ?>><?php echo $value['Name']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="row">
										<div class="col-md-4">
											<label>&nbsp;</label><br>
											<input type="checkbox" id="bankflag" class="check" name="bankflag" <?php if(old('bankflag', $request->bankflag)=="on"){ echo "checked"; } ?>>
											<label>Bank</label>
										</div>
										<div class="col-md-8">
											<label>Bank Ledger</label>
											<select class="select selectopt form-control" id="bank-ledger" name="bankledger">
												<option value="">Select Ledger</option>
												<?php foreach ($bank['Data'] as $key => $value) : ?>
													<option value="<?php echo $value['Id']?>" <?php if(old('bankledger', $request->bankledger)==$value['Id']){ echo "selected"; } ?>><?php echo $value['Name']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
                                <div class="col-md-2">
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
                    	<table class="table display">
                    		<thead>
                    			<tr>
                    				<th>S.No</th>
                    				<th>Date</th>
                    				<th>Voucher No</th>
                    				<th>Ledger Name</th>
                    				<th>Title</th>
                    				<th class="text-center">Debit</th>
                    				<th class="text-center">Credit</th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			<?php 
                    				$totaldebit = 0;
                    				$totalcredit = 0;
                    				$totalbalance = 0;
                    			?>

                    			@if($result!=="")
                                <?php foreach($result['Data'] as $key => $value) : ?>
                                	@if($value['VoucherType'] == "Opening")
										<tr class="font-weight-bold" style="border-bottom: 4px solid;color: #ed4040 !important">
											<td></td>
											<td><?php echo date("Y-m-d",strtotime($value['Date'])) ?></td>
											<td></td>
											<td><strong><?php echo $value['LedgerName']; ?></strong></td>
											<td><strong><?php echo $value['Narration']; ?></strong></td>
											<td class="bg-success text-right">
												<?php echo $value['Debit']; ?>
											</td>
											<td class="bg-warning text-right">
												<?php echo $value['Credit']; ?>
											</td>
										</tr>
									@elseif($value['VoucherType'] !== "Opening" && $value['VoucherType'] !== "Closing")
										<tr>
											<td>{{$key}}</td>
											<td><?php echo date("Y-m-d",strtotime($value['Date'])); ?></td>
											<td>
												<a data-id="{{$value['VoucherId']}}" data-number="{{$value['VoucherNo']}}" class="voucher_popup btn btn-danger btn-xs">
													<?php echo $value['VoucherNo']; ?>
												</a>
											</td>
											<td><?php echo $value['LedgerName']; ?></td>
											<td><?php echo $value['Narration']; ?></td>
											<td class="bg-success text-right"> <?php echo $value['Debit']; ?> </td>
											<td class="bg-warning text-right"><?php echo $value['Credit']; ?></td>
										</tr>
									@elseif($value['VoucherType'] == "Closing")
										<tr class="font-weight-bold"  style="border-top: 4px solid;border-bottom: 4px solid;color: #ed4040 !important">
											<td></td>
											<td><?php echo date("Y-m-d",strtotime($value['Date'])) ?></td>
											<td></td>
											<td><strong><?php echo $value['LedgerName']; ?></strong></td>
											<td><strong><?php echo $value['Narration']; ?></strong></td>
											<td class="bg-success text-right">
												<?php echo $value['Debit']; ?>
											</td>
											<td class="bg-warning text-right">
												<?php echo $value['Credit']; ?>
											</td>
										</tr>
									@endif
								<?php endforeach; ?>
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
    

    <script type="text/javascript">
    	$(document).on("click",".voucher_popup",function () {
	        var base_url = '{{url('/voucherdetails')}}';
	        var voucherno = $(this).data('number');
	        var voucherid = $(this).data('id');
	        var title     = $(this).data('title');
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
    </script>

<script>
$("input:checkbox").on('click', function() {
  	var $box = $(this);
  	if ($box.is(":checked")) {
    	var group = "input:checkbox.check";
    	$(group).prop("checked", false);
    	$box.prop("checked", true);
  	}else {
    	$box.prop("checked", false);
  	}
});

$('.selectopt').select2({
	width: 'resolve' ,
	theme: "default"
});
</script>
@endsection