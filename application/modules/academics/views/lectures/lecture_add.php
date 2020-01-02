<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Academic</a>
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
		'name' => 'add-form',
		'class' => 'form-horizontal'
	);
	echo form_open("academics/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Lecture</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('period-name')) echo 'has-error'; ?>">
									<?php echo form_label('Faculty <small class="text-danger">*</small>', 'period-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										$_faculty = $this->mdl_employee->dropdown('username'); 

										echo form_dropdown(array(
											'type' => 'text',
											'name' => 'employee-id',
											'class' => 'form-control',
											'placeholder' => 'Employee',
											'required' => 'true'
										),$_faculty);

										echo form_error('employee-id'); ?>
									</div>
								</div>

								<div class="form-group  <?php if(form_error('semester-id')) echo 'has-error'; ?>">
									<?php echo form_label('Semester <small class="text-danger">*</small>', 'semester-id',array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										$_semester = $this->mdl_semester->dropdown('semester_name');

										echo form_dropdown(array(
											'name' => 'semester-id',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_semester);

										echo form_error('semester-id'); ?>
									</div>
								</div>

								<div class="form-group  <?php if(form_error('branch-id')) echo 'has-error'; ?>">
									<?php echo form_label('Branch <small class="text-danger">*</small>', 'branch-id',array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										$_branch = $this->mdl_branch->dropdown('branch_code');

										echo form_dropdown(array(
											'name' => 'branch-id',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_branch);

										echo form_error('branch-id'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('subject-id')) echo 'has-error'; ?>">
									<?php echo form_label('Subject <small class="text-danger">*</small>', 'subject-id',array('class' => 'col-sm-3 control-label'));
									?>
									<div class="col-sm-9">
									<?php 
									$_subject = $this->mdl_subject->dropdown('subject_name');
									echo form_dropdown(array(
										'name' => 'subject-id',
										'class' => 'form-control select2_one',
										'required' => 'true'
									), $_subject);

									echo form_error('subject-id'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('period-id')) echo 'has-error'; ?>">
									<?php echo form_label('Period <small class="text-danger">*</small>', 'period-id',array('class' => 'col-sm-3 control-label'));
									?>
									<div class="col-sm-9">
									<?php 
									$_period = $this->mdl_period->dropdown('period_name'); ?>

									<select name="period-id" class="form-control select2_one select2-hidden-accessible">
										<option value="">Please Select</option>
									<?php 
									$_period = $this->mdl_period->get_all();
									foreach($_period as $period){ ?>
										
										 <option value="<?php echo $period->period_p_id;?>"><?php echo $period->period_name." [ ".$period->start_time." - ".$period->end_time." ] ";?></option>
									
									<?php } ?>
									</select>
									<?php echo form_error('period-id'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('start-date')) echo 'has-error'; ?>">
									<?php echo form_label('Start Date <small class="text-danger">*</small>', 'start-date',array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">					
									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<?php 
										echo form_input(array(
											'type' => 'text',	
											'name' => 'start-date',
											'id' => 'data_1',
											'class' => 'form-control',
											'placeholder' => 'Start Date',
											'value' => set_value('start-date'),
											'required' => 'true'
										));

										echo form_error('start-date'); ?>
										</div>
									</div>
								</div>

								<div class="form-group <?php if(form_error('end-date')) echo 'has-error'; ?>">
									<?php echo form_label('Date <small class="text-danger">*</small>', 'end-date',array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">					
									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<?php 
										echo form_input(array(
											'type' => 'text',	
											'name' => 'end-date',
											'id' => 'data_1',
											'class' => 'form-control',
											'placeholder' => 'End Date',
											'value' => set_value('end-date'),
											'required' => 'true'
										));

										echo form_error('end-date'); ?>
										</div>
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