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
		'enctype' => 'multipart/form-data',
		'class' => ''
	);
	echo form_open("{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Employee <small>(Basic Information)</small></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-3 b-r">
								<div class="form-group <?php if(form_error('employee-id')) echo 'has-error'; ?>">
									<?php
									echo form_label('Employee ID <small class="text-danger">*</small>', 'employee-id');

									echo form_input(array(
										'type' => 'text',
										'name' => 'employee-id',
										'id' => 'emp_id',
										'class' => 'form-control',
										'value' => set_value('employee-id'),
										'onblur' => 'generate_loginId()',
										'required' => 'true'
									));

									echo form_error('employee-id'); ?>
								</div>
								<div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
									<?php
									echo form_label('Full Name <small class="text-danger">*</small>', 'name');

									echo form_input(array(
										'type' => 'text',
										'name' => 'name',
										'class' => 'form-control',
										'placeholder' => 'Full Name',
										'value' => set_value('name'),
										'required' => 'true'
									));

									echo form_error('name'); ?>
								</div>
								<div class="form-group <?php if(form_error('resident-type')) echo 'has-error'; ?>">
									<?php
									$residentType = array(
										'' => 'Please Select',
										'InCampus' => 'In Campus',
										'OutSide' => 'Out Side'
									);
									echo form_label('Resident Type <small class="text-danger">*</small>','resident-type');

									echo form_dropdown(array(
										'name' => 'resident-type',
										'class' => 'form-control select2_one',
										'value' => set_value('resident-type'),
										'required' => 'true'
									), $residentType);

									echo form_error('resident-type'); ?>
								</div>
								
								
							</div>

							<div class="col-md-3 b-r">
								
								<div class="form-group <?php if(form_error('username')) echo 'has-error'; ?>">
									<?php
									echo form_label('Login Id <small class="text-danger">*</small>', 'username');

									echo form_input(array(
										'type' => 'text',
										'name' => 'username',
										'class' => 'form-control',
										'id' => 'login_id',
										'placeholder' => 'Username',
										'value' => set_value('username'),
										'required' => 'true',
										'readonly' => 'true'
									));

									echo form_error('username'); ?>
								</div>

								<div class="form-group <?php if(form_error('password')) echo 'has-error'; ?>">
									<?php
									echo form_label('Password <small class="text-danger">*</small>', 'password');

									echo form_input(array(
										'type' => 'password',
										'name' => 'password',
										'class' => 'form-control pass-strength',
										'placeholder' => 'Password',
										'value' => set_value('password'),
										'required' => 'true'
									));

									echo form_error('password'); ?>
									<div class="pwstrength_viewport_progress m-t"></div>
									<small class="help-block m-b-none text-danger">Password length should be between 8 to 15 characters.</small>
								</div>
								
							</div>

							<div class="col-md-3 b-r">
								<div class="form-group <?php if(form_error('photo')) echo 'has-error'; ?>">
									<?php
									echo form_label('Photo <small class="text-danger">*</small>', 'photo');

									echo form_input(array(
										'type' => 'file',
										'name' => 'photo',
										'class' => 'dropify',
										'value' => set_value('photo'),
										'required' => 'true'
									));

									echo form_error('photo'); ?>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group <?php if(form_error('signature')) echo 'has-error'; ?>">
									<?php
									echo form_label('Signature <small class="text-danger">*</small>', 'signature');

									echo form_input(array(
										'type' => 'file',
										'name' => 'signature',
										'value' => set_value('signature'),
										'class' => 'dropify',
										'required' => 'true'
									));

									echo form_error('signature'); ?>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Employee Information</small></h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6 b-r">
								

								<div class="form-group <?php if(form_error('qualification')) echo 'has-error'; ?>">
									<?php
									echo form_label('Qualification <small class="text-danger">*</small>', 'qualification');

									echo form_input(array(
										'type' => 'text',
										'name' => 'qualification',
										'class' => 'form-control',
										'placeholder' => 'Education Qualification',
										'value' => set_value('qualification'),
										'required' => 'true'
									));

									echo form_error('qualification'); ?>
								</div>

								<div class="form-group <?php if(form_error('dob')) echo 'has-error'; ?>">
									<?php
									echo form_label('Date of Birth <small class="text-danger">*</small>', 'dob');

									echo form_input(array(
										'type' => 'date',
										'name' => 'dob',
										'class' => 'form-control',
										'placeholder' => 'D.O.B.',
										'value' => set_value('dob'),
										'required' => 'true'
									));

									echo form_error('date'); ?>
								</div>

								<div class="form-group <?php if(form_error('phone')) echo 'has-error'; ?>">
									<?php
									echo form_label('Phone No.<small class="text-danger">*</small>', 'phone');

									echo form_input(array(
										'type' => 'text',
										'name' => 'phone',
										'class' => 'form-control',
										'placeholder' => 'Phone No.',
										'value' => set_value('phone'),
										'required' => 'true'
									));

									echo form_error('phone'); ?>
								</div>

								<div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
									<?php
									echo form_label('Email Id <small class="text-danger">*</small>', 'email');

									echo form_input(array(
										'type' => 'email',
										'name' => 'email',
										'class' => 'form-control',
										'placeholder' => 'Email Id',
										'value' => set_value('email'),
										'required' => 'true'
									));

									echo form_error('email'); ?>
								</div>

								<div class="form-group <?php if(form_error('gender')) echo 'has-error'; ?>">
									<?php
									echo form_label('Gender <small class="text-danger">*</small>', 'gender');  ?>
									<div class="form-control">
										<div class="row">
											<div class="col-xs-6">
												<div class="i-checks">
													<label> <?php echo form_radio('gender', 'Male', true)." Male "; ?> </label>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="i-checks">
													<label> <?php echo form_radio('gender', 'Female')." Female "; ?> </label>
												</div>
											</div>
										</div>
									</div>
									<?php echo form_error('gender'); ?>
								</div>

								<div class="form-group <?php if(form_error('cast-category')) echo 'has-error'; ?>">
									<?php echo form_label('Cast Category <small class="text-danger">*</small>', 'cast-category');

									$_cast_category = $this->mdl_cast_category->dropdown('cast_category');
									
										echo form_dropdown(array(
											'name' => 'cast-category',
											'class' => 'form-control select2_one',
											'value' => set_value('cast-category'),
											'required' => 'true'
										),$_cast_category);

										echo form_error('cast-category'); ?>
								</div>

								<div class="form-group <?php if(form_error('pan-number')) echo 'has-error'; ?>">
									<?php
									echo form_label('PAN Number', 'pan-number');

									echo form_input(array(
										'type' => 'text',
										'name' => 'pan-number',
										'class' => 'form-control',
										'placeholder' => 'PAN Number',
										'value' => set_value('pan-number')
									));

									echo form_error('pan-number'); ?>
								</div>

								<div class="form-group <?php if(form_error('adhar-number')) echo 'has-error'; ?>">
									<?php
									echo form_label('Adhar Number <small class="text-danger">*</small>', 'adhar-number');

									echo form_input(array(
										'type' => 'text',
										'name' => 'adhar-number',
										'class' => 'form-control',
										'placeholder' => 'Adhar Number ',
										'value' => set_value('adhar-number'),
										'required' => 'true'
									));

									echo form_error('adhar-number'); ?>
								</div>
								
							</div>

							<div class="col-md-6">
								<div class="form-group <?php if(form_error('experience')) echo 'has-error'; ?>">
									<?php
									echo form_label('Experience( In Year) <small class="text-danger">*</small>', 'experience');

									echo form_input(array(
										'type' => 'text',
										'name' => 'experience',
										'class' => 'form-control',
										'value' => set_value('experience'),
										'required' => 'true'
									));

									echo form_error('experience'); ?>
								</div>

								<div class="form-group <?php if(form_error('marital-status')) echo 'has-error'; ?>">
									<?php
									$options = array(
										'null' => '== Please select one option ==',
										'Single' => 'Single',
										'Married' => 'Married',
										'Divorced' => 'Divorced'
									);
									echo form_label('Marital Status', 'marital-status');

									echo form_dropdown(array(
										'name' => 'marital-status',
										'class' => 'form-control',
										'value' => set_value('marital-status'),
									), $options);

									echo form_error('marital-status'); ?>
								</div>

								<div class="form-group <?php if(form_error('religion')) echo 'has-error'; ?>">
									<?php
									$options = array(
										'null' => '== Please select one option ==',
										'Hinduism' => 'Hinduism',
										'Islam' => 'Islam',
										'Christianity' => 'Christianity',
										'Sikhism' => 'Sikhism',
										'Buddhism' => 'Buddhism',
										'Jainism' => 'Jainism'
									);
									echo form_label('Religion', 'religion');

									echo form_dropdown(array(
										'name' => 'religion',
										'class' => 'form-control',
										'value' => set_value('religion'),
									), $options);

									echo form_error('religion'); ?>
								</div>

								<div class="form-group">
									<?php
									$options = array(
										'null' => '== Please select one option ==',
										'A+' => 'A+',
										'A-' => 'A-',
										'B+' => 'B+',
										'B-' => 'B-',
										'AB+' => 'AB+',
										'AB-' => 'AB-',
										'O+' => 'O+',
										'O-' => 'O-'
									);
									echo form_label('Blood Group', 'blood-group');

									echo form_dropdown(array(
										'name' => 'blood-group',
										'class' => 'form-control',
										'value' => set_value('blood-group'),
										'required' => 'true'
									), $options); ?>
								</div>

								<div class="form-group <?php if(form_error('city')) echo 'has-error'; ?>">
									<?php
									echo form_label('City <small class="text-danger">*</small>', 'city');

									echo form_input(array(
										'type' => 'text',
										'name' => 'city',
										'class'=> 'form-control',
										'placeholder' => 'City',
										'value' => set_value('city'),
										'required' => 'true'
									));

									echo form_error('city'); ?>
								</div>

								<div class="form-group <?php if(form_error('state')) echo 'has-error'; ?>">
									<?php
									$options =  array(
										'Andhra Pradesh' => 'Andhra Pradesh',
										'Arunachal Pradesh' => 'Arunachal Pradesh',
										'Assam' => 'Assam',
										'Bihar' => 'Bihar',
										'Chhattisgarh' => 'Chhattisgarh',
										'Goa' => 'Goa',
										'Gujarat' => 'Gujarat',
										'Haryana' => 'Haryana',
										'Himachal Pradesh' => 'Himachal Pradesh',
										'Jammu and Kashmir' => 'Jammu and Kashmir',
										'Jharkhand' => 'Jharkhand',
										'Karnataka' => 'Karnataka',
										'Kerala' => 'Kerala',
										'Madhya Pradesh' => 'Madhya Pradesh',
										'Maharashtra' => 'Maharashtra',
										'Manipur' => 'Manipur',
										'Meghalaya' => 'Meghalaya',
										'Mizoram' => 'Mizoram',
										'Nagaland' => 'Nagaland',
										'Odisha' => 'Odisha',
										'Punjab' => 'Punjab',
										'Rajasthan' => 'Rajasthan',
										'Sikkim' => 'Sikkim',
										'Tamil Nadu' => 'Tamil Nadu',
										'Telangana' => 'Telangana',
										'Tripura' => 'Tripura',
										'Uttar Pradesh' => 'Uttar Pradesh',
										'Uttarakhand' => 'Uttarakhand',
										'West Bengal' => 'West Bengal'
									);

									echo form_label('State <small class="text-danger">*</small>', 'state');
									echo form_dropdown(array(
										'name' => 'state',
										'class' => 'form-control',
										'value' => set_value('state'),
										'required' => 'true'
									), $options, 'Bihar');

									echo form_error('state'); ?>
								</div>

								<div class="form-group <?php if(form_error('pincode')) echo 'has-error'; ?>	">
									<?php
									echo form_label('Pincode <small class="text-danger">*</small>', 'pincode');

									echo form_input(array(
										'type' => 'text',
										'name' => 'pincode',
										'class' => 'form-control',
										'placeholder' => 'Pincode',
										'value' => set_value('pincode'),
										'required' => 'true'
									));

									echo form_error('pincode');
									?>
								</div>

								<div class="form-group <?php if(form_error('address')) echo 'has-error'; ?>">
									<?php
									echo form_label('Address <small class="text-danger">*</small>', 'address');

									echo form_textarea(array(
										'rows' => '2',
										'name' => 'address',
										'class' => 'form-control',
										'placeholder' => 'Adress',
										'value' => set_value('address'),
										'required' => 'true'
									));

									echo form_error('address'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Previous Joining Detail </h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6 b-r">
								<div class="form-group <?php if(form_error('prev_org')) echo 'has-error'; ?>">
									<?php
									echo form_label('Organization Name', 'prev_org');

									echo form_input(array(
										'type' => 'text',
										'name' => 'prev_org',
										'class' => 'form-control',
										'placeholder' => 'Account Holder Name',
										'value' => set_value('prev_org')
									));

									echo form_error('prev_org'); ?>
								</div>

								<div id="data_5" class="form-group <?php if(form_error('prev_org')) echo 'has-error'; ?>">	
									<?php
									echo form_label('Duration', 'prev_org'); ?>

									<div class="input-daterange input-group" id="datepicker">
                                    	<?php 
											echo form_input(array(
												'type' => 'text',
												'name' => 'month-start',
												'class' => 'input-sm form-control',
												'placeholder' => 'From',
												'value' => set_value('prev_org')
											));
											?>
									<span class="input-group-addon">to</span>
                                    <?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'month-end',
											'class' => 'input-sm form-control',
											'placeholder' => 'To',
											'value' => set_value('prev_org')
										));
											
                                    	echo form_error('prev_org'); ?>
                                	</div>
								</div>
								<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
									<?php
									echo form_label('Remarks', 'remarks');

									echo form_input(array(
										'type' => 'text',
										'name' => 'remarks',
										'class' => 'form-control',
										'placeholder' => 'remarks',
										'value' => set_value('remarks')
									));

									echo form_error('remarks'); ?>
								</div>
								
							</div>

							<div class="col-md-6">								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Current Joining Detail </h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6 b-r">
								
								<!-- employment details -->
								<div class="form-group <?php if(form_error('joining-date')) echo 'has-error'; ?>">
									<?php
									echo form_label('Joining Date <small class="text-danger">*</small>', 'joining-date');

									echo form_input(array(
										'type' => 'date',
										'name' => 'joining-date',
										'class' => 'form-control',
										'value' => set_value('joining-date'),
										'required' => 'true'
									));

									echo form_error('joining-date'); ?>
								</div>

								<div class="form-group <?php if(form_error('employement-type')) echo 'has-error'; ?>">
									<?php

									$employmentType = $this->mdl_emp_type->dropdown('emp_type_name');

									echo form_label('Nature Of Joining <small class="text-danger">*</small>' ,'employement-type');

									echo form_dropdown(array(
										'name' => 'employement-type',
										'class' => 'form-control',
										'value' => set_value('employement-type'),
										'required' => 'true'
									), $employmentType);

									echo form_error('employement-type'); ?>
								</div>
								<div class="form-group <?php if(form_error('department')) echo 'has-error'; ?>">
									<?php
									$department = $this->mdl_dept->dropdown('dept_name');
									echo form_label('Department <small class="text-danger">*</small>','department');

									echo form_dropdown(array(
										'name' => 'department',
										'class' => 'form-control',
										'value' => set_value('department'),
										'required' => 'true',

									), $department);

									echo form_error('department'); ?>
								</div>
								<div class="form-group <?php if(form_error('designation')) echo 'has-error'; ?>">
									<?php
									echo form_label('Designation <small class="text-danger">*</small>','designation'); ?>
									<select name="designation" class="form-control" required="true"> </select>

									<?php echo form_error('designation'); ?>
								</div>

								<div class="form-group <?php if(form_error('employee-type')) echo 'has-error'; ?>">
									<?php
									$employeeType = $this->mdl_empe_type->dropdown('employee_type_name');
									echo form_label('Employee Type <small class="text-danger">*</small>','employee-type');

									echo form_dropdown(array(
										'name' => 'employee-type',
										'class' => 'form-control select2_one',
										'value' => set_value('employee-type'),
										'required' => 'true'
									), $employeeType);

									echo form_error('employee-type'); ?>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group <?php if(form_error('in-time')) echo 'has-error'; ?>">
									
									<?php
									echo form_label('In Time <small class="text-danger">*</small>', 'inTime'); ?>
									<div class="input-group clockpicker" data-autoclose="true">
									
										<?php 
											echo form_input(array(
												'type' => 'time',
												'name' => 'in-time',
												'class' => 'form-control',
												'value' => set_value('in-time'),
												'required' => 'true',
												'placeholder' => 'Log in Time'
											));

											echo form_error('in-time'); ?>
                                
		                                <span class="input-group-addon">
		                                    <span class="fa fa-clock-o"></span>
		                                </span>
                            		</div>
								</div>

								<div class="form-group <?php if(form_error('out-time')) echo 'has-error'; ?>">
									<?php
									echo form_label('Out Time <small class="text-danger">*</small>', 'out-time'); ?>
									<div class="input-group clockpicker" data-autoclose="true">
									
										<?php 
											echo form_input(array(
												'type' => 'time',
												'name' => 'out-time',
												'class' => 'form-control',
												'value' => set_value('out-time'),
												'required' => 'true',
												'placeholder' => 'Log Out Time'
											));

											echo form_error('out-time'); ?>
                                
		                                <span class="input-group-addon">
		                                    <span class="fa fa-clock-o"></span>
		                                </span>
                            		</div>
								</div>
								
								<div class="form-group <?php if(form_error('salary')) echo 'has-error'; ?>">
									<?php
									echo form_label('Salary', 'salary');

									echo form_input(array(
										'type' => 'text',
										'name' => 'salary',
										'class' => 'form-control',
										'placeholder' => 'salary',
										'value' => set_value('salary')
									));

									echo form_error('salary'); ?>
								</div>

								<div class="form-group <?php if(form_error('working-hour')) echo 'has-error'; ?>">
									<?php
									echo form_label('Working Hour', 'working-hour');

									echo form_input(array(
										'type' => 'text',
										'name' => 'working-hour',
										'class' => 'form-control',
										'placeholder' => 'Working Hour',
										'value' => set_value('working-hour')
									));

									echo form_error('working-hour'); ?>
								</div>

								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Bank Details </h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6 b-r">

								<div class="form-group <?php if(form_error('account-name')) echo 'has-error'; ?>">
									<?php
									echo form_label('Account Holder Name', 'account-name');

									echo form_input(array(
										'type' => 'text',
										'name' => 'account-name',
										'class' => 'form-control',
										'placeholder' => 'Account Holder Name',
										'value' => set_value('account-name')
									));

									echo form_error('account-name'); ?>
								</div>

								<div class="form-group <?php if(form_error('account-number')) echo 'has-error'; ?>">
									<?php
									echo form_label('Account Number', 'account-number');

									echo form_input(array(
										'type' => 'text',
										'name' => 'account-number',
										'class' => 'form-control',
										'placeholder' => 'Account Number',
										'value' => set_value('account-number')
									));

									echo form_error('account-number'); ?>
								</div>

								<div class="form-group <?php if(form_error('bank-name')) echo 'has-error'; ?>">
									<?php
									echo form_label('Bank Name', 'bank-name');

									echo form_input(array(
										'type' => 'text',
										'name' => 'bank-name',
										'class' => 'form-control',
										'placeholder' => 'Bank Name',
										'value' => set_value('bank-name')
									));

									echo form_error('bank-name'); ?>
								</div>

								
							</div>

							<div class="col-md-6">
								<div class="form-group <?php if(form_error('ifsc-code')) echo 'has-error'; ?>">
									<?php
									echo form_label('IFSC Code', 'ifsc-code');

									echo form_input(array(
										'type' => 'text',
										'name' => 'ifsc-code',
										'class' => 'form-control',
										'placeholder' => 'IFSC Code',
										'value' => set_value('ifsc-code')
									));

									echo form_error('ifsc-code'); ?>
								</div>

								<div class="form-group <?php if(form_error('branch-address')) echo 'has-error'; ?>">
									<?php
									echo form_label('Branch Address', 'branch-address');

									echo form_textarea(array(
										'rows' => '2',
										'name' => 'branch-address',
										'class' => 'form-control',
										'placeholder' => 'Branch Address',
										'value' => set_value('branch-address')
									));

									echo form_error('branch-address'); ?>
								</div>

								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Upload Documents <small>(Resume, ID Proof, Joining Letter & Agreement Letter)</small></h5>
						<div class="ibox-tools">
							<small><code>#</code> Document should be less than 1 MB in size and .pdf, .doc, .docx format only.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6 b-r">
								<label>Resume <small class="text-danger">#</small></label>
								<div class="fileinput fileinput-new input-group" data-provides="fileinput">
									<div class="form-control" data-trigger="fileinput">
										<i class="glyphicon glyphicon-file fileinput-exists"></i>
										<span class="fileinput-filename"></span>
									</div>
									<span class="input-group-addon btn btn-default btn-file">
										<span class="fileinput-new">Select file</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="resume" />
									</span>
									<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>

								<label>ID Proof <small class="text-danger">#</small></label>
								<div class="fileinput fileinput-new input-group" data-provides="fileinput">
									<div class="form-control" data-trigger="fileinput">
										<i class="glyphicon glyphicon-file fileinput-exists"></i>
										<span class="fileinput-filename"></span>
									</div>
									<span class="input-group-addon btn btn-default btn-file">
										<span class="fileinput-new">Select file</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="id_proof" />
									</span>
									<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>

							<div class="col-md-6">
								<label>Joining Letter <small class="text-danger">#</small></label>
								<div class="fileinput fileinput-new input-group" data-provides="fileinput">
									<div class="form-control" data-trigger="fileinput">
										<i class="glyphicon glyphicon-file fileinput-exists"></i>
										<span class="fileinput-filename"></span>
									</div>
									<span class="input-group-addon btn btn-default btn-file">
										<span class="fileinput-new">Select file</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="joining_letter" />
									</span>
									<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>

								<label>Agreement Letter <small class="text-danger">#</small></label>
								<div class="fileinput fileinput-new input-group" data-provides="fileinput">
									<div class="form-control" data-trigger="fileinput">
										<i class="glyphicon glyphicon-file fileinput-exists"></i>
										<span class="fileinput-filename"></span>
									</div>
									<span class="input-group-addon btn btn-default btn-file">
										<span class="fileinput-new">Select file</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="agreement_letter" />
									</span>
									<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="text-right">
							<button class="btn btn-primary" type="submit">Save </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('input[name="employee-id"]').change(function() {
    	$('input[name="username"]').val($(this).val());
	});

	$('select[name="department"]').on('change', function() {
		var deptID = $(this).val();
		if(deptID) {
			$.ajax({
				url: base_url + "index.php/employees/get_designation_list_by_department/" + deptID,
				type: "POST",
				success:function(data)
				{
					$('select[name="designation"]').empty();
					$('select[name="designation"]').html('<option value="" selected="true">== Please select one option ==</option>');
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {
							var option = $('<option />');
							option.attr('value', this.desg_p_id).text(this.desg_name);
							$('select[name="designation"]').append(option);
						});
					} else {
						$('select[name="designation"]').empty();
					}
				}
			});
		} else {
			$('select[name="designation"]').empty();
		}
	});
});
</script>
<script type="text/javascript">
function generate_loginId()
{
	var empId = document.getElementById("emp_id").value;
	document.getElementById("login_id").value = empId;
	 
}
  $(document).ready(function(){
$('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

 $('.clockpicker').clockpicker();
 });

</script>
