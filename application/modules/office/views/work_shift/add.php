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
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Work Shift</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('shift-name')) echo 'has-error'; ?>">
									<?php echo form_label('Shift Name <small class="text-danger">*</small>', 'shift-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'shift-name',
											'class' => 'form-control',
											'placeholder' => 'Shift Name',
											'value' => set_value('shift-name')
										));

										echo form_error('shift-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('start-time')) echo 'has-error'; ?>">
									<?php echo form_label('Shift Start Time <small class="text-danger">*</small>', 'start-time', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'time',
											'name' => 'start-time',
											'class' => 'form-control',
											'value' => set_value('start-time')
										));

										echo form_error('start-time'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('end-time')) echo 'has-error'; ?>">
									<?php echo form_label('Shift End time <small class="text-danger">*</small>', 'end-time', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'time',
											'name' => 'end-time',
											'class' => 'form-control',
											'value' => set_value('end-time'),
										));

										echo form_error('end-time'); ?>
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