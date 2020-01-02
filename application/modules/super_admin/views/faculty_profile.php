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
                            <img src="<?= base_url().'assets/img/employees/'.$info->emp_photo ?>" class="img-responsive" style="width: 100%;height: 207px;">

                            <img src="<?= base_url().'assets/img/employees/'.$info->emp_signature ?>" class="img-responsive" style="width: 100%;height: 50px;">  

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
						                       <td><h4 class="text-info"><strong><?php echo $info->username; ?></strong></h4></td>
						                       <td><strong>Employee Name</strong></td>
						                       <td><?php echo $info->emp_name; ?></td>
						                        
						                    </tr>
						                    <tr>
						                       
						                       <td><strong>Contact No</strong></td>
						                       <td><?php echo $info->emp_phone; ?></td>
						                       <td><strong>Email ID</strong></td>
						                       <td><?php echo $info->emp_email; ?></td>
						                        
						                    </tr>
						                    
						                    <tr>
						                    	<td><strong>Gender</strong></td>
												<td><?php echo $info->emp_gender; ?></td>
												<td><strong>Employee Type</strong></td>
						                       	<td><?php echo $this->mdl_empe_type->get($info->emp_type)->employee_type_name; ?></td>  
						                    </tr>
						                    <tr>
						                       	<td><strong>Department </strong></td>
												<td><?php echo $this->mdl_dept->get($info->emp_department_ID)->dept_name; ?></td>
						                       	<td><strong>Designation</strong></td>
						                       	<td><?php echo $this->mdl_desg->get($info->emp_designation_ID)->desg_name; ?></td> 
						                    </tr>
						                    <tr>
						                       <td><strong>Address</strong></td>
						                       <td><?php echo $info->emp_address." ".$info->emp_state."-".$info->emp_pincode; ?>
						                       </td>
						                       <td><strong>Employee Status</strong></td>
						                       	<td>
						                       		<?php echo ($info->is_active) ? '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>' : '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'?>
						                       	</td> 
						                        
						                    </tr>
			                            </tbody>
			                        </table>
								</div>

								<div class="ibox float-e-margins m-t">
			                        <div class="ibox-title">
			                            <h5>Options / Actions  </h5>
			                        </div>
			                        <div class="ibox-content" style="padding:5px 0;">

			                            <table class="table table-bordered table-hover">
			                                <tbody>
			                                <tr>
			                                    
			                                    <td><?php echo anchor("{$this->misc->_getClassName()}/emp_monthly_attandance/{$info->emp_p_id}", '<span class="btn btn-primary btn-xs"> <strong>Monthly Attendance</strong> </span>','target="_blank"'); ?></td>
			                                  	<td><?php echo anchor("{$this->misc->_getClassName()}/emp_lecture_history/{$info->emp_p_id}", '<span class="btn btn-primary btn-xs"> <strong> Lecture History </strong> </span>','target="_blank"'); ?></td>
			                                  	<td><?php echo anchor("{$this->misc->_getClassName()}/emp_leave_history/{$info->emp_p_id}", '<span class="btn btn-primary btn-xs"> <strong> Leave History </strong> </span>','target="_blank"'); ?></td>
			                                  	<td><?php echo anchor("{$this->misc->_getClassName()}/evolution/{$info->emp_p_id}", '<span class="btn btn-primary btn-xs"> <strong class="text-uppercase">Generate APPRAISEL </strong></span>','target="_blank"'); ?></td>
			                                </tr>
			                                </tbody>
			                            </table>
			                        </div>
			                    </div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>