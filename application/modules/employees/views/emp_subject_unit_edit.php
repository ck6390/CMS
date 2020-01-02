<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("accounting/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
	<div class="row">
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Subject Unit Edit</h5>
					<div class="ibox-tools">
						<small><code>*</code> Required Fields.</small>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-sm-12">
							<div class="tabs-container">
                    
                    <div class="tab-content">
                    	
			            <div id="tab-2" class="tab-pane active">
			                <div class="panel-body">
			                    <div class="col-md-1"></div>
			                    <div class="col-md-8">
											
									<?php
									$attr = array(
										'role' => 'form',
										'method' => 'post',
										'name' => 'add-form',
										'class' => 'form-horizontal'
									);
									echo form_open("{$this->misc->_getClassName()}/subject_unit_edit/{$info->fk_emp_id}/{$info->emp_subject_unit_p_id}", $attr); ?>

									<div class="col-md-12">
										<div class="form-group <?php if(form_error('employee-id')) echo 'has-error'; ?>">
											<?php echo form_label('Employee <small class="text-danger">*</small>', 'employee-id');

												echo form_input(array(
													'type' => 'text',
													'class' => 'form-control',
													'placeholder' => 'Employee',
													'value' => set_value('employee', $emp_info->emp_name.'-'.($emp_info->employee_id)),
													'readonly' => 'true'
												));

												echo form_input(array(
													'type' => 'hidden',
													'name' => 'employee-id',
													'class' => 'form-control',
													'value' => set_value('employee', $emp_info->emp_p_id),
												));

												echo form_error('employee-id'); ?>
										</div>

										<div class="form-group <?php if(form_error('subject-id')) echo 'has-error'; ?>">
											<?php echo form_label('Subject <small class="text-danger">*</small>', 'subject-id');
											
											$_subject = $this->mdl_subject->get($info->fk_subject_id)->subject_name;
											echo form_input(array(
												'name' => 'subject-id',
												'class' => 'form-control',
												'required' => 'true',
												'readonly' => 'true',
												'value' => set_value('unit-id',$_subject)
											));

											echo form_error('subject-id'); ?>
										</div>

										<div class="form-group <?php if(form_error('unit-id')) echo 'has-error'; ?>">
											<?php echo form_label('Unit <small class="text-danger">*</small>', 'unit-id');
											
											$_unit = $this->mdl_unit->get($info->unit_id)->unit_number;
											echo form_input(array(
												'name' => 'unit-id',
												'class' => 'form-control',
												'required' => 'true',
												'readonly' => 'true',
												'value' => set_value('unit-id',$_unit)
											));

												echo form_error('unit-id'); ?>
										</div>

										<div class="form-group <?php if(form_error('start-date')) echo 'has-error'; ?>" id="">
												<?php echo form_label('Start Date<small class="text-danger">*</small>', 'start-date', array('class' => 'control-label')); ?>
													<div class="input-group ">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
														<?php 
															echo form_input(array(
																'type' => 'text',
																'name' => 'start-date', 
																'class' => 'form-control',
																'required' => 'true',
																'readonly' => 'true',
																'value' => set_value('start-date',$info->start_date)

															));
														?>
													</div>
											<?php echo form_error('start-date'); ?>
										</div>
										<div class="form-group <?php if(form_error('end-date')) echo 'has-error'; ?>" id="inputhMonth">
												<?php echo form_label('End Date<small class="text-danger">*</small>', 'start-date', array('class' => 'control-label')); ?>
													<div class="input-group date ">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
														<?php 
															echo form_input(array(
																'type' => 'text',
																'name' => 'end-date', 
																'class' => 'form-control',
																'required' => 'true',
																'value' => set_value('end-date',$info->end_date)

															));
														?>
													</div>
											<?php echo form_error('end-date'); ?>
										</div>
									</div>
									<div class="text-right">
										<button class="btn btn-primary" type="submit">Save</button>
									</div>
									<?php echo form_close(); ?>

									</div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
						</div>
					</div>

						
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $('input[name="invoice-for"]').on('change', function() {
		var value = $(this).val();
		if(value=="student"){
			$("#studentData").show();
			$("#studentData1").hide();
			

		}else{
			$("#studentData").hide();
			$("#studentData1").show();
			
		} 
  	});
    $("#studentData").hide();
    $("#studentData1").hide();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('select[name="fee-type"]').on('change', function() {
		var feeTypeID = $(this).val();
		if(feeTypeID) {
			$.ajax({
				url: base_url + "index.php/accounting/fee_types/get_feeType_amount/" + feeTypeID,
				type: "POST",
				success:function(data)
				{
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						
						$('input[name="fee-amount"]').attr('value', dataObj.fee_type_amount);
					
					} else {
						$('input[name="fee-amount"]').attr('value', '');
					}
				}
			});
		} else {
			$('input[name="fee-amount"]').attr('value', '');
		}
	});
	


	$('select[name="branch[]').on('change', function() {
		var branch = $(this).val();
		var session = $('select[name="session"]').val();
		var year = $('select[name="year"]').val();	
		var semester = $('select[name="semester"]').val();
		var formData = {'session':session,'branch':branch,'year':year, 'semester':semester};

		$.ajax({
			url: base_url + "index.php/accounting/invoices/get_student_for_Invoice/",
			
			data : formData,
			type: "POST",
			success:function(data)
			{
				$('#studentDropdown .select2_one').select2('val','');
				$('select[name="student-id[]"]').html('<option> </option>');
				var dataObj = jQuery.parseJSON(data);
				if(dataObj) {
					$(dataObj).each(function() {
						var option = $('<option />');
						option.attr('value',this.student_p_id).text(this.student_unique_id);
						$('select[name="student-id[]"]').append(option);
						$("#studentData1").html("<span class='btn btn-primary btn-xs'> <strong>Invoice will be generated for all student.  </strong></span>");
						$("#invoiceBtn").attr("disabled", false);
					});
				} else {
					$('#studentDropdown .select2_one').select2('val','');
					$("#studentData1").html("<span class='btn btn-primary btn-xs'> <strong> No Student Available! </strong></span>");
					$("#invoiceBtn").attr("disabled", true);
				}
			}
		});
		
	});
});
</script>