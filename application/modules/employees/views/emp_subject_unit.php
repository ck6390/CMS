<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}/profile/{$info->emp_p_id}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Subject Unit</strong>
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
					<h5>Subject Unit</h5>
					<div class="ibox-tools">
						<small><code>*</code> Required Fields.</small>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-sm-12">
							<div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1">  Subject Unit List </a></li>
                        <li><a data-toggle="tab" href="#tab-2"> Add Subject Unit </a></li>
                        
                    </ul>
                    <div class="tab-content">
                    	<div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTablesView">
						<thead>
							<tr>
								<th width="40px">S. NO.</th>
								<th>EMPLOYEE INFO</th>
								<th>SUBJECT</th>
								<th>UNIT</th>
								<th>START DATE</th>
								<th>END DATE</th>
								<th>STATUS</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(count($unit_list) == 0) { ?>
							<tr class="text-center text-uppercase">
								<td colspan="9"><strong>NO RECORDS AVAILABLE</strong></td>
							</tr>
						<?php
						} else {
							$i = 0;
							foreach ($unit_list as $list) {
							$i++; ?>
							<tr>
								<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
								<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>

								<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->emp_name." [ ".$list->employee_id." ]",ENT_QUOTES,'UTF-8').'</span>' ?></td>

								<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->subject_name." [ ".$list->subject_code." ]",ENT_QUOTES,'UTF-8').'</span>' ?></td>

								<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->unit_number,ENT_QUOTES,'UTF-8').'</span>' ?></td>

								<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->start_date,ENT_QUOTES,'UTF-8').'</span>' ?></td>

								<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->end_date,ENT_QUOTES,'UTF-8').'</span>' ?></td>

								<td><?php echo ($list->is_active) ? '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>' : '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'; ?>
									</td>

								<td>
									<a href="<?php echo site_url("{$this->misc->_getClassName()}/subject_unit_edit/{$list->fk_emp_id}/{$list->emp_subject_unit_p_id}"); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
								</td>
							</tr>
							<?php }
						} ?>
						</tbody>
						<tfoot>
							<tr>
								<th width="40px">S. NO.</th>
								<th>EMPLOYEE INFO</th>
								<th>SUBJECT</th>
								<th>UNIT</th>
								<th>START DATE</th>
								<th>END DATE</th>
								<th>STATUS</th>
								<th>ACTION</th>
							</tr>
						</tfoot>
					</table>
				</div>
            </div>
        </div>
            <div id="tab-2" class="tab-pane ">
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
						echo form_open("{$this->misc->_getClassName()}/subject_unit/{$info->emp_p_id}", $attr); ?>

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

							<div class="form-group <?php if(form_error('subject-id')) echo 'has-error'; ?>">
								<?php echo form_label('Subject <small class="text-danger">*</small>', 'subject-id');
								
								$_subject = $this->mdl_subject->dropdown('subject_name');
								echo form_dropdown(array(
									'name' => 'subject-id',
									'class' => 'form-control select2_one',
									'required' => 'true'
								), $_subject);

									echo form_error('subject-id'); ?>
							</div>

							<div class="form-group <?php if(form_error('unit-id')) echo 'has-error'; ?>">
								<?php echo form_label('Unit <small class="text-danger">*</small>', 'unit-id');
								?>
								<select id="unitDropdown" name="unit-id" class="form-control select2_one" required="true"></select>
								<!-- $_unit = $this->mdl_unit->dropdown('unit_number');
								echo form_dropdown(array(
									'name' => 'unit-id',
									'class' => 'form-control select2_one',
									'required' => 'true'
								), $_unit); -->
								<div id="oo"></div>
								<?php echo form_error('unit-id'); ?>
							</div>

							<div class="form-group <?php if(form_error('start-date')) echo 'has-error'; ?>" id="inputhMonth">
									<?php echo form_label('Start Date<small class="text-danger">*</small>', 'start-date', array('class' => 'control-label')); ?>
										<div class="input-group date ">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<?php 
												echo form_input(array(
													'type' => 'text',
													'name' => 'start-date',
													'id' => 'month_from', 
													'class' => 'form-control',
													'required' => 'true',
													'value' => set_value('start-date')

												));
											?>
										</div>
								<?php echo form_error('start-date'); ?>
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
	
	$('select[name="subject-id"]').on('change', function() {
		var subjectID = $(this).val();
		var empID = $('input[name="employee-id"]').val();
		var formData = {'subjectID':subjectID,'empID':empID};

		$.ajax({
			url: base_url + "index.php/ajax/emp_subject_unit",
			data : formData,
			type: "POST",
			success:function(data)
			{	

				//console.log( JSON.stringify(data) );
				//$('#unitDropdown .select2_one').select2('val','');
				$('select[name="unit-id"]').html('<option> </option>');
				var dataObj = jQuery.parseJSON(data);
				
				if(dataObj) {
					$(dataObj).each(function() {
						//alert(subject_unit_p_id);
						var option = $('<option />');
						option.attr('value',this.subject_unit_p_id).text(this.unit_number);
						$('#unitDropdown').append(option);
						
					});
				} else {
					//$('#unitDropdown .select2_one').select2('val','');
				}
			}
		});
		
	});
});
</script>