<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url($this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getMethodName()); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'form',
		'class' => 'form-horizontal'
	);
	echo form_open("{$this->misc->_getClassName()}/debit_statement", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Debit Statement Report</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12">
								<div class="col-sm-3">									
									<div class=" <?php if(form_error('account_type')) echo 'has-error'; ?>"><?= form_label('Account Type<small class="text-danger">*</small>', 'day_due_fee', array('class' => ' control-label')); ?>
										<select class="form-control" name="account_type" id="account_type">
											<option value="">==Select Account User==</option>
											<option value="All,All">All</option>
											<?php 
												$allFee = get_account_user($this->config->item('role_id'));
												foreach ($allFee as $value) {
											?>
											<option value="<?= $value->user_p_id.','.$value->user_full_name ?>" <?= $this->session->userdata['userID'] == $value->user_p_id ? 'selected':''?>><?= $value->user_full_name?></option>
											<?php } ?>
										</select>
									<?php echo form_error('account_type'); ?>										
									</div>
								</div>
								<div class="col-sm-3">
									<div class=" <?php if(form_error('purpose')) echo 'has-error'; ?>">
									<?php echo form_label('Purpose<small class="text-danger">*</small>', 'purpose', array('class' => ' control-label'));
										
										
										$_purpose = $this->mdl_debit_purpose->dropdown('purpose_name');
										//var_dump($_purpose); 
										echo form_dropdown(array(
											'name' => 'purpose',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_purpose);

										echo form_error('purpose'); ?>
										
									</div>	
								</div>
								<div class="col-sm-3">
									<div class=" <?php if(form_error('month-from')) echo 'has-error'; ?>" id="inputhMonth">
									<?php echo form_label('Month From<small class="text-danger">*</small>', 'month-from', array('class' => 'control-label')); ?>
										<div class="input-group ">
											<?php 
												echo form_input(array(
													'type' => 'date',
													'name' => 'month-from',
													'id' => 'month_from', 
													'class' => 'form-control',
													'required' => 'true',
													'value' => set_value('month-from')

												));
											?>
										</div>
										<?php echo form_error('month-from'); ?>
									</div>
								</div>
								<div class="col-sm-2">
									<div class=" <?php if(form_error('month-to')) echo 'has-error'; ?>" id="inputhMonth">
									<?php echo form_label('Month To<small class="text-danger">*</small>', 'month-to', array('class' => 'control-label')); ?>
										<div class="input-group ">
											<?php 
												echo form_input(array(
													'type' => 'date',
													'name' => 'month-to',
													'id' => 'month_to', 
													'class' => 'form-control custom-form',
													'required' => 'true',
													'value' => set_value('month-to'),

												));
											?>
										</div>
										<?php echo form_error('month-to'); ?>
									</div>
								</div>
								<div class="col-sm-1 text-center">
									<div style="margin-top:10px;" class=" <?php if(form_error('department-id')) echo 'has-error'; ?>">
										<?php 

										echo form_submit('submit', 'Go', 'class="btn btn-sm m-t  btn-primary"'); ?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>

	
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					
					<div class="table-responsive">
						<table id="day_statement" class="table table-striped table-bordered table-hover ">
							<thead>
								<tr>
									<th colspan="9" class="text-center"><?= @$account_type ?></th>
								</tr>
								<tr>
									<th>Receipt / Transcation No.</th>
									<th>Amount Paid To</th>
									<th>Purpose</th>
									<th>Remarks</th>
									<th>Payment Mode</th>
									<th>Payment Date</th>
									<th>Ref No./ Cheque No./ DD</th>
									<th>Paid Amount</th>
									<th>Invoice</th>
								</tr>
							</thead>
							<tfoot>
					            <tr>
					                <th colspan="7" style="text-align:right">Filter Total: - <br/> All Total</th>
					                <th></th>
					            </tr>
					        </tfoot>
							<?php if(!empty($lists)): ?>
							<tbody>
							<?php foreach ($lists as $list) :?>
								
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="admin/<?= $this->misc->_getClassName(); ?>">
									<td id="total1"></i><?php echo $list->debit_p_id." / ". $list->debit_id ; ?> </td>
									
									<td>
										<?= htmlspecialchars($list->paid_to,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?= htmlspecialchars($this->mdl_debit_purpose->get($list->purpose)->purpose_name,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?= htmlspecialchars($list->remarks,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?= $this->mdl_pay_mode->get($list->fk_peyment_mode_id)->payment_mode_name; ?>
									</td>

									<td>
										<?= htmlspecialchars($this->misc->reformatDate($list->created_on),ENT_QUOTES,'UTF-8') ?>
									</td>

									<td>
										<?= htmlspecialchars($list->payment_mode_reference,ENT_QUOTES,'UTF-8') ?>
									</td>

									<td>
										<?= htmlspecialchars($list->amount,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<a target="_blank" href="<?= site_url($this->misc->_getClassName()."/debit_invoice/".$list->debit_p_id ); ?>"><span class="text-capitalize">Invoice</span></a>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php endif; ?>
							<?php if(!empty($fee)): ?>
							<tbody>
								<?php foreach ($fee as $duefee): ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="admin/<?= $this->misc->_getClassName(); ?>">
									<td id="total1"></i><?php echo $duefee->payment_id." / ". $duefee->payment_p_id ; ?> </td>
									
									<td><?= htmlspecialchars($duefee->student_full_name."(".$duefee->student_unique_id.") - ".$this->mdl_branch->get($duefee->fk_branch_id)->branch_code,ENT_QUOTES,'UTF-8') ?></td>
									<td><?php $feeTypes = explode(",", $duefee->fee_types_id); 
											
											foreach($feeTypes as $ftps){
												
												$length = strlen($ftps);
												$result = substr($ftps,0,2);
												
												if($result == "hs"){
													
													$result1 = substr($ftps, 2, $length);
													
													$hostel_charge = $this->mdl_accountant->day_statement_hostel_fee($result1);
													
													echo $fff = $this->mdl_fee_type->get($hostel_charge->fk_fee_type_id)->fee_type_name." ".$hostel_charge->hostel_charge_month." - ".$hostel_charge->fee_amount."  Rs.";
												}
											}
									?></td>
									<td>
										<?= $this->mdl_pay_mode->get($duefee->payment_mode)->payment_mode_name; ?>
									</td>
									<td>
										<?= htmlspecialchars($this->misc->reformatDate($duefee->created_on),ENT_QUOTES,'UTF-8') ?>
									</td>
									
									<td>
										<?= htmlspecialchars($duefee->reference_no,ENT_QUOTES,'UTF-8') ?>
									</td>

									<td><?= htmlspecialchars($duefee->paid_amount,ENT_QUOTES,'UTF-8') ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php endif; ?>
							
						</table>
								<style>
		.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
            border-top: 1px solid #000 !important;

        }
        .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{
            border: 1px solid #555 !important;

        }
         .custom-form{
        	width: 155px !important;
        }
	</style>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	var from = $('#month_from').val();
	var to = $('#month_to').val();
	if(to == ""){
		to = new Date();
	}
    $('#day_statement').DataTable ( {
    	<?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>
        dom: 'Bfrtip',
        buttons: [
	       
	        { 
	        	extend: 'print' ,
	         	footer:true, 
	         	title: '',
	         	 
	         	message: '<table style="margin-top:0;padding-top:0;"class="table table-bordered"><tbody><tr><td><img class="img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>"  style="float:left;border:0;padding:0;width:100px; height:80px;"><div style="width:80%;float:left;text-align:center;display:table;"><h3 style="text-align:center;font-size:20px;margin-bottom:10px;padding-top:8px;"> Ganga Memorial College Of Polytechnic</h3><p >AT NH-31, HARNAUT, NALANDA, BIHAR - 803110</p></div></td></tr><tr class="text-center"><td>Debit Satement From : '+from+' To : '+to+' </td><tr></tr><tr><th class="text-center"><?= $account_type ?></th></tr></tbody></table>',

	         customize: function ( win ) {
	         		$(win.document.body)
	                    .css( 'font-size', '8px' )
	                    .css( 'margin-left', '80px' )
	                    .css( 'margin-top', '0px' )
	                $(win.document.body).find( 'table thead' )
	                	.css( 'font-size', '10px' )
	            	$(win.document.body).find( 'table tbody tr td' )
	            	 	.css( 'padding', '1px' )
	            	 	.css( 'font-size', '10px' )
	                $(win.document.body).find( 'table tfoot' )
	                    .css( 'display','table-row-group');
	                $(win.document.body).find( 'table tfoot' )
	                     .css( 'font-size', '12px' )
	            }
	        }
	    ],
         "footerCallback": function (row, data, start, end, display) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };

            // Total over all pages
            total = api.column(7)
                .data()
                .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            });

            // Total over this page
            pageTotal = api.column(7, {
                page: 'current'
            })
                .data()
                .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            // Total over this page
            pageTotalFilter = api.column(7, {
                filter: 'applied'
            })
                .data()
                .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            // Update footer
            /*$(api.column(6).footer()).html(
                '' + pageTotal + ' <br/>' + total );*/
            $(api.column(7).footer()).html(
                '' + pageTotalFilter + ' <br/>' + total );
        }
    } );
     $('#day_statement tbody').on('click', 'tr', function () {

        $(this).toggleClass('selected');
    });
} );
</script>