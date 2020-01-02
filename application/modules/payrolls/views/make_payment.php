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
				<strong class="text-capitalize">Employee Payslip List</strong>
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
	echo form_open("{$this->misc->_getClassName()}/make_payment", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Make Payment</h5>
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
										$department = $this->mdl_dept->dropdown('dept_name');
										echo form_dropdown(array(
											'name' => 'department',
											'class' => 'form-control',
											'required' => 'true'
										), $department);

										echo form_error('department'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('employee')) echo 'has-error'; ?>">
									<?php echo form_label('Employee <small class="text-danger">*</small>','employee', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9" id="empDropdown">
										<?php $_employees = $this->mdl_employee->get_many_by('emp_department_ID', $departmentID); ?>
										<select name="employee" class="form-control" required="true">
										<?php foreach ($_employees as $_employee) { ?>
											<option value="<?= $_employee->emp_p_id ?>" <?= $employeeID == $_employee->emp_p_id ? 'selected':'' ?> ><?= $_employee->emp_name; ?></option>
										<?php } ?>
										</select>
										<?php echo form_error('employee'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('month')) echo 'has-error'; ?>" id="inputhMonth">
									<?php echo form_label('Month <small class="text-danger">*</small>', 'month', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="input-group date">
											<input type="text" name="month" class="form-control" value="<?= !empty($month) ? $month : date('01-m-Y') ?>" required="true" />
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
										<?php echo form_error('month'); ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3"></div>
									<div class="col-sm-9">
										<button class="btn btn-primary" type="submit">Go</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>

	<?php if(!empty($salary)): ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Make Employee Payment.</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<?php
						$attr = array(
							'role' => 'form',
							'method' => 'post',
							'name' => 'form',
							'class' => 'form-horizontal'
						);
						echo form_open($this->misc->_getClassName()."/save_payroll", $attr); ?>
							<div class="col-md-10 col-md-offset-1 col-sm-12">
								<div class="panel panel-info">
									<div class="panel-heading">
										<i class="fa fa-info-circle"></i> Employee Salary <span class="text-capitalize">[<?= $salary->salary_type ?>]</span>
									</div>

									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr class="text-center">
													<td>
														<img src="<?= base_url(); ?>assets/img/companies/<?= $companyDetail->comp_logo ?>" class="img-circle circle-border m-b-md" alt="logo" width="100px" />
													</td>
													<td colspan="3">
														<h2 class="m-b-xs"><strong><?= $companyDetail->comp_name ?></strong></h2>
														<h5 class="m-b-xs"><strong>GSTIN - <?= $companyDetail->comp_gstin ?></strong></h5>
														<p class="m-b-none">
															<?= $companyDetail->comp_address.'<br/>'.$companyDetail->comp_city.'-'.$companyDetail->comp_pincode.', '.$companyDetail->comp_state.', '.$companyDetail->comp_country ?>
														</p>
														<p class="m-b-xs"><?= "<i class='fa fa-phone'></i> : ".$companyDetail->comp_phone.", <i class='fa fa-envelope'></i> : ".$companyDetail->comp_email; ?></p>
													</td>
												</tr>
												<tr>
													<td width="25%">
														<span class="label label-success">Salary Month : <?= $month ?></span>
													</td>
													<td width="25%">
														<span class="label label-success">Employee ID : <?= $employeeDetail->employee_id ?></span>
													</td>
													<td width="25%">
														<span class="label label-success">Date of Birth : <?= $employeeDetail->emp_dob ?>
													</td>
													<td width="25%">
														<span class="label label-success">Joining Date : <?= $employeeDetail->emp_joined_date ?>
													</td>
												</tr>
												<tr>
													<td colspan="4"><h3 class="m-b-xs"><strong><?= $employeeDetail->emp_name ?></strong></h3></td>
												</tr>
												<tr>
													<td colspan="2">
														<h5 class="m-b-xs">Department : <strong><?= $employeeDetail->dept_name ?></strong></h5>
													</td>
													<td colspan="2">
														<h5 class="m-b-xs">Designation : <strong><?= $employeeDetail->desg_name ?></strong></h5>
													</td>
												</tr>

												<tr>
													<td><h5 class="m-b-xs">Month's Days : </h5></td>
													<td><strong><?= $empWorking['totalDays'] ?> days</strong></td>
													<td><h5 class="m-b-xs">Present Days : </h5></td>
													<td><strong><?= $empWorking['presentDays']->present_days ?> days</strong></td>
												</tr>
												<tr>
													<td><h5 class="m-b-xs">Weekly Off : </h5></td>
													<td><strong><?= $empWorking['weeklyOff'] ?> days</strong></td>
													<td><h5 class="m-b-xs">Absent Days : </h5></td>
													<td><strong><?= $empWorking['absentDays']->absent_days ?> days</strong></td>
												</tr>
												<tr>
													<td><h5 class="m-b-xs">Office/Public Holidays : </h5></td>
													<td><strong><?= $empWorking['holidays'] ?> days</strong></td>
													<td><h5 class="m-b-xs">Unpaid Leaves : </h5></td>
													<td><strong><?= $empWorking['unpaidLeave']->unpaid_leave ?> days</strong></td>
												</tr>
											</table>
										</div>

										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td colspan="4"><h3 class="m-b-xs"><strong>COMPLETE SALARY DETAILS</strong></h3></td>
												</tr>
												<tr>
													<td colspan="2" width="50%">
														<h4 class="m-b-xs"><strong>TOTAL EARNINGS</strong></h4>
													</td>
													<td colspan="2" width="50%">
														<h4 class="m-b-xs"><strong>TOTAL DEDUCTIONS</strong></h4>
													</td>
												</tr>

												<tr>
													<td colspan="2">
														<table class="table custom-table">
															<tr>
																<td colspan="3">
																	<strong class="text-success">Employee Earnings</strong><hr class="hr-line-solid"/>
																</td>
															</tr>
															<tr>
																<td>
																	<strong>Components</strong>
																</td>
																<td class="text-right">
																	<strong>Fixed Structure</strong>
																</td>
																<td class="text-right">
																	<strong>Earned</strong>
																</td>
															</tr>
															<?php
															if(count($salaryEarningList)):
																foreach($salaryEarningList as $earning):
																	if(in_array($earning->component_p_id, $empSalaryComponent)):
																		$amount = '';
																		if(!empty($empSalaryDetails)) {
																			foreach ($empSalaryDetails as $key => $details) {
																				if ($earning->component_p_id == $key) {
																					$amount1 = $details;
																					$amount2 = $details * (($empWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $empWorking['totalDays']);
																				}
																			}
																		} ?>
																		<tr>
																			<td>
																				<strong><small><?= $earning->component_name ?> : </small></strong>
																			</td>
																			<td class="text-right"><?= $amount1 ?></td>
																			<td class="text-right"><?= round($amount2); ?>
																				<?php
																				$component_name = str_replace(array('+', ' '), array('plus', '-'), $earning->component_name);
																				echo form_input(array(
																					'type' => 'hidden',
																					'name' => strtolower($component_name),
																					'value' => set_value($earning->component_p_id, round($amount2))
																				)); ?>
																			</td>
																		</tr>
																		<?php
																	endif;
																endforeach;
															endif; ?>
														</table>
													</td>
													<td colspan="2">
														<table class="table custom-table">
															<tr>
																<td colspan="3">
																	<strong class="text-success">Employee Deductions</strong><hr class="hr-line-solid"/>
																</td>
															</tr>
															<tr>
																<td>
																	<strong>Components</strong>
																</td>
																<td class="text-right">
																	<strong>Fixed Structure</strong>
																</td>
																<td class="text-right">
																	<strong>Earned</strong>
																</td>
															</tr>
															<?php
															if(count($salaryDeductionList)):
																foreach($salaryDeductionList as $deduction):
																	if($deduction->payable_amount == '1'):
																	if(in_array($deduction->component_p_id, $empSalaryComponent)):
																		$amount = '';
																		if(!empty($empSalaryDetails)) {
																			foreach ($empSalaryDetails as $key => $details) {
																				if ($deduction->component_p_id == $key) {
																					$amount1 = $details;
																					$amount2 = $details * (($empWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $empWorking['totalDays']);
																				}
																			}
																		} ?>
																		<tr>
																			<td>
																				<strong><small><?= $deduction->component_name ?></small></strong>
																			</td>
																			<td class="text-right"><?= $amount1 ?></td>
																			<td class="text-right"><?= round($amount2); ?>
																				<?php
																				$component_name = str_replace(array(' ', '(', ')'), array('-', '', ''), $deduction->component_name);
																				echo form_input(array(
																					'type' => 'hidden',
																					'name' => strtolower($component_name),
																					'value' => set_value($deduction->component_p_id, round($amount2))
																				)); ?>
																			</td>
																		</tr>
																		<?php
																	endif;
																	endif;
																endforeach;
															endif; ?>

															<tr>
																<td colspan="3">
																	<strong class="text-success"><br/>Employer Contributions</strong><hr class="hr-line-solid"/>
																</td>
															</tr>
															<tr>
																<td>
																	<strong>Components</strong>
																</td>
																<td class="text-right">
																	<strong>Fixed Structure</strong>
																</td>
																<td class="text-right">
																	<strong>Earned</strong>
																</td>
															</tr>
															<?php
															if(count($salaryDeductionList)):
																foreach($salaryDeductionList as $deduction):
																	if($deduction->cost_to_company == '1'):
																	if(in_array($deduction->component_p_id, $empSalaryComponent)):
																		$amount = '';
																		if(!empty($empSalaryDetails)) {
																			foreach ($empSalaryDetails as $key => $details) {
																				if ($deduction->component_p_id == $key) {
																					$amount1 = $details;
																					$amount2 = $details * (($empWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $empWorking['totalDays']);
																				}
																			}
																		} ?>
																		<tr>
																			<td>
																				<strong><small><?= $deduction->component_name ?></small></strong>
																			</td>
																			<td class="text-right"><?= $amount1 ?></td>
																			<td class="text-right"><?= round($amount2); ?>
																				<?php
																				$component_name = str_replace(array(' ', '(', ')'), array('-', '', ''), $deduction->component_name);
																				echo form_input(array(
																					'type' => 'hidden',
																					'name' => strtolower($component_name),
																					'value' => set_value($deduction->component_p_id, round($amount2))
																				)); ?>
																			</td>
																		</tr>
																		<?php
																	endif;
																	endif;
																endforeach;
															endif; ?>
														</table>
													</td>
												</tr>
											</table>
										</div>

										<div class="form-group">
											<?php echo form_label('Gross Salary', 'gross-salary', array('class' => 'col-sm-4 control-label')); ?>
											<div class="col-sm-8">
												<?php
												$amt1 = $salary->total_payable + $salary->total_deduction;
												$gross_salary = $amt1 * (($empWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $empWorking['totalDays']);
												echo form_input(array(
													'type' => 'text',
													'name' => 'gross-salary',
													'class' => 'form-control',
													'value' => set_value('gross-salary', round($gross_salary)),
													'readonly' => 'true'
												)); ?>
											</div>
										</div>

										<div class="form-group">
											<?php echo form_label('Deduction', 'deduction', array('class' => 'col-sm-4 control-label')); ?>
											<div class="col-sm-8">
												<?php
												$amt2 = $salary->total_deduction;
												$total_deduction = $amt2 * (($empWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $empWorking['totalDays']);
												echo form_input(array(
													'type' => 'text',
													'name' => 'deduction',
													'class' => 'form-control',
													'value' => set_value('deduction', round($total_deduction)),
													'readonly' => 'true'
												)); ?>
											</div>
										</div>

										<div class="form-group">
											<?php echo form_label('Net Salary', 'net-salary', array('class' => 'col-sm-4 control-label')); ?>
											<div class="col-sm-8">
												<?php
												$amt3 = $salary->total_payable;
												$total_payable = $amt3 * (($empWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $empWorking['totalDays']);
												echo form_input(array(
													'type' => 'text',
													'name' => 'net-salary',
													'class' => 'form-control',
													'value' => set_value('net-salary', round($total_payable)),
													'readonly' => 'true'
												)); ?>
											</div>
										</div>

										<div class="form-group <?php if(form_error('bonus')) echo 'has-error'; ?>">
											<?php echo form_label('Bonus', 'bonus', array('class' => 'col-sm-4 control-label')); ?>
											<div class="col-sm-8">
												<?php
												echo form_input(array(
													'type' => 'text',
													'name' => 'bonus',
													'id' => 'bonus',
													'class' => 'form-control',
													'placeholder' => 'Bonus',
													'value' => set_value('bonus', (!empty($payroll->bonus)) ? $payroll->bonus:'')
												));

												echo form_error('bonus'); ?>
											</div>
										</div>

										<div class="form-group <?php if(form_error('fine-deduction')) echo 'has-error'; ?>">
											<?php echo form_label('Fine Deduction', 'fine-deduction', array('class' => 'col-sm-4 control-label')); ?>
											<div class="col-sm-8">
												<?php
												echo form_input(array(
													'type' => 'text',
													'name' => 'fine-deduction',
													'id' => 'fine_deduction',
													'class' => 'form-control',
													'placeholder' => 'Fine Deduction',
													'value' => set_value('fine-deduction', (!empty($payroll->fine_deduction)) ? $payroll->fine_deduction:'')
												));

												echo form_error('fine-deduction'); ?>
											</div>
										</div>

										<div class="form-group <?php if(form_error('other-deduction')) echo 'has-error'; ?>">
											<?php echo form_label('Other Deduction', 'other-deduction', array('class' => 'col-sm-4 control-label')); ?>
											<div class="col-sm-8">
												<?php
												echo form_input(array(
													'type' => 'text',
													'name' => 'other-deduction',
													'id' => 'other_deduction',
													'class' => 'form-control',
													'placeholder' => 'Other Deduction',
													'value' => set_value('other-deduction', (!empty($payroll->fine_deduction)) ? $payroll->fine_deduction:'')
												));

												echo form_error('other-deduction'); ?>
											</div>
										</div>

										<div class="form-group">
											<?php echo form_label('Payment Amount', 'payment-amount', array('class' => 'col-sm-4 control-label')); ?>
											<div class="col-sm-8">
												<?php
												$payable = $salary->total_payable;
												$net_amount = $payable * (($empWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $empWorking['totalDays']);
												$net_amount = round($net_amount);
												echo form_input(array(
													'type' => 'text',
													'name' => 'payment-amount',
													'id' => 'payment_amount',
													'class' => 'form-control',
													'placeholder' => 'Payment Amount',
													'value' => set_value('payment-amount', (!empty($payroll->net_payment)) ? $payroll->net_payment : $net_amount),
													'readonly' => 'true'
												)); ?>
												<input type="hidden" value="<?= $net_amount ?>"  id="net_salary">
											</div>
										</div>

										<div class="form-group <?php if(form_error('payment-method')) echo 'has-error'; ?>">
											<?php echo form_label('Payment Method', 'payment-method', array('class' => 'col-sm-4 control-label')); ?>
											<div class="col-sm-8">
												<?php
												$_payment_method = $this->mdl_pay_mode->dropdown('payment_mode_name');
												echo form_dropdown(array(
													'name' => 'payment-method',
													'class' => 'form-control',
													'required' => 'true'
												), $_payment_method, (!empty($payroll->payment_method)) ? $payroll->payment_method : '');

												echo form_error('payment-method'); ?>
											</div>
										</div>

										<div class="form-group <?php if(form_error('comment')) echo 'has-error'; ?>">
											<?php echo form_label('Comment', 'comment', array('class' => 'col-sm-4 control-label')); ?>
											<div class="col-sm-8">
												<?php
												echo form_textarea(array(
													'name' => 'comment',
													'class' => 'form-control',
													'placeholder' => 'Comment',
													'rows' => '3',
													'value' => set_value('comment', (!empty($payroll->note)) ? $payroll->note:'')
												));

												echo form_error('comment'); ?>
											</div>
										</div>

										<?php $ctc = $salary->total_ctc * (($empWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $empWorking['totalDays']); ?>
										<input type="hidden" name="monthly-ctc" id="monthly_ctc" value="<?= round($ctc) ?>" />
										<input type="hidden" name="net-ctc" id="net_ctc" />
										<input type="hidden" name="employee-id" value="<?= $employeeID ?>" />
										<input type="hidden" name="salary-month" value="<?= $month ?>" />

										<hr/>
										<div class="text-right">
											<button type="submit" id="sbtn" class="btn bg-primary btn-md btn-flat">Save</button>
										</div>
									</div>
								</div>
							</div>
						<?php echo form_close(); ?>
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
					$('select[name="employee"]').empty();
					$('select[name="employee"]').html('<option value="" selected="true">== Please select one option ==</option>');
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {
							var option = $('<option />');
							option.attr('value', this.emp_p_id).text(this.emp_name);
							$('select[name="employee"]').append(option);
						});
					} else {
						$('select[name="employee"]').empty();
					}
				}
			});
		} else {
			$('select[name="employee"]').empty();
		}
	});
});

$(document).on("change", function() {
	var fine = 0;
	var bonus = 0;
	fine = $("#fine_deduction").val();
	bonus = $("#bonus").val();
	var net_salary = $("#net_salary").val();
	var monthly_ctc = $("#monthly_ctc").val();
	var total =  net_salary - fine + + bonus;
	var ctc =  monthly_ctc - fine + + bonus;
	$("#payment_amount").val(total);
	$("#net_ctc").val(ctc);
});
</script>
