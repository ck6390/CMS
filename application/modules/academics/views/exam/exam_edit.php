<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("academic/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
	echo form_open("academic/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Apply New Form</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6 b-r">
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('student-id')) echo 'has-error'; ?>">
										<?php echo form_label('Student ID <small class="text-danger">*</small>', 'student-id');

										echo form_input(array(
											'type' => 'text',
											'name' => 'student-id',
											'class' => 'form-control',
											'placeholder' => 'Student ID',
											'value' => set_value('student-id'),
											'required' => 'true'
										));

										echo form_error('student-id'); ?>
									</div>
									<div class="form-group <?php if(form_error('form-type')) echo 'has-error'; ?>">
										<?php
										$options = array(
											'' => 'Select Form',
											'1' => 'Examination Form',
											'2' => 'Registration Form',
											'3' => 'Miscelleneous Form',
										);?>
										<?php echo form_label('Form Type <small class="text-danger">*</small>', 'form-type');

											echo form_dropdown(array(
												'name' => 'form-type',
												'class' => 'form-control select2_one'
											), $options);

											echo form_error('form-type'); ?>
									</div>
									<div class="form-group <?php if(form_error('payment-mode')) echo 'has-error'; ?>">
										<?php
										$options = array(
											'' => 'Select Payment',
											'1' => 'Cash',
											'2' => 'Cheque',
											'3' => 'Net Banking'
										);?>
										<?php echo form_label('Payment Mode <small class="text-danger">*</small>', 'payment-mode');

											echo form_dropdown(array(
												'name' => 'payment-mode',
												'class' => 'form-control select2_one'
											), $options);

											echo form_error('payment-mode'); ?>
									</div>
									<div class="form-group <?php if(form_error('subject')) echo 'has-error'; ?>">
										<?php echo form_label('Subject', 'subject');

											echo form_input(array(
												'type' => 'text',
												'name' => 'subject',
												'class' => 'form-control',
												'placeholder' => 'Subject',
												'value' => set_value('subject'),
												'required' => 'true'
											));

											echo form_error('subject'); ?>
									</div>
									<div class="form-group <?php if(form_error('fee')) echo 'has-error'; ?>">
										<?php echo form_label('Fee <small class="text-danger">*</small>', 'fee');

										echo form_input(array(
											'type' => 'text',
											'name' => 'fee',
											'class' => 'form-control',
											'placeholder' => 'Fee',
											'value' => set_value('fee'),
											'required' => 'true'
										));

										echo form_error('fee'); ?>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('session')) echo 'has-error'; ?>">
										<?php
										$options = array(
											'' => 'Select session',
											'1' => '2016-2019',
											'2' => '2017-2020',
											'3' => '2018-2021',
											'4' => '2019-2022'
										);
										echo form_label('Session <small class="text-danger">*</small>', 'session');
										echo form_dropdown(array(
											'name' => 'session',
											'class' => 'form-control select2_one'
										), $options);

										echo form_error('branch'); ?>
											
									</div>
									<div class="form-group <?php if(form_error('semester')) echo 'has-error'; ?>">
										<?php
										$options = array(
											'' => 'Select Semester',
											'1' => '1st Sem',
											'2' => '2nd Sem',
											'3' => '3rd Sem',
											'4' => '4th Sem'
										);
										echo form_label('Semester <small class="text-danger">*</small>', 'semester');
										echo form_dropdown(array(
											'name' => 'semester',
											'class' => 'form-control select2_one'
										), $options);

										echo form_error('semester'); ?>
											
									</div>
									<div class="form-group <?php if(form_error('ref-number')) echo 'has-error'; ?>">
										<?php echo form_label('Ref. Number', 'ref-number'); 
											echo form_input(array(
												'type' => 'text',
												'name' => 'ref-number',
												'class' => 'form-control',
												'placeholder' => 'Ref. Number',
												'value' => set_value('ref-number'),
												'required' => 'true'
											));

											echo form_error('ref-number'); ?>
									</div>
									<div class="form-group <?php if(form_error('fine')) echo 'has-error'; ?>">
										<?php echo form_label('Fine <small class="text-danger">*</small>', 'fine');
										echo form_input(array(
											'type' => 'text',
											'name' => 'fine',
											'class' => 'form-control',
											'placeholder' => 'Fine',
											'value' => set_value('fine'),
											'required' => 'true'
										));

										echo form_error('fine'); ?>
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