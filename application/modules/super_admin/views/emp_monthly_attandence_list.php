<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace("_"," ",$this->misc->_getClassName()) ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url($this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= str_replace("_"," ",$this->misc->_getClassName()); ?></span></a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}/faculty_profile/{$this->uri->segment('3')}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Month Attendance List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		
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
												<td><strong>Employee Tyoe</strong></td>
						                       	<td><?php echo $this->mdl_empe_type->get($info->emp_type)->employee_type_name; ?></td>  
						                    </tr>
						                    <tr>
						                       	<td><strong>Designation</strong></td>
												<td><?php echo $this->mdl_dept->get($info->emp_department_ID)->dept_name; ?></td>
						                       	<td><strong>Department</strong></td>
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
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= str_replace("_"," ",$this->misc->_getClassName()); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th width="40px">S. NO.</th>
									<th>MONTH - YEAR</th>
									<th>WORKING DAYS</th>
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
									<td>
										<?php  
										$monthName = date('F', mktime(0, 0, 0, $list->month, 10));
										
										echo $monthName." - ".$list->year; ?>
										
									</td>
									<td>
										<?= htmlspecialchars($list->year,ENT_QUOTES,'UTF-8'); ?>
										
									</td>
									<td>
			                       		
			                       		<a href="<?php echo site_url("{$this->misc->_getClassName()}/view_attendance/{$info->emp_p_id}/{$list->id}"); ?>" ><span class="btn btn-info btn-xs">View / Print</span> </a>
			                       	</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th width="40px">S. NO.</th>
									<th>MONTH - YEAR</th>
									<th>WORKING DAYS</th>
									<th>ACTION</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
