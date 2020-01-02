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
			<li class="active">
				<strong>Active Semester</strong>
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
					<h5>Active Semester</h5>
					<div class="ibox-tools">
						<small><code>*</code> Required Fields.</small>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-sm-12">
							<div class="tabs-container">
			                    <ul class="nav nav-tabs">
			                        <li class="<?php if(empty($edit)){ echo'active'; }?>"><a data-toggle="tab" href="#tab-1">  Semester List </a></li>
			                        <li><a data-toggle="tab" href="#tab-2"> Add Semester </a></li>
				                    <?php if(isset($edit)){ ?>
		                            <li  class="active"><a href="#tab-3"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> Edit Semester</a> </li>
		                            <?php } ?>
			                       <!--  <li><a data-toggle="tab" href="#tab-3"> Edit Semester </a></li> -->
			                    </ul>
                    <div class="tab-content">
                    	<div id="tab-1" class="tab-pane <?php if(empty($edit)){ echo'active'; }?>">
                            <div class="panel-body">
                                <div class="table-responsive">
									<table class="table table-striped table-bordered table-hover dataTablesView">
										<thead>
											<tr>
												<th width="40px">S. NO.</th>
												<th>SEMESTER</th>
												<th>SESSION</th>
												<th>START DATE</th>
												<th>END DATE</th>
												<th>STATUS</th>
												<th>ACTION</th> 
											</tr>
										</thead>
										<tbody>
										<?php
										if(count($lists) == 0) { ?>
											<tr class="text-center text-uppercase">
												<td colspan="9"><strong>NO RECORDS AVAILABLE</strong></td>
											</tr>
										<?php
										} else {
											$i = 0;
											foreach ($lists as $list) {
											$i++; ?>
											<tr>
												<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
												<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>

												<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->semester_name,ENT_QUOTES,'UTF-8').'</span>' ?></td>

												<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->session_name,ENT_QUOTES,'UTF-8').'</span>' ?></td>

												<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->startDt,ENT_QUOTES,'UTF-8').'</span>' ?></td>

												<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->endDt,ENT_QUOTES,'UTF-8').'</span>' ?></td>

												<td><?php echo ($list->is_active) ? anchor("super_admin/{$this->misc->_getClassName()}/deactivate/" . $list->id, '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("super_admin/{$this->misc->_getClassName()}/activate/" . $list->id, '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
												</td>

												<td>
													 <a href="<?php echo site_url("super_admin/{$this->misc->_getClassName()}/edit/{$list->id}"); ?>" class="btn btn-success btn-xs">
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
												<th>SEMESTER</th>
												<th>SESSION</th>
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
			                    <div class="col-md-12">
											
									<?php
									$attr = array(
										'role' => 'form',
										'method' => 'post',
										'name' => 'add-form',
										'class' => 'form-horizontal'
									);
									echo form_open("super_admin/{$this->misc->_getClassName()}", $attr); ?>

									<div class="col-sm-6">
										<div class="col-sm-12">
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
										</div>
									</div>
									

									<div class="col-sm-6">
										<div class="col-sm-12">
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
										</div>
									</div>

									<div class="col-sm-6">
										<div class="col-sm-12">
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
										</div>
									</div>

									<div class="col-sm-6">
										<div class="col-sm-12">
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
										</div>
									</div>
									<div class="text-right">
										<button class="btn btn-primary" type="submit">Save</button>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
	                    </div>
	                    <?php if(isset($edit)){ ?>
	                    <div id="tab-3" class="tab-pane <?php if(!empty($edit)){ echo'active'; }?>">
			                <div class="panel-body">
			                    <div class="col-md-12">
											
									<?php
									$attr = array(
										'role' => 'form',
										'method' => 'post',
										'name' => 'edit-form',
										'class' => 'form-horizontal'
									);
									echo form_open("super_admin/{$this->misc->_getClassName()}/edit/{$info->id}", $attr); ?>

									<div class="col-sm-6">
										<div class="col-sm-12">
											<div class="form-group <?php if(form_error('session-id')) echo 'has-error'; ?>">
												<?php echo form_label('Session <small class="text-danger">*</small>', 'session-id');

												$_session = $this->mdl_session->dropdown('session_name');

													echo form_dropdown(array(
														'name' => 'session-id',
														'class' => 'form-control select2_one',
														'required' => 'true'
													), $_session,$info->fk_session_id);

													echo form_error('session-id'); ?>
											</div>
										</div>
									</div>
									

									<div class="col-sm-6">
										<div class="col-sm-12">
											<div class="form-group <?php if(form_error('semester-id')) echo 'has-error'; ?>">
												<?php echo form_label('Semester <small class="text-danger">*</small>', 'semester-id');

												$_semester = $this->mdl_semester->dropdown('semester_name');

													echo form_dropdown(array(
														'name' => 'semester-id',
														'class' => 'form-control select2_one for_subject for_unit',
														'required' => 'true'
													), $_semester,$info->fk_semester_id);

													echo form_error('semester-id'); ?>
											</div>
										</div>
									</div>

									<div class="col-sm-6">
										<div class="col-sm-12">
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
														'value' => set_value('start-date',$info->startDt),
														'required' => 'true',
													));

													echo form_error('start-date'); ?>
												</div>
											</div>
										</div>
									</div>

									<div class="col-sm-6">
										<div class="col-sm-12">
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
														'value' => set_value('end-date',$info->endDt),
													));

													echo form_error('end-date'); ?>
												</div>
											</div>
										</div>
									</div>
									<div class="text-right">
										<button class="btn btn-primary" type="submit">Edit</button>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
	                    </div>
	                    <?php } ?>
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
	
	$('select[name="subject-id"]').on('change', function() {
		var subjectID = $(this).val();
		//var empID = $('input[name="employee-id"]').val();
		var formData = {'subjectID':subjectID};

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