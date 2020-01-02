<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url($this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
	echo form_open("{$this->misc->_getClassName()}/attendance_report", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Attendance Report</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('month')) echo 'has-error'; ?>" id="inputhMonth">
									<?php echo form_label('Month <small class="text-danger">*</small>', 'month', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="input-group date">
											<input type="text" name="month" class="form-control" value="<?= !empty($month) ? $month : date('01-m-Y') ?>" required="true" />
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
										<?php echo form_error('month'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('department-id')) echo 'has-error'; ?>">
									<?php echo form_label('Department <small class="text-danger">*</small>', 'department-id', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										$all = array('all' => 'ALL');
										$department = $this->mdl_dept->dropdown('dept_name');
										array_splice($department, 1, 0, $all);
										echo form_dropdown(array(
											'name' => 'department-id',
											'class' => 'form-control',
											'required' => 'true'
										), $department);

										echo form_error('department-id'); ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3"></div>
									<div class="col-sm-9">
										<?php echo form_submit('submit', 'Go', 'class="btn btn-sm btn-primary"'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>

	<?php if(!empty($attendance)): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Employee Attendance Record.</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover attendanceTable" width="100%">
							<thead>
								<tr>
									<th>Name</th>
									<?php foreach ($dates as $date) { ?>
									<th class="active"><?php echo $date ?></th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($attendance as $key => $v_employee): ?>
								<tr>
									<td><strong><small><?php echo $employee[$key]->emp_name ?></small></strong></td>
									<?php foreach ($v_employee as $v_result): ?>
										<?php foreach ($v_result as $emp_attendance): ?>
											<td>
												<?php
												if ($emp_attendance->attendance_status == 'P') {
													echo '<small class="label bg-info">P</small>';
												} else if($emp_attendance->attendance_status == 'L'){
													echo '<small class="label bg-danger">L</small>';
												} else if ($emp_attendance->attendance_status == 'H') {
													echo '<small class="label btn-default">H</small>';
												} ?>
											</td>
										<?php endforeach; ?>
									<?php endforeach; ?>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
