<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				academics
			</li>
			<li>
				<a href="<?= site_url("academics/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
	echo form_open("academics/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Notification</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6 b-r">
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('fee-group')) echo 'has-error'; ?>">
										<?php echo form_label('Group <small class="text-danger">*</small>', 'fee-group');

										$_fee_group = $this->mdl_fee_group->dropdown('fee_group_name');

										echo form_dropdown(array(
											'name' => 'fee-group',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_fee_group);

										echo form_error('fee-group'); ?>
									</div>

									<div id="feeTypeDropdown" class="form-group <?php if(form_error('fee-type')) echo 'has-error'; ?>">
										<?php echo form_label('Type <small class="text-danger">*</small>', 'fee-type');
										$_fee_type = $this->mdl_fee_type->dropdown('fee_type_name');

										echo form_dropdown(array(
											'name' => 'fee-type',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_fee_type);

										echo form_error('fee-type'); ?>
									</div>

									<div class="form-group <?php if(form_error('fee')) echo 'has-error'; ?>">
										<?php echo form_label('Fee <small class="text-danger">*</small>', 'fee');

										echo form_input(array(
											'type' => 'text',
											'name' => 'fee',
											'class' => 'form-control',
											'placeholder' => 'Fee Amount',
											'value' => set_value('fee'),
											'required' => 'true'
										));

										echo form_error('fee'); ?>
									</div>
									
									<div class="form-group <?php if(form_error('start-on')) echo 'has-error'; ?>">
										<?php echo form_label('Start On <small class="text-danger">*</small>', 'start-on'); ?>
										
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<?php 
											echo form_input(array(
												'type' => 'text',	
												'name' => 'start-on',
												'id' => 'data_1',
												'class' => 'form-control',
												'placeholder' => 'Start On',
												'value' => set_value('start-on'),
												'required' => 'true'
											));

											echo form_error('start-on'); ?>

										</div>
									</div>

									<div class="form-group <?php if(form_error('close-on')) echo 'has-error'; ?>">
										<?php echo form_label('Closed On <small class="text-danger">*</small>', 'close-on');?>
											
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<?php 
												echo form_input(array(
													'type' => 'text',	
													'name' => 'close-on',
													'id' => 'data_1',
													'class' => 'form-control',
													'placeholder' => 'Closed On',
													'value' => set_value('close-on'),
													'required' => 'true'
												));

												echo form_error('close-on'); ?>

										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('semester')) echo 'has-error'; ?>">
										<?php
										echo form_label('Semester <small class="text-danger">*</small>', 'semester');
										$_semester = $this->mdl_semester->dropdown('semester_name');
										echo form_dropdown(array(
											'name' => 'semester',
											'class' => 'form-control select2_one'
										), $_semester);

										echo form_error('semester'); ?>
									
									</div>

									<div class="form-group <?php if(form_error('academic-session')) echo 'has-error'; ?>">

										<?php echo form_label('Academic Session <small class="text-danger">*</small>', 'academic-session');
										$_session = $this->mdl_session->dropdown('session_name');

										echo form_dropdown(array(
											'name' => 'academic-session',
											'class' => 'form-control select2_one'
										), $_session);

										echo form_error('academic-session'); ?>
									</div>

									<div class="form-group <?php if(form_error('ex-fee')) echo 'has-error'; ?>">
										<?php echo form_label('Extra Fee Per Subject', 'ex-fee');

										echo form_input(array(
											'type' => 'text',
											'name' => 'ex-fee',
											'class' => 'form-control',
											'placeholder' => 'Extra Fee',
											'value' => set_value('ex-fee')
										));

										echo form_error('ex-fee'); ?>
									</div>

									<div class="form-group <?php if(form_error('fine-days')) echo 'has-error'; ?>">
										<?php echo form_label('Fine Per Days', 'fine-days');

										echo form_input(array(
											'type' => 'text',
											'name' => 'fine-days',
											'class' => 'form-control',
											'placeholder' => 'Fine Per Days',
											'value' => set_value('fine-days')
										));

										echo form_error('fine-days'); ?>

									</div>

									<div class="form-group <?php if(form_error('end-on')) echo 'has-error'; ?>">
										<?php echo form_label('End On', 'end-on'); ?>
									
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<?php 
											echo form_input(array(
												'type' => 'text',	
												'name' => 'end-on',
												'id' => 'data_1',
												'placeholder' => 'End On',
												'class' => 'form-control',
												'value' => set_value('end-on')
											));
											echo form_error('end-on'); ?>
										</div>
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

<script type="text/javascript">
$(document).ready(function() {

	$('select[name="fee-group"]').on('change', function() {
		var feeGroupID = $(this).val();
		if(feeGroupID) {
			$.ajax({
				url: base_url + "index.php/setting/fee_types/get_feeType_list_by_group/" + feeGroupID,
				type: "POST",
				success:function(data)
				{
					$('#feeTypeDropdown .select2_one').select2('val','');
					$('select[name="fee-type"]').html('<option value="" selected="true">== Please select one option ==</option>');
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {
							var option = $('<option />');
							option.attr('value', this.fee_type_p_id).text(this.fee_type_name);
							$('select[name="fee-type"]').append(option);
						});
					} else {
						$('#feeTypeDropdown .select2_one').select2('val','');
					}
				}
			});
		} else {
			$('#feeTypeDropdown .select2_one').select2('val','');
		}
	});


	$('select[name="fee-type"]').on('change', function() {
		var feeTypeID = $(this).val();
		if(feeTypeID) {
			$.ajax({
				url: base_url + "index.php/setting/fee_types/get_feeType_amount/" + feeTypeID,
				type: "POST",
				success:function(data)
				{
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						
						$('input[name="fee"]').attr('value', dataObj.fee_type_amount);
					
					} else {
						$('input[name="fee"]').attr('value', '');
					}
				}
			});
		} else {
			$('input[name="fee"]').attr('value', '');
		}
	});
});
</script>