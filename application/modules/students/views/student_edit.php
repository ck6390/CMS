<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize">Student Edit<!-- <?= $this->misc->_getClassName(); ?> --></span></h2>
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
		<div class="title-action">
			<a href="<?= site_url("{$this->misc->_getClassName()}/profile/{$info->student_p_id}") ?>" class="btn btn-primary"><i class="fa fa-eye"></i>  View Profile</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'edit-form',
		'enctype' => 'multipart/form-data',
		'class' => 'form-horizontal'
	);
	echo form_open("{$this->misc->_getClassName()}/edit/$info->student_p_id", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Upload Students Details</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-md-4 b-r">
									<div class="form-group <?php if(form_error('left-thumb')) echo 'has-error'; ?>">
										<div class="col-md-10 col-md-offset-1">
											<?php
											echo form_label('Left Thumb', 'left-thumb');

											echo form_input(array(
												'type' => 'file',
												'name' => 'left-thumb',
												'id' => 'thumb_id',
												'class' => 'form-control',
												'onchange' => 'thumbImage(this);'
												//'required' => 'true'

											));
											echo form_input(array(
												'type' => 'hidden',
												'name' => 'previous-thumb',
												'value' => set_value('left-thumb', $info->student_left_thumb)
												
											)); 
											echo form_error('left-thumb');?>

											<img id="preview_thumb" class="img-responsive" />
											<img src="<?= base_url().'assets/img/students/'.$info->student_unique_id.'/'.$info->student_left_thumb ?>" id="preview" class="img-responsive">
										</div>
									</div>
								</div>
								<div class="col-md-4 b-r">
									<div class="form-group <?php if(form_error('student-photo')) echo 'has-error'; ?>">
										<div class="col-md-10 col-md-offset-1">
											<?php
											echo form_label('Student Photo', 'student-photo');

											echo form_input(array(
												'type' => 'file',
												'name' => 'student-photo',
												'id' => 'photo_id',
												'class' => 'form-control',
												'onchange' => 'photoImage(this);'
												//'required' => 'true'
											));
											echo form_input(array(
												'type' => 'hidden',
												'name' => 'previous-photo',
												'value' => set_value('student-photo', $info->student_photo)
												
											));

											echo form_error('student-photo'); ?>

											<img id="preview_photo" class="img-responsive" />
											<div class="col-md-offset-3">
												<img src="<?= base_url().'assets/img/students/'.$info->student_unique_id.'/'.$info->student_photo ?>" id="preview1" class="img-responsive">
											</div>
										</div>
									</div>
									<!-- <input type="hidden" name="student-photo" value="<?= base_url().'assets/img/students/'.$info->student_unique_id.'/'.$info->student_photo ?>"> -->
								</div>
								<div class="col-md-4">
									<div class="form-group <?php if(form_error('student-sign')) echo 'has-error'; ?>">
										<div class="col-md-10 col-md-offset-1">
											<?php
											echo form_label('Student Sign', 'student-sign');

											echo form_input(array(
												'type' => 'file',
												'name' => 'student-sign',
												'id' => 'sign_id',
												'class' => 'form-control',
												'onchange' => 'signImage(this);'
												//'required' => 'true'
											));
											echo form_input(array(
												'type' => 'hidden',
												'name' => 'previous-sign',
												'value' => set_value('student-sign', $info->student_sign)
												
											));

											echo form_error('student-sign');?>

											<img id="preview_sign" class="img-responsive" />

											<img src="<?= base_url().'assets/img/students/'.$info->student_unique_id.'/'.$info->student_sign ?>" id="preview2" class="img-responsive">
										</div>
									</div>
									<!-- <input type="hidden" name="student-sign" value="<?= base_url().'assets/img/students/'.$info->student_unique_id.'/'.$info->student_sign ?>"> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Student Basic Details</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-md-6 b-r">
									<div class="col-md-12">
										<div class="form-group <?php if(form_error('student-name')) echo 'has-error'; ?>">
											<?php
											echo form_label('Student Name <small class="text-danger">*</small>', 'student-name');
											echo form_input(array(
												'type' => 'text',
												'name' => 'student-name',
												'class' => 'form-control',
												'placeholder' => 'Student Name',
												'value'=> set_value('student-name', $info->student_full_name),
												'required' => 'true'
											));

											echo form_error('student-name'); ?>		
										</div>

										<div class="form-group <?php if(form_error('father-name')) echo 'has-error'; ?>">
											<?php
											echo form_label('Father\'s Name <small class="text-danger">*</small>', 'father-name');
											echo form_input(array(
												'type' => 'text',
												'name' => 'father-name',
												'class' => 'form-control',
												'placeholder' => 'Father\'s Name',
												'value' => set_value('father-name', $info->father_name),
												'required' => 'true'
											));

											echo form_error('father-name'); ?>	
										</div>

										<div class="form-group <?php if(form_error('mother-name')) echo 'has-error'; ?>">
											<?php
											echo form_label('Mother\'s Name <small class="text-danger">*</small>', 'mother-name');
											echo form_input(array(
												'type' => 'text',
												'name' => 'mother-name',
												'class' => 'form-control',
												'placeholder' => 'Mother\'s Name',
												'value' => set_value('mother-name', $info->mother_name),
												'required' => 'true'
											));

											echo form_error('mother-name'); ?>	
										</div>

										<div class="form-group <?php if(form_error('dob')) echo 'has-error'; ?>">
											<?php echo form_label('Date of Birth <small class="text-danger">*</small>', 'dob'); ?>
											
											<div class="input-group date">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<?php 
												echo form_input(array(
													'type' => 'text',	
													'name' => 'dob',
													'id' => 'data_1',
													'class' => 'form-control',
													'placeholder' => 'Date',
													'value' => set_value('dob', $info->dob),
													'required' => 'true'
												));
												echo form_error('dob'); ?>
											</div>	
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-12">
										<div class="form-group <?php if(form_error('cast-category')) echo 'has-error'; ?>">
											<?php echo form_label('Category <small class="text-danger">*</small>', 'cast-category');

											$_cast_category = $this->mdl_cast_category->dropdown('cast_category');
											
												echo form_dropdown(array(
													'name' => 'cast-category',
													'class' => 'form-control select2_one'
												),$_cast_category, $info->fk_cast_category);

												echo form_error('cast-category'); ?>
										</div>

										<div class="form-group <?php if(form_error('gender')) echo 'has-error'; ?>">
											<?php echo form_label('Gender <small class="text-danger">*</small>', 'gender');?>
											
											<div class="form-control">
												<div class="i-checks">
													<label> <?php echo form_radio('gender', 'male', $info->gender == "male" ? true :"")." Male "; ?> </label>
													
													<label> <?php echo form_radio('gender', 'female', $info->gender == "female" ? true :"" )." Female "; ?> </label>
												</div>
											</div>
											<?php echo form_error('gender'); ?>		
										</div>

										<div class="form-group <?php if(form_error('blood-grp')) echo 'has-error'; ?>">
											<?php
											echo form_label('Blood Group', 'blood-grp');
											echo form_input(array(
												'type' => 'text',
												'name' => 'blood-grp',
												'class' => 'form-control',
												'value' => set_value('blood-grp', $info->blood_group),
												'placeholder' => 'Blood Group',
											));

											echo form_error('blood-grp'); ?>		
										</div>

										<div class="form-group <?php if(form_error('identification-mark')) echo 'has-error'; ?>">
											<?php
											echo form_label('Identification Mark', 'visible-marks');
											echo form_input(array(
												'type' => 'text',
												'name' => 'identification-mark',
												'class' => 'form-control',
												'value' => set_value('identification-mark', $info->identification_mark),
												'placeholder' => 'Identification Mark',
											));

											echo form_error('identification-mark'); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Course & College Details</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-md-6 b-r">
									<div class="col-md-12">
										<div class="form-group <?php if(form_error('session')) echo 'has-error'; ?>">
											<?php echo form_label('Session <small class="text-danger">*</small>', 'session');
											$_session = $this->mdl_session->dropdown('session_name');

												echo form_dropdown(array(
													'name' => 'session',
													'class' => 'form-control select2_one',

												),$_session,$info->fk_session_id);

												echo form_error('session'); ?>
										</div>

										<div class="form-group <?php if(form_error('branch')) echo 'has-error'; ?>">
											<?php echo form_label('Branch <small class="text-danger">*</small>', 'branch');

											$_branch = $this->mdl_branch->dropdown('branch_name');
											
												echo form_dropdown(array(
													'name' => 'branch',
													'class' => 'form-control select2_one'
												),$_branch, $info->fk_branch_id);

												echo form_error('branch'); ?>
										</div>

										<div class="form-group <?php if(form_error('semester')) echo 'has-error'; ?>">
											<?php echo form_label('Semester <small class="text-danger">*</small>', 'semester');

											$_semester = $this->mdl_semester->dropdown('semester_name');
											
												echo form_dropdown(array(
													'name' => 'semester',
													'class' => 'form-control select2_one'
												),$_semester, $info->fk_semester_id);

												echo form_error('semester'); ?>
										</div>

										<div class="form-group <?php if(form_error('course-year')) echo 'has-error'; ?>">
											<?php echo form_label('Course Year <small class="text-danger">*</small>', 'course-year');

											$_year = $this->mdl_course_year->dropdown('course_year_name');
											
												echo form_dropdown(array(
													'name' => 'course-year',
													'class' => 'form-control select2_one'
												),$_year, $info->fk_course_year_id);

												echo form_error('course-year'); ?>
										</div>

										<div class="form-group <?php if(form_error('registration-number')) echo 'has-error'; ?>">
											<?php
											echo form_label('Registration Number', 'registration-number');
											echo form_input(array(
												'type' => 'text',
												'name' => 'registration-number',
												'class' => 'form-control',
												'placeholder' => 'Registration Number',
												'value' => set_value('registration-number', $info->registration_no)
												
											));

											echo form_error('registration-number'); ?>
												
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-12">
										<div class="form-group <?php if(form_error('student-id')) echo 'has-error'; ?>">
											<?php
											echo form_label('Student ID <small class="text-danger">*</small>', 'register-number');
											echo form_input(array(
												'type' => 'text',
												'name' => 'student-id',
												'class' => 'form-control',
												'placeholder' => 'Student ID',
												'value' => set_value('student-id', $info->student_unique_id),
												'readonly' => 'true'
											));

											echo form_error('student-id'); ?>
											
										</div>

										<div class="form-group <?php if(form_error('admission-date')) echo 'has-error'; ?>">
											<?php echo form_label('Date of Admission <small class="text-danger">*</small>', 'admission-date'); ?>
											
											<div class="input-group date">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<?php 
												echo form_input(array(
													'type' => 'text',	
													'name' => 'admission-date',
													'id' => 'data_1',
													'class' => 'form-control',
													'placeholder' => 'Date of Admission',
													'value' => set_value('admission-date', $info->admission_date),
													'required' => 'true'
												));
												echo form_error('admission-date'); ?>
												
											</div>
										</div>

										<div class="form-group <?php if(form_error('admission-number')) echo 'has-error'; ?>">
											<?php
											if($this->session->userdata('roleID') == 1){
												$readonly = "";
											}else{
												$readonly = 'readonly="true"';
											}
											echo form_label('Admission Number <small class="text-danger">*</small>', 'admission-number');
											/*echo form_input(array(
												'type' => 'text',
												'name' => 'admission-number',
												'class' => 'form-control',
												'placeholder' => 'Admission Number',
												'value' => set_value('admission-number', $info->admission_no),
												'required' => 'true'												
											));*/?>
											<input type="text" name="admission-number" class="form-control" placeholder="placeholder" <?= $readonly ?> value="<?= $info->admission_no ?>"><?php echo form_error('admission-number'); ?>
										</div>

										<div class="form-group <?php if(form_error('counselor-id')) echo 'has-error'; ?>">
											<?php
											echo form_label('Counselor ID <small class="text-danger">*</small>', 'counselor-id');
											echo form_input(array(
												'type' => 'text',
												'name' => 'counselor-id',
												'class' => 'form-control',
												'value' => set_value('counselor-id', $info->counselor_id),
												'placeholder' => 'Counselor ID',
												'required' => 'true'
											));

											echo form_error('counselor-id'); ?>
												
										</div>

										<div class="form-group <?php if(form_error('admission-status')) echo 'has-error'; ?>">
											<?php echo form_label('Admission Status <small class="text-danger">*</small>', 'admission-status');?>
											
											<div class="form-control">
												<div class="i-checks">
													<label> <?php echo form_radio('admission-status', 'provisional', $info->admission_status == "provisional" ? true :"")." Provisional "; ?> </label>
													
													<label> <?php echo form_radio('admission-status', 'final', $info->admission_status == "final" ? true :"" )." Final "; ?> </label>

													<label> <?php echo form_radio('admission-status', 'pending', $info->admission_status == "pending" ? true :"" )." Pending "; ?> </label>

													<label> <?php echo form_radio('admission-status', 'passout', $info->admission_status == "passout" ? true :"" )." Passout "; ?> </label>
												</div>
											</div>
											<?php echo form_error('admission-status'); ?>		
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Student Details & Reference</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6 b-r">
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('parent-contact')) echo 'has-error'; ?>">

										<?php echo form_label('Parent/Father\'s Mobile no. <small class="text-danger">*</small>', 'parent-contact');
									
										echo form_input(array(
											'type' => 'tel',
											'name' => 'parent-contact',
											'class' => 'form-control',
											'placeholder' => 'Parent Mobile no. *',
											'value' => set_value('parent-contact', $info->student_parents_no),
											'required' => 'true'
										));

										echo form_error('parent-contact'); ?>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								
								<?php 
								echo form_label('(optional)');
								echo form_input(array(
									'type' => 'tel',
									'name' => 'parent-contact2',
									'class' => 'form-control',
									'placeholder' => 'Parent Mobile no.2',
									'value' => set_value('parent-contact', $info->parents_mobile_2),
								));
								echo form_error('parent-contact'); ?>
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 b-r">
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('student-contact')) echo 'has-error'; ?>">
									
										<?php echo form_label('Student Mobile no. <small class="text-danger">*</small>', 'student-contact'); 
										
										echo form_input(array(
											'type' => 'tel',
											'name' => 'student-contact',
											'class' => 'form-control',
											'placeholder' => 'Student Mobile no. *',
											'value' => set_value('student-contact', $info->student_sms_no),
											'required' => 'true'
										));

										echo form_error('student-contact'); ?>
									</div>
								</div>
							</div>
							<div class="col-md-6">
									<?php
									echo form_label('(optional))'); 
									echo form_input(array(
										'type' => 'tel',
										'name' => 'student-contact2',
										'class' => 'form-control',
										'placeholder' => 'Student Mobile no.2',
										'value' => set_value('student-contact', $info->student_mobile_2),
										// 'required' => 'true'
									));

									echo form_error('student-contact'); ?>
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 b-r">
								<div class="col-md-12">

									<div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
										<?php echo form_label('Email', 'email');

										echo form_input(array(
											'type' => 'email',
											'name' => 'email',
											'class' => 'form-control',
											'placeholder' => 'Email',
											'value' => set_value('email', $info->student_email),
											// 'required' => 'true'
										));

										echo form_error('email'); ?>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('adhar-no')) echo 'has-error'; ?>">
									
										<?php echo form_label('Adhar Number <small class="text-danger">*</small>', 'adhar-no');

										echo form_input(array(
											'type' => 'text',
											'name' => 'adhar-no',
											'class' => 'form-control',
											'placeholder' => 'Adhar Number',
											'value' => set_value('adhar-no', $info->adhar_number),
											'required' => 'true'
										));

										echo form_error('adhar-no'); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 b-r">
								<div class="col-md-12">

									<div class="form-group <?php if(form_error('local-guardian')) echo 'has-error'; ?>">
									
										<?php echo form_label('Local Guardian Name', 'local-guardian');

										echo form_input(array(
											'type' => 'text',
											'name' => 'local-guardian',
											'class' => 'form-control',
											'placeholder' => 'Local Guardian Name',
											'value' => set_value('local-guardian', $info->local_guardian)
											// 'required' => 'true'
										));

										echo form_error('local-guardian'); ?>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-12">

									<div class="form-group <?php if(form_error('guardian-relation')) echo 'has-error'; ?>">
									
										<?php echo form_label('Relationship', 'guardian-relation');

										echo form_input(array(
											'type' => 'text',
											'name' => 'guardian-relation',
											'class' => 'form-control',
											'placeholder' => 'Relation With Applicant',
											'value' => set_value('guardian-relation', $info->guardian_relationship)
											// 'required' => 'true'
										));

										echo form_error('guardian-relation'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 b-r">
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('login-pin')) echo 'has-error'; ?>">
									
										<?php echo form_label('Login Pin <small class="text-danger">*</small>', 'login-pin');

										echo form_input(array(
											'type' => 'text',
											'name' => 'login-pin',
											'class' => 'form-control',
											'placeholder' => 'Local Guardian Name',
											'value' => set_value('login-pin', $info->login_pin),
											'required' => 'true'
										));

										echo form_error('login-pin'); ?>
										<small class="text-danger">(max 4 digit pin)</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('nationality')) echo 'has-error'; ?>">
											<?php
											echo form_label('Nationality <small class="text-danger">*</small>', 'nationality');
											echo form_input(array(
												'type' => 'text',
												'name' => 'nationality',
												'class' => 'form-control',
												'placeholder' => 'Nationality',
												'value' => set_value('nationality', $info->nationality),
												'required' => 'true'
											));

											echo form_error('nationality'); ?>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Student Address Detail</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-6 b-r">
								<div>
									<span class="label label-primary" style="font-size: 12px;">Correspondence Address Details:</span>
								</div><br>
								
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('locality')) echo 'has-error'; ?>">
										<?php echo form_label('Locality <small class="text-danger">*</small>', 'locality'); 
										echo form_input(array(
											'type' => 'text',
											'name' => 'locality',
											'class' => 'form-control',
											'id' => 'locality',
											'placeholder' => 'Locality',
											'value' => set_value('locality', $info->l_locality),
											'required' => 'true'
										));

										echo form_error('locality'); ?>
									</div>
								
									<div class="form-group <?php if(form_error('local-post-office')) echo 'has-error'; ?>">
										<?php echo form_label('Post Office <small class="text-danger">*</small>', 'local-post-office'); 
										echo form_input(array(
											'type' => 'text',
											'name' => 'local-post-office',
											'class' => 'form-control',
											'id' => 'local_post_office',
											'placeholder' => 'Post Office',
											'value' => set_value('local-post-office', $info->local_post_office),
											'required' => 'true'
										));

										echo form_error('local-post-office'); ?>
									</div>

									<div class="form-group <?php if(form_error('local-district')) echo 'has-error'; ?>">
										<?php
										echo form_label('District <small class="text-danger">*</small>', 'local-district'); 
										echo form_input(array(
											'type' => 'text',
											'name' => 'local-district',
											'class' => 'form-control',
											'placeholder' => 'District',
											'id' => 'local_district',
											'value' => set_value('local-district', $info->local_district),
											'required' => 'true'
										));

										echo form_error('local-district'); ?>
											
									</div>

									<div class="form-group <?php if(form_error('local-state')) echo 'has-error'; ?>">
										<?php
										echo form_label('State <small class="text-danger">*</small>', 'local-state');
										echo form_input(array(
											'type' => 'text',
											'name' => 'local-state',
											'class' => 'form-control',
											'id' => 'local_state',
											'placeholder' => 'State',
											'value' => set_value('local-state', $info->local_state),
											'required' => 'true'
										));

										echo form_error('local-state'); ?>
											
									</div>

									<div class="form-group <?php if(form_error('local-pin-code')) echo 'has-error'; ?>">
										<?php echo form_label('Pin Code <small class="text-danger">*</small>', 'local-pin-code');
										echo form_input(array(
											'type' => 'text',
											'name' => 'local-pin-code',
											'class' => 'form-control',
											'id' => 'local_pin_code',
											'placeholder' => 'Pin Code',
											'value' => set_value('local-pin-code', $info->local_pin_code),
											'required' => 'true'
										));

										echo form_error('local-pin-code'); ?>
											
									</div>
									<input type="checkbox" name="filltoo" id="filltoo" onclick="filladdress()">
									<em>Check this box if Correspondence Address and Permanent Address are the same.</em>
								</div>
							</div>

							<div class="col-sm-6">
								<div>
									<span class="label label-primary" style="font-size: 12px;">Permanent Address Details:</span>
								</div><br>
								<div class="col-md-12">
									<div class="form-group <?php if(form_error('permanent-locality')) echo 'has-error'; ?>">
										<?php echo form_label('Locality <small class="text-danger">*</small>', 'permanent-locality'); 
										echo form_input(array(
											'type' => 'text',
											'name' => 'permanent-locality',
											'class' => 'form-control',
											'id' => 'permanent_locality',
											'placeholder' => 'Locality',
											'value' => set_value('permanent-locality', $info->p_locality),
											'required' => 'true'
										));

										echo form_error('permanent-locality'); ?>
									</div>
									
									<div class="form-group <?php if(form_error('permanent-post-office')) echo 'has-error'; ?>">
										<?php echo form_label('Post Office <small class="text-danger">*</small>', 'permanent-post-office'); 
										echo form_input(array(
											'type' => 'text',
											'name' => 'permanent-post-office',
											'class' => 'form-control',
											'id' => 'permanent_post_office',
											'placeholder' => 'Post Office',
											'value' => set_value('permanent-post-office', $info->p_post_office),
											'required' => 'true'
										));

										echo form_error('permanent-post-office'); ?>
									</div>

									<div class="form-group <?php if(form_error('permanent-district')) echo 'has-error'; ?>">
										<?php
										echo form_label('District <small class="text-danger">*</small>', 'permanent-district'); 
										echo form_input(array(
											'type' => 'text',
											'name' => 'permanent-district',
											'class' => 'form-control',
											'id' => 'permanent_district',
											'placeholder' => 'District',
											'value' => set_value('permanent-district', $info->p_district),
											'required' => 'true'
										));

										echo form_error('permanent-district'); ?>
												
									</div>

									<div class="form-group <?php if(form_error('permanent-state')) echo 'has-error'; ?>">
										<?php
										echo form_label('State <small class="text-danger">*</small>', 'permanent-state');
										echo form_input(array(
											'type' => 'text',
											'name' => 'permanent-state',
											'class' => 'form-control',
											'id' => 'permanent_state',
											'placeholder' => 'State',
											'value' => set_value('permanent-state', $info->p_state),
											'required' => 'true'
										));

										echo form_error('permanent-state'); ?>
												
									</div>

									<div class="form-group <?php if(form_error('permanent-pin-code')) echo 'has-error'; ?>">
										<?php echo form_label('Pin Code <small class="text-danger">*</small>', 'permanent-pin-code');
										echo form_input(array(
											'type' => 'text',
											'name' => 'permanent-pin-code',
											'class' => 'form-control',
											'id' => 'permanent_pin_code',
											'placeholder' => 'Pin Code',
											'value' => set_value('permanent-pin-code', $info->p_pin_code),
											'required' => 'true'
										));

										echo form_error('permanent-pin-code'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Qualification Details</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-md-1 b-r">
									<div class="col-md-12">
										<div class="form-group">
											<?php echo form_label('Class', 'class');?>
										</div>
										<div class="form-group">
											<?php echo form_label('10th', 'hsc');?>
										</div>
										<div class="form-group">
											<?php echo form_label('12th', 'ssc');?>
										</div>
										<div class="form-group">
											<?php echo form_label('ITI', 'iti');?>
										</div>
									</div>
								</div>
								<div class="col-md-3 b-r">
									<div class="col-md-12">
										<div class="form-group">
											<?php echo form_label('Name of Board', '10th-board-name');
												echo form_input(array(
													'type' => 'text',
													'name' => '10th-board-name',
													'id' => 'hsc_board_id',
													'class' => 'form-control',
													'placeholder' => '10th',
													'value' => set_value('10th-board-name', $info->hsc_board),
													// 'required' => 'true'
												));
												echo form_error('10th-board-name');
											?><br>
											<?php 
												echo form_input(array(
													'type' => 'text',
													'name' => '12th-board-name',
													'id' => 'ssc_board_id',
													'class' => 'form-control',
													'placeholder' => '12th',
													'value' => set_value('12th-board-name', $info->ssc_board),
												));
												echo form_error('12th-board-name');
											?><br>
											<?php
												echo form_input(array(
													'type' => 'text',
													'name' => 'graduate-board-name',
													'class' => 'form-control',
													'placeholder' => 'Graduate',
													'value' => set_value('graduate-board-name', $info->graduate_board),
												));
												echo form_error('graduate-board-name');

											?>
										</div>
									</div>
								</div>

								<div class="col-md-2 b-r">
									<div class="col-md-12">
										<div class="form-group">
											<?php echo form_label('Subject/Stream', '10th-subject-stream');
												echo form_input(array(
													'type' => 'text',
													'name' => '10th-subject-stream',
													'class' => 'form-control',
													'placeholder' => 'Subject/Stream',
													'value' => set_value('10th-subject-stream', $info->hsc_stream),
												));
												echo form_error('10th-subject-stream');
											?><br>
											<?php
												echo form_input(array(
													'type' => 'text',
													'name' => '12th-subject-stream',
													'class' => 'form-control',
													'placeholder' => 'Subject/Stream',
													'value' => set_value('12th-subject-stream', $info->ssc_stream),
												));
												echo form_error('12th-subject-stream');
											?><br>
											<?php
												echo form_input(array(
													'type' => 'text',
													'name' => 'graduate-subject-stream',
													'class' => 'form-control',
													'placeholder' => 'Subject/Stream',
													'value' => set_value('graduate-subject-stream', $info->graduate_stream),
												));
											
												echo form_error('graduate-subject-stream'); 
											?>
										</div>
									</div>
								</div>

								<div class="col-md-3 b-r">
									<div class="col-md-12">
										<div class="form-group">
											<?php echo form_label('Year of Passing', '10th-passing-year');?>
												<div class="input-group date">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													<?php 
													echo form_input(array(
														'type' => 'text',	
														'name' => '10th-passing-year',
														'id' => 'data_1',
														'class' => 'form-control',
														'placeholder' => 'Passing Year',
														'value' => set_value('10th-passing-year', $info->hsc_passing_year),
														// 'required' => 'true'
													));
													echo form_error('10th-passing-year'); ?>
												
												</div>
											<br>
											<div class="input-group date">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<?php 
													echo form_input(array(
														'type' => 'text',	
														'name' => '12th-passing-year',
														'id' => 'data_1',
														'class' => 'form-control',
														'placeholder' => 'Passing Year',
														'value' => set_value('12th-passing-year', $info->ssc_passing_year),
														
														));
													echo form_error('12th-passing-year');
												?>
												
											</div><br>
											<div class="input-group date">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<?php 
													echo form_input(array(
														'type' => 'text',	
														'name' => 'graduate-passing-year',
														'id' => 'data_1',
														'class' => 'form-control',
														'placeholder' => 'Passing Year',
														'value' => set_value('graduate-passing-year', $info->graduate_passing_year),
													
													));
													echo form_error('graduate-passing-year'); 
												?>
												
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="col-md-12">
										<div class="form-group">
											<?php echo form_label('Marks %', 'marks');
												echo form_input(array(
													'type' => 'text',
													'name' => '10th-marks',
													'class' => 'form-control',
													'placeholder' => 'Marks',
													'value' => set_value('10th-marks', $info->hsc_percentage_marks),
													// 'required' => 'true'
												));
												echo form_error('10th-marks'); 
											?><br>
											<?php
												echo form_input(array(
													'type' => 'text',
													'name' => '12th-marks',
													'class' => 'form-control',
													'placeholder' => 'Marks',
													'value' => set_value('12th-marks', $info->ssc_percentage_marks),
												));
												echo form_error('12th-marks'); 
											?><br>
											<?php
												echo form_input(array(
													'type' => 'text',
													'name' => 'graduate-marks',
													'class' => 'form-control',
													'placeholder' => 'Marks',
													'value' => set_value('graduate-marks', $info->graduate_percentage_marks),
												));
											
												echo form_error('graduate-marks'); 
											?>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Certificate Check List</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group <?php if(form_error('matriculation')) echo 'has-error'; ?>">
									<div class="col-md-2">
										<?php echo form_label('Matriculation ', 'matriculation'); ?>
									</div>
										
									<div class="col-sm-10">
										<div class="i-checks">
											<div class="col-md-2">

												<label> <?php echo form_checkbox('hsc-marksheet', '1', $info->hsc_marksheet == "1" ? true :"", 'id = "hsc_marks_id"')." Marksheet "; ?> </label>
											</div>
												<?php echo form_error('hsc-marksheet'); ?>

												
											<div class="col-md-2">
												<label> <?php echo form_checkbox('hsc-slc', '1', $info->hsc_slc == "1" ? true :"", 'id = "hsc_slc_id"')." SLC ";?> </label>
											</div>
												<?php echo form_error('hsc-slc'); ?>

											<div class="col-md-2">
												<label> <?php echo form_checkbox('hsc-provisional', '1', $info->hsc_provisional == "1" ? true :"")." Provisional "; ?> </label>
											</div>
											<?php echo form_error('hsc-provisional'); ?>

											<div class="col-md-2">
												<label> <?php echo form_checkbox('hsc-migration', '1', $info->hsc_migration == "1" ? true :"", 'id = "hsc_mig_id"')." Migration "; ?> </label>
											</div>
											<?php echo form_error('hsc-migration'); ?>

											<div class="col-md-2">
												<label> <?php echo form_checkbox('hsc-admit-card', '1', $info->hsc_admit_card == "1" ? true :"")." Admit Card "; ?> </label>
											</div>
											<?php echo form_error('hsc-admit-card'); ?>

										</div>
									</div>
								</div>

								<div class="form-group <?php if(form_error('intermediate')) echo 'has-error'; ?>">
									<div class="col-md-2">
										<?php echo form_label('Intermediate ', 'intermediate'); ?>
									</div>
										
									<div class="col-sm-10">
										<div class="i-checks">
											<div class="col-md-2">
												<label> <?php echo form_checkbox('ssc-marksheet', '1', $info->ssc_marksheet == "1" ? true :"", 'id ="marks_id"')." Marksheet "; ?> </label>
											</div>
											
											<div class="col-md-2">
												
												<label> <?php echo form_checkbox('ssc-clc', '1', $info->ssc_slc == "1" ? true :"", 'id ="clc_id"') ." CLC "; ?> </label>
												
											</div>
											<div class="col-md-2">
												<label> <?php echo form_checkbox('ssc-provisional', '1', $info->ssc_provisional == "1" ? true :"")." Provisional "; ?> </label>
											</div>
											
											<div class="col-md-2">
												
												<label> <?php echo form_checkbox('ssc-migration', '1', $info->ssc_migration == "1" ? true :"", 'id ="mig_id"')." Migration "; ?> </label>
												
											</div>
											<div class="col-md-2">
												<label> <?php echo form_checkbox('ssc-admit-card', '1', $info->ssc_admit_card == "1" ? true :"")." Admit Card "; ?> </label>
											</div>
										</div>
												<?php echo form_error('intermediate'); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
						<div class="row text-right">
							<div class="col-md-4 pull-right">
								<div class="text-right col-xs-6">
									<div class="i-checks">
										<label> <?php echo form_checkbox('final_save', '1', $info->final_submit == "1" ? true :"",'id ="final_save"')." Final Save "; ?> </label>
									</div>
								</div>
								<div class="text-right col-xs-6">						
									<button class="btn btn-primary" id="edit_form" type="submit">Save</button>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
	function filladdress()
	{
		if(filltoo.checked == true)
     	{	
     		
            var lVillage =document.getElementById("locality").value;
			var lPO =document.getElementById("local_post_office").value;
			var ldistrict =document.getElementById("local_district").value;
			var lState =document.getElementById("local_state").value;
			var lPincode =document.getElementById("local_pin_code").value;
            document.getElementById("permanent_locality").value = lVillage;
            document.getElementById("permanent_post_office").value = lPO;
            document.getElementById("permanent_district").value = ldistrict;
            document.getElementById("permanent_state").value = lState;
            document.getElementById("permanent_pin_code").value = lPincode;
		}
	 	else if(filltoo.checked == false)
	 	{
			document.getElementById("permanent_locality").value='';
			document.getElementById("permanent_post_office").value='';
			document.getElementById("permanent_district").value='';
			document.getElementById("permanent_state").value='';
			document.getElementById("permanent_pin_code").value='';
	 	}
	}
</script>
<script type="text/javascript">
        function thumbImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview_thumb').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function photoImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview_photo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function signImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview_sign').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function(){
		  	$("#thumb_id").click(function(){	
		    	$("#preview").hide();
		    		
		  	});
		  	$("#photo_id").click(function(){	
		    	$("#preview1").hide();
		    		
		  	});
		  	$("#sign_id").click(function(){	
		    	$("#preview2").hide();
		    		
		  	});
		  	
		});

		

    </script>
    <script type="text/javascript">
    	$(document).ready(function(){

			$('input[name="10th-board-name"]').blur(function() {
				//alert('board_id');
				var hscdata = $(this).val();
				alert(hscdata);
				if(hscdata == ""){
					//$("#hsc_marks_id").attr('required',false);
					$("#hsc_slc_id").attr('required',false);
					//$("#hsc_mig_id").attr('required',false);
					
					
				}else{
					//$("#hsc_marks_id").attr('required',true);
					$("#hsc_slc_id").attr('required',true);
					//$("#hsc_mig_id").attr('required',true);
				}
				
				
			});

			$('input[name="12th-board-name"]').on('change', function()  {
				var sscdata = $(this).val();
				
				if(sscdata == ""){
					//$("#marks_id").attr('required',false);
					$("#clc_id").attr('required',false);
					//$("#mig_id").attr('required',false);
				}else{
					//$("#marks_id").attr('required',true);
					$("#clc_id").attr('required',true);
					//$("#mig_id").attr('required',true);
					
					
				}
				
				
			});
			
			

		});
    </script>
