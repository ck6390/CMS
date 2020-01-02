<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url($this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
			</li>
			<li>
				<a href="<?= site_url($this->misc->_getClassName()."/employees"); ?>"><span class="text-capitalize">Employees</span></a>
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
	<div class="row m-b-lg m-t-lg">
		<div class="col-md-8 col-sm-6">
			<div class="profile-image">
				<img src="<?= base_url(); ?>assets/img/employees/<?= $info->emp_photo ?>" class="img-circle circle-border m-b-md" alt="profile">
			</div>
			<div class="profile-info">
				<div class="">
					<div>
						<h2 class="no-margins"> <?= '<span class="badge badge-primary">'.htmlspecialchars($info->employee_id,ENT_QUOTES,'UTF-8').'</span><br/><strong>'.htmlspecialchars($info->emp_name,ENT_QUOTES,'UTF-8').'</strong>' ?> </h2>
						<h4><?= htmlspecialchars($this->mdl_desg->get($info->emp_designation_ID)->desg_name,ENT_QUOTES,'UTF-8').', '.htmlspecialchars($this->mdl_dept->get($info->emp_department_ID)->dept_name,ENT_QUOTES,'UTF-8'); ?></h4>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6">
			<table class="table small m-b-xs">
				<tbody>
					<tr>
						<td>
							<i class="fa fa-suitcase fa-fw"></i>&nbsp;<strong><?= htmlspecialchars($this->mdl_empe_type->get($info->emp_type)->employee_type_name,ENT_QUOTES,'UTF-8'); ?></strong>
						</td>
					</tr>
					<tr>
						<td>
							<i class="fa fa-phone fa-fw"></i>&nbsp;<strong>+91-<?= htmlspecialchars($info->emp_phone,ENT_QUOTES,'UTF-8'); ?></strong>
						</td>
					</tr>
					<tr>
						<td>
							<i class="fa fa-envelope fa-fw"></i>&nbsp;<strong><?= htmlspecialchars($info->emp_email,ENT_QUOTES,'UTF-8'); ?></strong>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<!-- personal detail form -->
<div class="row m-t-lg m-b-lg">
	<div class="ibox-content">
	<?php 
		$attr = array(
					'role' => 'form',
					'method' => 'post',
					'name' => 'edit-form',
					'class' => ''
				);
		echo form_open("super_admin/emp_edit/$info->emp_p_id", $attr);?>
	<div class="col-md-12">
		<h4 class="bg-primary p-xs">Job Details</h4>
	</div>
	<div class="col-md-8">
		
		<div class="form-group <?php if(form_error('username')) echo 'has-error'; ?>">
			<?php
			echo form_label('Employee Id <small class="text-danger">*</small>', 'username');

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
			<small class="help-block m-b-none text-danger">Password length should be between 4 to 15 characters.</small>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="hr-line-dashed"></div>

	<div class="col-sm-12 text-right">
		<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
	</div>
	<?php echo form_close(); ?>
</div>
</div>
</div>