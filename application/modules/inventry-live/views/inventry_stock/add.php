<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', 'Inventory'); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("inventry/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', 'Inventory'); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= $this->misc->_getMethodName(); ?></strong>
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
		'name' => 'add-form',
		'class' => 'form-horizontal',
		'enctype' => 'multipart/form-data'
	);
	echo form_open("inventry/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Inventory</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('stock_on_date')) echo 'has-error'; ?>">
									<?php echo form_label('Date of purchasing<small class="text-danger">*</small>', 'stock_name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'date',
											'name' => 'stock_on_date',
											'class' => 'form-control',
											'placeholder' => 'Stock Date',
											'id' => 'data_1',
											'value' =>  set_value('stock_on_date'),
											'required' => 'true',
										));

										echo form_error('stock_on_date'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('stock_id')) echo 'has-error'; ?>">
									<?php echo form_label('Stock Name<small class="text-danger">*</small>', 'stock_id', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										$dropdown[null] = '== Please select one option ==';
										foreach ($stocks as $stock) {
                                           $dropdown[$stock->id]=$stock->stock_name;
										}

										echo form_dropdown(array(
													'name' => 'stock_id',
													'class' => 'form-control',
													'required' => 'true',
												), $dropdown);

										echo form_error('stock_id'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('quantity')) echo 'has-error'; ?>">
									<?php echo form_label('Quantity<small class="text-danger">*</small>', 'quantity', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'number',
											'name' => 'quantity',
											'class' => 'form-control',
											'placeholder' => 'Quantity',
											'id' => 'quantity',
											'value' =>  set_value('quantity'),
											'required' => 'true',
										));

										echo form_error('quantity'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('purchase_price')) echo 'has-error'; ?>">
									<?php echo form_label('Purchase Price<small class="text-danger">*</small>', 'purchase_price', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'number',
											'name' => 'purchase_price',
											'class' => 'form-control',
											'id' => 'purchase_price',
											'placeholder' => 'Purchase Price',
											'value' =>  set_value('purchase_price'),
											'required' => 'true',
										));

										echo form_error('purchase_price'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('sell_price')) echo 'has-error'; ?>">
									<?php echo form_label('Sell Price<small class="text-danger">*</small>', 'sell_price', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'number',
											'name' => 'sell_price',
											'class' => 'form-control',
											'placeholder' => 'Sell Price',
											'value' =>  set_value('sell_price'),
											'required' => 'true',
										));

										echo form_error('sell_price'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('total_amount')) echo 'has-error'; ?>">
									<?php echo form_label('Total Amount<small class="text-danger">*</small>', 'total_amount', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'number',
											'name' => 'total_amount',
											'class' => 'form-control',
											'id' => 'totalvalue',
											'placeholder' => 'Total Amount',
											'value' =>  set_value('total_amount'),
											'required' => 'true',
										));

										echo form_error('total_amount'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('pay_mode')) echo 'has-error'; ?>">
									<?php echo form_label('Payment Mode<small class="text-danger">*</small>', 'pay_mode', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
                                         $option = $this->mdl_pay_mode->dropdown('payment_mode_name');
										echo form_dropdown(array(
													'name' => 'pay_mode',
													'class' => 'form-control',
													'placeholder' => 'Payment Mode',
													'required' => 'true',
												), $option);
										echo form_error('pay_mode'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('transaction_no')) echo 'has-error'; ?>">
									<?php echo form_label('Ref No./ Check No./ DD<small class="text-danger">*</small>', 'transaction_no', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'transaction_no',
											'class' => 'form-control',
											'placeholder' => 'Transaction',
											'value' =>  set_value('transaction_no'),
											'required' => 'true',
										));

										echo form_error('transaction_no'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('agency_name')) echo 'has-error'; ?>">
									<?php echo form_label('Agency Name<small class="text-danger">*</small>', 'agency_name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'agency_name',
											'class' => 'form-control',
											'placeholder' => 'Agency Name',
											'value' =>  set_value('agency_name'),
											'required' => 'true',
										));

										echo form_error('agency_name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('bill_ref_no')) echo 'has-error'; ?>">
									<?php echo form_label('Bill Refer No<small class="text-danger">*</small>', 'bill_ref_no', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'bill_ref_no',
											'class' => 'form-control',
											'placeholder' => 'Bill Refer No',
											'value' =>  set_value('bill_ref_no'),
											'required' => 'true',
										));

										echo form_error('bill_ref_no'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('bill_add')) echo 'has-error'; ?>">
									<?php echo form_label('Attach File (Bill Add)', 'bill_add', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'file',
											'name' => 'bill_add',
											'class' => 'form-control',
											'placeholder' => 'Attach File',
											'value' =>  set_value('bill_add'),
											//'required' => 'true',
										));

										echo form_error('bill_add'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('remark')) echo 'has-error'; ?>">
									<?php echo form_label('Remark', 'remark', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_textarea(array(
											'name' => 'remark',
											'class' => 'form-control',
											'rows' => '3',
											'placeholder' => 'remark',
											'value' => set_value('remark')
										));

										echo form_error('remark'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="text-right">
							<button class="btn btn-primary" type="submit">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
<script>
	$(function () {
		$("[id*=quantity]").keyup(function () {
		debugger;
		//alert('adsgsg');die();
		var price = parseFloat($("[id*=purchase_price]").val());
		var Qnt = parseFloat($("[id*=quantity]").val());
		var total = parseFloat(price * Qnt);
		$("[id*=totalvalue]").val(total);
		});
		});
</script>
<script>
        $(document).on("change keyup blur", "#purchase_price", function() {
            var quantity = $('#quantity').val();
            var amount = $('#purchase_price').val();
            //var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
            var mult = quantity * amount; // gives the value for subtract from main value
            $('#totalvalue').val(mult);
        });
 </script> 
