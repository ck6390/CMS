<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize">Library Student Profile<!-- <?= str_replace('_', ' ', $this->misc->_getClassName()); ?> --></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Library</li>
			<li>
				<a href="<?= site_url("library/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
                <div>
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
                        <div class="bg-danger p-xs b-r-sm m-t"> Library Fine : <?php echo $library_dues->library_fine ? $library_dues->library_fine : 0.00; ?>  </div>
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

						<div class="ibox float-e-margins m-t">
                        	<div class="ibox-title">
                            	<h5>Library Options / Actions  </h5>
                        	</div>
                        	<div class="ibox-content" style="padding:5px 0;">

                            	<table class="table table-bordered table-hover">
                                	<tbody>
		                                <tr>
		                                    <td><?php echo anchor("library/{$this->misc->_getClassName()}/issue_history/{$info->student_p_id}", '<span class="btn btn-primary btn-xs"> <strong>BOOK HISTORY </strong></span>'); ?></td>
		                                  	<td>
		                                  		<?php if($lists->admission_status == 'pending'){?>
		                                  			<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> LIBRARY BLOCKED</span>
		                                  		<?php }else{?>
		                                  			<?php echo anchor("library/{$this->misc->_getClassName()}/book_issue/{$info->student_p_id}", '<span class="btn btn-primary btn-xs"> <strong> ISSUE A BOOK </strong> </span>'); ?>
		                                  		<?php }?>
		                                  	</td>
		                                  	<td><?php echo anchor("library/{$this->misc->_getClassName()}/add_fine/{$info->student_p_id}", '<span class="btn btn-primary btn-xs"> <strong>ADD FINE</strong> </span>'); ?></td>
		                                  	<td><?php if($lists->admission_status == 'pending'){?>
		                                  			<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> MANNUAL ISSUE BLOCK</span>
		                                  		<?php }else{?>
		                                  			<?php echo anchor("library/{$this->misc->_getClassName()}/mannual_issue/{$info->student_p_id}", '<span class="btn btn-primary btn-xs"> <strong> MANNUAL ISSUE A BOOK </strong> </span>'); ?>
		                                  		<?php }?></td>
		                                </tr>
		                                 
		                                
                                	</tbody>
                            	</table>
                            	<table class="table table-bordered table-hover">
                                	<tbody>
                                		<tr>
		                                 	<td>  <strong> Submit Book </strong> </td>
		                                	<?php $i=0; foreach($book_lists as $book){ $i++; ?>
		                                		 
		                                		<td> <span data-toggle="modal" onclick="book_model(<?php echo $info->student_unique_id.",".$book->book_issue_p_id;?>)" class="btn btn-primary btn-xs"> <strong><?php echo "Book - ".$i." [ Acc No. - ".$book->acc_no." ]";?> </strong> </span></td>
		                                		
		                                	<?php } ?>
		                                </tr>
                                	</tbody>
                            	</table>
                            	<table class="table table-bordered table-hover">
                            		<thead>
                            			<th><strong>Manual Submit</strong></th>
                            		</thead>
                                	<tbody>
                                		<?php $i=0; foreach($book_lists as $book){ $i++; ?>
                                		<tr>
		                                 	
		                                 	<td>
		                                	  <?php 

		                                		$fine_amount = $this->mdl_fee_type->get($book->fine_type_id)->fee_type_amount;
				                                $date1 = new DateTime($book->return_date);
				                                $date2 = new DateTime("now");
				                                if($date1 > $date2){
				                                    $date_over = $date2->diff($date2);
				                                }else{
				                                    $date_over = $date1->diff($date2);
				                                }
				                                $fine_days = $date_over->format('%a');
				                                $fine =  $fine_days * $fine_amount;
				                                $total_fine = $fine-$book->library_fine;


	                                    if($book->paid_status == "paid" && $book->is_active == '1'){ ?>
	                                    	<a href="<?php echo site_url("library/{$this->misc->_getClassName()}/book_return/{$info->student_p_id}/{$book->acc_no}/{$book->book_issue_p_id}"); ?>"class="btn btn-primary btn-xs"><i class="fa fa-undo"></i> <strong><?php echo "Book - ".$i." [ Acc No- ".$book->acc_no." ]";?> </strong> Return </a>
	                                    <?php }elseif($book->paid_status != "paid" && $book->is_active == '1'){ if($fine > 0){?>
	                                    <span class="btn btn-danger btn-xs"><i class="fa fa-ban"></i> <strong><?php echo "Book - ".$i." [ Acc No- ".$book->acc_no." ] [ Fine Amount - ".$total_fine." ] ";?> </strong> Go To Account</span>
	                                <?php }else{ ?>
	                                	<a href="<?php echo site_url("library/{$this->misc->_getClassName()}/book_return/{$info->student_p_id}/{$book->acc_no}/{$book->book_issue_p_id}"); ?>"class="btn btn-primary btn-xs"><i class="fa fa-undo"></i> <strong><?php echo "Book - ".$i." [ Acc No-".$book->acc_no." ] [ Fine Amount - ".$total_fine." ] ";?> </strong> Return </a>
	                                <?php } } ?>
                                    </td>
		                                	
		                                </tr>
		                            <?php } ?>
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


<div class="modal inmodal fade" id="book_model" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h6 class="modal-title">Issued Book</h6>
                
            </div>
            <div class="modal-body">
            	<div id="book_info"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>

function book_model(studentUniqueId,bookIssueId)
{
	var studentUniqueId = studentUniqueId;
	var bookIssueId = bookIssueId;
	var formData = {'bookIssueId':bookIssueId,'studentUniqueId':studentUniqueId};
	$.ajax({
		url: base_url + "index.php/library/library_student/book_info_model/",
		type: "POST",
		data : formData,
		success:function(data)
		{	
			$("#book_model").modal('show');
			$("#book_info").html(data);
			$(".rtrn_btn").hide();
			//$('#rtrn_btn').prop('disabled', true);
		}
	});
} 

function verify_student($student_id)
{	
	var student_id = $student_id;
	$.ajax
	    ({ 
	        url: base_url + "index.php/library/books/verify_library_student",
	        data: {"student_id": student_id},
	        type: 'post',
	        success: function(result)
	        {	
	        	if(result == student_id){
	        		$("#successMessage").html(+student_id+" has been Verified");
	        		$('.rtrn_btn').show();
	        	}else{
	        		$("#successMessage").html(+student_id+" has not Verified");
	        		$('.rtrn_btn').hide();
	        	}
	        	
	        }
	});
}
</script>


