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
                        <h4 class="box-title titlefix" style="display: inline-block;" id="headtitle">Trail Balance</h4>
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
                                    <input type="date" autocomplete="off" name="ToDate" class="form-control date" value="{{old('FromDate',$request->FromDate)}}" required>
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
                    	<div class="row">
                    		<div class="col-sm-12">
                    			<div class="pull-right" style="margin-bottom: 15px">
	                            	<label style="font-size: 18px;"><strong>Summary</strong></label><br>
	                            	<label class="switch">
										<input type="checkbox" class="summary_check">
										<span class="slider round"></span>
									</label>
								</div>
                            </div>
                    	</div>
                    	<table class="table display">
                    		<thead>
                    			<tr>
                    				<th rowspan="2" class="align-middle">Category</th>
                    				<th rowspan="2" class="align-middle">Particulars</th>
                    				<th rowspan="2" class="align-middle summary">Ledger Title</th>
                    				<th colspan="2">Opening Balance</th>
                    				<th colspan="2">Transaction Balance</th>
                    				<th colspan="2">Closing Balance</th>
                    			</tr>
                    			<tr>
                    				<th>Debit(Rs)</th>
                    				<th>Credit(Rs)</th>
                    				<th>Debit(Rs)</th>
                    				<th>Credit(Rs)</th>
                    				<th>Debit(Rs)</th>
                    				<th>Credit(Rs)</th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			<?php 
                    				$totalopeningcr = 0;
                    				$totalopeningdr = 0;
                    				$totaltrnxdr = 0;
                    				$totaltrnxcr = 0;
                    				$closingdr = 0;
                    				$closingcr = 0;
                    			?>

                    			@if($result !== "")
                    				
                                <?php foreach($result['Data'] as $key => $value) : ?>
									<tr class="font-weight-bold">
										<td colspan="2"><?php echo $value['Name']; ?></td>
										<td class="summary"></td>
										<td class="bg-warning text-right">
											<?php echo $value['OpeningDR']; ?>
										</td>
										<td class="bg-warning text-right">
											<?php echo $value['OpeningCR']; ?>
										</td>
										<td class="bg-success text-right">
											<?php echo $value['TxnDR']; ?>
										</td>
										<td class="bg-success text-right">
											<?php echo $value['TxnCR']; ?>
										</td>
										<td class="bg-secondary text-right">
											<?php echo $value['ClosingDR']; ?>
										</td>
										<td class="bg-secondary text-right">
											<?php echo $value['ClosingCR']; ?>
										</td>
									</tr>
									<?php
									$totalopeningcr = $totalopeningcr + $value['OpeningCR'];
									$totalopeningdr = $totalopeningdr + $value['OpeningDR'];
									$totaltrnxdr = $totaltrnxdr + $value['TxnDR'];
									$totaltrnxcr = $totaltrnxcr + $value['TxnCR'];
									$closingdr = $closingdr + $value['ClosingDR'];
									$closingcr = $closingcr + $value['ClosingCR'];
									?>

									<?php if(isset($value['tBMainHeadDtos'])) : ?>
										<?php foreach ($value['tBMainHeadDtos'] as $key => $subvalue) : ?>
											<tr class="font-weight-bold">
												<td></td>
												<td><?php echo $subvalue['Name']; ?></td>
												<td class="summary"></td>
												<td class="bg-warning text-right">
													<?php echo $subvalue['OpeningDR']; ?>
												</td>
												<td class="bg-warning text-right">
													<?php echo $subvalue['OpeningCR']; ?>
												</td>
												<td class="bg-success text-right">
													<?php echo $subvalue['TxnDR']; ?>
												</td>
												<td class="bg-success text-right">
													<?php echo $subvalue['TxnCR']; ?>
												</td>
												<td class="bg-secondary text-right">
													<?php echo $subvalue['ClosingDR']; ?>
												</td>
												<td class="bg-secondary text-right">
													<?php echo $subvalue['ClosingCR']; ?>
												</td>
											</tr>

											<?php if(isset($subvalue['subsidiaryDtos'])) : ?>
												<?php foreach ($subvalue['subsidiaryDtos'] as $key => $subsidairy) : ?>
													<tr class="summary">
														<td colspan="3" style="text-align: right;color: #2880cb;font-weight: bold;"><?php echo $subsidairy['Name']; ?></td>
														<td class="bg-warning text-right"><?php echo $subsidairy['OpeningDR']; ?></td>
														<td class="bg-warning text-right"><?php echo $subsidairy['OpeningCR']; ?></td>
														<td class="bg-success text-right"><?php echo $subsidairy['TxnDR']; ?></td>
														<td class="bg-success text-right"><?php echo $subsidairy['TxnCR']; ?></td>
														<td class="bg-secondary text-right"><?php echo $subsidairy['ClosingDR']; ?></td>
														<td class="bg-secondary text-right"><?php echo $subsidairy['ClosingCR']; ?></td>
													</tr>

												<?php endforeach; ?>
											<?php endif; ?>
										<?php endforeach; ?>

									<?php endif; ?>
								<?php endforeach; ?>
								@endif
                    		</tbody>
                    		<tfoot>
								<tr class="font-weight-bold">
									<td class="summary"></td>
									<td colspan="2"><strong>Grand Total(रू)</strong></td>
									<td class="bg-warning text-right">
										<span class="double-underline">
											{{$totalopeningdr}}
										</span>
									</td>
									<td class="bg-warning text-right">
										<span class="double-underline">
											{{$totalopeningcr}}
										</span>
									</td>
									<td class="bg-success text-right">
										<span class="double-underline">
											{{$totaltrnxdr}}
										</span>
									</td>
									<td class="bg-success text-right">
										<span class="double-underline">
											{{$totaltrnxcr}}
										</span>
									</td>
									<td class="bg-secondary text-right">
										<span class="double-underline">
											{{$closingdr}}
										</span>
									</td>
									<td class="bg-secondary text-right">
										<span class="double-underline">
											{{$closingcr}}
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

    

<script type="text/javascript">
     $(document).ready(function(){
    	$(".summary").hide();

    	$(".summary_check").change(function() {
		    if(this.checked) {
		        $(".summary").show();
		    }
		    else{
		        $(".summary").hide();
		    }
		});
    });

</script>
    
@endsection