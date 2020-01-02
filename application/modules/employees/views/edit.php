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

	<div class="row m-t-lg m-b-lg">
		<div class="col-md-3 col-sm-4">
			<div class="panel panel-primary r-0">
				<!-- <div class="panel-heading"> Navigation Panel</div> -->
				<div class="panel-body no-padding">
					<ul class="nav" id="empNavTab">
						<li class="<?= $this->misc->_getMethodName() == 'edit_personal_details' ? 'active' : null ?>">
							<a href="<?= site_url('employees/edit_personal_details/'.$info->emp_p_id) ?>"> <h4 class="m-b-xs"><i class="fa fa-user"></i> Personal Details</h4></a>
						</li>
						<li class="<?= $this->misc->_getMethodName() == 'edit_job_details' ? 'active' : null ?>">
							<a href="<?= site_url('employees/edit_job_details/'.$info->emp_p_id) ?>"> <h4 class="m-b-xs"><i class="fa fa-suitcase"></i> Job Details</h4></a>
						</li>
						<li class="<?= $this->misc->_getMethodName() == 'edit_salary_details' ? 'active' : null ?>">
							<a href="<?= site_url('employees/edit_salary_details/'.$info->emp_p_id) ?>"> <h4 class="m-b-xs"><i class="fa fa-money"></i> Salary Details</h4></a>
						</li>
						<li class="<?= $this->misc->_getMethodName() == 'edit_bank_details' ? 'active' : null ?>">
							<a href="<?= site_url('employees/edit_bank_details/'.$info->emp_p_id) ?>"> <h4 class="m-b-xs"><i class="fa fa-bank"></i> Bank Details</h4></a>
						</li>
						<li class="<?= $this->misc->_getMethodName() == 'edit_login_details' ? 'active' : null ?>">
							<a href="<?= site_url('employees/edit_login_details/'.$info->emp_p_id) ?>"> <h4 class="m-b-xs"><i class="fa fa-key"></i> Login Details</h4></a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-md-9 col-sm-8">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Edit Employee Details</h5>
					<div class="ibox-tools">
						<small><code>*</code> Required Fields.</small>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<?php
						if($this->misc->_getMethodName() == 'edit_personal_details') {
							$attr = array(
								'role' => 'form',
								'method' => 'post',
								'name' => 'edit-form',
								'enctype' => 'multipart/form-data',
								'class' => 'employee-form tab-1'
							);
							echo form_open("employees/edit_personal_details/$info->emp_p_id", $attr);
								require ('edit_personal_details.php');
							echo form_close();
						} elseif($this->misc->_getMethodName() == 'edit_job_details') {
							$attr = array(
								'role' => 'form',
								'method' => 'post',
								'name' => 'edit-form',
								'enctype' => 'multipart/form-data',
								'class' => 'employee-form tab-2'
							);
							echo form_open("employees/edit_job_details/$info->emp_p_id", $attr);
								require ('edit_job_details.php');
							echo form_close();
						} elseif($this->misc->_getMethodName() == 'edit_salary_details') {
							$attr = array(
								'role' => 'form',
								'method' => 'post',
								'name' => 'edit-form',
								'class' => 'employee-form tab-3 form-horizontal'
							);
							echo form_open("employees/edit_salary_details/$info->emp_p_id", $attr);
								require ('edit_salary_details.php');
							echo form_close();
						} elseif($this->misc->_getMethodName() == 'edit_bank_details') {
							$attr = array(
								'role' => 'form',
								'method' => 'post',
								'name' => 'edit-form',
								'class' => 'employee-form tab-4'
							);
							echo form_open("employees/edit_bank_details/$info->emp_p_id", $attr);
								require ('edit_bank_details.php');
							echo form_close();
						} elseif($this->misc->_getMethodName() == 'edit_login_details') {
							$attr = array(
								'role' => 'form',
								'method' => 'post',
								'name' => 'edit-form',
								'class' => ''
							);
							echo form_open("employees/edit_login_details/$info->emp_p_id", $attr);
								require ('edit_login_details.php');
							echo form_close();
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- script -->
<script>
$(document).ready(function () {
	$(".employee-form :input").attr("disabled", true);
	$(".employee-form :input[type='file']").attr("disabled", false);

	$('select[name="department"]').on('change', function() {
		var deptID = $(this).val();
		if(deptID) {
			$.ajax({
				url: base_url + "index.php/employees/get_designation_list_by_department/" + deptID,
				type: "GET",
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
