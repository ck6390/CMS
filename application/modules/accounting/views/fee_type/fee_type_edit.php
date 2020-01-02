<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Accounting</a>
			</li>
			<li>
				<a href="<?= site_url("accounting/".$this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
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
		'name' => 'edit-form',
		'class' => 'form-horizontal edit-form',	
	);
	echo form_open("accounting/".$this->misc->_getClassName()."/edit/$info->fee_type_p_id", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Fee Type <span class="text-success">[<?= $info->fee_type_name ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('fee-type')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Type <small class="text-danger">*</small>', 'fee-type', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'fee-type',
											'class' => 'form-control',
											'placeholder' => 'Fee Type Title',
											'value' => set_value('fee-type',$info->fee_type_name),
											'required' => 'true'
										));

										echo form_error('fee-type'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('fee-group')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Group <small class="text-danger">*</small>', 'fee-group', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										$_fee_group = $this->mdl_fee_group->dropdown('fee_group_name');

										echo form_dropdown(array(
											'name' => 'fee-group',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_fee_group,$info->fee_group);

										echo form_error('fee-group'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('fee-amount')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Amount <small class="text-danger">*</small>', 'fee-amount', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'fee-amount',
											'class' => 'form-control',
											'placeholder' => 'Fee Amount',
											'value' => set_value('fee-type',$info->fee_type_amount),
											'required' => 'true'
										));

										echo form_error('fee-amount'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
									<?php echo form_label('Description ', 'description', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_textarea(array(
											'name' => 'description',
											'class' => 'form-control',
											'rows' => '3',
											'placeholder' => 'Description',
											'value' => set_value('description',$info->description),
											
										));

										echo form_error('description'); ?>
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
		var groupID = $(this).val();
		if(groupID == '1'){
			$("#feeYear").show();
			$('select[name="fee-year"]').attr("disabled", false);
		}else{
			$("#feeYear").hide();
			$('select[name="fee-year"]').attr("disabled", true);
		}
	});
	$("#feeYear").hide();
	$('select[name="fee-year"]').attr("disabled", true);

});
</script>
