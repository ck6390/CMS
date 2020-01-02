
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}/profile/{$info->emp_p_id}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Student Zone</strong>
			</li>
		</ol>
	</div>
	
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Employee  Details</h5>
                </div>
	            <div class="ibox-content no-padding border-left-right">
	                <img alt="image" class="img-responsive img-thumbnail" style="width: 100%;height: 207px;"src="<?= base_url().'assets/img/employees/'.$info->emp_photo ?>" class="img-responsive" style="width: 100%;height: 207px;">

	                <img alt="image" class="img-responsive img-thumbnail m-t" src="<?= base_url().'assets/img/employees/'.$info->emp_signature ?>" class="img-responsive" style="width: 100%;height: 50px;">

	            </div>
	            <div class="ibox-content profile-content">
	                <h4><strong><?php echo $info->emp_name; ?></strong></h4>
	                <h5><strong>Employee ID</strong></h5>
	                <h4 class="text-info"><strong><?php echo $info->employee_id; ?></strong></h4>
	                
	            </div>
	        </div>    
    	</div>
    	<div class="col-md-9">
		    <div class="row">
				<div class="col-sm-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Add Lecture </h5>
							<div class="ibox-tools">
								<small><code>*</code> Required Fields.</small>
							</div>
						</div>

						<div class="ibox-content">
							<?php
							$attr = array(
								'role' => 'form',
								'method' => 'post',
								'name' => 'add-form',
								'class' => 'form-horizontal'
							);
							echo form_open("{$this->misc->_getClassName()}/student_zone/{$info->emp_p_id}", $attr); ?>

							<div class="col-md-12">
								<div class="form-group <?php if(form_error('employee-id')) echo 'has-error'; ?>">
									<?php echo form_label('Employee <small class="text-danger">*</small>', 'employee-id');

										echo form_input(array(
											'type' => 'text',
											'class' => 'form-control',
											'placeholder' => 'Employee',
											'value' => set_value('employee', $info->emp_name.'-'.($info->employee_id)),
											'readonly' => 'true'
										));

										echo form_input(array(
											'type' => 'hidden',
											'name' => 'employee-id',
											'class' => 'form-control',
											'value' => set_value('employee', $info->emp_p_id),
										));

										echo form_error('employee-id'); ?>
								</div>

								<div class="form-group <?php if(form_error('session-id')) echo 'has-error'; ?>">
									<?php echo form_label('Session <small class="text-danger">*</small>', 'session-id');
									
									$_session = $this->mdl_session->dropdown('session_name');
									echo form_dropdown(array(
										'name' => 'session-id',
										'class' => 'form-control select2_one',
										'required' => 'true'
									), $_session);

										echo form_error('session-id'); ?>
								</div>

								<div class="form-group <?php if(form_error('semester-id')) echo 'has-error'; ?>">
									<?php echo form_label('Semester <small class="text-danger">*</small>', 'semester-id');

									$_semester = $this->mdl_semester->dropdown('semester_name');

										echo form_dropdown(array(
											'name' => 'semester-id',
											'class' => 'form-control select2_one for_subject for_unit',
											'required' => 'true'
										), $_semester);

										echo form_error('semester-id'); ?>
								</div>

								<div class="form-group <?php if(form_error('branch-id')) echo 'has-error'; ?>">
									<?php echo form_label('Branch <small class="text-danger">*</small>', 'branch-id');
									
									$_branch = $this->mdl_branch->dropdown('branch_name');
									echo form_dropdown(array(
										'name' => 'branch-id',
										'class' => 'form-control select2_one for_subject for_unit',
										'required' => 'true'
									), $_branch);

										echo form_error('branch-id'); ?>
								</div>

								<div class="form-group <?php if(form_error('period-id')) echo 'has-error'; ?>">
									<?php echo form_label('Period <small class="text-danger">*</small>', 'period-id');
									
									$_period = $this->mdl_period->dropdown('period_name');
									echo form_dropdown(array(
										'name' => 'period-id',
										'class' => 'form-control select2_one',
										'required' => 'true'
									), $_period);

										echo form_error('period-id'); ?>
								</div>

								<div class="form-group <?php if(form_error('subject-id')) echo 'has-error'; ?>">
									<?php echo form_label('Subject <small class="text-danger">*</small>', 'subject-id');
										echo form_error('subject-id'); ?>
										<select id="subjectDropdown" name="subject-id" class="form-control for_unit select2_one" required="true"></select>
								</div>

								<div class="form-group <?php if(form_error('engaged')) echo 'has-error'; ?>"><?php echo form_label('Engaged By', 'engaged'); ?>
									<select name="engaged" class="form-control select2_one select2-hidden-accessible">
										<option value="">Please Select</option>
									<?php 
									$_employee = $this->mdl_employee->engaged_of_Faculty();
									foreach($_employee as $employee){ ?>
										
										 <option value="<?php echo $employee->emp_p_id;?>"><?php echo $employee->username." - ".$employee->emp_name;?></option>
									
									<?php } ?>
									</select>
								</div> 

								<div class="form-group <?php if(form_error('unit-id')) echo 'has-error'; ?>">
									<?php echo form_label('Unit <small class="text-danger">*</small>', 'unit-id');									
									echo form_error('unit-id'); ?>
									<select id="unitDropdown" name="unit-id" class="form-control select2_one" required="true"></select>
								</div>

								<div class="form-group <?php if(form_error('lecture-required')) echo 'has-error'; ?>">
									<?php echo form_label('Lecture Required <small class="text-danger">*</small>', 'lecture-required');
									
									echo form_input(array(
										'name' => 'lecture-required',
										'class' => 'form-control',
										'readonly' => 'true',
										'required' => 'true',
										'value' => set_value('lecture-required')
									));

									echo form_error('lecture-required'); ?>
								</div>

								<div class="form-group <?php if(form_error('lecture-required')) echo 'has-error'; ?>">
									<?php echo form_label('Lecture Provided <small class="text-danger">*</small>', 'lecture-required');
									
									echo form_input(array(
										'name' => 'lecture-provided',
										'class' => 'form-control',
										'readonly' => 'true',
										'required' => 'true',
										'value' => set_value('lecture-provided')
									));

									echo form_error('lecture-provided'); ?>
								</div>

								<div class="<?php if(form_error('lecture-required')) echo 'has-error'; ?>">
									<?php 
									
									echo form_input(array(
										'type'=> 'hidden',
										'name' => 'subject-unitLct',
										'class' => 'form-control',
										'readonly' => 'true',
										'required' => 'true',
									));

									echo form_error('lecture-provided'); ?>
								</div>

								<div class="form-group <?php if(form_error('start-date')) echo 'has-error'; ?>">
									<?php
									echo form_label('Start Date <small class="text-danger">*</small>', 'start-date'); ?>

									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<?php 
										echo form_input(array(
											'type' => 'text',	
											'name' => 'start-date',
											'id' => 'data_1',
											'class' => 'form-control',
											'placeholder' => 'Start Date',
											'value' => set_value('start-date'),
											'required' => 'true',
										));

										echo form_error('start-date'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('end-date')) echo 'has-error'; ?>">
									<?php
									echo form_label('End Date', 'end-date'); ?>

									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<?php 
										echo form_input(array(
											'type' => 'text',	
											'name' => 'end-date',
											'id' => 'data_1',
											'class' => 'form-control',
											'placeholder' => 'End Date',
											'value' => set_value('end-date'),
										));

										echo form_error('end-date'); ?>
									</div>
								</div>

								<div id="data_3" class="form-group <?php if(form_error('attndnce-date')) echo 'has-error'; ?>">
									<?php
									echo form_label('Attandance Date', 'attndnce-date'); ?>

									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<?php 
										echo form_input(array(
											'type' => 'text',	
											'name' => 'attndnce-date',
											'id' => 'attndnceDt',
											'class' => 'form-control',
											'placeholder' => 'Attandance Date',
											'value' => set_value('attndnce-date'),
										));

										echo form_error('attndnce-date'); ?>
									</div>
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
<script type="text/javascript">
$(document).ready(function () {

	$('.for_subject').on('change', function() {
		var branchID = $('select[name="branch-id"]').val();
		var semester = $('select[name="semester-id"]').val();
		var formData = {'branchID':branchID,'semester':semester};
		$.ajax({
			url: base_url + "index.php/ajax/subject_list",
			data : formData,
			type: "POST",
			success:function(data)
			{	

				//console.log( JSON.stringify(data) );
				//$('#unitDropdown .select2_one').select2('val','');
				$('select[name="subject-id"]').html('<option> </option>');
				var dataObj = jQuery.parseJSON(data);				
				if(dataObj) {
					$(dataObj).each(function() {
						//alert(subject_unit_p_id);
						var option = $('<option />');
						option.attr('value',this.subject_p_id).text(this.subject_name);
						$('#subjectDropdown').append(option);
						
					});
				} else {
					//$('#unitDropdown .select2_one').select2('val','');
				}
			}
		});
		
	});

	$('.for_unit').on('change', function() {
		var branchID = $('select[name="branch-id"]').val();
		var semester = $('select[name="semester-id"]').val();
		var subject = $('select[name="subject-id"]').val();
		var formData = {'branchID':branchID,'semester':semester,'subject':subject};
		$.ajax({
			url: base_url + "index.php/ajax/lecture_unit",
			data : formData,
			type: "POST",
			success:function(data)
			{	
				alert(data);
				console.log(data);
				//console.log( JSON.stringify(data) );
				//$('#unitDropdown .select2_one').select2('val','');
				$('select[name="unit-id"]').html('<option> </option>');
				var dataObj = jQuery.parseJSON(data);
				
				if(dataObj) {
					$(dataObj).each(function() {
						//alert(subject_unit_p_id);
						var option = $('<option />');
						option.attr('value',this.unit_id).text(this.unit_number);
						$('#unitDropdown').append(option);
						
					});
				} else {
					//$('#unitDropdown .select2_one').select2('val','');
				}
			}
		});
		
	});

	$('select[name="unit-id"]').on('change', function() {
		var unitID = $(this).val();
		var branchID = $('select[name="branch-id"]').val();
		var semester = $('select[name="semester-id"]').val();
		var subject = $('select[name="subject-id"]').val();
		var formData = {'branchID':branchID,'semester':semester,'subject':subject,'unitID':unitID};
		$.ajax({
			url: base_url + "index.php/ajax/lecture_unit_detail",
			data : formData,
			type: "POST",
			success:function(data)
			{	
				var dataObj = jQuery.parseJSON(data);
				var lecture_provide;
				if(dataObj.extra_lecture != null){

					lecture_provide = parseInt(dataObj.extra_lecture)+parseInt(dataObj.lecture_required) ;
				}else if(dataObj.extra_lecture == null){

					lecture_provide = dataObj.lecture_required;
				}

				if(dataObj.startDt != null){
					startDt = dataObj.startDt;
				}else{
					startDt ="";
				}
				if(dataObj) {

					$('input[name="lecture-required"]').attr('value', dataObj.lecture_required);
					$('input[name="subject-unitLct"]').attr('value', dataObj.emp_subject_unit_p_id);
					$('input[name="lecture-provided"]').attr('value', lecture_provide);
					$('input[name="start-date"]').attr('value',startDt);
					if(startDt != ""){
						$('input[name="start-date"]').attr('readonly', true); 
					}


					var dateToday = new Date(startDt);   
				    //alert(dateToday);
					$('#attndnceDt').datepicker({
				        todayBtn: "linked",
				        minDate: dateToday,
				        startDate: new Date(dateToday),
				        keyboardNavigation: false,
				        forceParse: false,
				        calendarWeeks: true,
				        autoclose: true,
				        dateFormat: 'YY-MM-DD',
				    });

				    $("#attndnceDt" ).datepicker({ dateFormat: 'YY-MM-DD' }).datepicker(
			            "setDate", new Date(dateToday));
					
				} else {
					//$('#unitDropdown .select2_one').select2('val','');
				}
			}
		});
		
	});
	
	$("input[name='start-date']").on("change",function(){
	    //alert($(this).val());
	    var selected = $(this).val();
        
	    var dateToday = new Date(selected);   
	    //alert(dateToday);
		$('#attndnceDt').datepicker({
	        todayBtn: "linked",
	        minDate: selected,
	        startDate: new Date(selected),
	        keyboardNavigation: false,
	        forceParse: false,
	        calendarWeeks: true,
	        autoclose: true,
	        dateFormat: 'YY-MM-DD',
	    });

	    $("#attndnceDt" ).datepicker({ dateFormat: 'YY-MM-DD' }).datepicker(
            "setDate", new Date(selected));

	});
		

	
	
});
</script>

