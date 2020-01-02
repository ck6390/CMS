<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Office</li>
			<li>
				<a href="<?= site_url("office/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
						<h5>Add New Bank</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10 col-sm-12">
								<div class="form-group <?php if(form_error('bank-name')) echo 'has-error'; ?>">
									<?php echo form_label('Bank Name <small class="text-danger">*</small>', 'bank-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'bank-name',
											'class' => 'form-control',
											'placeholder' => 'Bank Name',
											'value' => set_value('bank-name'),
											'required' => 'true'
										));

										echo form_error('bank-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('account-name')) echo 'has-error'; ?>">
									<?php echo form_label('Account Holder Name <small class="text-danger">*</small>', 'account-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'account-name',
											'class' => 'form-control',
											'placeholder' => 'Account Holder Name',
											'value' => set_value('account-name'),
											'required' => 'true'
										));

										echo form_error('account-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('account-number')) echo 'has-error'; ?>">
									<?php echo form_label('Account Number <small class="text-danger">*</small>', 'account-number', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'account-number',
											'class' => 'form-control',
											'placeholder' => 'Account Number',
											'value' => set_value('account-number'),
											'required' => 'true'
										));

										echo form_error('account-number'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('ifsc-code')) echo 'has-error'; ?>">
									<?php echo form_label('IFSC Code <small class="text-danger">*</small>', 'ifsc-code', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'ifsc-code',
											'class' => 'form-control',
											'placeholder' => 'IFSC Code',
											'value' => set_value('ifsc-code'),
											'required' => 'true'
										));

										echo form_error('ifsc-code'); ?>
									</div>
								</div>

								<div class="form-group">
									<?php echo form_label('Branch Address', 'address', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_textarea(array(
											'name' => 'address',
											'class' => 'form-control',
											'placeholder' => 'Enter Branch Address',
											'rows' => '3'
										)); ?>
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