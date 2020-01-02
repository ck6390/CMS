<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				academics
			</li>
			
			<li>
				<a href="<?= site_url("academics/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
	echo form_open("academics/{$this->misc->_getClassName()}/edit/{$info->subject_p_id}", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Subject [<?= $info->subject_name ?>]</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6 b-r">
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('subject-name')) echo 'has-error'; ?>">
										<?php echo form_label('Subject Name <small class="text-danger">*</small>', 'subject-name');

										echo form_input(array(
											'type' => 'text',
											'name' => 'subject-name',
											'class' => 'form-control',
											'placeholder' => 'Subject name',
											'value' => set_value('subject-name', $info->subject_name),
											'required' => 'true'
											));
										echo form_error('subject-name'); ?>

									</div>

									<div class="form-group <?php if(form_error('branch')) echo 'has-error'; ?>">
										<?php
										echo form_label('Branch <small class="text-danger">*</small>', 'branch');
										$_branch = $this->mdl_branch->dropdown('branch_code');
										echo form_dropdown(array(
											'name' => 'branch',
											'class' => 'form-control select2_one'
										), $_branch, $info->fk_branch_id);

										echo form_error('branch'); ?>
									</div>

									<div class="form-group <?php if(form_error('full-marks-internal')) echo 'has-error'; ?>">
										<?php echo form_label('Full Marks(Theory/Internal) ', 'full-marks-internal');

										echo form_input(array(
											'type' => 'text',
											'name' => 'full-marks-internal',
											'class' => 'form-control',
											'placeholder' => 'Full Marks',
											'value' => set_value('full-marks-internal', $info->full_marks_internal),
											//'required' => 'true'
										));
										echo form_error('full-marks-internal'); ?>

									</div>

									<div class="form-group <?php if(form_error('pass-marks-internal')) echo 'has-error'; ?>">
										<?php echo form_label('Pass Marks(Theory/Internal) ', 'pass-marks-internal');

										echo form_input(array(
											'type' => 'text',
											'name' => 'pass-marks-internal',
											'class' => 'form-control',
											'placeholder' => 'Pass Marks',
											'value' => set_value('pass-marks-internal', $info->pass_marks_internal),
											//'required' => 'true'
										));
										echo form_error('pass-marks-internal'); ?>

									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('subject-id')) echo 'has-error'; ?>">
										<?php echo form_label('Subject Code <small class="text-danger">*</small>', 'subject-id');

										echo form_input(array(
											'type' => 'text',
											'name' => 'subject-id',
											'class' => 'form-control',
											'placeholder' => 'Subject Code',
											'value' => set_value('subject-id', $info->subject_code),
											//'required' => 'true'
										));
										echo form_error('subject-id'); ?>

									</div>

									<div class="form-group <?php if(form_error('semester')) echo 'has-error'; ?>">
										<?php
										echo form_label('Semester <small class="text-danger">*</small>', 'semester');

										$_semester = $this->mdl_semester->dropdown('semester_name');
										echo form_dropdown(array(
											'name' => 'semester',
											'class' => 'form-control select2_one'
										), $_semester, $info->fk_semester_id);

										echo form_error('semester'); ?>

									</div>

									<div class="form-group <?php if(form_error('full-marks-external')) echo 'has-error'; ?>">
										<?php echo form_label('Full Marks(Terminal/External) ', 'full-marks-external');

										echo form_input(array(
											'type' => 'text',
											'name' => 'full-marks-external',
											'class' => 'form-control',
											'placeholder' => 'Full Marks Terminal',
											'value' => set_value('full-marks-external', $info->full_marks_external),
											//'required' => 'true'
										));

										echo form_error('full-marks-external'); ?>

									</div>

									<div class="form-group <?php if(form_error('pass-marks-external')) echo 'has-error'; ?>">
										<?php echo form_label('Pass Marks(Terminal/External) ', 'pass-marks-external');

										echo form_input(array(
											'type' => 'text',
											'name' => 'pass-marks-external',
											'class' => 'form-control',
											'placeholder' => 'Pass Marks Terminal',
											'value' => set_value('pass-marks-external', $info->pass_marks_external),
											//'required' => 'true'
										));

										echo form_error('pass-marks-external'); ?>
										
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
