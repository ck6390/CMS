<style>
	.totalValue{
		margin-left: 445px!important;
	}
</style>
<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', 'Receipt Stock'); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("inventry/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', 'Receipt'); ?></span></a>
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
		'class' => 'form-horizontal'
	);
	echo form_open("inventry/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add Receipt</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('student_id')) echo 'has-error'; ?>">
									<?php echo form_label('Student Name<small class="text-danger">*</small>', 'student_id', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										$option[null] = '== Please select one option ==';
										foreach ($studs as $stud) {
                                           $option[$stud->student_unique_id]=$stud->student_unique_id  . "   =>  "  .$stud->student_full_name;
										}

										echo form_dropdown(array(
													'name' => 'student_id',
													'class' => 'form-control select2_one',
													'required' => 'true',
												), $option);

										echo form_error('student_id'); ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('sell_on_date')) echo 'has-error'; ?>">
									<?php echo form_label('Receipt Date<small class="text-danger">*</small>', 'stock_name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'sell_on_date',
											'class' => 'form-control',
											'placeholder' => 'sell on Date',
											'id' => 'data_1',
											'value' =>  date("d/m/Y"),
											'required' => 'true',
											'readonly' => 'true',
										));

										echo form_error('sell_on_date'); ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-4"></div>
									<div class="col-sm-8">
										<table class="table table-bordered">
											<tr>
												<th width="125">Enter Quantity</th>
												<th width="160" style="padding-left: 20px;">Available Quantity</th>
												<th>Unit Price</th>
												<th>Amount</th>
											</tr>
										</table>
									</div>
								</div>

								<?php //var_dump($inventries);die();
								foreach($inventries as $inventry){ ?>

									<div class="form-group">
								<?php echo form_label($inventry->stock_name, $inventry->stock_name, array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-1">
										<label class="checkbox-inline"> 
										<input type="checkbox" id="inv_<?= $inventry->id; ?>" name="inventry_id[]" value="<?= $inventry->id; ?>" class="check_box">
										<input type="hidden" id="sid_<?= $inventry->id; ?>" name="stock_id[]" value="<?= $inventry->sid; ?>" disabled="disabled"> 
										<input type="hidden" id="sname_<?= $inventry->id; ?>" name="stock_name[]" value="<?= $inventry->stock_name; ?>" disabled="disabled"> 
										</label>
									</div>
									<div class="col-sm-2">
										<?php
										echo form_input(array(
											'type' => 'number',
											'name' => 'quantity[]',
											'class' => 'form-control quantity',
											'placeholder' => 'Quantity',
											'id' => 'quan_'.$inventry->id,
											'value' =>  set_value('quantity'),
											'required' => 'true',
											'disabled' => 'disabled',
											'min' =>'1',
											'max' => $inventry->available_quantity,

										));?>
										<span id='message_<?php echo $inventry->id; ?>'></span>
									</div>
									<div class="col-sm-2">
										<?php
										echo form_input(array(
											'type' => 'text',
											//'name' => 'restquantity[]',
											'class' => 'form-control restquantity',
											'placeholder' => 'Available Quantity',
											'id' => 'restquantity_'.$inventry->id,
											'value' =>  $inventry->available_quantity,
											'readonly' => 'true',
											'disabled' => 'disabled',

										)); ?>
										<?php
										echo form_input(array(
											'type' => 'hidden',
											'name' => 'avquantity[]',
											'class' => 'form-control',
											'placeholder' => 'Available Quantity',
											'id' => 'avquantity_'.$inventry->id,
											'value' =>  '',
											'readonly' => 'true',
											'disabled' => 'disabled',

										)); ?>
									</div>
									<div class="col-sm-2">
										<?php
										echo form_input(array(
											'type' => 'number',
											'name' => 'unit_price[]',
											'class' => 'form-control',
											'id' => 'unit_price_'.$inventry->id,
											'placeholder' => 'Unit Price',
											'value' =>  set_value('unit_price',$inventry->sell_price),
											'readonly' => 'true',
											'disabled' => 'disabled',
										));?>
									</div>
									<div class="col-sm-2">
										<?php
										echo form_input(array(
											'type' => 'number',
											'name' => 'sub_price[]',
											'class' => 'form-control subPrice',
											'id' => 'sub_price_'.$inventry->id,
											'placeholder' => 'Sub Total',
											'value' =>  set_value('sub_price'),
											'required' => 'true',
											'readonly' => 'true',
											'disabled' => 'disabled',
										));?>
									</div>
								</div>

								<?php }?>
								<div class="form-group<?php if(form_error('total_price')) echo 'has-error'; ?>">
									<?php echo form_label('Total Amount', 'total_price', array('class' => 'col-sm-3 control-label totalValue')); ?>
									<div class="col-sm-3">
										<?php
										echo form_input(array(
											'type' => 'number',
											'name' => 'total_price',
											'class' => 'form-control',
											'id' => 'totalprice',
											'placeholder' => 'Total Amount',
											'value' =>  set_value('total_price'),
											'required' => 'true',
										));
										echo form_error('total_price'); ?>
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
	$(function(){
		$(".check_box").click(function () {
        	var id  = ($(this).val());
        	//alert(id);
            if ($(this).is(":checked")) {
            	$('#quan_'+id).removeAttr("disabled");
                $('#sid_'+id).removeAttr("disabled");
                $('#sname_'+id).removeAttr("disabled");
                $('#restquantity_'+id).removeAttr("disabled");
                $('#unit_price_'+id).removeAttr("disabled");
                $('#sub_price_'+id).removeAttr("disabled");
                $('#avquantity_'+id).removeAttr("disabled");
                //$('#'+id).focus();
            } else {
                $('#quan_'+id).attr("disabled", "disabled");
                $('#sid_'+id).attr("disabled", "disabled");
                $('#sname_'+id).attr("disabled", "disabled");
                $('#restquantity_'+id).attr("disabled", "disabled");
                $('#unit_price_'+id).attr("disabled", "disabled");
                $('#sub_price_'+id).attr("disabled", "disabled");
                 $('#avquantity_'+id).attr("disabled", "disabled");
            }
       
        //$(document).on("change keyup blur", "#quantity", function() {
        $('#quan_'+id).on('change keyup blur', function(e){
        	//var id = $(this).attr('id');
        	//alert(id);
			var quantity = '';
		    var restquantity = '';
		    quantity = $(this).val();
		    restquantity = $('#restquantity_'+id).val();
			if ( parseInt(quantity) > parseInt(restquantity)) {
			  $('#message_'+id).html('Enter quantity should be less').css('color', 'red');
			} else{
				$('#message_'+id).html('Enter quantity').css('color', 'green');
			}
            //var quantity = $(this).val();
            var amount = $('#unit_price_'+id).val();
            var mult = quantity * amount; 
            var avquantity = restquantity - quantity;
            $('#avquantity_'+id).val(avquantity);
            $('#sub_price_'+id).val(mult);
             var sum = 0;
          $('.subPrice').each(function () {
             var amount = $(this).val();
             if (!isNaN(amount) && amount.length !== 0) {
                 sum += parseFloat(amount);
             }
         });
         $('#totalprice').val(sum);
        });
       });
     });
 </script> 

