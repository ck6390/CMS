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
				<a href="<?= site_url("accounting/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getMethodName()); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			
			<?php 
            $val = json_decode(check_sms(),true);
            echo "<h3 class='btn btn-primary'>Available SMS - [".@$val[0]['routeBalance']."]</h3>";
        ?>
		</div>
		
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
	echo form_open("{$this->misc->_getClassName()}/send_sms", $attr); ?>
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
                            <li class="active"><a data-toggle="tab" href="#tab-1"> SMS </a></li>
                            
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

								
								<div class="form-group <?php if(form_error('year')) echo 'has-error'; ?>">
									<?php echo form_label('Course Year <small class="text-danger">*</small>', 'year', array('class' => 'col-sm-3 control-label')); ?>
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
								
								<div id="semesterFee">
									<div class="form-group <?php if(form_error('semester')) echo 'has-error'; ?>">
										<?php echo form_label('Semester<small class="text-danger">*</small>', 'semester-fee',array('class' => 'col-sm-3 control-label'));  ?>
										<div class="col-sm-9">
											<?php 
												$semesterFee = $this->mdl_semester->dropdown('semester_name');
												echo form_dropdown(array(
													'name' => 'semester',
													'class' => 'form-control select2_one'
												), $semesterFee);
												echo form_error('semester'); ?>
										</div>
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
								
                                
								
								<div class="form-group <?php if(form_error('sms-for')) echo 'has-error'; ?>">
									<?php echo form_label('SMS For', 'sms-for', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div>
											<label> <?php echo form_radio('sms-for', 'all')." All Student "; ?> </label>
										</div>
										<div>
											<label> <?php echo form_radio('sms-for', 'student')." Specific Student "; ?> </label>
										</div>
										<?php echo form_error('sms-for'); ?>
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

								<div class="form-group <?php if(form_error('message')) echo 'has-error'; ?>">
									<?php echo form_label('Message ', 'message', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_textarea(array(
											'name' => 'message',
											'class' => 'form-control',
											'rows' => '3',
											'placeholder' => 'Message',
											'value' => set_value('message'),
											
										));

										echo form_error('message'); ?>
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

    $('input[name="sms-for"]').on('change', function() {
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
	$('select[name="branch[]').on('change', function() {
		var branch = $(this).val();
		var session = $('select[name="session"]').val();
		var year = $('select[name="year"]').val();	
		var semester = $('select[name="semester"]').val();
		var formData = {'session':session,'branch':branch,'year':year, 'semester':semester};

		$.ajax({
			url: base_url + "index.php/sms/get_student_for_sms/",
			
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
						$("#studentData1").html("<span class='btn btn-primary btn-xs'> <strong>SMS will be send for all student.  </strong></span>");
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