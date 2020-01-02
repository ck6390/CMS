<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Admin</li>
			<li>
				<a href="<?= site_url("admin/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
	echo form_open("admin/{$this->misc->_getClassName()}/edit/{$info->permission_p_id}", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Permission <span class="text-success">[<?= $info->display_name ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('permission-value')) echo 'has-error'; ?>">
									<?php echo form_label('Permission Value <small class="text-danger">*</small>', 'permission-value', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'permission-value',
											'class' => 'form-control',
											'placeholder' => 'Permission Value',
											'value' => set_value('permission-value', $info->permission_name),
											'required' => 'true'
										));

										echo form_error('permission-value'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('display-name')) echo 'has-error'; ?>">
									<?php echo form_label('Display Name <small class="text-danger">*</small>', 'display-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'display-name',
											'class' => 'form-control',
											'placeholder' => 'Display Name',
											'value' => set_value('display-name', $info->display_name),
											'required' => 'true'
										));

										echo form_error('display-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('module-name')) echo 'has-error'; ?>">
									<?php echo form_label('Module Name <small class="text-danger">*</small>', 'module-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'module-name',
											'class' => 'form-control',
											'placeholder' => 'Module Name',
											'value' => set_value('module-name', $info->module_name),
											'required' => 'true'
										));

										echo form_error('module-name'); ?>
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