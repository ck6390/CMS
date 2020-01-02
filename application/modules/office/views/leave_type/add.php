<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Office</li>
			<li>
				<a href="<?= site_url("office/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
	echo form_open("office/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Leave Type</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10 col-sm-12">
								<div class="form-group <?php if(form_error('leave-name')) echo 'has-error'; ?>">
									<?php echo form_label('Leave Name <small class="text-danger">*</small>', 'leave-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'leave-name',
											'class' => 'form-control',
											'placeholder' => 'Leave Name',
											'value' => set_value('leave-name'),
											'required' => 'true'
										));

										echo form_error('leave-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('leave-code')) echo 'has-error'; ?>">
									<?php echo form_label('Leave Code <small class="text-danger">*</small>', 'leave-code', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'leave-code',
											'class' => 'form-control',
											'placeholder' => 'Leave Code',
											'value' => set_value('leave-code'),
											'required' => 'true'
										));

										echo form_error('leave-code'); ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('leave-limit')) echo 'has-error'; ?>">
									<?php echo form_label('Leave Limit <small class="text-danger">*</small>', 'leave-limit', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'leave-limit',
											'class' => 'form-control',
											'placeholder' => 'Leave Limit',
											'value' => set_value('leave-limit'),
											'required' => 'true'
										));

										echo form_error('leave-limit'); ?>
									</div>
								</div>
								<div class="form-group">
									<?php echo form_label('Salary Deduction <small class="text-danger">*</small><br/><small class="text-navy">Will salary be deducted?</small>', 'salary-deduct', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="i-checks">
											<label> <?php echo form_radio('salary-deduct', '1')." Yes "; ?> </label>
										</div>
										<div class="i-checks">
											<label> <?php echo form_radio('salary-deduct', '0', true)." No "; ?> </label>
										</div>
									</div>
								</div>

								<div class="form-group <?php if(form_error('deduction-value')) echo 'has-error'; ?>">
									<?php echo form_label('Deduction Value <small class="text-danger">*</small>', 'deduction-value', array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-9">
											<div class="input-group">
											<?php 
											echo form_input(array(
												'type' => 'text',
												'name' => 'deduction-value',
												'class' => 'form-control',
												'placeholder' => 'Leave Name',
												'value' => set_value('deduction-value')
											)); ?>
											<span class="input-group-addon">days</span>
										</div>
										<?php echo form_error('deduction-value'); ?>
										<small class="help-block m-b-none text-danger">Value should be in number of days for which salary will be deductd.</small>
									</div>
								</div>

								<div class="form-group">
									<?php echo form_label('Description', 'description', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_textarea(array(
											'name' => 'description',
											'class' => 'form-control',
											'placeholder' => 'Enter Description',
											'rows' => '3'
										)); ?>
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