<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-3">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong>Student Profile</strong>
			</li>
		</ol>
	</div>
	<?php if($this->session->flashdata('danger')) { ?>
	<div class="col-sm-9 bg-danger">
		<ul type="square">
			<?=$this->session->flashdata('danger')?>
		</ul>
	</div>
	<?php } ?>
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
                        <div class="ibox-content profile-content">
                            <h4><strong><?php echo $info->student_full_name; ?></strong></h4>
                            <h5><strong>Student ID</strong></h5>
                            <h4 class="text-info"><strong><?php echo $info->student_unique_id; ?></strong></h4>
                            <h5><strong>Admission No.</strong></h5>
                            <h4 class="text-info"><strong><?php echo $info->admission_no; ?></strong></h4>
                            <div class="bg-danger p-xs b-r-sm"> Admin Due : 
                            <?php

                            $admin_dues = 0; 
                            // if(!empty($fee_dues))
                            // {
                            // 	$admin_dues = $fee_dues->fee_amount-$fee_dues->due_amount;
                            // 	echo  $admin_dues;	
                            // }else{
                            // 	echo $admin_dues;	
                            // }
                            foreach ($academicFeeList as $academicFee) { 

	                            if($academicFee->paid_status == "unpaid"){
	                                $admin_dues = $admin_dues + $academicFee->fee_amount;
	                                           
	                            }else{
	                                $admin_dues = $admin_dues + $academicFee->fee_amount-$academicFee->due_amount;
	                            }
	                        }
	                        echo $admin_dues;
                           ?>  </div>
                            <div class="bg-danger p-xs b-r-sm m-t"> Library Fine : <?php //echo $library_dues->library_fine ? $library_dues->library_fine : 0.00; 
                            	$library_due = 0;
                            	$fine = 0;
                            	foreach($library_info as $book)
                            	{ 
                            		//var_dump($booklists->return_date);
                            		$fine_amount = $this->mdl_fee_type->get($book->fine_type_id)->fee_type_amount;
	                                $date1 = new DateTime($book->return_date);
	                                $date2 = new DateTime("now");
	                                if($date1 > $date2){
	                                    $date_over = $date2->diff($date2);
	                                }else{
	                                    $date_over = $date1->diff($date2);
	                                }
	                                $fine_days = $date_over->format('%a')."\n";
	                                $fine =  $fine + $fine_days * $fine_amount;
	                               // $total_fine = $fine-$book->library_fine;
                            	}
                            	
                            	echo $fine; 
                            	//echo $library_due;

                            ?>  </div>
                           
	                        <div class="bg-danger p-xs b-r-sm m-t"> Hostel Charge : 
	                        	<?php 
	                        	 $hostelDue = 0;
	                        	 	if(!empty($hostel_dues)){

	                        	 		foreach($hostel_dues as $hostelRm){
	                        	 			
	                        	 			if($hostelRm->paid_status == "unpaid"){
	                                            $hostelDue = $hostelDue + $hostelRm->fee_amount + $this->misc->hostelFine($hostelRm->hostel_charge_month);
	                                        }else{
	                                        	 $hostelDue = $hostelDue + $hostelRm->fee_amount+$hostelRm->late_fine-$hostelRm->due_amount;
	                                        }
		                        		}

		                        	}

	                        		echo $hostelDue;
	                        	?>
	                        </div>

	                        <div class="bg-danger p-xs b-r-sm m-t"> Mess Charge : 
	                        	<?php 
	                        	 $messDue = 0;
	                        	 	if(!empty($hostel_mess)){

	                        	 		foreach($hostel_mess as $hostelMess){

		                        			if($hostelMess->paid_status == "unpaid"){
	                                            $messDue = $messDue + $hostelMess->fee_amount + $this->misc->hostelFine($hostelMess->hostel_charge_month);
	                                           
	                                        }else{
	                                        	 $messDue = $messDue + $hostelMess->fee_amount+$hostelMess->late_fine-$hostelMess->due_amount;
	                                        }
		                        		}

		                        	}

	                        		echo $messDue;	                        	?>
	                        </div>
	                        <div class="bg-danger p-xs b-r-sm m-t"> 
	                         	Total Hostel Due : <?php echo  $messDue + $hostelDue; ?>
                            </div>
	                        
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
			                                	<?php foreach($fee_types as $type){ ?>
			                                		 
			                                		<td> <span data-toggle="modal" onclick="showduesList(<?php echo $info->student_p_id.",".$type->fee_type_p_id.",".$type->fee_group ?>)" class="btn btn-primary btn-xs"> <strong><?php echo $type->fee_type_name ?> </strong> </span></td>
			                                		
			                                	<?php } ?>
			                                </tr>
			                                <tr>
			                                    <td>
			                                    	<?php echo anchor("{$this->misc->_getClassName()}/fee_deposit/{$info->student_p_id}", '<span class="btn btn-primary btn-xs"> <strong>FEE DEPOSIT </strong> </span>');
			                                    	 ?>	
			                                    </td>
			                                  	
			                                  	
			                                  	
			                                  	<td>
			                                  		<?php
			                                  		 echo anchor("{$this->misc->_getClassName()}/payment_history/{$info->student_p_id}", '<span class="btn btn-primary btn-xs"> <strong> PAYMENT HISTORY </strong></span>');
			                                  		 ?>
			                                  	</td>
			                                  	<td>
			                                  		<?php echo anchor("{$this->misc->_getClassName()}/general_receipt/{$info->student_p_id}", '<span class="btn btn-primary btn-xs"> <strong> Others </strong> </span>'); ?>
			                                  	</td>
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
<script>
function showduesList(StudentId,feeTypeId,feeGroup)
{
	var StudentId = StudentId;
	var feeTypeId = feeTypeId;
	var feeGroup = feeGroup;
	var formData = {'StudentId':StudentId,'feeTypeId':feeTypeId,'feeGroup':feeGroup};
	$.ajax({
		url: base_url + "index.php/accountants/feeduesmodel/",
		type: "POST",
		data : formData,
		success:function(data)
		{	
			$("#hostel"+feeTypeId).modal('show');
			$('#dueList'+feeTypeId).html(data);
		}
	});
} 
	
function showAcademicDuesList(StudentId,feeStructureId)
{
	var StudentId = StudentId;
	var feeStructureId = feeStructureId;
	var formData = {'StudentId':StudentId,'feeStructureId':feeStructureId};
	$.ajax({
		url: base_url + "index.php/accountants/academic_fee_dues/",
		type: "POST",
		data : formData,
		success:function(data)
		{	
			$("#academics"+feeStructureId).modal('show');
			$('#dueList'+feeStructureId).html(data);
		}
	});
} 
</script>
<?php foreach($fee_types as $type){ ?>
<div class="modal inmodal fade" id="hostel<?php echo $type->fee_type_p_id ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Due List</h4>
                
            </div>
            <div class="modal-body">
            	<table class="table table-striped table-bordered table-hover "><thead>
				<tr>
					<th>Fee Type</th><th>Due Amount</th><th>Payment status</th></tr>
				</thead>
					
            		<tbody id="dueList<?php echo $type->fee_type_p_id ?>">
					
					</tbody>
            		<tfoot><tr><th>Fee Type</th><th>Amount</th><th>Payment status</th></tr></tfoot></table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
