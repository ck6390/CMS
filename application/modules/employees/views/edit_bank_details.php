<!-- personal detail form -->
	<div class="col-md-12">
		<h4 class="bg-primary p-xs">Job Details</h4>
	</div>
	<div class="col-md-6 b-r">
		<div class="form-group <?php if(form_error('account-name')) echo 'has-error'; ?>">
			<?php
			echo form_label('Account Holder Name <small class="text-danger">*</small>', 'account-name');

			echo form_input(array(
				'type' => 'text',
				'name' => 'account-name',
				'class' => 'form-control',
				'placeholder' => 'Account Holder Name',
				'value' => set_value('account-name', $info->emp_account_name),
				'required' => 'true'
			));

			echo form_error('account-name'); ?>
		</div>

		<div class="form-group <?php if(form_error('account-number')) echo 'has-error'; ?>">
			<?php
			echo form_label('Account Number <small class="text-danger">*</small>', 'account-number');

			echo form_input(array(
				'type' => 'text',
				'name' => 'account-number',
				'class' => 'form-control',
				'placeholder' => 'Account Number',
				'value' => set_value('account-number', $info->emp_account_number),
				'required' => 'true'
			));

			echo form_error('account-number'); ?>
		</div>

		<div class="form-group <?php if(form_error('bank-name')) echo 'has-error'; ?>">
			<?php
			echo form_label('Bank Name <small class="text-danger">*</small>', 'bank-name');

			echo form_input(array(
				'type' => 'text',
				'name' => 'bank-name',
				'class' => 'form-control',
				'placeholder' => 'Bank Name',
				'value' => set_value('bank-name', $info->emp_bank_name),
				'required' => 'true'
			));

			echo form_error('bank-name'); ?>
		</div>

		<div class="form-group <?php if(form_error('ifsc-code')) echo 'has-error'; ?>">
			<?php
			echo form_label('IFSC Code <small class="text-danger">*</small>', 'ifsc-code');

			echo form_input(array(
				'type' => 'text',
				'name' => 'ifsc-code',
				'class' => 'form-control',
				'placeholder' => 'IFSC Code',
				'value' => set_value('ifsc-code', $info->emp_ifsc_code),
				'required' => 'true'
			));

			echo form_error('ifsc-code'); ?>
		</div>

		
	</div>

	<div class="col-md-6">
		<div class="form-group <?php if(form_error('branch-address')) echo 'has-error'; ?>">
			<?php
			echo form_label('Branch Address <small class="text-danger">*</small>', 'branch-address');

			echo form_textarea(array(
				'rows' => '8',
				'name' => 'branch-address',
				'class' => 'form-control',
				'placeholder' => 'Branch Address',
				'value' => set_value('branch-address', $info->emp_branch),
				'required' => 'true'
			));

			echo form_error('branch-address'); ?>
		</div>

		<div class="form-group <?php if(form_error('uan-number')) echo 'has-error'; ?>">
			<?php
			echo form_label('UAN Number', 'uan-number');

			echo form_input(array(
				'type' => 'text',
				'name' => 'uan-number',
				'class' => 'form-control',
				'placeholder' => 'UAN Number',
				'value' => set_value('uan-number', $info->emp_uan)
			));

			echo form_error('uan-number'); ?>
		</div>

		<div class="form-group <?php if(form_error('esic-number')) echo 'has-error'; ?>">
			<?php
			echo form_label('ESIC Number', 'esic-number');

			echo form_input(array(
				'type' => 'text',
				'name' => 'esic-number',
				'class' => 'form-control',
				'placeholder' => 'ESIC Number',
				'value' => set_value('esic-number', $info->emp_esic)
			));

			echo form_error('esic-number'); ?>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="hr-line-dashed"></div>

	<div class="col-sm-12 text-right">
		<a class="btn bg-warning" id="editTab4"><i class="fa fa-pencil"></i> Edit</a>
		<a class="btn bg-danger" id="cancelTab4" style="display: none;"><i class="fa fa-times"></i> Cancel</a>&nbsp;
		<button class="btn btn-primary" id="saveTab4" type="submit" style="display: none;"><i class="fa fa-save"></i> Save</button>
	</div>

	<!-- script -->
	<script>
	$(document).ready(function () {
		var form = $('.tab-4');

		$('#editTab4').click(function(event) {
			form.find(':disabled').each(function() {
				$(this).removeAttr('disabled');
			});
			$('#cancelTab4').show();
			$('#saveTab4').show();
			$('#editTab4').hide();
		});

		$('#cancelTab4').click(function(event) {
			form.find(':enabled').each(function() {
				$(this).attr("disabled", "disabled");
			});
			$('#cancelTab4').hide();
			$('#saveTab4').hide();
			$('#editTab4').show();
		});
	});
	</script>
