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
		'name' => 'edit-form',
		'class' => 'form-horizontal'
	);
	echo form_open("office/{$this->misc->_getClassName()}/edit/" . $info->holiday_p_id, $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Bank <span class="text-success">[<?= $info->event_name ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10 col-sm-12">
								<div class="form-group <?php if(form_error('event-name')) echo 'has-error'; ?>">
									<?php echo form_label('Bank Name <small class="text-danger">*</small>', 'event-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'event-name',
											'class' => 'form-control',
											'placeholder' => 'Bank Name',
											'value' => set_value('event-name', $info->event_name),
											'required' => 'true'
										));

										echo form_error('event-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('start-date')) echo 'has-error'; ?>">
									<?php echo form_label('Account Holder Name <small class="text-danger">*</small>', 'start-date', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'date',
											'name' => 'start-date',
											'class' => 'form-control',
											'placeholder' => 'Account Holder Name',
											'value' => set_value('start-date', $info->start_date),
											'required' => 'true'
										));

										echo form_error('start-date'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('end-date')) echo 'has-error'; ?>">
									<?php echo form_label('Account Number <small class="text-danger">*</small>', 'end-date', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'date',
											'name' => 'end-date',
											'class' => 'form-control',
											'placeholder' => 'Account Number',
											'value' => set_value('end-date', $info->end_date),
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
											'value' => set_value('description', $info->description),
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