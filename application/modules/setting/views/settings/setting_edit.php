<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-5">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Setting</a>
			</li>
			<li>
				<a href="<?= site_url("setting/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= $this->misc->_getMethodName(); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-7"></div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'edit-form',
		'enctype' => 'multipart/form-data',
		'class' => ''
	);
	echo form_open("setting/".$this->misc->_getClassName()."/edit/$info->inst_p_id", $attr); ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Institute <span class="text-success">[<?= $info->inst_id ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6 b-r">
								<div class="form-group <?php if(form_error('institute-name')) echo 'has-error'; ?>">
									<?php
									echo form_label('Name <small class="text-danger">*</small>', 'institute-name');

									echo form_input(array(
										'type' => 'text',
										'name' => 'institute-name',
										'class' => 'form-control',
										'placeholder' => 'Institute Name',
										'value' => set_value('institute-name', $info->inst_name),
										'required' => 'true'
									));

									echo form_error('institute-name'); ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<?php
									echo form_label('Affiliation Number', 'affiliation-no');

									echo form_input(array(
										'type' => 'text',
										'name' => 'affiliation-no',
										'class' => 'form-control',
										'placeholder' => 'Affiliation Number',
										'value' => set_value('affiliation-no', $info->inst_affiliation_no)
									));
									
									echo form_error('affiliation-no'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Other Details <small>(Address, Contact, Bank &amp; Taxes Information)</small></h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-6 b-r">
								<h4 class="bg-primary p-xxs b-r-sm">Address Information</h4><hr/>
								<div class="form-group <?php if(form_error('address')) echo 'has-error'; ?>">
									<?php
									echo form_label('Institute Address <small class="text-danger">*</small>', 'address');

									echo form_textarea(array(
										'name' => 'address',
										'class' => 'form-control',
										'placeholder' => 'Institue Address',
										'rows' => '3',
										'value' => set_value('address', $info->inst_address),
										'required' => 'true'
									));

									echo form_error('address'); ?>
								</div>

								<div class="form-group <?php if(form_error('city')) echo 'has-error'; ?>">
									<?php
									echo form_label('City <small class="text-danger">*</small>', 'city');

									echo form_input(array(
										'type' => 'text',
										'name' => 'city',
										'class' => 'form-control',
										'placeholder' => 'City',
										'value' => set_value('city', $info->inst_city),
										'required' => 'true'
									));

									echo form_error('city'); ?>
								</div>

								<div class="form-group <?php if(form_error('state')) echo 'has-error'; ?>">
									<?php
									echo form_label('State <small class="text-danger">*</small>', 'state');

									echo form_input(array(
										'type' => 'text',
										'name' => 'state',
										'class' => 'form-control',
										'placeholder' => 'State',
										'value' => set_value('state', $info->inst_state),
										'required' => 'true'
									));

									echo form_error('state'); ?>
								</div>

								<div class="form-group <?php if(form_error('pincode')) echo 'has-error'; ?>">
									<?php
									echo form_label('Pin Code <small class="text-danger">*</small>', 'pincode');

									echo form_input(array(
										'type' => 'text',
										'name' => 'pincode',
										'class' => 'form-control',
										'placeholder' => 'PinCode',
										'value' => set_value('pincode', $info->inst_pincode),
										'required' => 'true'
									));
		
									echo form_error('pincode'); ?>
								</div>

								<div class="form-group">
									<?php
									echo form_label('Country', 'country');

									echo form_input(array(
										'type' => 'text',
										'name' => 'country',
										'class' => 'form-control',
										'placeholder' => 'Country',
										'value' => set_value('country', $info->inst_country)
									)); ?>
								</div>
							</div>

							<div class="col-md-6">
								<h4 class="bg-primary p-xxs b-r-sm">Contact Information</h4><hr/>
								<div class="form-group <?php if(form_error('phone-1')) echo 'has-error'; ?>">
									<?php
									echo form_label('Mobile Number [Primary] <small class="text-danger">*</small>', 'phone-1');

									echo form_input(array(
										'type' => 'text',
										'name' => 'phone-1',
										'class' => 'form-control',
										'placeholder' => 'Mobile Number [Primary]',
										'value' => set_value('phone-1', $info->inst_phone),
										'required' => 'true'
									));

									echo form_error('phone-1'); ?>
								</div>

								<div class="form-group <?php if(form_error('phone-2')) echo 'has-error'; ?>">
									<?php
									echo form_label('Mobile Number [Secondary]', 'phone-2');

									echo form_input(array(
										'type' => 'text',
										'name' => 'phone-2',
										'class' => 'form-control',
										'placeholder' => 'Mobile Number [Secondary]',
										'value' => set_value('phone-2', $info->inst_phone_2)
									));

									echo form_error('phone-2'); ?>
								</div>

								<div class="form-group <?php if(form_error('fax')) echo 'has-error'; ?>">
									<?php
									echo form_label('Fax Number', 'fax');

									echo form_input(array(
										'type' => 'text',
										'name' => 'fax',
										'class' => 'form-control',
										'placeholder' => 'Fax Number',
										'value' => set_value('fax', $info->inst_fax)
									));

									echo form_error('fax'); ?>
								</div>

								<div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
									<?php
									echo form_label('Email Id <small class="text-danger">*</small>', 'email');

									echo form_input(array(
										'type' => 'text',
										'name' => 'email',
										'class' => 'form-control',
										'placeholder' => 'Email Id',
										'value' => set_value('email', $info->inst_email),
										'required' => 'true'
									));
		
									echo form_error('email'); ?>
								</div>

								<div class="form-group">
									<?php
									echo form_label('Web Address', 'website');

									echo form_input(array(
										'type' => 'text',
										'name' => 'website',
										'class' => 'form-control',
										'placeholder' => 'Web Address',
										'value' => set_value('website', $info->inst_website)
									)); ?>
								</div>

								<div class="form-group">
									<?php
									echo form_label('Grace Period Time', 'grace_time');

									echo form_input(array(
										'type' => 'text',
										'name' => 'grace_time',
										'class' => 'form-control',
										'placeholder' => 'Grace Period Time',
										'value' => set_value('grace_time', @$info->grace_time)
									)); ?>
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>

						<div class="row">
							<div class="col-md-4 b-r">
								<h4 class="bg-primary p-xxs b-r-sm">Logo</h4>
								<div class="form-group <?php if(form_error('logo')) echo 'has-error'; ?>">
									<?php
									echo form_label('Logo  <small class="text-danger">*</small>', 'logo');

									echo form_input(array(
										'type' => 'file',
										'name' => 'logo',
										'class' => 'dropify'
									));
									echo form_input(array(
										'type' => 'hidden',
										'name' => 'previous-logo',
										'value' => set_value('website', $info->inst_logo)
										
									));
									echo form_error('logo'); ?>
								</div>
								<input type="hidden" name="logo" value="<?= $info->inst_logo ?>">
							</div>
							<div class="col-md-8">
								<h4 class="bg-primary p-xxs b-r-sm">Terms & Condition</h4>
								<div class="form-group">
									<?php
									echo form_label('Terms & Condition', 'terms-condition');

									echo form_textarea(array(
										'name' => 'terms-condition',
										'class' => 'summernote',
										'value' => set_value('terms-condition', $info->inst_term)
									)); ?>
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