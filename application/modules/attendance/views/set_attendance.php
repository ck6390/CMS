<!-- page -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/attendance.js"></script>
<style>
	td > input[type="checkbox"] {
		margin-top: 1px!important;
		cursor: pointer;
		width: 30px;
		height: 30px;
		-moz-transform: scale(2); /* FF */
		border-width: 0;
		transition: all .3s linear;
	}
	.presentChkBox, .absentChkBox { float: left; }

	div[id="leave"], div[id="timing"] { display: none; }
	input[class="absentChkBox"]:checked ~ div[id="leave"] { display:block; }
	input[class="presentChkBox"]:checked ~ div[id="timing"] { display:block; }
</style>
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
	echo form_open("{$this->misc->_getClassName()}/set_attendance", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Set Attendance</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('date')) echo 'has-error'; ?>" id="inputDate">
									<?php echo form_label('Date <small class="text-danger">*</small>', 'date', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="input-group date">
											<input type="text" name="date" class="form-control" value="<?= !empty($input_date) ? $input_date : date('d-m-Y') ?>" required="true" />
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
										<?php echo form_error('date'); ?>
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
										<button class="btn btn-primary" type="submit">Go</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>

	<?php if(!empty($lists)): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Edit Attendance Record.</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<?php
						$attr = array(
							'role' => 'form',
							'method' => 'post',
							'name' => 'form',
							'class' => 'form-horizontal'
						);
						echo form_open($this->misc->_getClassName()."/save_attendance", $attr); ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th width="10%">EMP. CODE</th>
										<th width="25%">EMPLOYEE NAME</th>
										<th width="40%">
											<label class="">
												<input type="checkbox" class="selectedChkBox" id="presentAll"> ATTENDANCE [IN-TIME/OUT-TIME]
											</label>
										</th>
										<th width="25%">
											<label class="">
												<input type="checkbox" class="selectedChkBox" id="absentAll"> LEAVE [STATUS]
											</label>
										</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($lists as $list) { ?>
									<tr>
										<td><?= "<span class='badge badge-primary'>".htmlspecialchars($list->employee_id,ENT_QUOTES,'UTF-8')."</span>" ?></td>
										<td>
											<input type="hidden" name="date" value="<?php echo $date ?>" />
											<input type="hidden" name="employee_id[]" value="<?php echo $list->emp_p_id ?>" />
											<?php
											foreach ($attendance as $emp_attendance) {
												if (!empty($emp_attendance)) {
													if ($list->emp_p_id == $emp_attendance->emp_ID) { ?>
														<input type="hidden" name="attendance_id[]" value="<?php if ($emp_attendance) echo $emp_attendance->attendance_p_id ?>">
													<?php
													}
												}
											} ?>
											<?= "<strong>".htmlspecialchars($list->emp_name,ENT_QUOTES,'UTF-8')."</strong>" ?>
										</td>
										<td>
											<input type="checkbox" name="attendance[]" id="<?= $list->emp_p_id ?>" value="<?= $list->emp_p_id ?>" class="presentChkBox"
											<?php
											foreach ($attendance as $emp_attendance) {
												if ($emp_attendance) {
													if ($list->emp_p_id == $emp_attendance->emp_ID) {
														echo $emp_attendance->attendance_status == 'P' ? 'checked' : '';
													}
												}
											} ?> />
											<div id="timing" class="m-l-xl">
												<?php
												foreach ($attendance as $emp_attendance) {
													if (!empty($emp_attendance)) {
														if ($list->emp_p_id == $emp_attendance->emp_ID) {
															$inTime = $emp_attendance->in_time;
															$outTime = $emp_attendance->out_time;
														}
													}
												} ?>
												<div class="">
													<div class="col-md-6">
														<div class="input-group clockpicker" data-autoclose="true">
															<span class="input-group-addon bg-danger"><strong>IN</strong></span>
															<input type="text" class="form-control input-sm" name="in[]" value="<?php if(!empty($inTime)){ echo $inTime; }else{ echo '09:30:00'; } ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div class="input-group clockpicker" data-autoclose="true">
															<span class="input-group-addon bg-danger"><strong>OUT</strong></span>
															<input type="text" class="form-control input-sm" name="out[]" value="<?php if(!empty($outTime)){ echo $outTime; }else{ echo '06:00:00'; } ?>">
														</div>
													</div>
												</div>
											</div>
										</td>
										<td>
											<input type="checkbox" id="<?= $list->emp_p_id ?>" value="<?= $list->emp_p_id ?>" class="absentChkBox"
											<?php
											foreach ($attendance as $emp_attendance) {
												if ($emp_attendance) {
													if ($list->emp_p_id == $emp_attendance->emp_ID) {
														echo $emp_attendance->attendance_status == 'L' ? 'checked' : '';
													}
												}
											} ?> />
											<div id="leave" class="m-l-xl">
												<?php $_options = $this->mdl_leave_type->get_all('leave_name'); ?>
												<select name="leave[]" class="form-control input-sm">
												<?php foreach ($_options as $leave): ?>
													<option value="<?php echo $leave->leave_p_id ?>"
													<?php
													foreach ($attendance as $emp_attendance) {
														if ($emp_attendance) {
															if ($list->emp_p_id == $emp_attendance->emp_ID) {
																echo $leave->leave_p_id == $emp_attendance->leave_type_id ? 'selected' : '';
															}
														}
													} ?> ><?php echo $leave->leave_name ?></option>;
												<?php endforeach; ?>
												</select>
											</div>
										</td>
									</tr>
								<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<th>EMP. CODE</th>
										<th>EMPLOYEE NAME</th>
										<th>ATTENDANCE</th>
										<th>LEAVE</th>
									</tr>
								</tfoot>
							</table>

							<div class="hr-line-dashed"></div>

							<div class="text-right">
								<button type="submit" class="btn bg-danger"> <i class="fa fa-save"></i> Update</button>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
