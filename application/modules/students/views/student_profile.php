<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
                            <h5>Student Detail</h5>
                        </div>
                        <div class="ibox-content no-padding border-left-right">
                            <img alt="image" class="img-responsive img-thumbnail" style="width: 100%;height: 207px;"src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_photo}") ?>">

                              <img alt="image" class="img-responsive img-thumbnail m-t" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_sign}") ?>">

                        </div>
                        
                	</div>
                </div>
                <div class="col-md-9">
                   <div class="row">
						<div class="col-sm-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Student Basic Details</h5>
									<div class="ibox-tools">
										<small><code>*</code> Required Fields.</small>
									</div>
								</div>


								<div class="ibox-content">
									<table class="table table-bordered table-hover">
			                                
			                            <tbody>
						                    <tr>
						                       <td><strong>Student Id</strong></td>
						                       <td><h4 class="text-info"><strong><?php echo $info->student_unique_id; ?></strong></h4></td>
						                       <td><strong>Admission No.</strong></td>
						                       <td> <h4 class="text-info"><strong><?php echo $info->admission_no; ?></strong></h4></td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Student Name</strong></td>
						                       <td><?php echo $info->student_full_name; ?></td>
						                       <td><strong>Father's Name</strong></td>
						                       <td><?php echo $info->father_name; ?></td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Session</strong></td>
						                       <td><?php echo $info->session_name;?></td>
						                       <td><strong>Branch</strong></td>
						                       <td><?php echo $info->branch_code; ?></td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Semester</strong></td>
						                       <td><?php echo $info->semester_name; ?></td>
						                       <td><strong>Contact No.</strong></td>
						                       <td><?php echo $info->student_sms_no; ?></td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Student Status</strong></td>
						                       <td>
						                       		<?php echo ($info->is_active) ? '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>' : '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'?>
						                       	</td>
						                       <td><strong>Admission Status</strong></td>
												<td>
													<?php if($info->admission_status == "provisional") {
														echo '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Provisional</span>';
													}elseif($info->admission_status	 == "pending"){
														echo '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Pending </span>';
													}elseif($info->admission_status == "passout"){
														echo '<span class="btn btn-xs btn-danger"><i class="fa fa-ban"></i> Passout </span>';
													}elseif($info->admission_status == "junk"){
														echo '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Junk </span>';
													}else{
														echo '<span class="btn btn-xs btn-primary"><i class="fa fa-check"></i> Final </span>';
													} ?> 
												</td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Local Address</strong></td>
						                       <td><?php echo $info->l_locality ; ?>,<br>
						                       	<strong>P.O : </strong><?php echo $info->local_post_office ; ?>,<br>
						                       	<strong>District : </strong><?php echo $info->local_district ; ?>,<br>
						                       	<strong>State : </strong><?php echo $info->local_state ."-". $info->local_pin_code; ?><br>
						                       </td>
						                       <td><strong>Permanent Address</strong></td>
						                       <td><?php echo $info->p_locality ; ?>,<br>
						                       	<strong>P.O : </strong><?php echo $info->p_post_office ; ?>,<br>
						                       	<strong>District : </strong><?php echo $info->p_district ; ?>,<br>
						                       	<strong>State : </strong><?php echo $info->p_state ."-". $info->p_pin_code; ?><br>
						                       </td>
						                        
						                    </tr>
			                            </tbody>
			                        </table>
								</div>

								<div class="ibox float-e-margins m-t">
			                        <div class="ibox-title">
			                            <h5>Admin Options / Actions  </h5>
			                        </div>
			                        <div class="ibox-content" style="padding:5px 0;">

			                            <table class="table table-bordered table-hover">
			                                <tbody>
			                                <tr>
			                                    <td><?php echo anchor("{$this->misc->_getClassName()}/attach_file/{$info->student_p_id}", '<span class="btn btn-primary btn-xs"> <strong> ATTACH FILE </strong> </span>'); ?></td>
			                                    <td><?php echo anchor("{$this->misc->_getClassName()}/fee_fine/{$info->student_p_id}", '<span class="btn btn-primary btn-xs"> <strong>ADD FEE / FINE </strong> </span>'); ?></td>
			                           
			                                  	<td>   
			                                  	 <?php
												if($info->final_submit != "1" || $this->session->userdata['roleID'] == '7'){
												 echo anchor("{$this->misc->_getClassName()}/edit/{$info->student_p_id}", '<span class="btn btn-primary btn-xs"> <strong> EDIT PROFILE </strong> </span>'); } ?>	
			                                  	</td>
			                               
			                                  	<td><?php echo anchor("{$this->misc->_getClassName()}/payment_history/{$info->student_p_id}", '<span class="btn btn-primary btn-xs"> <strong> PAYMENT HISTORY </strong></span>'); ?></td>
			                                  	<td><?php echo anchor("{$this->misc->_getClassName()}", '<span class="btn btn-primary btn-xs"> <strong>NO DUE CERT.</strong> </span>'); ?></td>
			                                </tr>
			                                <tr>
			                                    <td><?php echo anchor("{$this->misc->_getClassName()}", '<span class="btn btn-primary btn-xs"> <strong> 1ST YEAR RECEIPT </strong> </span>'); ?></td>
			                                    <td><?php echo anchor("{$this->misc->_getClassName()}", '<span class="btn btn-primary btn-xs"> <strong> 2ND YEAR RECEIPT </strong> </span>'); ?></td>
			                                  	
			                                  	<td><?php echo anchor("{$this->misc->_getClassName()}", '<span class="btn btn-primary btn-xs"> <strong> 3RD YEAR RECEIPT </strong> </span>'); ?></td>
			                                  	<td></td>
			                                  	<td></td>
			                                </tr>
			                               
			                                <tr>
			                                    <td></td>
			                                    <td></td>
			                                  	<td></td>
			                                  	<td></td>
			                                  	<td></td>
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