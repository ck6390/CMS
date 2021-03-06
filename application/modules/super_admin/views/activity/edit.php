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
								<div class="form-group <?php if(form_error('activity-name')) echo 'has-error'; ?>">
									<?php echo form_label('Activity Name <small class="text-danger">*</small>', 'activity-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'activity-name',
											'class' => 'form-control',
											'placeholder' => 'Activity Name',
											'value' => set_value('activity-name',$info->activity_name),
											'required' => 'true'
										));

										echo form_error('activity-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('activity-amount')) echo 'has-error'; ?>">
									<?php echo form_label('Activity Amount <small class="text-danger">*</small>', 'activity-amount', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'activity-amount',
											'class' => 'form-control',
											'placeholder' => 'Activity Amount',
											'value' => set_value('activity-amount',$info->amount)
											
										));

										echo form_error('activity-amount'); ?>
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
