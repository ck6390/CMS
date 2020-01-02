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
						<h5>Add New Holiday</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10 col-sm-12">
								<div class="form-group <?php if(form_error('event-name')) echo 'has-error'; ?>">
									<?php echo form_label('Holiday/Event Name <small class="text-danger">*</small>', 'event-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'event-name',
											'class' => 'form-control',
											'placeholder' => 'Holiday/Event Name',
											'value' => set_value('event-name'),
											'required' => 'true'
										));

										echo form_error('event-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('start-date')) echo 'has-error'; ?>">
									<?php echo form_label('Start Date <small class="text-danger">*</small>', 'start-date', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'date',
											'name' => 'start-date',
											'class' => 'form-control',
											'placeholder' => 'Start Date',
											'value' => set_value('start-date'),
											'required' => 'true'
										));

										echo form_error('start-date'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('end-date')) echo 'has-error'; ?>">
									<?php echo form_label('End Date <small class="text-danger">*</small>', 'end-date', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'date',
											'name' => 'end-date',
											'class' => 'form-control',
											'placeholder' => 'End Date',
											'value' => set_value('end-date'),
											'required' => 'true'
										));

										echo form_error('end-date'); ?>
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