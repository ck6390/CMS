<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize">Issue Book<!-- <?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?> --></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("library/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li>
				<a href="<?= site_url("library/{$this->misc->_getClassName()}/profile/{$info->student_p_id}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Issued History</strong>
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
	                <img alt="image" class="img-responsive img-thumbnail" style="width: 100%;height: 207px;" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_photo}") ?>">

	                <img alt="image" class="img-responsive img-thumbnail m-t" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_sign}") ?>">

	            </div>
	            <div class="ibox-content profile-content">
                    <div class="bg-danger p-xs b-r-sm m-t"> Library Fine : <?php echo $library_dues->library_fine ? $library_dues->library_fine : 0.00; ?>  </div>
	                
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
				                       <td><?php echo $info->session_name; ?></td>
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Issued Book History</h5>
                </div>
                <div class="ibox-content">
                	<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Accession No.</th>
									<th>Call No. </th>
									<th>Book Title</th>
									<th>Issue On</th>
									<th>Return Date</th>
									<th>Submit Date</th>
									<th>Fine Amount</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="8"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {

								foreach ($lists as $list) {

								$fine_amount = $this->mdl_fee_type->get($list->fine_type_id)->fee_type_amount;
                                $date1 = new DateTime($list->return_date);
                                $date2 = new DateTime("now");
                                if($date1 > $date2){
                                    $date_over = $date2->diff($date2);
                                }else{
                                    $date_over = $date1->diff($date2);
                                }
                                $fine_days = $date_over->format('%a');
                                $fine =  $fine_days * $fine_amount;
                                $total_fine = $fine-$list->library_fine;


								 ?>
								<tr>
									<td>
										<strong><?= htmlspecialchars($list->acc_no,ENT_QUOTES,'UTF-8') ?></strong>
									</td>

									<td>
										<strong><?= htmlspecialchars($list->call_no,ENT_QUOTES,'UTF-8') ?></strong>
									</td>

									<td>
										<strong><?= htmlspecialchars($list->book_name,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									
									<td><?php $date = new DateTime($list->issue_date);
                                        echo $date->format('d/m/Y');?></td>

                                    <td><?php $date = new DateTime($list->return_date);
                                        echo $date->format('d/m/Y');?></td>

                                    <td><?php echo $list->submit_date ? $this->misc->reformatDate($list->submit_date) : null; ?></td>

                                    <td>
                                    	<?php if($list->paid_status == "paid"){ ?>
                                    		<strong><?= htmlspecialchars($list->library_fine,ENT_QUOTES,'UTF-8') ?></strong>
                                    	<?php }elseif($list->paid_status == "unpaid"){ ?>
                                    		<strong><?= htmlspecialchars($fine,ENT_QUOTES,'UTF-8') ?></strong>
                                    	<?php } elseif($list->paid_status == "partial"){ ?>
                                    		<strong><?= htmlspecialchars($total_fine,ENT_QUOTES,'UTF-8') ?></strong>
                                    	<?php } ?>
                                    </td>
                                    <td>
                                    	<strong><?= htmlspecialchars($list->paid_status,ENT_QUOTES,'UTF-8') ?></strong>
                                    </td>

                                    <td>
                                    	<?php 

	                                    if($list->is_active == '0'){ ?>
	                                    	<span class="btn btn-success btn-xs"><i class="fa fa-ban"></i> Returned</span>
	                                    <?php }elseif($list->paid_status == "paid" && $list->is_active == '1'){ ?>
	                                    	<a href="<?php echo site_url("library/{$this->misc->_getClassName()}/book_return/{$info->student_p_id}/{$list->acc_no}/{$list->book_issue_p_id}"); ?>"class="btn btn-primary btn-xs"><i class="fa fa-undo"></i> Return </a>
	                                    <?php }elseif($list->paid_status != "paid" && $list->is_active == '1'){ if($fine > 0){?>
	                                    <span class="btn btn-danger btn-xs"><i class="fa fa-ban"></i> Go To Account</span>
	                                <?php }else{ ?>
	                                	<a href="<?php echo site_url("library/{$this->misc->_getClassName()}/book_return/{$info->student_p_id}/{$list->acc_no}/{$list->book_issue_p_id}"); ?>"class="btn btn-primary btn-xs"><i class="fa fa-undo"></i> Return </a>
	                                <?php } }?>
                                    </td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Accession No.</th>
									<th>Call No. </th>
									<th>Book Title</th>
									<th>Issue On</th>
									<th>Submit Date</th>
									<th>Return Date</th>
									<th>Fine Amount</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
                </div>
            </div>
        </div>
    </div> 
</div>