<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("hostel/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
	echo form_open("hostel/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Send New Sms</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> Send Sms </a></li>
                            
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="col-md-10">
								
								<div class="form-group <?php if(form_error('session')) echo 'has-error'; ?>">
									<?php echo form_label('Session <small class="text-danger">*</small>', 'session', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										$_fee_group = $this->mdl_session->dropdown('session_name');

										echo form_dropdown(array(
											'name' => 'session',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_fee_group);

										echo form_error('session'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('branch[]')) echo 'has-error'; ?>">
									<?php echo form_label('Course Year <small class="text-danger">*</small>', 'branch[]', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
											$_course_year = $this->mdl_course_year->dropdown('course_year_name');
											echo form_dropdown(array(
												'name' => 'year',
												'class' => 'form-control select2_one'
											), $_course_year);
											echo form_error('year'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('branch[]')) echo 'has-error'; ?>">
									<?php echo form_label('Branch <small class="text-danger">*</small>', 'branch[]', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										$_fee_group = $this->mdl_branch->dropdown('branch_code');

										echo form_dropdown(array(
											'name' => 'branch[]',
											'class' => 'form-control select2_one',
											'required' => 'true',
											'multiple' => 'true'
										), $_fee_group);

										echo form_error('branch[]'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('fee-group')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Group <small class="text-danger">*</small>', 'fee-group', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										$_fee_group = $this->mdl_fee_group->dropdown('fee_group_name');

										echo form_dropdown(array(
											'name' => 'fee-group',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_fee_group);

										echo form_error('fee-group'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('fee-type')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Type <small class="text-danger">*</small>', 'fee-type', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div id="feeTypeDropdown">
												<select name="fee-type" class="form-control select2_one"> </select>
										</div>
									</div>
								</div>
                              
								<div class="form-group <?php if(form_error('fee-amount')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Amount <small class="text-danger">*</small>', 'fee-amount', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										
										echo form_input(array(
											'type' => 'hidden',
											'name' => 'fee-structure-for',
											'class' => 'form-control',
											'required' => 'true'
										));

										echo form_input(array(
											'type' => 'text',

											'name' => 'fee-amount',
											'class' => 'form-control',
											'placeholder' => 'Fee Amount',
											'value' => set_value('fee-type'),
											'required' => 'true'
										));

										echo form_error('fee-amount'); ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('month')) echo 'has-error'; ?>">
									<?php echo form_label('Month <small class="text-danger">*</small>', 'month', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 

										echo form_input(array(
											'type' => 'text',	
											'name' => 'month',
											'class' => 'form-control date-own',
											'placeholder' => '2019',
											'id' => 'start_session_year',
											'value' => set_value('session-start'),
											'required' => 'true'
										));

										echo form_error('session-start'); ?>
									</div>
								</div>
								
								<div class="form-group <?php if(form_error('invoice-for')) echo 'has-error'; ?>">
									<?php echo form_label('Invoice For', 'invoice-for', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div>
											<label> <?php echo form_radio('invoice-for', 'all')." All Student "; ?> </label>
										</div>
										<div>
											<label> <?php echo form_radio('invoice-for', 'student')." Specific Student "; ?> </label>
										</div>
										<?php echo form_error('invoice-for'); ?>
									</div>
								</div>

								<div class="form-group" >
									<?php echo form_label('', 'fee_type', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9" id="studentData1">
										<span class='btn btn-primary btn-xs'> <strong> Please Select Session, Course Year and Branch First! </strong></span>
									</div>
								</div>

								<div class="form-group">
									<?php echo form_label('', 'fee_type', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="panel panel-success" id="studentData">
                                        <div class="panel-heading">
                                           Search Student
                                        </div>
                                        <div class="panel-body">
                                        	<div class="col-sm-12">
                                        		<div class="<?php if(form_error('student-id[]')) echo 'has-error'; ?>">
		                                            <div class="form-group col-sm-12 ">
		                                            	<?php echo form_label('Select Student', 'student-id[]', array('class' => 'control-label'));?>
														<div id="studentDropdown">
												<select name="student-id[]" class="form-control select2_one" multiple> </select>
										</div>
		                                            </div>
		                                        </div>
                                        	</div>
                                        </div>
                                    </div>
									</div>
								</div>

								<div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
									<?php echo form_label('Remarks ', 'description', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_textarea(array(
											'name' => 'description',
											'class' => 'form-control',
											'rows' => '3',
											'placeholder' => 'Remarks',
											'value' => set_value('description'),
											
										));

										echo form_error('description'); ?>
									</div>
								</div>

							</div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Donec quam felis</strong>

                                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
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

    $('.date-own').datepicker({
     	minViewMode: "months",
     	startView: "year", 
   		format: "MM-yyyy"
   });

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


	$('select[name="session"]' && 'select[name="year"]' && 'select[name="branch[]"]'  ).on('change', function() {
		var session = $('select[name="session"]').val();
		var branch = $('select[name="branch[]"]').val();
		var year = $('select[name="year"]').val();
		var formData = {'session':session,'branch':branch,'year':year };

		$.ajax({
			url: base_url + "index.php/hostel/hostel_invoices/student_hostel_for_Invoice/",
			
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