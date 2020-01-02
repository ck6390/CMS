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
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'form',
		'class' => 'form-horizontal'
	);
	echo form_open("{$this->misc->_getClassName()}", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Search Payslip</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10 col-sm-12">
								<div class="form-group <?php if(form_error('department')) echo 'has-error'; ?>">
									<?php echo form_label('Department <small class="text-danger">*</small>', 'department', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										$_department = $this->mdl_dept->dropdown('dept_name');
										echo form_dropdown(array(
											'name' => 'department',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_department);

										echo form_error('department'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('employee')) echo 'has-error'; ?>">
									<?php echo form_label('Employee <small class="text-danger">*</small>','employee', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9" id="empDropdown">
										<?php
										$_employees = $this->mdl_employee->get_many_by('emp_department_ID', $dept_id); ?>
										<select name="employee" class="form-control select2_one" required="true">
											<?php foreach ($_employees as $_employees) { ?>
												<option value="<?= $_employees->emp_p_id ?>" <?= $emp_id == $_employees->emp_p_id ? 'selected':'' ?> ><?= $_employees->emp_name; ?></option>
											<?php } ?>
										</select>
										<?php echo form_error('employee'); ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-9 col-sm-offset-3">
										<?php echo form_submit('submit', 'Go', 'class="btn btn-sm btn-primary"'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>

	<?php if(!empty($payslips)): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Employee Payslip List</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead >
								<tr>
									<th width="40px">S. NO.</th>
									<th>MONTH</th>
									<th>EMPLOYEE INFO</th>
									<th>NET SALARY</th>
									<th>FINE &amp; BONUS</th>
									<th>NET PAYMENT</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(count($payslips) == 0) { ?>
									<tr class="text-center text-uppercase">
										<td colspan="7"><strong>NO RECORDS AVAILABLE</strong></td>
									</tr>
								<?php
								} else {
									$i = 0;
									foreach ($payslips as $payslip) {
									$i++; ?>
									<tr>
										<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
										<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
										<td><?= '<span class="badge badge-primary">'.htmlspecialchars($payslip->month,ENT_QUOTES,'UTF-8').'</span>'; ?></td>
										<td><?= '<strong>'.htmlspecialchars($payslip->employee_ID,ENT_QUOTES,'UTF-8').'<br/>'.htmlspecialchars($payslip->department_ID,ENT_QUOTES,'UTF-8').'</strong>' ?></td>
										<td><?= '<strong>'.htmlspecialchars($payslip->net_salary,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
										<td><?= '<strong>'.htmlspecialchars($payslip->fine_deduction,ENT_QUOTES,'UTF-8').'<br/>'.htmlspecialchars($payslip->bonus,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
										<td><?= '<strong>'.htmlspecialchars($payslip->net_payment,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
										<td>
											<a href="<?php echo site_url("{$this->misc->_getClassName()}/edit/{$payslip->payroll_p_id}"); ?>" class="btn btn-success btn-xs">
												<i class="fa fa-pencil"></i>
											</a>
											<button class="btn btn-xs btn-danger deleteRow" value="<?= $payslip->payroll_p_id ?>">
												<i class="fa fa-trash"></i>
											</button>
											<?php if($this->auth->_isDeveloper()) { ?>
												<a href="<?php echo site_url("{$this->misc->_getClassName()}/force_delete/{$payslip->payroll_p_id}"); ?>" class="btn btn-default btn-xs">DEL</a>
											<?php } ?>
										</td>
									</tr>
									<?php }
								} ?>
							</tbody>
							<tfoot>
								<tr>
									<th width="40px">S. NO.</th>
									<th>MONTH</th>
									<th>EMPLOYEE INFO</th>
									<th>NET SALARY</th>
									<th>FINE &amp; BONUS</th>
									<th>NET PAYMENT</th>
									<th>ACTION</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('select[name="department"]').on('change', function() {
		var deptID = $(this).val();
		if(deptID) {
			$.ajax({
				url: base_url + "index.php/payrolls/get_employee_list_by_department/" + deptID,
				type: "POST",
				success:function(data)
				{
					$('#empDropdown .select2_one').select2('val','');
					$('select[name="employee"]').html('<option value="" selected="true">== Please select one option ==</option>');
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {
							var option = $('<option />');
							option.attr('value', this.emp_p_id).text(this.emp_name);
							$('select[name="employee"]').append(option);
						});
					} else {
						$('#empDropdown .select2_one').select2('val','');
					}
				}
			});
		} else {
			$('#empDropdown .select2_one').select2('val','');
		}
	});
});
</script>
