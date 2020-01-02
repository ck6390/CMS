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
				<a href="<?= site_url('office/'.$this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= $this->misc->_getMethodName(); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'edit-form',
		'class' => 'form-horizontal'
	);
	echo form_open("office/".$this->misc->_getClassName()."/edit/$info->grade_p_id", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Pay Grade [<?= $info->grade_name ?>]</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10 col-sm-12">
								<div class="form-group <?php if(form_error('grade-name')) echo 'has-error'; ?>">
									<?php echo form_label('Grade Name <small class="text-danger">*</small>', 'grade-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'grade-name',
											'class' => 'form-control',
											'placeholder' => 'Grade Name',
											'value' => set_value('grade-name', $info->grade_name),
											'required' => 'true'
										));

										echo form_error('grade-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('minimum-salary')) echo 'has-error'; ?>">
									<?php echo form_label('Minimum Salary <small class="text-danger">*</small>', 'minimum-salary', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'minimum-salary',
											'class' => 'form-control',
											'placeholder' => 'Minimum Salary',
											'value' => set_value('minimum-salary', $info->min_salary),
											'required' => 'true'
										));

										echo form_error('minimum-salary'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('maximum-salary')) echo 'has-error'; ?>">
									<?php echo form_label('Maximum Salary <small class="text-danger">*</small>', 'maximum-salary', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'maximum-salary',
											'class' => 'form-control',
											'placeholder' => 'Maximum Salary',
											'value' => set_value('maximum-salary', $info->max_salary),
											'required' => 'true'
										));

										echo form_error('maximum-salary'); ?>
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