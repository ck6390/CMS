<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}/student_profile/{$info->student_p_id}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Other Fee</strong>
			</li>
		</ol>
	</div>
	
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Student Detail</h5>
                </div>
	            <div class="ibox-content no-padding border-left-right">
	                <img alt="image" class="img-responsive img-thumbnail" style="    width: 100%;height: 207px;"src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_photo}") ?>">

	                <img alt="image" class="img-responsive img-thumbnail m-t" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_sign}") ?>">

	            </div>
	            <div class="ibox-content profile-content">
	                <h4><strong><?php echo $info->student_full_name; ?></strong></h4>
                    <h5><strong>Student ID</strong></h5>
                    <h4 class="text-info"><strong><?php echo $info->student_unique_id; ?></strong></h4>
                    <h5><strong>Admission No.</strong></h5>
                    <h4 class="text-info"><strong><?php echo $info->admission_no; ?></strong></h4>
	            </div>
	        </div>    
    	</div>
    	<div class="col-md-9">
		    <div class="row">
				<div class="col-sm-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Other Fee</h5>
							<div class="ibox-tools">
								<small><code>*</code> Required Fields.</small>
							</div>
						</div>

						<div class="ibox-content">
							<?php
							$attr = array(
								'role' => 'form',
								'method' => 'post',
								'name' => 'add-form',
								'enctype' => 'multipart/form-data',
								'class' => 'form-horizontal',
							);
							echo form_open("{$this->misc->_getClassName()}/general_receipt/{$info->student_p_id}", $attr); ?>

							<div class="col-md-12">
								<div class="form-group <?php if(form_error('receipt-title')) echo 'has-error'; ?>">
									<?php echo form_label('Receipt Title', 'receipt-title');?>

									<div id="title">
										<?php 
										$allFee = array(
											'' => 'Please Select',
											'Registration Fee (with Processing Charges)' => 'Registration Fee (with Processing charges)',
											'Examination Fee (with Processing charges)' => 'Examination Fee (with Processing charges)',
											'Extra class charges' => 'Extra class charges',
											'Other' => 'Other',
											'Hostel'=>'Hostel',
											'Mess'=>'Mess',
											'Dress'=>'Dress',
											'Stationery'=>'Stationery',
											'Final Document'=>'Final Document',
										);

									//$allFee = $this->mdl_fee_type->dropdown('fee_type_name');
										echo form_dropdown(array(
											'name' => 'receipt-title',
											'class' => 'form-control',
											'required' => 'true'
										), $allFee);
										/*echo form_input(array(
											'type' => 'text',
											'name' => 'receipt-title',
											'class' => 'form-control',
											'placeholder' => 'Receipt Title',
										));*/
										echo form_error('receipt-title'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('semester')) echo 'has-error'; ?>">
									<?php 
									 echo form_label('Semester', 'semester');

										$_semester = $this->mdl_semester->dropdown('semester_name');
										
										echo form_dropdown(array(
											'name' => 'semester',
											'class' => 'form-control select2_one'
										), $_semester);

										echo form_error('semester'); ?>
								</div>

								<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
									<?php echo form_label('Amount <small class="text-danger">*</small>', 'amount');

									echo form_input(array(
										'type' => 'text',
										'name' => 'amount',
										'class' => 'form-control',
										'placeholder' => 'Amount',
										'required' => 'true',
									));
									echo form_error('amount'); ?>
								</div>

								<div class="form-group <?php if(form_error('payment-mode')) echo 'has-error'; ?>">
									<?php echo form_label('Payment Mode <small class="text-danger">*</small>', 'payment-mode');

									$_payment_mode = $this->mdl_pay_mode->dropdown('payment_mode_name');

										echo form_dropdown(array(
											'type' => 'text',
											'name' => 'payment-mode',
											'class' => 'form-control',
											'placeholder' => 'Payment Mode',
											'required' => 'true',
										),$_payment_mode);

										echo form_error('payment-mode'); ?>
								</div>

								<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
									<?php echo form_label('Remarks/ UPI / Refrence / Cheque No.', 'remarks');

									echo form_input(array(
										'type' => 'text',
										'name' => 'remarks',
										'class' => 'form-control',
										'placeholder' => 'Remarks',
									));
									echo form_error('remarks'); ?>
								</div>
							</div>
							<!-- <div class="hr-line-dashed"></div> -->
							<div class="text-right">
								<button class="btn btn-primary" type="submit">Paid</button>
							</div>
							
							<?php echo form_close(); ?>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {

	$('select[name="fee-group"]').on('change', function() {
		var feeGroupID = $(this).val();
		if(feeGroupID) {
			$.ajax({
				url: base_url + "index.php/accounting/fee_types/get_feeType_list_by_group/" + feeGroupID,
				type: "POST",
				success:function(data)
				{
					
					$('select[name="fee-type"]').html('<option value="" selected="true">== Please select one option ==</option>');
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {
							var option = $('<option />');
							option.attr('value', this.fee_type_p_id).text(this.fee_type_name);
							$('select[name="fee-type"]').append(option);

							$('#title').hide();


						});
					} else {
						$('#feeTypeDropdown .select2_one').select2('val','');
						$('#title').show();
					}
				}
			});
		} else {
			$('#feeTypeDropdown .select2_one').select2('val','');
			$('#title').show();
		}
	});


	$('select[name="fee-type"]').on('change', function() {
		var feeTypeID = $(this).val();
		if(feeTypeID) {
			$.ajax({
				url: base_url + "index.php/accounting/fee_types/get_feeType_amount/" + feeTypeID,
				type: "POST",
				success:function(data)
				{
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						
						$('input[name="amount"]').attr('value', dataObj.fee_type_amount);
					
					} else {
						$('input[name="amount"]').attr('value', '');
					}
				}
			});
		} else {
			$('input[name="amount"]').attr('value', '');
		}
	});
});
</script>
<script>
	$(document).ready(function () {
		$('#title').prop("disabled", true);
		$('select[name="fee-type"]').on('change', function() {
		$('#feeTypeDropdown').click(function(event) {

			if(('#feeTypeDropdown').attr('value', '')){
				$('#feeTypeDropdown').hide();
				$('#title').show();
			}else{
				$('#feeTypeDropdown').show();
				$('#title').hide();
			}
				
		});
	
		// $('#feeTypeDropdown').click(function(event) {
		// 	title.find(':enabled').each(function() {
		// 		$(this).attr("disabled", "disabled");
		// 	});
		// 	$('#feeTypeDropdown').hide();
		// 	//$('#saveTab1').hide();
		// 	$('#title').show();
		// });
	});
</script>

