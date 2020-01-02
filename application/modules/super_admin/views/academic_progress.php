<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace("_" , " " ,$this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url($this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= str_replace("_" , " " ,$this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getMethodName()); ?></strong>
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
		'name' => 'form',
		'class' => 'form-horizontal'
	);
	echo form_open("{$this->misc->_getClassName()}/academic_progress", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Acamedic Progress </h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12">

								<div class="col-sm-3">
									<div class=" <?php if(form_error('month-from')) echo 'has-error'; ?>" id="inputhMonth">
									<?php echo form_label('Semester <small class="text-danger">*</small>', 'semester');

										$_semester = $this->mdl_semester->dropdown('semester_name');
										echo form_dropdown(array(
											'name' => 'semester',
											'class' => 'form-control select2_one'
										), $_semester);

										echo form_error('semester');  ?>
									</div>
								</div>
								<div class="col-sm-3">
									<div class=" <?php if(form_error('month-to')) echo 'has-error'; ?>" id="inputhMonth">
									<?php
										echo form_label('Branch <small class="text-danger">*</small>', 'branch');
										$_branch = $this->mdl_branch->dropdown('branch_code');
										echo form_dropdown(array(
											'name' => 'branch',
											'class' => 'form-control select2_one'
										), $_branch);

										echo form_error('branch'); ?>
										
									</div>
								</div>
								<div class="col-sm-5">
									<div class=" <?php if(form_error('subject-id')) echo 'has-error'; ?>">
									<?php echo form_label('Subject <small class="text-danger">*</small>', 'subject-id', array('class' => ' control-label')); ?>
									<select name="subject-id" class="form-control select2_one select2-hidden-accessible">
										<option value="">Please Select</option>
									<?php 
									$_subjects = $this->mdl_subject->get_all();
									foreach($_subjects as $subject){ ?>
										
										 <option value="<?php echo $subject->subject_p_id;?>"><?php echo $subject->subject_name." - ".$subject->subject_code;?></option>
									
									<?php } ?>
									</select>
										
									</div>	
								</div>
								<div class="col-sm-1 text-center">
									<div style="margin-top:10px;" class=" <?php if(form_error('department-id')) echo 'has-error'; ?>">
										<?php 

										echo form_submit('submit', 'Go', 'class="btn btn-sm m-t  btn-primary"'); ?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>

	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize">Academic Progress Report</span></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table id="day_statement" class="table table-striped table-bordered table-hover ">
							<thead>
								<tr>
									<th>S. No.</th>
									<th>Employee Info</th>
									<th>Subject</th>
									<th>Subject Unit</th>
									<th>Total Lecture</th>
								</tr>
							</thead>
							<?php if(!empty($lists)): ?>
							<tbody>
							<?php $i=0; foreach ($lists as $list) : $i++; ?>
								
								<tr>
									<td>
										<?php  echo '<span class="badge badge-primary"><strong>'.$i.' .</strong></span>'; ?>
									</td>
									<td>
										<?= htmlspecialchars($this->mdl_employee->get($list->employee_id)->emp_name." - ".$this->mdl_employee->get($list->employee_id)->employee_id,ENT_QUOTES,'UTF-8') ?>
									 </td>
									
									<td><?= htmlspecialchars($this->mdl_subject->get($list->fk_subject_id)->subject_name." - ".$this->mdl_subject->get($list->fk_subject_id)->subject_code,ENT_QUOTES,'UTF-8') ?></td></td>
									<td>
										<?= htmlspecialchars($this->mdl_subject_unit->get($list->unit)->unit_number,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?php  
											echo $unit_count = $this->mdl_super_Admin->count_subject_unit($list->unit);

										?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php endif; ?>
							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>