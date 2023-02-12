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
	table.ledger-table th{
		background-color: #615f5f;
		color: #fff !important;
		padding: 10px;
		border: 1px solid #000;
	}
	table.ledger-table td{
		border: 1px solid #000;
	}
	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
		background-color: #d5cfcf;
		opacity: 1;
		color: #000 !important;
		cursor: not-allowed;
		font-weight: bold;
		border: none;
		border-radius: 0;
	}
	.table button.btn-default{
		border: none;
	}
	.select2-container--default .select2-selection--single{
		display: inline-table !important;
		border: none !important;
		height: 38px !important;
		width: 100% !important;
	}

	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	/* Firefox */
	input[type=number] {
		-moz-appearance: textfield;
	}

	.remove{
		border-radius: 0;
	}

</style>
<?php

$actoken = $_COOKIE["Token"];

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://actm.prabhumanagement.com/api/ChartOfAccount/GetSubsidiaryListByFlag?Flag=CB',
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
$topselect=json_decode($response,true);

?>

<?php 




$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://actm.prabhumanagement.com/api/ChartOfAccount/GetSubsidiaryListByFlag?Flag=ASEX',
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
$subsidairy=json_decode($response,true);


?>

<div class="content-body">

	@include('includes.dashboard.message')
	<div class="container-fluid">
		<form action="{{route('account.voucherentry.savepaymentvoucher')}}" method="POST">
			@csrf
			<div class="row">
				<div class="col-sm-12">
					<div class="box box-primary">
						<div class="box-header ptbnull with-border">
							<h4 class="box-title titlefix" style="display: inline-block;" id="headtitle">Payment Voucher</h4>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="filter-box">
								<div class="box-body row justify-content-start payment-head">
									<div class="col-md-3">
										<label>Title</label>
										<span style="color: red;font-size: 25px;line-height: 15px">*</span>
										<input type="text" autocomplete="off" name="title" class="form-control" value="" required>
									</div>
									<div class="col-md-3">
										<label>Ledger Head</label><br>
										
										<select class="select selectopt form-control" data-live-search="true" name="CashGlId" required>
											<option value="">--Select Ledger--</option>
											@foreach($topselect['Data'] as $key => $value)
												<option value="<?php echo $value['Id']; ?>" data-balance="<?php echo $value['Balance']; ?>"><?php echo $value['Name']; ?></option>
											@endforeach
										</select>
									</div>
									<div class="col-md-2 balance">
										<label>Balance</label>
										<span style="color: red;font-size: 25px;line-height: 15px">*</span>
										<input type="text" name="balance" class="form-control" placeholder="0.00" disabled>
									</div>

									<div class="col-md-2">
										<label>Transaction Date</label>
										<span style="color: red;font-size: 25px;line-height: 15px">*</span>
										<input type="date" autocomplete="off" name="date" class="form-control date" value="<?php echo date('Y-m-d'); ?>" readonly>
									</div>
									<div class="col-md-2">
										<label><strong>Reference No</strong></label>
										<input type="text" autocomplete="off" name="refno" class="form-control" value="">
										<input type="hidden" name="trans_id" value="<?php $guid= new App\Models\AccountCategory(); echo $guid->GUID(); ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>



				<div class="col-sm-12" style="margin-top: 20px">

					<div class="box box-primary" style="margin-top: 20px">
						<div class="row">
							<div class="col-sm-12">
								<a type="button" class="btn btn-success pull-right btn-sm" id="addProduct" style="margin-bottom: 20px">Add New Row</a>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<table class="ledger-table">
									<thead>
										<tr>
											<th style="width: 40%">Ledger</th>
											<th style="width: 10%">Balance</th>
											<th style="width: 10%">Amount</th>
											<th style="width: 20%">Remarks</th>
											<th style="width: 10%">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<select class="select selectopt form-control" data-live-search="true" name="GLId[]" required>
													<option value="">--Select Ledger--</option>
													<?php foreach ($subsidairy['Data'] as $key => $value) : ?>
														<option value="<?php echo $value['Id']; ?>" data-balance="<?php echo $value['Balance']; ?>"><?php echo $value['Name']; ?></option>
													<?php endforeach; ?>
												</select>
											</td>
											<td class="balance">
												<input type="text" class="form-control balance" name="balance[]" placeholder="0.00" readonly="">
											</td>
											<td><input type="number" name="amount[]" placeholder="0.00" class="form-control amount"></td>
											<td><input type="text" name="remark[]" placeholder="remark" class="form-control"></td>
											<td><button class="btn btn-danger remove">Remove</button></td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2" class="text-center"><strong>Total Amount</strong></td>
											<td><input type="text" name="totalamount" class="total-amount form-control" readonly></td>
											<td colspan="2">&nbsp;</td>
										</tr>
									</tfoot>
								</table>

								<button type="submit" name="submit" value="submit" class="btn btn-primary pull-right submit-form" style="margin-top: 20px"> Save</button>
							</div>
						</div>
					</div>
				</div>
			</div>



		</form>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){

		var html = '<tr><td><select class="selectopt form-control" data-show-subtext="true" data-live-search="true" name="GLId[]"><option value="">--Select Ledger--</option><?php foreach ($subsidairy['Data'] as $key => $value) : ?><option data-balance="<?php echo $value['Balance']; ?>" value="<?php echo $value['Id']; ?>"><?php echo $value['Name']; ?></option><?php endforeach; ?></select></td><td class="balance"><input type="text" name="balance" placeholder="0.00" readonly class="form-control"></td><td><input type="number" name="amount[]" placeholder="0.00" class="amount form-control"></td><td><input type="text" name="remark[]" placeholder="remark" class="form-control"></td><td><button class="btn btn-danger remove">Remove</button></td></tr>'; 
		$("#addProduct").click(function(){
			$('tbody').append(html);
			$('.selectopt').select2({
				width: 'resolve' ,
				theme: "default"
			});
		});

		$(document).on('click','.remove',function(){
			$(this).parents('tr').remove();
			var sum = 0;
			$(".amount").each(function(){
				if ($(this).val().trim() != "" && !isNaN($(this).val())) {
					sum += parseFloat($(this).val());
				};
			});
			$('.total-amount').val(sum);
		});
	});


	$(document).ready(function(){
		$('.payment-head').on('change', '.selectopt', function() {

			$balance=$(this).find(':selected').data('balance');
			$(this).parents().next(".balance").children().val($balance);
		});	


		$('.ledger-table').on('change', '.selectopt', function() {
			$balance=$(this).find(':selected').data('balance');
			$(this).parents().next(".balance").children().val($balance);

			$(this).parent().next(".balance").children().addClass("hawa");
		});
	});

	$('.ledger-table').on('keyup', '.amount', function(e) {
		var sum = 0;
		$(".amount").each(function(){
			if ($(this).val().trim() != "" && !isNaN($(this).val())) {
				sum += parseFloat($(this).val());
			};
		});
		$('.total-amount').val(sum);
	});
</script>
@endsection
