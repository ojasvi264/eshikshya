							<style type="text/css">
								.double-underline{
									text-decoration-line: underline;
  									text-decoration-style: double;
  									border-top: 1px solid #000;
								}

								.header-table p{
									margin-bottom: 0;
								}

								.table-hover th{
								    color: #fff;
    								background: #4e4848;
								}

								.table-striped>tbody>tr:nth-of-type(odd),.table>:not(caption)>*>*{
									--bs-table-accent-bg: transparent;
								}
							</style>
							<div class="header-table">
								<div class="row">

										<?php foreach ($sendingdetails['Data'] as $key => $value) { ?>
											<?php if($value['Parent']=="1"): ?>
												<div class="col-sm-6">
													<p><strong>Title : </strong><?php echo $value['Narration']; ?></p>
													<p><strong>Voucher No. : </strong><?php echo $value['VoucherNo']; ?></p>
													<p><strong>Entry Date : <?php echo date("Y-m-d",strtotime($value['CreatedDate'])); ?></strong></p>
												</div>
												<div class="col-sm-6">
													<p><strong>Created By : </strong><?php echo $value['CreatedBy']; ?></p>
													@if($title=="Approved Vouchers")
													<p><strong>Approved By : </strong><?php echo $value['ApprovedBy']; ?></p>
													<p><strong>Approved Date : <?php echo date("Y-m-d",strtotime($value['ApprovedDate'])); ?></strong></p>
													@elseif($title=="Rejected Vouchers")
													<p><strong>Rejected By : </strong><?php echo $value['ApprovedBy']; ?></p>
													<p><strong>Rejected Date : <?php echo date("Y-m-d",strtotime($value['ApprovedDate'])); ?></strong></p>
													@endif
	                                                
												</div>
											<?php endif; ?>
										<?php } ?>
								</div>
							</div>

							<div class="table-responsive">
								<table class="table table-bordered table-color table-striped table-danger table-hover js-dataTable-buttons" id="VoucherDetailstable" width="100%">
									<thead class="bg-danger">
										<tr class="text-nowrap">
											<th>S.N</th>
											<th class="text-center">
												Leadger Head
											</th>
											<th class="text-right">
												Debit(रू)
											</th>
											<th class="text-right">
												Credit(रू)
											</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$totaldebit = 0;
											$totalcredit = 0;
										?>
										<?php foreach ($sendingdetails['Data'] as $key => $value) { ?>
											<?php if($value['Parent']==""): ?>
											<tr>
												<td width="10px"><?php echo $key; ?></td>
												<td class="text-center"><a><?php echo $value['GLSubsidiary'];?></a></td>
												<td class="bg-warning text-right"><?php echo $value['Debit'];?></td>
												<td class="bg-success text-right"><?php echo $value['Credit'];?></td>
											</tr>
											<?php 
											$totaldebit = $totaldebit + $value['Debit'];
											$totalcredit= $totalcredit + $value['Credit'];
											 ?>
											<?php endif; ?>
										<?php } ?>
										

									</tbody>
									<tfoot style="display: table-row-group;">
										<tr class="table-secondary">
											<td colspan="1"></td>
											<td class="text-right"><strong>Grand Total(रू.):</strong></td>
											<td class="bg-warning text-right">
												<strong>
													<span class="double-underline"><?php echo $totaldebit; ?></span>
												</strong>
											</td><td class="bg-success text-right">
												<strong>
													<span class="double-underline"><?php echo $totalcredit; ?></span>
												</strong>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>