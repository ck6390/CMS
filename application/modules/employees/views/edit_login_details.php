<!-- personal detail form -->
	<div class="col-md-12">
		<h4 class="bg-primary p-xs">Job Details</h4>
	</div>
	<div class="col-md-8">
		<div class="form-group <?php if(form_error('username')) echo 'has-error'; ?>">
			<?php
			echo form_label('Username <small class="text-danger">*</small>', 'username');

			echo form_input(array(
				'type' => 'text',
				'name' => 'username',
				'class' => 'form-control',
				'placeholder' => 'Username',
				'value' => set_value('username', $info->username),
				'readonly' => 'true',
				'required' => 'true'
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
			<div class="pwstrength_viewport_progress"></div>
			<small class="help-block m-b-none text-danger">Password length should be between 8 to 15 characters.</small>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="hr-line-dashed"></div>

	<div class="col-sm-12 text-right">
		<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
	</div>