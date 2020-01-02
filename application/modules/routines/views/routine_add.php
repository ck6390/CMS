<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("navigations/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
		'name' => 'add-form',
		'class' => 'form-horizontal'
	);
	echo form_open("{$this->misc->_getClassName()}/add", $attr); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Add New Routine</h5>
					<div class="ibox-tools">
						<small><code>*</code> Required Fields.</small>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-sm-12">
							<div class="tabs-container">
                        		<ul class="nav nav-tabs">
                            		<li class="active"><a data-toggle="tab" href="#tab-1"> Routine </a></li>
                            
                        		</ul>
                        		<div class="tab-content">
                            		<div id="tab-1" class="tab-pane active">
                                		<div class="panel-body">
                                    		<div class="col-md-6 b-r">
                                    			<div class="col-md-12">
								
													<div class="form-group <?php if(form_error('session')) echo 'has-error'; ?>">
														<?php echo form_label('Session <small class="text-danger">*</small>', 'session'); 
														$_session = $this->mdl_session->dropdown('session_name');

														echo form_dropdown(array(
															'name' => 'session',
															'class' => 'form-control select2_one',
															'required' => 'true'
														), $_session);

														echo form_error('session'); ?>
													</div>

													<div class="form-group <?php if(form_error('branch')) echo 'has-error'; ?>">
														<?php echo form_label('Branch <small class="text-danger">*</small>', 'branch');

															$_branch = $this->mdl_branch->dropdown('branch_name');

															echo form_dropdown(array(
																'name' => 'branch',
																'class' => 'form-control select2_one',
																'required' => 'true'
															), $_branch);

															echo form_error('branch'); ?>
													</div>

													<div class="form-group <?php if(form_error('teacher')) echo 'has-error'; ?>">
														<?php echo form_label('Teacher<small class="text-danger">*</small>', 'teacher');

															$_teacher = $this->mdl_employee->dropdown('emp_name');
															echo form_dropdown(array(
																'name' => 'teacher',
																'class' => 'form-control select2_one'
															), $_teacher);
															echo form_error('teacher'); ?>
													</div>

													<div class="form-group <?php if(form_error('start-time')) echo 'has-error'; ?>">
														<?php echo form_label('Start Time <small class="text-danger">*</small>', 'start-time');?>
														<div class="input-group clockpicker" data-autoclose="true">
															<?php echo form_input(array(
																'type' => 'text',
																'name' => 'start-time',
																'class' => 'form-control',
																'required' => 'true'
															));
															echo form_error('start-time');?>
                                							
                                							<span class="input-group-addon">
                                    							<span class="fa fa-clock-o"></span>
                                							</span>
                            							</div>
                            						</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="col-md-12">

													<div class="form-group <?php if(form_error('semester')) echo 'has-error'; ?>">
														<?php echo form_label('Semester<small class="text-danger">*</small>', 'semester');
															$_semester = $this->mdl_semester->dropdown('semester_name');
															echo form_dropdown(array(
																'name' => 'semester',
																'class' => 'form-control select2_one'
															), $_semester);
															echo form_error('semester'); ?>
													</div>

													<div class="form-group <?php if(form_error('subject')) echo 'has-error'; ?>">
														<?php echo form_label('Subject<small class="text-danger">*</small>', 'subject');

															$_subject = $this->mdl_subject->dropdown('subject_name');
															echo form_dropdown(array(
																'name' => 'subject',
																'class' => 'form-control select2_one'
															), $_subject);
															echo form_error('subject'); ?>
													</div>

													<div class="form-group <?php if(form_error('days')) echo 'has-error'; ?>">
														<?php $_option = array(
															'' => '==Please Select One Option==',
															'Monday' => 'Monday',
															'Tuesday' => 'Tuesday',
															'Wednesday' => 'Wednesday',
															'Thrusday' => 'Thrusday',
															'Friday' => 'Friday',
															'Saturday' => 'Saturday'
														);
														echo form_label('Days <small class="text-danger">*</small>', 'days');
														
														echo form_dropdown(array(
															'type' => 'text',	
															'name' => 'days',
															'class' => 'form-control select2_one',
															'placeholder' => 'Days',
															'required' => 'true'
														), $_option);
														echo form_error('days'); ?>
													</div>

													<div class="form-group <?php if(form_error('end-time')) echo 'has-error'; ?>">
														<?php echo form_label('End Time <small class="text-danger">*</small>', 'end-time');?>
														<div class="input-group clockpicker" data-autoclose="true">
															<?php echo form_input(array(
																'type' => 'text',
																'name' => 'end-time',
																'class' => 'form-control',
																'required' => 'true'
															));
															echo form_error('end-time');?>
                                							
                                							<span class="input-group-addon">
                                    							<span class="fa fa-clock-o"></span>
                                							</span>
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
					<div class="hr-line-dashed"></div>
					<div class="text-right">
						<button id="invoiceBtn" class="btn btn-primary" type="submit">Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('select[name="fee-type"]').on('change', function() {
		var feeStructuretype = $(this).val();
		if(feeStructuretype == "annual"){
			$('#courseYear').show();
			$('#semesterFee').hide();
	
		}else{
			$('#courseYear').hide();	
			$('#semesterFee').show();
			$('#feeTypeList').empty();
		
		}
	});
	$('#semesterFee').hide();
	$('#courseYear').hide();



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

	$('select[name="fee-group"]').on('change', function() {
		var feeGroupID = $(this).val();
		if(feeGroupID) {
			$.ajax({
				url: base_url + "index.php/accounting/fee_types/get_feeType_list_by_group/" + feeGroupID,
				type: "POST",
				success:function(data)
				{
					$('#feeTypeDropdown .select2_one').select2('val','');
					$('select[name="fee-type"]').html('<option value="" selected="true">== Please select one option ==</option>');
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {
							var option = $('<option />');
							option.attr('value', this.fee_type_p_id).text(this.fee_type_name);
							$('select[name="fee-type"]').append(option);
						});
					} else {
						$('#feeTypeDropdown .select2_one').select2('val','');
					}
				}
			});
		} else {
			$('#feeTypeDropdown .select2_one').select2('val','');
		}
	});


	$('select[name="branch[]').on('change', function() {
		var branch = $(this).val();
		var session = $('select[name="session"]').val();
		var year = $('select[name="year"]').val();	
		var semester = $('select[name="semester"]').val();
		var feestypes = $('select[name="fee-type"]').val();
		var formData = {'session':session,'branch':branch,'year':year, 'semester':semester,'feestypes':feestypes};
		if(feestypes =="semester"){
			$.ajax({
			url: base_url + "index.php/accounting/invoices/get_semester_fee/",
			
			data : formData,
			type: "POST",
			success:function(data)
			{
				var dataObj = jQuery.parseJSON(data);
				if(dataObj) {
					$(dataObj).each(function() {
						
						$("#feeList").html('<div class="panel panel-primary"><div class="panel-heading">Fee List</div><div class="panel-body"><p><strong>Semester Fee  :  '+this.semester_fee+'</strong></p></div></div>');
						$('input[name="fee-structure-for"]').attr('value', this.fee_structure_p_id);
						$('input[name="fee-amount"]').attr('value', this.total_fee);
						$("#invoiceBtn").attr("disabled", false);
						
					});
				} else {
					$("#feeList").html("<div class=\"panel panel-primary\"><div class=\"panel-heading\">Fee List</div><div class=\"panel-body\"><p>No Fee Available</p></div></div>");
					$('input[name="fee-amount"]').attr('value', '');
					$("#invoiceBtn").attr("disabled", true);
				}
			}
		});
		}else{
			$.ajax({
			url: base_url + "index.php/accounting/invoices/get_annual_fee/",
			
			data : formData,
			type: "POST",
			success:function(data)
			{
				var dataObj = jQuery.parseJSON(data);
				if(dataObj) {
					$(dataObj).each(function() {
						
						$("#feeList").html('<div class="panel panel-primary"><div class="panel-heading">Fee List</div><div class="panel-body"><p><strong>Tution Fee  :  '+this.tution_fee+'</strong></p><p><strong>Admission Fee  :  '+this.admission_fee+'</strong></p><p><strong>Library Fee  :  '+this.library_fee+'</strong></p><p><strong>Magazine Fee  :  '+this.magazine_fee+'</strong></p><p><strong>Exam Fee (Internal) Fee  :  '+this.exam_fee_internal+'</strong></p><p><strong>Sports  :  '+this.sports_fee+'</strong></p><p><strong>Medical Exam. Fee  :  '+this.medical_exam_fee+'</strong></p><p><strong>Development & Establishment Fee  :  '+this.developement_fee+'</strong></p><p><strong>Miscellaneous Fee  :  '+this.miscellaneous_fee+'</strong></p><p><strong>Other Fee  :  '+this.other_fee+'</strong></p></div></div>');
						$('input[name="fee-structure-for"]').attr('value', this.fee_structure_p_id);
						$('input[name="fee-amount"]').attr('value', this.total_fee);
						$("#invoiceBtn").attr("disabled", false);
						
					});
				} else {
					$("#feeList").html("<div class=\"panel panel-primary\"><div class=\"panel-heading\">Fee List</div><div class=\"panel-body\"><p>No Fee Available</p></div></div>");
					$('input[name="fee-amount"]').attr('value', '');
					$("#invoiceBtn").attr("disabled", true);
				}
			}
		});
		}

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