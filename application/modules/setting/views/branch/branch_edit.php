<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("setting/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
		'name' => 'edit-form',
		'class' => 'form-horizontal edit-form',	
	);
	echo form_open("setting/{$this->misc->_getClassName()}/edit/$info->branch_p_id", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Branch <span class="text-success">[<?= $info->branch_name ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('branch-name')) echo 'has-error'; ?>">
									<?php echo form_label('Branch Name <small class="text-danger">*</small>', 'branch-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'branch-name',
											'class' => 'form-control',
											'placeholder' => 'Branch Name',
											'value' => set_value('branch-name',$info->branch_name),
											'required' => 'true'
										));

										echo form_error('branch-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('branch-code')) echo 'has-error'; ?>">
									<?php echo form_label('Branch Code <small class="text-danger">*</small>', 'branch-code', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'branch-code',
											'class' => 'form-control',
											'placeholder' => 'Branch Code',
											'value' => set_value('branch-code',$info->branch_code),
											'required' => 'true'
										));

										echo form_error('branch-code'); ?>
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
											'value' => set_value('description',$info->description)
										));
										echo form_error('description'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>
						<div class="col-sm-12 text-right">
							<a class="btn bg-warning" id="editTab1"><i class="fa fa-pencil"></i> Edit</a>
							<a class="btn bg-danger" id="cancelTab1" style="display: none;"><i class="fa fa-times"></i> Cancel</a>&nbsp;
							<button class="btn btn-primary" id="saveTab1" type="submit" style="display: none;"><i class="fa fa-save"></i> Save</button>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
<script>
	$(document).ready(function () {
		var form = $('.edit-form');
		$('form input,select,textarea,button.remCF,button[type="submit"]').prop("disabled", true);
		$('#editTab1').click(function(event) {
			form.find(':disabled').each(function() {
				$(this).removeAttr('disabled');
			});
			$('#cancelTab1').show();
			$('#saveTab1').show();
			$('#editTab1').hide();
		});
	
		$('#cancelTab1').click(function(event) {
			form.find(':enabled').each(function() {
				$(this).attr("disabled", "disabled");
			});
			$('#cancelTab1').hide();
			$('#saveTab1').hide();
			$('#editTab1').show();
		});
	});
</script>

