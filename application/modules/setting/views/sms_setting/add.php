<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= $this->misc->_getMethodName(); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("setting/{$this->misc->_getClassName()}/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'add-form',
		'class' => 'form-horizontal	'
	);
	echo form_open("setting/".$this->misc->_getClassName(), $attr); ?>
		<div class="row">
			
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Sms Setting Info</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group <?php if(form_error('auth-key')) echo 'has-error'; ?>">
									<?php
									echo form_label('Auth Key <small class="text-danger">*</small>', 'auth-key', array('class' => 'control-label col-sm-4'));
									$auth = !empty($info->auth_key)? $info->auth_key: '';  ?>
									<div class="col-sm-8">
									<?php 
									echo form_input(array(
										'type' => 'text',
										'name' => 'auth-key',
										'class' => 'form-control ',
										'placeholder' => 'Auth Key',
										'value' => set_value('auth-key',$auth),
										'required' => 'true'
									));

									echo form_error('auth-key'); ?>
								</div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group <?php if(form_error('sender-id')) echo 'has-error'; ?>">
									<?php
									echo form_label('Sender Id <small class="text-danger">*</small>', 'sender-id', array('class' => 'control-label col-sm-4'));
									$sender_id = isset($info->sender_id)? $info->sender_id: '';  ?>
									<div class="col-sm-8">
									<?php 
									echo form_input(array(
										'type' => 'text',
										'name' => 'sender-id',
										'class' => 'form-control ',
										'placeholder' => 'Sender Id',
										'value' => set_value('sender-id',$sender_id),
										'required' => 'true'
									));

									echo form_error('sender-id'); ?>
								</div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group <?php if(form_error('status')) echo 'has-error'; ?>">
									<?php
									echo form_label('Status <small class="text-danger">*</small>', 'status', array('class' => 'control-label col-sm-4'));
									$sender_id = isset($info->sender_id)? $info->sender_id: '';  ?>
									<div class="col-sm-8">
									<?php 

									$_status = array(
												'0' =>'Deactivate',
												'1' => 'Activate' 
									);
									echo form_dropdown(array(
										'type' => 'text',
										'name' => 'status',
										'class' => 'form-control ',
										'placeholder' => 'Sender Id',
										'required' => 'true'
									),$_status,$info->is_active);

									echo form_error('status'); ?>
								</div>
								</div>
							</div>

							<div class="text-right col-sm-8">
							<button class="btn btn-primary " type="submit">Save</button>
						</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>