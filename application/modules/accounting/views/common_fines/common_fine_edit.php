<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Accounting</a>
			</li>
			<li>
				<a href="<?= site_url("accounting/".$this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
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
		'name' => 'edit-form',
		'class' => 'form-horizontal edit-form',	
	);
	echo form_open("accounting/".$this->misc->_getClassName()."/edit/$info->fee_type_p_id", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Fee Type <span class="text-success">[<?= $info->fee_type_name ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('fee-type')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Type <small class="text-danger">*</small>', 'fee-type', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'fee-type',
											'class' => 'form-control',
											'placeholder' => 'Fee Type Title',
											'value' => set_value('fee-type',$info->fee_type_name),
											'required' => 'true'
										));

										echo form_error('fee-type'); ?>
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
										), $_fee_group,$info->fee_group);

										echo form_error('fee-group'); ?>
									</div>
								</div>

								<div id="feeYear" class="form-group <?php if(form_error('fee-year')) echo 'has-error'; ?>">
									<?php echo form_label('Select Year <small class="text-danger">*</small>', 'fee-year', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										$_course_year = $this->mdl_course_year->dropdown('course_year_name');

										echo form_dropdown(array(
											'name' => 'fee-year',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_course_year,$info->fee_year_id);

										echo form_error('fee-year'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('fee-amount')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Amount <small class="text-danger">*</small>', 'fee-amount', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'fee-amount',
											'class' => 'form-control',
											'placeholder' => 'Fee Amount',
											'value' => set_value('fee-type',$info->fee_type_amount),
											'required' => 'true'
										));

										echo form_error('fee-amount'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('fee-schedule')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Schedule', 'fee-schedule', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div><label> <?php echo form_radio('fee-schedule', 'annually', $info->fee_type_schedule == "annually" ? true :"")."annually"; ?> </label></div>
										<div>
										<label> <?php echo form_radio('fee-schedule', 'oneTime', $info->fee_type_schedule == "onetime" ? true :"")." One Time ( Fixed date ) "; ?> </label></div>
										
										<?php echo form_error('fee-schedule'); ?>
									</div>
								</div>

								<div class="form-group">
									<?php echo form_label('', 'fee_type', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="panel panel-success" id="feeScheduleDt">
                                        <div class="panel-heading">
                                           Fee Schedule Details
                                        </div>
                                        <div class="panel-body">
                                        	<div class="col-sm-12">
                                        		<div class="col-sm-6 <?php if(form_error('fixed-date')) echo 'has-error'; ?>">
		                                            <div class="form-group col-sm-12 ">
		                                            	<?php echo form_label('Fixed Date', 'fee_type', array('class' => 'control-label'));?>
		                                            	<div class="input-group date">
															<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															<?php 
															echo form_input(array(
																'type' => 'text',	
																'name' => 'fixed-date',
																'id' => 'data_1',
																'class' => 'form-control',
																'placeholder' => 'Fixed Date',
																'value' => set_value('fixed-date',$info->fixed_date),
																'required' => 'true'
															));
															echo form_error('fixed-date'); ?>
														</div> 
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-6 <?php if(form_error('due-date')) echo 'has-error'; ?>">
		                                            <div class="form-group col-sm-12">
		                                            	<?php echo form_label('Due Date', 'fee_type', array('class' => 'control-label'));?>
		                                            	<div class="input-group date">
															<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															<?php 
															echo form_input(array(
																'type' => 'text',	
																'name' => 'due-date',
																'id' => 'data_2',
																'class' => 'form-control',
																'placeholder' => 'Due Date',
																'value' => set_value('due-date',$info->due_date),
																'required' => 'true'
															));
															echo form_error('due-date'); ?>
														</div> 
		                                            </div>
		                                        </div>
                                        	</div>
                                        </div>
                                    </div>
									</div>
								</div>

								<div class="form-group <?php if(form_error('fee-allocated')) echo 'has-error'; ?>">
									<?php echo form_label('Allocate To', 'fee-allocated', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div>
											<label> <?php echo form_radio('fee-allocated', 'all', $info->fee_allocated == "all" ? true :"")." All Student "; ?> </label>
										</div>
										<div>
											<label> <?php echo form_radio('fee-allocated', 'student', $info->fee_allocated == "student" ? true :"")." Specific Student "; ?> </label>
										</div>
										<?php echo form_error('fee-allocated'); ?>
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
                                        		<div class="<?php if(form_error('fixed-date')) echo 'has-error'; ?>">
		                                            <div class="form-group col-sm-12 ">
		                                            	<?php echo form_label('Select Student', 'fee_type', array('class' => 'control-label'));?>
		                                            	<?php
		                                            	$_students = $this->mdl_student->dropdown('student_unique_id');
		                                            	if($info->fee_allocated == "student"){

		                                            		$studentId = $this->mdl_fee_type->get_fee_allocated_student($info->fee_type_p_id);

															echo form_dropdown(array(
																'name' => 'student-id',
																'class' => 'form-control select2_one',
																'required' => 'true'
															),$_students,$studentId->student_id);
		                                            	}else{
		                                            		echo form_dropdown(array(
															'name' => 'student-id',
															'class' => 'form-control select2_one',
															'required' => 'true'
														),$_students);
		                                            	}
														

														echo form_error('student-id'); ?>
		                                            </div>
		                                        </div>
                                        	</div>
                                        </div>
                                    </div>
									</div>
								</div>

								<div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
									<?php echo form_label('Description ', 'description', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_textarea(array(
											'name' => 'description',
											'class' => 'form-control',
											'rows' => '3',
											'placeholder' => 'Description',
											'value' => set_value('description'),
											
										));

										echo form_error('description'); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>
						<div class="text-right">
							<button class="btn btn-primary" type="submit">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>

<script type="text/javascript">
$(document).ready(function() {

	var schedule = $('input[name="fee-schedule"]:checked').val();
	
	if(schedule == "oneTime"){
		$("#feeScheduleDt").show();
	}else{
		$("#feeScheduleDt").hide();
	}


	var allocate = $('input[name="fee-allocated"]:checked').val();
	
	if(allocate == "student"){
		$("#studentData").show();
	}else{
		$("#studentData").hide();
	}


	$('select[name="fee-group"]').on('change', function() {
		var groupID = $(this).val();
		if(groupID == '1'){
			$("#feeYear").show();
			$('select[name="fee-year"]').attr("disabled", false);
		}else{
			$("#feeYear").hide();
			$('select[name="fee-year"]').attr("disabled", true);
		}
	});
	$("#feeYear").hide();
	$('select[name="fee-year"]').attr("disabled", true);


	$('input[name="fee-schedule"]').on('change', function() {
		var value = $(this).val();
		if(value=="oneTime"){
			$("#feeScheduleDt").show();
		}else{
			$("#feeScheduleDt").hide();
		} 
  	});
    


    $('input[name="fee-allocated"]').on('change', function() {
		var value = $(this).val();
		if(value=="student"){
			$("#studentData").show();
		}else{
			$("#studentData").hide();
		} 
  	});
   
});
</script>
