<!-- personal detail form -->
	<div class="col-sm-12">
		<h4 class="bg-primary p-xs">Current Job Details</h4>
	</div>
	<div class="col-md-6 b-r">

		<div class="form-group <?php if(form_error('joining-date')) echo 'has-error'; ?>">
			<?php
			echo form_label('Joining Date <small class="text-danger">*</small>', 'joining-date');

			echo form_input(array(
				'type' => 'date',
				'name' => 'joining-date',
				'class' => 'form-control',
				'value' => set_value('joining-date', $info->emp_joined_date),
				'required' => 'true'
			));

			echo form_error('joining-date'); ?>
		</div>

		<div class="form-group <?php if(form_error('employee-type')) echo 'has-error'; ?>">
			<?php
			$employeeType = $this->mdl_empe_type->dropdown('employee_type_name');
			echo form_label('Employee Type <small class="text-danger">*</small>','employee-type');

			echo form_dropdown(array(
				'name' => 'employee-type',
				'class' => 'form-control select2_one',
				'required' => 'true'
			), $employeeType, $info->emp_type);

			echo form_error('resident-type'); ?>
		</div>

		<div class="form-group <?php if(form_error('resident-type')) echo 'has-error'; ?>">
			<?php
			$residentType = array(
				'' => 'Please Select',
				'InCampus' => 'In Campus',
				'OutSide' => 'Out Side'
			);
			echo form_label('Resident Type <small class="text-danger">*</small>','resident-type');

			echo form_dropdown(array(
				'name' => 'resident-type',
				'class' => 'form-control select2_one',
				'required' => 'true'
			), $residentType, $info->emp_resident_type);

			echo form_error('resident-type'); ?>
		</div>
		<div class="form-group <?php if(form_error('department')) echo 'has-error'; ?>">
			<?php
			$_department = $this->mdl_dept->dropdown('dept_name');
			echo form_label('Department <small class="text-danger">*</small>','department');

			echo form_dropdown(array(
				'name' => 'department',
				'class' => 'form-control',
				'required' => 'true'
			), $_department, $info->emp_department_ID);

			echo form_error('department'); ?>
		</div>

		<div class="form-group <?php if(form_error('designation')) echo 'has-error'; ?>">
			<?php
			echo form_label('Designation <small class="text-danger">*</small>','designation'); ?>
			<div id="designationDropdown">
				<?php $_designations = $this->mdl_desg->get_many_by('dept_ID', $info->emp_department_ID); ?>
				<select name="designation" class="form-control" required="true">
					<?php foreach ($_designations as $_designation) { ?>
						<option value="<?= $_designation->desg_p_id ?>" <?= $info->emp_designation_ID == $_designation->desg_p_id ? 'selected':'' ?> ><?= $_designation->desg_name; ?></option>
					<?php } ?>
				</select>
			</div>

			<?php echo form_error('designation'); ?>
		</div>
		<div class="form-group <?php if(form_error('base_salary')) echo 'has-error'; ?>">		
			<?php			
			echo form_label('Base Salary', 'base_salary');

			echo form_input(array(
				'type' => 'text',
				'name' => 'base_salary',
				'class' => 'form-control',
				'placeholder' => 'base_salary',
				'value' => set_value('base_salary',$info->base_salary)
			));

			echo form_error('base_salary'); ?>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group <?php if(form_error('employement-type')) echo 'has-error'; ?>">
			<?php
			$_employmentType = $this->mdl_emp_type->dropdown('emp_type_name');
			echo form_label('Nature Of Joining <small class="text-danger">*</small>' ,'employement-type');

			echo form_dropdown(array(
				'name' => 'employement-type',
				'class' => 'form-control',
				'required' => 'true'
			), $_employmentType, $info->emp_employment_type);

			echo form_error('employement-type'); ?>
		</div>

		<div class="form-group <?php if(form_error('in-time')) echo 'has-error'; ?>">
			<?php
			echo form_label('In Time <small class="text-danger">*</small>', 'inTime'); ?>
			<div class="input-group clockpicker" data-autoclose="true">
			
				<?php 
					echo form_input(array(
						'type' => 'time',
						'name' => 'in-time',
						'class' => 'form-control',
						'value' => set_value('in-time', $info->emp_login_time),
						'required' => 'true',
						'placeholder' => 'Log in Time'
					));

					echo form_error('in-time'); ?>
        
                <span class="input-group-addon">
                    <span class="fa fa-clock-o"></span>
                </span>
    		</div>
		</div>

		<div class="form-group <?php if(form_error('out-time')) echo 'has-error'; ?>">
			<?php
			echo form_label('Out Time <small class="text-danger">*</small>', 'out-time'); ?>
			<div class="input-group clockpicker" data-autoclose="true">
			
				<?php 
					echo form_input(array(
						'type' => 'time',
						'name' => 'out-time',
						'class' => 'form-control',
						'value' => set_value('out-time',$info->emp_logout_time),
						'required' => 'true',
						'placeholder' => 'Log Out Time'
					));

					echo form_error('out-time'); ?>
        
                <span class="input-group-addon">
                    <span class="fa fa-clock-o"></span>
                </span>
    		</div>
		</div>

		<div class="form-group <?php if(form_error('salary')) echo 'has-error'; ?>">
			<input type="hidden" name="previous_salary" id="previous_salary" value="<?= $info->emp_salary ?>">
			<?php
			$inreament_salary = get_increament($info->emp_p_id);
			
			if(!empty($inreament_salary)){
				$salary =  $inreament_salary->emp_salary;
			}else{
				$salary = $info->emp_salary;
			}
			echo form_label('Increased Salary  <small class="text-danger">*</small>', 'salary');
			echo form_input(array(
				'type' => 'text',
				'name' => 'salary',
				'class' => 'form-control',
				'placeholder' => 'salary',
				'value' => set_value('salary',$salary)
			));

			echo form_error('salary'); ?>
		</div>

		<div class="form-group <?php if(form_error('allowance')) echo 'has-error'; ?>">
			<input type="hidden" name="previous_allowance" id="previous_allowance" value="<?= $info->allowance ?>">
			<?php
			if(!empty($inreament_salary)){
				$allowance =  $inreament_salary->allowance;
			}else{
				$allowance = $info->allowance;
			}
			echo form_label('Other Allowance', 'allowance');

			echo form_input(array(
				'type' => 'text',
				'name' => 'allowance',
				'class' => 'form-control',
				'placeholder' => 'allowance',
				'value' => set_value('allowance',$allowance)
			));

			echo form_error('allowance'); ?>
		</div>
		<div class="form-group <?php if(form_error('joing_salary')) echo 'has-error'; ?>">		
			<?php			
			echo form_label('Joing Salary', 'joing_salary');

			echo form_input(array(
				'type' => 'text',
				'name' => 'joing_salary',
				'class' => 'form-control',
				'placeholder' => 'joing_salary',
				'value' => set_value('joing_salary',$info->joing_salary)
			));

			echo form_error('joing_salary'); ?>
		</div>
	</div>

	<div class="clearfix"></div><br/>

	<div class="col-sm-12">
		<h4 class="bg-primary p-xs">Document List</h4>
	</div>
	<div class="col-sm-12 table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>File Name</th>
					<th>Download Link</th>
				</tr>
			</thead>
			<tbody>
				<?php if($info->emp_resume != null) { ?>
				<tr>
					<td><strong>Resume</strong></td>
					<td>
						<a href="<?= base_url(); ?>assets/img/employees/<?= $info->emp_resume ?>" class="btn btn-xs btn-info m-b-none" title="Resume/CV Copy" target="_blank">Download</a>
					</td>
				</tr>
				<?php } if($info->emp_id_proof != null) { ?>
				<tr>
					<td><strong>ID Proof</strong></td>
					<td>
						<a href="<?= base_url(); ?>assets/img/employees/<?= $info->emp_id_proof ?>" class="btn btn-xs btn-info m-b-none" title="ID Proof Copy" target="_blank">Download</a>
					</td>
				</tr>
				<?php } if($info->emp_joining_letter != null) { ?>
				<tr>
					<td><strong>Joining Letter</strong></td>
					<td>
						<a href="<?= base_url(); ?>assets/img/employees/<?= $info->emp_joining_letter ?>" class="btn btn-xs btn-info m-b-none" title="Joining Letter Copy" target="_blank">Download</a>
					</td>
				</tr>
				<?php } if($info->emp_agreement != null) { ?>
				<tr>
					<td><strong>Agreement Letter</strong></td>
					<td>
						<a href="<?= base_url(); ?>assets/img/employees/<?= $info->emp_agreement ?>" class="btn btn-xs btn-info m-b-none" title="Agreement Copy" target="_blank">Download</a>
					</td>
				</tr>
				<?php } ?>
				<input type="hidden" name="emp_resume" value="<?= $info->emp_resume ?>" />
				<input type="hidden" name="emp_id_proof" value="<?= $info->emp_id_proof ?>" />
				<input type="hidden" name="emp_joining_letter" value="<?= $info->emp_joining_letter ?>" />
				<input type="hidden" name="emp_agreement" value="<?= $info->emp_agreement ?>" />
			</tbody>
		</table>
	</div>
	<p class="text-danger text-right p-w-sm"><small><code>*</code> Document should be less than 1 MB in size and .pdf, .doc, .docx format only.</small></p>
	<div class="col-md-6 b-r">
		<label>Resume</label>
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Select file</span>
				<span class="fileinput-exists">Change</span>
				<input type="file" name="resume" />
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
		</div>

		<label>ID Proof</label>
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Select file</span>
				<span class="fileinput-exists">Change</span>
				<input type="file" name="id_proof" />
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
		</div>
	</div>

	<div class="col-md-6">
		<label>Joining Letter</label>
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Select file</span>
				<span class="fileinput-exists">Change</span>
				<input type="file" name="joining_letter" />
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
		</div>

		<label>Agreement Letter</label>
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Select file</span>
				<span class="fileinput-exists">Change</span>
				<input type="file" name="agreement_letter" />
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="hr-line-dashed"></div>

	<div class="col-sm-12 text-right">
		<a class="btn bg-warning" id="editTab2"><i class="fa fa-pencil"></i> Edit</a>
		<a class="btn bg-danger" id="cancelTab2" style="display: none;"><i class="fa fa-times"></i> Cancel</a>&nbsp;
		<button class="btn btn-primary" id="saveTab2" type="submit" style="display: none;"><i class="fa fa-save"></i> Save</button>
	</div>

	<!-- script -->
	<script>
	$(document).ready(function () {
		var form = $('.tab-2');

		$('#editTab2').click(function(event) {
			form.find(':disabled').each(function() {
				$(this).removeAttr('disabled');
			});
			$('#cancelTab2').show();
			$('#saveTab2').show();
			$('#editTab2').hide();
		});

		$('#cancelTab2').click(function(event) {
			form.find(':enabled').each(function() {
				$(this).attr("disabled", "disabled");
			});
			$('#cancelTab2').hide();
			$('#saveTab2').hide();
			$('#editTab2').show();
		});
	});
	</script>
