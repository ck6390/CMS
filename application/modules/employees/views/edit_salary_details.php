<!-- personal detail form -->
	<div class="col-sm-12">
		<div class="jumbotron p-sm">
			<h2>Select salaray type</h2>
			<div class="form-group">
				<div class="col-sm-12">
					<label><?php echo form_radio('salary-type', 'monthly', true)." Monthly "; ?> </label>
				</div>
				<!--<div class="col-sm-12">
					<label> </?php echo form_radio('salary-type', 'hourly')." Hourly "; ?> </label>
				</div> -->
			</div>
		</div>
	</div>

	<div class="col-sm-12">
		<h4 class="bg-primary p-xs">Salary Details</h4>
	</div>

	<div class="box monthly">
		<div class="col-sm-12">
			<!-- all earnings -->
			<h4 class="text-success m-b-none">All Earnings</h4><hr class="m-t-xs" />
			<?php
			if(count($salaryEarningList)):
				foreach($salaryEarningList as $earning):
					$value = '';
					$amount = '';
					if(!empty($empSalaryDetails)) {
						foreach ($empSalaryDetails as $vKey => $vDetails) {
							if ($earning->component_p_id == $vKey) {
								$value = $vDetails;
							}
						}
					}
					if(!empty($empSalaryAmountDetails)) {
						foreach ($empSalaryAmountDetails as $aKey => $aDetails) {
							if ($earning->component_p_id == $aKey) {
								$amount = $aDetails;
							}
						}
					} ?>
					<div class="form-group">
						<?php $type = $earning->value_type == 'amt' ? 'Amount': 'Percent' ?>
						<?php echo form_label("$earning->component_name <small class='text-danger'>*</small><br/><small class='text-navy'>$type</small>", '', array('class' => 'col-md-4 col-sm-5 control-label p-t-none')); ?>
						<div class="col-md-8 col-sm-7">
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => $earning->component_p_id,
								'id' => 'component'.$earning->component_p_id,
								'class' => 'form-control earning key',
								'placeholder' => $earning->component_name,
								'value' => set_value($earning->component_p_id, $value),
								'required' => 'true'
							)); ?>

							<input type="hidden" name="amount<?= $earning->component_p_id ?>" id="amount<?= $earning->component_p_id ?>" value="<?= $amount ?>" />
							<input type="hidden" value="<?php echo $earning->component_type?>" id="<?php echo 'type'.$earning->component_p_id ?>">
							<input type="hidden" value="<?php echo $earning->payable_amount?>" id="<?php echo 'pay'.$earning->component_p_id ?>">
							<input type="hidden" value="<?php echo $earning->cost_to_company?>" id="<?php echo 'cost'.$earning->component_p_id ?>">
							<input type="hidden" value="<?php echo $earning->value_type?>" id="<?php echo 'valueType'.$earning->component_p_id ?>">
							<input type="hidden" value="<?php echo $earning->add_to?>" id="<?php echo 'addTo'.$earning->component_p_id ?>">
							<input type="hidden" name="credit[]" value="<?php echo $earning->component_p_id ?>">
						</div>
					</div>
				<?php
				endforeach;
			endif; ?>

			<!-- all deductions -->
			<h4 class="text-success m-b-none">All Deductions</h4><hr class="m-t-xs" />
			<?php
			if(count($salaryDeductionList)):
				foreach($salaryDeductionList as $deduction):
					$value = '';
					$amount = '';
					if(!empty($empSalaryDetails)) {
						foreach ($empSalaryDetails as $vKey => $vDetails) {
							if ($deduction->component_p_id == $vKey) {
								$value = $vDetails;
							}
						}
					}
					if(!empty($empSalaryAmountDetails)) {
						foreach ($empSalaryAmountDetails as $aKey => $aDetails) {
							if ($deduction->component_p_id == $aKey) {
								$amount = $aDetails;
							}
						}
					} ?>
					<div class="form-group">
						<?php $type = $deduction->value_type == 'amt' ? 'Amount': 'Percent' ?>
						<?php echo form_label("$deduction->component_name <small class='text-danger'>*</small><br/><small class='text-navy'>$type</small>", '', array('class' => 'col-md-4 col-sm-5 control-label p-t-none')); ?>
						<div class="col-md-8 col-sm-7">
							<?php
							echo form_input(array(
								'type' => 'text',
								'name' => $deduction->component_p_id,
								'id' => 'component'.$deduction->component_p_id,
								'class' => 'form-control deduction key',
								'placeholder' => $deduction->component_name,
								'value' => set_value($deduction->component_p_id, $value),
								'required' => 'true'
							)); ?>

							<input type="hidden" name="amount<?= $deduction->component_p_id ?>" id="amount<?= $deduction->component_p_id ?>" value="<?= $amount ?>" />
							<input type="hidden" value="<?php echo $deduction->component_type?>" id="<?php echo 'type'.$deduction->component_p_id ?>">
							<input type="hidden" value="<?php echo $deduction->payable_amount?>" id="<?php echo 'pay'.$deduction->component_p_id ?>">
							<input type="hidden" value="<?php echo $deduction->cost_to_company?>" id="<?php echo 'cost'.$deduction->component_p_id ?>">
							<input type="hidden" value="<?php echo $deduction->value_type?>" id="<?php echo 'valueType'.$deduction->component_p_id ?>">
							<input type="hidden" value="<?php echo $deduction->add_to?>" id="<?php echo 'addTo'.$deduction->component_p_id ?>">
							<input type="hidden" name="debit[]" value="<?php echo $deduction->component_p_id ?>">
						</div>
					</div>
				<?php
				endforeach;
			endif; ?>
			<br/>
			<h4 class="text-success m-b-none">Salaray Summary</h4><hr class="m-t-xs" />
			<div class="well well-sm">
				<div class="row">
					<div class="col-md-4 col-sm-5 text-right">
						<h4 class="text-success m-b-none">Total Payable : </h4>
					</div>
					<div class="col-md-8 col-sm-7" id="resultTotalPayable">
						<h4 class="m-b-none">INR <?= !empty($salary->total_payable) ? $salary->total_payable : '0.00' ?></h4>
					</div>
					<input type="hidden" name="total_payable" id="totalPayable" value="<?= !empty($salary->total_payable) ? $salary->total_payable : '0' ?>">
				</div>

				<div class="row">
					<div class="col-md-4 col-sm-5 text-right">
						<h4 class="text-success m-b-none">Total Deduction : </h4>
					</div>
					<div class="col-md-8 col-sm-7" id="resultTotalDeduction">
						<h4 class="m-b-none">INR <?= !empty($salary->total_deduction) ? $salary->total_deduction : '0.00' ?></h4>
					</div>
					<input type="hidden" name="total_deduction" id="totalDeduction" value="<?= !empty($salary->total_deduction) ? $salary->total_deduction : '0' ?>">
				</div>

				<div class="row">
					<div class="col-md-4 col-sm-5 text-right">
						<h4 class="text-success m-b-none">CTC [Cost to Company] : </h4>
					</div>
					<div class="col-md-8 col-sm-7" id="resultCostToCompany">
						<h4 class="m-b-none">INR <?= !empty($salary->total_ctc) ? $salary->total_ctc : '0.00' ?> <small class="text-danger"><strong>[PF + ESIC] </strong></small></h4>
					</div>
					<input type="hidden" name="total_ctc" id="totalCostCompany" value="<?= !empty($salary->total_ctc) ? $salary->total_ctc : '0' ?>">
				</div>
			</div>
			<input type="hidden" name="salary-id" value="<?= !empty($salary->salary_p_id) ? $salary->salary_p_id : '' ?>" >
			<input type="hidden" name="basic" id="basic" value="<?= !empty($salary->basic) ? $salary->basic : '0' ?>" >
			<input type="hidden" name="gross" id="gross" value="<?= !empty($salary->gross) ? $salary->gross : '0' ?>" >
		</div>
	</div>

	<div class="box hourly">
		<div class="col-sm-12">
			<div class="form-group <?php if(form_error('hourly-salary')) echo 'has-error'; ?>">
				<?php echo form_label("Hourly Salary <small class='text-danger'>*</small><br/><small class='text-navy'>Amount</small>", 'hourly-salary',  array('class' => 'col-md-4 col-sm-5 control-label p-t-none')); ?>
				<div class="col-md-8 col-sm-7">
					<?php
					echo form_input(array(
						'type' => 'text',
						'name' => 'hourly-salary',
						'class' => 'form-control',
						'placeholder' => 'Hourly Salary',
						'value' => set_value('hourly-salary', $info->emp_name),
						'required' => 'true'
					));

					echo form_error('hourly-salary'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="hr-line-dashed"></div>

	<div class="text-right">
		<a class="btn bg-warning" id="editTab3"><i class="fa fa-pencil"></i> Edit</a>
		<a class="btn bg-danger" id="cancelTab3" style="display: none;"><i class="fa fa-times"></i> Cancel</a>&nbsp;
		<button class="btn btn-primary" id="saveTab3" type="submit" style="display: none;"><i class="fa fa-save"></i> Save</button>
	</div>

	<!-- script -->
	<script>
	$(document).ready(function () {
		// edit salary details
		var form = $('.tab-3');
		$('.hourly').hide();

		$('#editTab3').click(function(event) {
			form.find(':disabled').each(function() {
				$(this).removeAttr('disabled');
			});
			$('#cancelTab3').show();
			$('#saveTab3').show();
			$('#editTab3').hide();
		});

		$('#cancelTab3').click(function(event) {
			form.find(':enabled').each(function() {
				$(this).attr("disabled", "disabled");
			});
			$('#cancelTab3').hide();
			$('#saveTab3').hide();
			$('#editTab3').show();
		});

		// hide salary detail box
		$('input[type="radio"]').click(function(){
			var inputValue = $(this).attr("value");
			var targetBox = $("." + inputValue);
			$(".box").not(targetBox).hide();
			$(targetBox).show();
		});

		// salary calculate
		function  calculate(valueType, salary, basicSalary ) {
			if(valueType == 'per' && salary != 0) {
				var tmp  = salary / 100;
				return resultAmount = Math.round(tmp * basicSalary);
			} else if(salary != 0) {
				return resultAmount = Math.round(salary);
			} else {
				return resultAmount = 0;
			}
		}

		//key press
		$(".key").keyup(function() {
			var allID = [];

			$('div input[name][id][value]').each(function() {
				allID.push($(this).attr('id'));
			});

			var totalPayable = 0;
			var totalCostCompany = 0;
			var totalPayableDeduction = 0;
			var totalCompanyDeduction = 0;
			var resultDeduction = 0;
			var resultDeduction2 = 0;

			arrayLength = allID.length;
			for (var i = 0; i < arrayLength; i++) {
				var fieldId = allID[i].slice(9);
				var type = $( "#type"+fieldId ).val();
				var payable = $( "#pay"+fieldId ).val();
				var company = $( "#cost"+fieldId ).val();
				var valueType = $( "#valueType"+fieldId ).val(); // amount or percentage
				var addTo = $( "#addTo"+fieldId ).val(); // basic or gross

				var salary = ($.trim($("#component" + fieldId).val()) != "" && !isNaN($("#component" + fieldId).val())) ? parseFloat($("#component" + fieldId).val()) : 0;
				var basicSalary = ($.trim($("#component1").val()) != "" && !isNaN($("#component1").val())) ? parseInt($("#component1").val()) : 0;

				// credict and debit calculation
				if(type == 'CR') { // credit
					//total payable
					if(payable == 1) {
						var res = calculate(valueType, salary, basicSalary)
						$("#amount" + fieldId).val(res);
						totalPayable += res;
					}
					//cost to company
					if(company == 1) {
						var res = calculate(valueType, salary, basicSalary);
						$("#amount" + fieldId).val(res);
						totalCostCompany += res;
					}
				} else { //debit
					if(payable == 1 && company == 1) {
						if(addTo == 'gross') {
							var res = calculate(valueType, salary, totalPayable);
							$("#amount" + fieldId).val(res);
							var resultDeductionAmount = res;
						} else {
							var res = calculate(valueType, salary, basicSalary);
							$("#amount" + fieldId).val(res);
							var resultDeductionAmount = res;
						}
						resultDeduction += resultDeductionAmount;
					} else if(payable == 1) {
						if(addTo == 'gross') {
							var res = calculate(valueType, salary, totalPayable);
							$("#amount" + fieldId).val(res);
							var resultDeductionAmount = res;
						} else {
							var res = calculate(valueType, salary, basicSalary);
							$("#amount" + fieldId).val(res);
							var resultDeductionAmount = res;
						}
						resultDeduction += resultDeductionAmount;
					} else if(company == 1) {
						if(addTo == 'gross') {
							var resultDeductionAmount = calculate(valueType, salary, totalPayable );
						} else {
							var resultDeductionAmount = calculate(valueType, salary, basicSalary );
						}
						resultDeduction2 += resultDeductionAmount;
					} else {
						if(addTo == 'gross') {
							var res = calculate(valueType, salary, totalPayable);
							$("#amount" + fieldId).val(res);
							var resultDeductionAmount = res;
						} else {
							var res = calculate(valueType, salary, basicSalary);
							$("#amount" + fieldId).val(res);
							var resultDeductionAmount = res;
						}
						resultDeduction += resultDeductionAmount;
					}

					if(payable == 1) { // payable
						if(addTo == 'gross') {
							var res = calculate(valueType, salary, totalPayable);
							$("#amount" + fieldId).val(res);
							var resultDeductionAmount = res;
						} else {
							var res = calculate(valueType, salary, basicSalary);
							$("#amount" + fieldId).val(res);
							var resultDeductionAmount = res;
						}
						totalPayableDeduction += resultDeductionAmount ;
					}
					if(company == 1) { // cost to company
						if(addTo == 'gross') {
							var res = calculate(valueType, salary, totalPayable);
							$("#amount" + fieldId).val(res);
							var resultDeductionAmount = res;
						} else {
							var res = calculate(valueType, salary, basicSalary);
							$("#amount" + fieldId).val(res);
							var resultDeductionAmount = res;
						}
						totalCompanyDeduction += resultDeductionAmount ;
					}
				}
			}

			// salary payable
			var resultSalaryPayable = totalPayable - totalPayableDeduction;
			$('#resultTotalPayable').empty();
			$("#resultTotalPayable").append('<strong>INR '+ resultSalaryPayable  +'</strong>');
			$('#totalPayable').val(resultSalaryPayable);

			// deduction
			$('#resultTotalDeduction').empty();
			$("#resultTotalDeduction").append('<strong>INR '+ resultDeduction  +'</strong>');
			$('#totalDeduction').val(resultDeduction);

			//salary cost to company
			var resultSalaryCostToCompany = totalCostCompany + totalCompanyDeduction;
			$('#resultCostToCompany').empty();
			$("#resultCostToCompany").append('<strong>INR '+ resultSalaryCostToCompany  +'</strong>');
			$('#totalCostCompany').val(resultSalaryCostToCompany);

			$('#basic').val(basicSalary);
			$('#gross').val(totalPayable);
		});
	});
</script>
