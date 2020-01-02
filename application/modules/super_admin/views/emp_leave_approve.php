<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong>Profile</strong>
			</li>
		</ol>
	</div>
	
</div>
<div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Employee Photo</h5>
                        </div>
                        <div class="ibox-content no-padding border-left-right">
                            <img src="<?= base_url().'assets/img/employees/'.$employeeInfo->emp_photo ?>" class="img-responsive" style="width: 100%;height: 207px;">

                            <img src="<?= base_url().'assets/img/employees/'.$employeeInfo->emp_signature ?>" class="img-responsive" style="width: 100%;height: 50px;">  

                        </div>
                        <div class="ibox-content profile-content">
                            
                        </div>
                	</div>
                </div>
                <div class="col-md-9">
                   <div class="row">
						<div class="col-sm-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Employee Basic Details</h5>
									<div class="ibox-tools">
										<small><code>*</code> Required Fields.</small>
									</div>
								</div>


								<div class="ibox-content">
									<table class="table table-bordered table-hover">
			                                
			                            <tbody>
						                    <tr>
						                       <td><strong>Employee Id</strong></td>
						                       <td><h4 class="text-info"><strong><?php echo $employeeInfo->username; ?></strong></h4></td>
						                       <td><strong>Employee Name</strong></td>
						                       <td><?php echo $employeeInfo->emp_name; ?></td>
						                        
						                    </tr>
						                    <tr>
						                       
						                       <td><strong>Contact No</strong></td>
						                       <td><?php echo $employeeInfo->emp_phone; ?></td>
						                       <td><strong>Email ID</strong></td>
						                       <td><?php echo $employeeInfo->emp_email; ?></td>
						                        
						                    </tr>
						                    
						                    <tr>
						                    	<td><strong>Gender</strong></td>
												<td><?php echo $employeeInfo->emp_gender; ?></td>
												<td><strong>Employee Tyoe</strong></td>
						                       	<td><?php echo $this->mdl_empe_type->get($employeeInfo->emp_type)->employee_type_name; ?></td>  
						                    </tr>
						                    <tr>
						                       	<td><strong>Designation</strong></td>
												<td><?php echo $this->mdl_dept->get($employeeInfo->emp_department_ID)->dept_name; ?></td>
						                       	<td><strong>Department</strong></td>
						                       	<td><?php echo $this->mdl_desg->get($employeeInfo->emp_designation_ID)->desg_name; ?></td> 
						                    </tr>
						                    <tr>
						                       <td><strong>Address</strong></td>
						                       <td><?php echo $employeeInfo->emp_address." ".$employeeInfo->emp_state."-".$employeeInfo->emp_pincode; ?>
						                       </td>
						                       <td><strong>Employee Status</strong></td>
						                       	<td>
						                       		<?php echo ($employeeInfo->is_active) ? '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>' : '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'?>
						                       	</td> 
						                    </tr>
			                            </tbody>
			                        </table>

								</div>
							</div>
						</div>
					</div>
                </div>
            </div>

            <div class="row">
            	<div class="ibox float-e-margins m-t">
                    <div class="ibox-title">
                        <h5>Apply Leave </h5>
                    </div>
                    <div class="ibox-content">
                	<?php
						$attr = array(
							'role' => 'form',
							'method' => 'post',
							'name' => 'add-form',
							'class' => 'form-horizontal'
						);
						echo form_open("{$this->misc->_getClassName()}/leave_request_approval/{$employeeInfo->emp_p_id}/{$leaveInfo->emp_leave_id}", $attr); ?>

                        <table class="table table-bordered table-hover">
                        	<tbody>
			                    <tr align="center" >
		                           <th colspan="2"><strong>&nbsp; Leave Date </strong></th>
		                           <th align="center"><strong><?php echo form_label('Type Of Leave <small class="text-danger">*</small>', 'leave-id');?></strong></th>
		                           <th align="center"><strong><?php echo form_label('Emp Message', 'description');?></strong></th>
		                           <th align="center"><strong><?php echo form_label('Remarks <small class="text-danger">*</small>', 'admin-remark');?></strong></th>
		                          	 <th align="center">Permission</th>
		                           <th align="center">Action</th>
                        		</tr>
                           		<tr align="center">
                              		<td colspan="2">
                              			<div class=" <?php if(form_error('from-date')) echo 'has-error'; ?>">
										<?php echo form_label('Date From<small class="text-danger">*</small>', 'from-date'); ?>
														
											<div class="input-group date">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<?php 
												echo form_input(array(
													'type' => 'text',	
													'name' => 'from-date',
													'id' => 'data_1',
													'class' => 'form-control',
													'placeholder' => 'Date From',
													'value' => set_value('from-date',$leaveInfo->leave_from),
													'required' => 'true'
												));

												echo form_error('from-date'); ?>
											</div>
										</div>
										<div class=" <?php if(form_error('to-date')) echo 'has-error'; ?>">
											<?php echo form_label('Date To<small class="text-danger">*</small>', 'to-date'); ?>
																
											<div class="input-group date">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<?php 
												echo form_input(array(
													'type' => 'text',	
													'name' => 'to-date',
													'id' => 'data_1',
													'class' => 'form-control',
													'placeholder' => 'Date to',
													'value' => set_value('to-date',$leaveInfo->leave_to),
													'required' => 'true'
												));

												echo form_error('to-date'); ?>

											</div>
										</div>
									</td>
	                                <td align="center <?php if(form_error('leave-id')) echo 'has-error'; ?>">
										
										<?php 

										$_leave = $this->mdl_leave_type->dropdown('leave_name');

											echo form_dropdown(array(
												'name' => 'leave-id',
												'class' => 'form-control select2_one',
												'required' => 'true'
											), $_leave,$leaveInfo->fk_leave_type_id);

											echo form_error('leave-id'); ?>
									
									</td>
									<td align="center <?php if(form_error('description')) echo 'has-error'; ?>"> 
										<?php 

										echo form_textarea(array(
												'name' => 'description',
												'class' => 'form-control',
												'required' => 'true',
												'readonly' => 'true',
												'value' => set_value('description',$leaveInfo->description),
												'rows'=>'5',
												'cols' => '12'


											));

											echo form_error('description'); ?>
										
									</td>
									<td align="center <?php if(form_error('admin-remark')) echo 'has-error'; ?>"> 
										<?php 

										echo form_textarea(array(
												'name' => 'admin-remark',
												'class' => 'form-control',
												'required' => 'true',
												'rows'=>'5',
												'cols' => '12'

											));

											echo form_error('admin-remark'); ?>
										
									</td>
									<td align="center <?php if(form_error('permission')) echo 'has-error'; ?>">
										
										<?php 

										$_permission = array(

											'1' => 'Approve',
											'0' => 'Not Approve'
										);

										echo form_dropdown(array(
											'name' => 'permission',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_permission,$leaveInfo->is_active);

										echo form_error('permission'); ?>
									
									</td>
									<td align="center"> 
	                                	<div class="text-right">
											<button class="btn btn-primary" type="submit">Save</button>
										</div>
	                                </td>
                          		</tr>
                          	</tbody>
			            </table>
			            <?php echo form_close(); ?>
	                    </div>
	                </div>
	            </div>


	            <div class="row">
	            	<div class="ibox float-e-margins m-t">
	                    <div class="ibox-title">
	                        <h5>Leave Limit Status</h5>
	                    </div>
	                    <div class="ibox-content">
							<table class="table table-bordered table-hover">
	                               <thead>
										<tr>
											<th width="40px">S. NO.</th>
											<th>Leave Type</th>
											<th>Leave Name</th>
											<th>Total Leave / Year</th>
											<th>Consumed</th>
											<th>Balance</th>
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
											<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->leave_code,ENT_QUOTES,'UTF-8').'</span>' ?></td>
											<td>
												<?= htmlspecialchars($list->leave_name,ENT_QUOTES,'UTF-8') ?>

											</td>
												
											<td>
												<?= htmlspecialchars($list->leave_limit,ENT_QUOTES,'UTF-8') ?>
											</td>
											<td>
												<?php 
													if(!empty($list->leave_limit)){												 
													$cl= get_cl($employeeInfo->emp_p_id,$list->leave_p_id);
											
													echo $consumed_leave = $cl * ($list->leave_limit / 12);
													}
												
												?>
											</td>
											<td>
												<?php 
												if(!empty($list->leave_limit)){
													echo $list->leave_limit - $consumed_leave;
												}
												?>
											</td>
										</tr>
										<?php }
									} ?>
									</tbody>
	                        </table>
						</div>
		            </div>
	            </div>
	        </div>