
<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Hostel</a>
			</li> 
			<li>
				<a href="<?= site_url("hostel/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getMethodName()) ; ?></strong>
			</li>
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'add-form',
		'enctype' => 'multipart/form-data',
		'class' => ''
	);
	echo form_open("hostel/".$this->misc->_getClassName()."/hostel_invoice_payment/".$info->invoice_p_id."/".$info->student_id, $attr);


	echo form_input(array(
		'type' => 'hidden',
		'name' => 'purchase-order',		
		'value' =>$info->invoice_p_id,								
	));

	echo form_error('purchase-order'); ?>

		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Invoice Payment [ <span class="text-navy"><?php echo $info->invoice_id; ?> </span> ]</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					
                    <div class="ibox float-e-margins">
                        <div class="ibox-content" style="">
                        	<div class="row">
                        	
                        	<div class="col-md-8 b-r">
                        		<h5 class="bg-success p-xxs b-r-sm">Add Payment</h5>
                        		<div class="form-group col-md-6 p-xxs" id="data_1" <?php if(form_error('purchase-date')) echo 'has-error'; ?>">
	                                <?php
									echo form_label('Date <small class="text-danger">*</small>', 'purchase-date'); ?>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<?php 
										echo form_input(array(
											'type' => 'date',
											'name' => 'payment-date',										
											'class' => 'form-control',
											'placeholder' => 'dd/mm/yyyy',
											'value' => set_value('purchase-date'),
											'required' => 'true'
										));
									
										echo form_error('purchase-date'); ?>
                            		</div>
                            	</div>
								<div class="form-group col-md-6 p-xxs <?php if(form_error('payment-id')) echo 'has-error'; ?>">
									<?php
									echo form_label('Payment #', 'payment-id');
									echo form_input(array(
										'type' => 'text',
 										'name' => 'payment-id',
										'class' => 'form-control',
										'readonly' => 'true',
										'placeholder' => '',
										'value' => 'PE-'.$lastId,
									));
									echo form_error('payment-id'); ?>
								</div>
								
								<div class="form-group col-md-12 p-xxs<?php if(form_error('pay-amount')) echo 'has-error'; ?>">
									<?php
									$paid_amount = $this->mdl_payment->payable_amount($info->invoice_p_id); 
									echo form_label('Pay Amount <small class="text-danger">*</small>', 'pay-amount');
									echo form_input(array(
										'type' => 'text',
 										'name' => 'pay-amount',
										'class' => 'form-control',
										'id' => 'payAmount',
										'onkeyup'=>'balance_validate()',
										'placeholder' => '0.00',
										'value' =>set_value('pay-amount',$info->fee_amount-$paid_amount), 
										
									));
									echo form_error('pay-amount');

									echo form_input(array(
										'type' => 'hidden',
 										'name' => 'invoice-id',
										'class' => 'form-control',
										'value' =>set_value('invoice-id',$info->invoice_p_id), 
										'readonly' => 'true'
										
									));
									echo form_error('invoice-id');

									echo form_input(array(
										'type' => 'hidden',
 										'name' => 'total-amount',
										'class' => 'form-control',
										'value' =>set_value('total-amount',$info->fee_amount), 
										'readonly' => 'true'
										
									));
									echo form_error('total-amount');

									 ?>
									<p class="text-danger" id="due"></p>
								</div>
								<div class="form-group col-md-12 p-xxs<?php if(form_error('pay_method')) echo 'has-error'; ?>">
									<?php
									$_paymethod = $this->mdl_pay_mode->dropdown('payment_mode_name');
									echo form_label('Payment Mode <small class="text-danger">*</small>', 'shipping-city');
									
									
									echo form_dropdown(array(
										'name' => 'pay-method',
										'id' => 'pay_method',
										'class' => 'form-control',
									), $_paymethod);

									echo form_error('pay-method'); ?>
								</div>
								
								<div class="form-group col-md-12 p-xxs">
									<div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <?php
												echo form_label('Ref No. ', 'reference-no');
												echo form_input(array(
													'type' => 'text',
			 										'name' => 'reference-no',
													'class' => 'form-control',
													'placeholder' => 'Refenrence no.',
													
												));
												echo form_error('reference-no'); ?>
                                            </div>
                                        </div>
                                    </div>
								</div>
								
                        	</div>
                        	<div class="col-md-4 ">
                        		
                        		<h5 class="bg-success p-xxs ">Payment Detail</h5>
                        		<div class="jumbotron">
                        		<h2 class=" p-xxs ">Payable Amount</h2>
                        		<h4 class="p-xxs">Total: <?php echo $info->fee_amount;?> Rs.</h4>
                        		<h5 class="p-xxs">Total Paid: <?php 
 											if($paid_amount){
 												echo $paid_amount;
 											}else{
 												echo 0.00;
 											}	
									?></h5>
                        		<h5 class="p-xxs">Amount Due: <?php echo $info->fee_amount - $paid_amount; ?> </h5>
                        		<?php 
                        		$due = $info->fee_amount - $paid_amount;
								echo form_input(array(
										'type' => 'hidden',
										'name' => 'due-balance',
										'id' => 'dueBalance',		
										'value' =>$due,								
								));
                        		?>
                        		<h5>
                        			<?php 
                        			if($paid_amount==0)
                        			{
 										echo '<span class="badge badge-danger"> UnPaid <span>';
 									}
 									elseif($paid_amount > 0  && $paid_amount < $info->fee_amount)
 									{
 										echo '<span class="badge badge-warning">Partially Paid <span>';
 									}
 									else
 									{
 												echo '<span class="badge badge-primary "> Paid <span>';
 									}	 
 									?>
                        		</h5>
                        		</div>
							</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary" id="submitPayment" type="submit">Make a payment!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
					
			</div>
		</div>
	<?php echo form_close(); ?>
</div>


	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize">Payment </span> History</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Payment Entry</th>
									<th>Payment Date</th>
									<th>Paid Amount</th>
									<th>Payment Mode</th>
									<th>Payment For</th>
									<th>Reference No.</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if($payment_history == false) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="8"><strong>NO RECORDS AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($payment_history as $payment_history) { ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
									<td><?= '<span class="badge badge-primary">'.htmlspecialchars($payment_history->payment_id,ENT_QUOTES,'UTF-8').'</span>' ?></td>
									<td><?= htmlspecialchars($this->misc->reformatDate($payment_history->payment_date),ENT_QUOTES,'UTF-8') ?></td>
									 
									<td><?= htmlspecialchars($payment_history->paid_amount,ENT_QUOTES,'UTF-8') ?></td>
									<td><?php echo $this->mdl_payment->get_type_name_by_id('payment_mode',$payment_history->payment_mode,'payment_mode_name'); ?></td>
									<td><?= htmlspecialchars($payment_history->fee_structure_title,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($payment_history->reference_no,ENT_QUOTES,'UTF-8') ?></td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Payment Entry</th>
									<th>Payment Date</th>
									<th>Paid Amount</th>
									<th>Payment Mode</th>
									<th>Payment For</th>
									<th>Reference No.</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function balance_validate(){

   var payAmount = document.getElementById("payAmount").value;
   var due = document.getElementById("dueBalance").value;
   var errmsg;
   if(payAmount > due || payAmount == 0){
   	errmsg = "Due Amount : " + due;   
   	document.getElementById("due").innerHTML = errmsg;
   	document.getElementById("submitPayment").disabled = true;
   }else{
   	errmsg = "";
   	document.getElementById("due").innerHTML = errmsg;
   	document.getElementById("submitPayment").disabled = false;
   }
   
}

$(document).ready(function(){
	
	var checkAmount = document.getElementById("payAmount").value;
  	if(checkAmount == 0){
  		$('form input,select,button[type="submit"]').prop("disabled", true);
  	}
});
</script>