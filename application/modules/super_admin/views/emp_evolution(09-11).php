<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}/faculty_profile/{$this->uri->segment('3')}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Evolution Report</strong>
			</li>
		</ol>
	</div>
	
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Employee Basic Details</h5>
				<div class="ibox-tools">
					<small><code>*</code> Required Fields.</small>
				</div>
			</div>
			<div class="ibox-content">
				<table class="table table-bordered table-hover">
                    <tbody>
	                    <tr>
	                    	<td><strong>Employee Name</strong></td>
	                       	<td><?php echo $info->emp_name." ( ".$info->username." ) "; ?></td>
	                    </tr>
	                    <tr>
	                    	<td><strong>Designation</strong></td>
							<td><?php echo $this->mdl_dept->get($info->emp_department_ID)->dept_name; ?></td>
	                    </tr>
	                    <tr>
	                    	<td><strong>Department</strong></td>
	                       	<td><?php echo $this->mdl_desg->get($info->emp_designation_ID)->desg_name; ?></td>
	                    </tr>
	                    <tr>
	                    	<td><strong>Employee Type</strong></td>
	                       	<td><?php echo $this->mdl_empe_type->get($info->emp_type)->employee_type_name; ?></td>
	                    </tr>
                    </tbody>
                </table>
			</div>
		</div>
    </div>
    <div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Attributes List</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover ">
							<thead>
								<tr>
								
									<th>Attributes</th>
									<th>Max Points </th>
									<th>Obtained Points</th>
									
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td><?php echo form_label('TEACHING SKILLS', 'student-attendance');?></td>
									<td>10</td>
									<td class="col-md-3 <?php if(form_error('student-attendance')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'student-attendance',
											'class' => 'form-control ',
											'placeholder' => 'student attendance',
											'value' => set_value('student-attendance'),
											'required' => 'true'
										));
										echo form_error('student-attendance'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('AVERAGE NO OF STUDENT CLEAR THE RESPECTIVE SUBJECT IN SEMESTER ', 'student-attendance');?></td>
									<td>10</td>
									<td class="col-md-3 <?php if(form_error('student-attendance')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'student-attendance',
											'class' => 'form-control ',
											'placeholder' => 'student attendance',
											'value' => set_value('student-attendance'),
											'required' => 'true'
										));
										echo form_error('student-attendance'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('EXTRA CORECULAM ACTIVITY INVOLVEMENT IN EXTRACARICULAM ACTIVITY', 'student-attendance');?></td>
									<td>10</td>
									<td class="col-md-3 <?php if(form_error('student-attendance')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'student-attendance',
											'class' => 'form-control ',
											'placeholder' => 'student attendance',
											'value' => set_value('student-attendance'),
											'required' => 'true'
										));
										echo form_error('student-attendance'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('DEDICATION TOWARDS COLLEGE ', 'student-attendance');?></td>
									<td>10</td>
									<td class="col-md-3 <?php if(form_error('student-attendance')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'student-attendance',
											'class' => 'form-control ',
											'placeholder' => 'student attendance',
											'value' => set_value('student-attendance'),
											'required' => 'true'
										));
										echo form_error('student-attendance'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('STUDENT FACULTY RELATION', 'student-attendance');?></td>
									<td>10</td>
									<td class="col-md-3 <?php if(form_error('student-attendance')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'student-attendance',
											'class' => 'form-control ',
											'placeholder' => 'student attendance',
											'value' => set_value('student-attendance'),
											'required' => 'true'
										));
										echo form_error('student-attendance'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('MORAL & BEHAVIORS', 'student-attendance');?></td>
									<td>10</td>
									<td class="col-md-3 <?php if(form_error('student-attendance')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'student-attendance',
											'class' => 'form-control ',
											'placeholder' => 'student attendance',
											'value' => set_value('student-attendance'),
											'required' => 'true'
										));
										echo form_error('student-attendance'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('NUMBER OF STUDENT PERSENT IN CLASS ', 'student-attendance');?></td>
									<td>10</td>
									<td class="col-md-3 <?php if(form_error('student-attendance')) echo 'has-error'; ?>">
										<?php 
										$total_student = 0;
										$present_student = 0;
										foreach($lists as $list)
										{
											$obj = json_decode($list->lecture_student_attendance,true);
											$total_student = $total_student + count($obj);
											foreach($obj as $student)
											{
												if($student['attance_status'] == "P"){

													$present_student = $present_student + count($student['attance_status']);
												}
												
											}
										}
										if($total_student != '0'){
											$point = (($present_student)/($total_student))*10;
										}else{
											$point ='0';
										}
										
										echo form_input(array(
											'type' => 'text',
											'name' => 'student-attendance',
											'class' => 'form-control ',
											'placeholder' => 'student attendance',
											'value' => set_value('student-attendance',$point),
											'required' => 'true'
										));
										echo form_error('student-attendance'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('CASUAL LEAVE ', 'cl-point');?></td>
									<td>10</td>
									<td class="col-md-3 <?php if(form_error('cl-point')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'cl-point',
											'class' => 'form-control ',
											'placeholder' => 'cl',
											'value' => set_value('cl-point'),
											'required' => 'true'
										));
										echo form_error('cl-point'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('LEAVE WITHOUT PAY', 'lwp-point');?></td>
									<td>10</td>
									<td class="col-md-3 <?php if(form_error('lwp-point')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'lwp-point',
											'class' => 'form-control ',
											'placeholder' => 'LWP',
											'value' => set_value('lwp-point'),
											'required' => 'true'
										));
										echo form_error('lwp-point'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('YEAR OF EXPERIENCE IN GANGA MEMORIAL COLLEGE OF POLYTECHNIC', 'experience');?></td>
									<td>10</td>
									<td class="col-md-3 <?php if(form_error('experience')) echo 'has-error'; ?>">
										<?php 

										$datetime1 = new DateTime($info->emp_joined_date); 
 										$datetime2 = new DateTime();
 										$interval = $datetime1->diff($datetime2);
 										

										echo form_input(array(
											'type' => 'text',
											'name' => 'experience',
											'class' => 'form-control ',
											'placeholder' => 'experience from date of joining',
											'value' => set_value('experience',number_format($interval->days / 365, 2)),
											'required' => 'true'
										));
										echo form_error('experience'); ?>
									</td>
								</tr>
							</tbody>	
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>