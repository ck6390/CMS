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
	echo form_open("office/{$this->misc->_getClassName()}/edit/" . $info->attribute_p_id, $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Attribute</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('status-name')) echo 'has-error'; ?>">
									<?php echo form_label('Shift Name <small class="text-danger">*</small>', 'status-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'shift-name',
											'class' => 'form-control',
											'placeholder' => 'Employment Status',
											'value' => set_value('status-name', $info->shift_name),
											'required' => 'true'
										));

										echo form_error('status-name'); ?>
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
											'value' => set_value('start-time', $info->shift_start),
											'required' => 'true'
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
											'value' => set_value('end-time', $info->shift_end),
											'required' => 'true'
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