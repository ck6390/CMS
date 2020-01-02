<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
	echo form_open("students/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Student</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('admission-number')) echo 'has-error'; ?>">
									<?php echo form_label('Admission Number <small class="text-danger">*</small>', 'admission-number', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="row">
											<div class="col-md-2 p-xxs">
											<?php 
											echo form_label('Year', 'admission-year', array('class' => 'control-label')); ?>
												<select name="admission-year" id="admission_year" class="form-control frm-inline-inpt2 select2_one" onchange = 'generate_studentId()'>
												<?php  
												$starting_year  =date('Y', strtotime('-10 year'));
												$ending_year = date('Y', strtotime('+80 year'));
												$current_year = date('Y');
												for($starting_year; $starting_year <= $ending_year; $starting_year++) {
												    echo '<option value="'.$starting_year.'"';
												    if( $starting_year ==  $current_year ) {
												            echo ' selected="selected"';
												    }
												    echo ' >'.$starting_year.'</option>';
												}  

												?>
												</select>
											</div>
											<div class="col-md-3 p-xxs">
												<?php 
												echo form_label('Roll', 'roll-number', array('class' => 'control-label'));

												echo form_input(array(
													'type' => 'number',
													'name' => 'roll-number',
													'class' => 'form-control frm-inline-inpt1',
													'id'   => 'student_roll',
													'placeholder' => 'Roll Number',
													'maxlength' =>'4',
													'value' => set_value('roll-number'),
													'onblur' => 'generate_studentId()',
													'required' => 'true',
												));

												echo form_error('roll-number');?>
											</div>
											<div class="col-md-2 p-xxs">
											<?php
												echo form_label('Code', 'college-code', array('class' => 'control-label'));
												echo form_input(array(
													'type' => 'text',
													'name' => 'college-code',
													'id' => 'college_id',
													'class' => 'form-control frm-inline-inpt1',
													'placeholder' => 'College Code',
													'value' => '188',
													'required' => 'true',
													'readonly' => 'true',
												));

												echo form_error('college-code'); ?>
											</div>

											<div class="col-md-3 p-xxs">
											<?php 
											 echo form_label('Branch Code', 'branch-code', array('class' => 'control-label')); 

												$_branch = $this->mdl_branch->dropdown('branch_code','branch_code');
												
												echo form_dropdown(array(
													'name' => 'branch-code',
													'id' => 'branch_id',
													'class' => 'form-control select2_one',
												), $_branch);

												echo form_error('branch-code'); ?>
											</div>
											<div class="col-md-2 p-xxs">
											<?php
												echo form_label('Type', 'student-type', array('class' => 'control-label'));
												$_student_type = array(
													'' => 'Please Select',
													'RE' => 'Regular',
													'LE' => 'Lateral Entry',
												);
												
												echo form_dropdown(array(
													'name' => 'student-type',
													'id' => 'student_type',
													'class' => 'form-control select2_one',
												), $_student_type);

												echo form_error('student-type'); ?>
											</div>
											<small id="validate_roll" class="text-danger col-sm-4"></small>
										</div>
									</div>	
								</div>
							</div>
							<div class="col-md-10">
								<div class="form-group<?php if(form_error('admission-no')) echo 'has-error'; ?>">
									<?php echo form_label('', 'admission-no', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'admission-no',
											'class' => 'form-control',
											'placeholder' => 'Admission Number',
											'id' => 'admission_no',
											'value' => set_value('admission-no'),
											'readonly' => 'true'
										));

										echo form_error('admission-no'); ?>
									</div>
								</div>

								<div class="form-group<?php if(form_error('student-id')) echo 'has-error'; ?>">
									<?php echo form_label('Student ID <small class="text-danger">*</small>', 'student-id', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'student-id',
											'class' => 'form-control',
											'placeholder' => 'Student id',
											'id' => 'student_id',
											'value' => set_value('student-id'),
											'required' => 'true',
											'readonly' => 'true'
										));

										echo form_error('student-id'); ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('admission-date')) echo 'has-error'; ?>">
									<?php echo form_label('Date of Admission <small class="text-danger">*</small>', 'admission-date', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<?php 
											echo form_input(array(
												'type' => 'text',	
												'name' => 'admission-date',
												'id' => 'data_1',
												'class' => 'form-control',
												'placeholder' => 'Date of Admission',
												'value' => set_value('admission-date'),
												'required' => 'true'
											));
											echo form_error('admission-date'); ?>
												
										</div>
									</div>
								</div>

								<div class="form-group <?php if(form_error('branch')) echo 'has-error'; ?>">
									<?php
									
									echo form_label('Branch <small class="text-danger">*</small>', 'branch', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										$_branch = $this->mdl_branch->dropdown('branch_code');
										echo form_dropdown(array(
											'name' => 'branch',
											'class' => 'form-control',
											'placeholder' => 'Branch',
										),$_branch);

										echo form_error('branch'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('semester')) echo 'has-error'; ?>">
									<?php
									
									echo form_label('Semester <small class="text-danger">*</small>', 'semester', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										$_semester = $this->mdl_semester->dropdown('semester_name');
										
										echo form_dropdown(array(
											'name' => 'semester',
											'class' => 'form-control select2_one'
										), $_semester);

										echo form_error('semester'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('session')) echo 'has-error'; ?>">
									
									<?php echo form_label('Academic Session <small class="text-danger">*</small>', 'academic_session', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										$_session = $this->mdl_session->dropdown('session_name');
										
										echo form_dropdown(array(
											'name' => 'session',
											'class' => 'form-control select2_one'
										), $_session);

										echo form_error('session'); ?>
									</div>
								</div>

								<div class="form-group"<?php if(form_error('admission-status')) echo 'has-error'; ?>>
									<?php echo form_label('Admission Status <small class="text-danger">*</small>', 'admission-status', array('class' => 'col-sm-3 control-label'));?>
									<div class="col-sm-9">
										<div class="form-control">
											<div class="i-checks">
												<label> <?php echo form_radio('admission-status', 'provisional', true)." Provisional "; ?> </label>
											</div>
											<?php echo form_error('admission-status'); ?>
										</div>
									</div>	
								</div>

								<div class="form-group <?php if(form_error('student-name')) echo 'has-error'; ?>">
									<?php echo form_label('Student Name <small class="text-danger">*</small>', 'student-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'student-name',
											'class' => 'form-control',
											'placeholder' => 'Student Name',
											'value' => set_value('student-name'),
											'required' => 'true'
										));

										echo form_error('student-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('father-name')) echo 'has-error'; ?>">
									<?php echo form_label('Father\'s Name <small class="text-danger">*</small>', 'father_name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'father-name',
											'class' => 'form-control',
											'placeholder' => 'Father\'s Name',
											'value' => set_value('father-name'),
											'required' => 'true'
										));

										echo form_error('father-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('mother-name')) echo 'has-error'; ?>">
									<?php echo form_label('Mother\'s Name <small class="text-danger">*</small>', 'mother-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'mother-name',
											'class' => 'form-control',
											'placeholder' => 'Mother\'s Name',
											'value' => set_value('mother-name'),
											'required' => 'true'
										));

										echo form_error('mother-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('dob')) echo 'has-error'; ?>">
									<?php echo form_label('Date of Birth <small class="text-danger">*</small>', 'dob', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<?php 
											echo form_input(array(
												'type' => 'text',	
												'name' => 'dob',
												'id' => 'data_1',
												'class' => 'form-control',
												'placeholder' => '2019-05-01',
												'value' => set_value('dob'),
												'required' => 'true'
											));
											echo form_error('dob'); ?>
												
										</div>
									</div>
								</div>
								
								<div class="form-group"<?php if(form_error('gender')) echo 'has-error'; ?>">
									<?php echo form_label('Gender <small class="text-danger">*</small>', 'gender', array('class' => 'col-sm-3 control-label'));?>
									<div class="col-sm-9">
										<div class="form-control">
										<div class="i-checks">
											<label> <?php echo form_radio('gender', 'male', true)." Male "; ?> </label>
										
											<label> <?php echo form_radio('gender', 'female')." Female "; ?> </label>
										</div>
										<?php echo form_error('gender'); ?>
									</div>
									</div>	
								</div>

								<div class="form-group <?php if(form_error('cast-category')) echo 'has-error'; ?>">
									
									<?php echo form_label('Category <small class="text-danger">*</small>', 'cast-category', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										$_cast_category = $this->mdl_cast_category->dropdown('cast_category');
									
										echo form_dropdown(array(
											'name' => 'cast-category',
											'class' => 'form-control select2_one',
											'value' => set_value('cast-category'),
											'required' => 'true'
										),$_cast_category);

										echo form_error('cast-category'); ?>
									</div>
								</div>
								
								<div class="form-group <?php if(form_error('student-sms-no')) echo 'has-error'; ?>">
									<?php echo form_label('Registered Mobile Number ', 'student-sms-no', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
                                        <div class="input-group m-b">
                                        	<span class="input-group-btn">
                                            <button type="button" class="btn btn-primary">+91</button> </span> <?php echo form_input(array(
											'type' => 'tel',
											'name' => 'student-sms-no',
											'class' => 'form-control',
											'placeholder' => 'Mobile Number',
											'value' => set_value('student-sms-no'),
											

										));?>
                                        </div>
                                        <?php echo form_error('student-sms-no'); ?>
                                    </div>
								</div>

								<div class="form-group <?php if(form_error('parents-no')) echo 'has-error'; ?>">
									<?php echo form_label('Parent\'s Mobile Number ', 'parents-no', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
                                        <div class="input-group m-b">
                                        	<span class="input-group-btn">
                                            <button type="button" class="btn btn-primary">+91</button> </span> <?php echo form_input(array(
											'type' => 'tel',
											'name' => 'parents-no',
											'class' => 'form-control',
											'placeholder' => 'Mobile Number',
											'value' => set_value('parents-no'),
											

										));?>
                                        </div>
                                        <?php echo form_error('parents-no'); ?>
                                    </div>
								</div>
								
								<div class="form-group"<?php if(form_error('send_sms')) echo 'has-error'; ?>>

									<?php echo form_label('SMS Send <small class="text-danger">*</small>', 'send_sms', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="form-control">
										<div class="i-checks">
											<label> <?php echo form_radio('send_sms', '1')." Yes "; ?> </label>
										
											<label> <?php echo form_radio('send_sms', '0', true)." No "; ?> </label>
										</div>
										<?php echo form_error('send_sms'); ?>
									</div>
									</div>
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>
						<div class="text-right">
							<button class="btn btn-primary" id="submit_form" type="submit">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>

<!-- generate student id -->
<script type="text/javascript">
	function generate_studentId()
	{
		var year = document.getElementById("admission_year").value;
    	var roll = document.getElementById("student_roll").value;
    	if(roll.length==4){
    		var final_year = year.slice(2,4); 
			var studentId = final_year.concat(roll);
			document.getElementById("student_id").value = studentId;
			document.getElementById("validate_roll").innerHTML = " " ;
			document.getElementById("submit_form").disabled = false;
			return false;
    	}else{
    		document.getElementById("validate_roll").innerHTML = "Roll number should be 4 digit."
    		document.getElementById("submit_form").disabled = true;
    	} 
    }
</script>

<!-- create admission no. -->
<script type="text/javascript">
$(document).ready(function() {

	$('select[name="student-type"]').on('change', function() {
		var studentType = $(this).val();
		var branchID = $('select[name="branch-code"]').val();
		var admissionYear = $('select[name="admission-year"]').val();
		var rollNumber  = $('input[name="roll-number"]').val();
		var collegeCode  = $('input[name="college-code"]').val();
		var admissionNo = admissionYear+"/"+rollNumber+"/"+collegeCode+"/"+branchID+"/"+studentType;
		
		if(rollNumber ==""){
           alert("Please Enter Roll Number");
		}else{

			$('input[name="admission-no"]').val(admissionNo);
		}
	});
});

// fetch branch from branch code choosen during creating admisssion no 
$(document).ready(function(){
	$('select[name="branch-code"]').on('change', function(){
		var branchID = $(this).val();
		if (branchID) {

			$('input[name="branch"]').val(branchID);
		}else{
			alert("Please Choose Branch Carefully");
		}

	});
});

</script>