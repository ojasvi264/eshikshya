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

<?php
	$actoken = $_COOKIE["Token"]; 
	if(isset($actoken)){
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://actm.prabhumanagement.com/api/ChartOfAccount/GetSubsidiaryListByFlag?Flag=All',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer '.$actoken
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$text= json_decode($response, true);
	}else{
		redirect($_SERVER['HTTP_REFERER']);
	}
	?>


<div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                	<div class="box box-primary">

                    <div class="box-header ptbnull with-border">
                        <h4 class="box-title titlefix" style="display: inline-block;" id="headtitle">General Ledger</h4>
                         </div><!-- /.box-header -->
                         <div class="box-body">
                            <div class="filter-box">
                            <form action="" action="GET">
                                @csrf
                                <div class="box-body row">
                                <div class="col-md-3">
                                    <label>From date</label>
                                    <input type="date" autocomplete="off" name="FromDate" class="form-control date" value="{{old('FromDate',$request->FromDate)}}" required>
                                </div>
                                <div class="col-md-3">
                                    <label>To date</label>
                                    <input type="date" autocomplete="off" name="ToDate" class="form-control date" value="{{old('ToDate',$request->ToDate)}}" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Choose Ledger</label>
                                    <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="glname" required>
										<option>Select Ledger</option>
										<?php foreach ($text['Data'] as $key => $value) : ?>
											<option value="<?php echo $value['Id']; ?>" <?php if(old('glname', $request->glname)==$value['Id']){ echo "selected"; } ?>><?php echo $value['Name']; ?></option>
										<?php endforeach; ?>
									</select>
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
                    				<th>Title</th>
                    				<th class="text-center">Debit</th>
                    				<th class="text-center">Credit</th>
                    				<th class="text-center">Balance</th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			<?php 
                    				$totaldebit = 0;
                    				$totalcredit = 0;
                    				$totalbalance = 0;
                    			?>

                    			@if($result !== "")
                    				
                                <?php foreach($result['Data'] as $key => $value) : ?>
									<tr class="font-weight-bold">
										<td><?php echo $key+1; ?></td>
										<td><?php echo date("Y-m-d",strtotime($value['CreatedDate'])) ?></td>
										<td>
											<a class="btn btn-danger btn-xs voucher_popup" data-toggle="tooltip" data-id="<?php echo $value['Id']; ?>"  data-number="<?php echo $value['VoucherNo']; ?>">
												<?php echo $value['VoucherNo']; ?>
											</a>
										</td>
										<td>
											<?php echo $value['Narration']; ?>
										</td>
										<td class="bg-success text-right">
											<?php echo $value['Debit']; ?>
										</td>
										<td class="bg-warning text-right">
											<?php echo $value['Credit']; ?>
										</td>
										<td class="bg-secondary text-right">
											<?php if($value['Debit'] > $value['Credit']){
												echo  ($value['Debit'] - $value['Credit']) . " " . "Dr";
											}else{
												echo ($value['Credit'] - $value['Debit']). " " . "Cr";
											}
											?>
										</td>
									</tr>
									<?php
									$totaldebit = $totaldebit + $value['Debit'];
									$totalcredit = $totalcredit + $value['Credit'];
									?>
								<?php endforeach; ?>
								@endif
                    		</tbody>
                    		<tfoot>
								<tr class="font-weight-bold">
									<td colspan="4" class="text-center"><strong>Grand Total(रू)</strong></td>
									<td class="bg-success text-right">
										<span class="double-underline">
											{{$totaldebit}}
										</span>
									</td>
									<td class="bg-warning text-right">
										<span class="double-underline">
											{{$totalcredit}}
										</span>
									</td>
									<td class="bg-secondary text-right">
										<span class="double-underline">
											<?php if($totaldebit > $totalcredit){
												echo ($totaldebit - $totalcredit) . " " . "Dr";
											}else{
												echo ($totalcredit - $totaldebit) . " " . "Cr";
											}
											?>

										</span>
									</td>
								</tr>
							</tfoot>
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
    </script>
@endsection