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
				<strong class="text-capitalize">Employee Payslip</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php if(!empty($salary)): ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<div class="panel panel-info">
						<div class="panel-heading">
							<i class="fa fa-info-circle"></i> COMPANY NAME
						</div>

						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<td width="25%">
											<span class="label label-success">Salary Month : </span>
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
										<td colspan="2"><h4 class="m-b-xs"><strong>Office</strong></h4></td>
										<td colspan="2"><h4 class="m-b-xs"><strong>Employee</strong></h4></td>
									</tr>
									<tr>
										<td><h5 class="m-b-xs">Month's Days : </h5></td>
										<td><strong><?= $officeWorking['totalDays'] ?> days</strong></td>
										<td><h5 class="m-b-xs">Present Days : </h5></td>
										<td><strong><?= $officeWorking['workingDays'] - $empWorking['absentDays']->absent_days ?> days</strong></td>
									</tr>
									<tr>
										<td><h5 class="m-b-xs">Working Days : </h5></td>
										<td><strong><?= $officeWorking['workingDays'] ?> days</strong></td>
										<td><h5 class="m-b-xs">Absent Days : </h5></td>
										<td><strong><?= $empWorking['absentDays']->absent_days ?> days</strong></td>
									</tr>
									<tr>
										<td><h5 class="m-b-xs">Weekly Off : </h5></td>
										<td><strong><?= $officeWorking['weeklyOff'] ?> days</strong></td>
										<td><h5 class="m-b-xs">Paid Leaves : </h5></td>
										<td><strong><?= $empWorking['absentDays']->absent_days - $empWorking['unpaidLeave']->unpaid_leave ?> days</strong></td>
									</tr>
									<tr>
										<td><h5 class="m-b-xs">Office/Public Holidays : </h5></td>
										<td><strong><?= $officeWorking['holidays'] ?> days</strong></td>
										<td><h5 class="m-b-xs">Unpaid Leaves : </h5></td>
										<td><strong><?= $empWorking['unpaidLeave']->unpaid_leave ?> days</strong></td>
									</tr>
								</table>

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
																		if($earning->value_type == 'per') {
																			$_temp = ($details/100) * $empSalaryDetails[1];
																			$amount1 = $_temp;
																			$amount2 = $_temp * (($officeWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $officeWorking['totalDays']);
																		} else {
																			$amount1 = $details;
																			$amount2 = $details * (($officeWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $officeWorking['totalDays']);
																		}
																	}
																}
															} ?>
															<tr>
																<td>
																	<strong><small><?= $earning->component_name ?> : </small></strong>
																</td>
																<td class="text-right"><?= $amount1 ?></td>
																<td class="text-right"><?= round($amount2, 1, PHP_ROUND_HALF_ODD); ?></td>
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
																		if($deduction->value_type == 'per') {
																			$_temp = ($details/100) * $empSalaryDetails[1];
																			$amount1 = $_temp;
																			$amount2 = $_temp * (($officeWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $officeWorking['totalDays']);
																		} else {
																			$amount1 = $details;
																			$amount2 = $details * (($officeWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $officeWorking['totalDays']);
																		}
																	}
																}
															} ?>
															<tr>
																<td>
																	<strong><small><?= $deduction->component_name ?></small></strong>
																</td>
																<td class="text-right"><?= $amount1 ?></td>
																<td class="text-right"><?= round($amount2, 1, PHP_ROUND_HALF_ODD); ?></td>
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
																		if($deduction->value_type == 'per') {
																			$_temp = ($details/100) * $empSalaryDetails[1];
																			$amount1 = $_temp;
																			$amount2 = $_temp * (($officeWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $officeWorking['totalDays']);
																		} else {
																			$amount1 = $details;
																			$amount2 = $details * (($officeWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $officeWorking['totalDays']);
																		}
																	}
																}
															} ?>
															<tr>
																<td>
																	<strong><small><?= $deduction->component_name ?></small></strong>
																</td>
																<td class="text-right"><?= $amount1 ?></td>
																<td class="text-right"><?= round($amount2, 1, PHP_ROUND_HALF_ODD); ?></td>
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

							<table class="table table-bordered">
								<tr>
									<td><strong>Gross Salary</strong></td>
									<td><?php
										$gross_salary = $salary->total_payable + $salary->total_deduction * (($officeWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $officeWorking['totalDays']);
										echo round($gross_salary, 0, PHP_ROUND_HALF_ODD);
									?></td>
									<td rowspan="2"><strong>Payment Method</strong></td>
									<td rowspan="2"><?= $payroll->payment_method ?></td>
								</tr>
								<tr>
									<td><strong>Salary Deduction</strong></td>
									<td><?php
										$total_deduction = $salary->total_deduction * (($officeWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $officeWorking['totalDays']);
										echo  round($total_deduction, 0, PHP_ROUND_HALF_ODD);
									?></td>
								</tr>
								<tr>
									<td><strong>Net Salary</strong></td>
									<td><?php
										$total_payable = $salary->total_payable * (($officeWorking['totalDays'] - $empWorking['deductionValue']->deduction_value) / $officeWorking['totalDays']);
										echo round($total_payable, 0, PHP_ROUND_HALF_ODD);
									?></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td><strong>Net Salary</strong></td>
									<td><?= $payroll->fine_deduction ?></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td><strong>Net Salary</strong></td>
									<td><?= $payroll->bonus ?></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td><strong>Net Salary</strong></td>
									<td><?= $payroll->net_payment ?></td>
									<td></td>
									<td></td>
								</tr>
							</table>
							<a class="btn" id="printButton">
								<i class="fa fa-print fa-2x" aria-hidden="true"></i>PRINT
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>


<script>
$(document).ready(function(){
	$("#printButton").click(function(){
		var mode = 'iframe'; // popup
		var close = mode == "popup";
		var options = { mode : mode, popClose : close};
		$("div.panel-body").printArea( options );
	});
});
</script>
