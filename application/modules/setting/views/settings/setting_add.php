<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= $this->misc->_getMethodName(); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("setting/{$this->misc->_getClassName()}/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
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
	echo form_open("setting/".$this->misc->_getClassName()."/add", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Company</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-3 b-r">
								<div class="form-group <?php if(form_error('institute-id')) echo 'has-error'; ?>">
									<?php
									echo form_label('Institute ID <small class="text-danger">*</small>', 'institute-id');

									echo form_input(array(
										'type' => 'text',
										'name' => 'institute-id',
										'class' => 'form-control',
										'value' => 'INST-'.$lastId,
										'required' => 'true',
										'readonly' => 'true'
									));

									echo form_error('institute-id'); ?>
								</div>
							</div>
							<div class="col-md-6 b-r">
								<div class="form-group <?php if(form_error('institute-name')) echo 'has-error'; ?>">
									<?php
									echo form_label('Name <small class="text-danger">*</small>', 'company-name');

									echo form_input(array(
										'type' => 'text',
										'name' => 'institute-name',
										'class' => 'form-control',
										'placeholder' => 'Institute Name',
										'value' => set_value('institute-name'),
										'required' => 'true'
									));

									echo form_error('institute-name'); ?>
								</div>
							</div>
							<div class="col-md-3 ">
								<div class="form-group">
									<?php
									echo form_label('Affiliation Number', 'affiliation-no');

									echo form_input(array(
										'type' => 'text',
										'name' => 'affiliation-no',
										'class' => 'form-control',
										'placeholder' => 'Affiliation Number',
										'value' => set_value('affiliation-no')
									)); ?>
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
									echo form_label('Institue Address <small class="text-danger">*</small>', 'address');

									echo form_textarea(array(
										'name' => 'address',
										'class' => 'form-control',
										'placeholder' => 'Institue Address',
										'rows' => '3',
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
										'required' => 'true'
									), $options, 'Bihar');

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
										'value' => set_value('pincode'),
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
										'value' => 'India'
									)); ?>
								</div>
							</div>

							<div class="col-md-6">
								<h4  class="bg-primary p-xxs b-r-sm">Contact Information</h4><hr/>
								<div class="form-group <?php if(form_error('phone-1')) echo 'has-error'; ?>">
									<?php
									echo form_label('Mobile Number [Primary] <small class="text-danger">*</small>', 'phone-1');

									echo form_input(array(
										'type' => 'text',
										'name' => 'phone-1',
										'class' => 'form-control',
										'placeholder' => 'Mobile Number [Primary]',
										'value' => set_value('phone-1'),
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
										'value' => set_value('phone-2')
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
										'value' => set_value('fax')
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
										'value' => set_value('email'),
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
										'value' => set_value('website')
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
										'class' => 'dropify',
										'required' => 'true'
									));

									echo form_error('logo'); ?>
								</div>
							</div>
							<div class="col-md-8">
								<h4 class="bg-primary p-xxs b-r-sm">Terms & Condition</h4>
								<div class="form-group">
									<?php
									echo form_label('Terms & Condition', 'terms-condition');

									echo form_textarea(array(
										'name' => 'terms-condition',
										'class' => 'summernote',
										'value' => set_value('terms-condition')
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