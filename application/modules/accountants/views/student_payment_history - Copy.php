<style type="text/css">
	.d-none{
		display: none;
	}
	 @media print {
          .hiddens{
            display: none! important; 
          }
          .d-none{
          	display: block !important;
          }
       	 .student-pro{
          	width: 30%;
          	float: left;
          }
          .student-details{
          	width: 70%;
          	float: left;
          }
          .stuimg{
          	width: 100% !important;
          	height: 100px !important;
          	float: left;
          }
          .stusign{
          	float: left;
          	width: 100% !important;
          	height: 80px !important;
          }
        }
</style>
	<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8 hiddens">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}/student_profile/{$info->student_p_id}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Payment History</strong>
			</li>
		</ol>
	</div>
	
</div>
<div class="wrapper wrapper-content"  id="printableArea">
    <div class="row animated fadeInRight">
    	<table class="d-none" style="margin-bottom: 30px;">
    		<tbody>
    			<tr>
    				<?php $instituteInfo = $this->mdl_general_setting->get('6'); ?>
    				<td><img class="img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>"  style="float:right;border:0;margin-left:120px;padding:0;width:100px; height:80px;">
    					
    				</td>
    				<td><h3 style="padding-left: 12px;"> Ganga Memorial College Of Polytechnic</h3>
    						<p >AT NH-31, HARNAUT, NALANDA, BIHAR - 803110</p></td>
    			</tr>
    		</tbody>
    	</table>

        <div class="col-md-3 student-pro">
            <div class="ibox float-e-margins">
                <div class="ibox-title hiddens">
                    <h5>Student Photo</h5>
                </div>
	            <div class="ibox-content no-padding border-left-right">
                    <img alt="image" class="stuimg" style="width: 100%;height: 175px;"src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_photo}") ?>">

                      <img alt="image" class="m-t stusign" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_sign}") ?>" style="width: 100%;height: 82px;margin-top: -2px;">
                </div>
	        </div>    
    	</div>
    	<div class="col-md-9 student-details">
		    <div class="row">
				<div class="col-sm-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title hiddens">
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
				                       <td><?php echo $this->mdl_student->get_single_value_by_id('session',$info->fk_session_id,'session_name');?></td>
				                       <td><strong>Branch</strong></td>
				                       <td><?= $this->branch->get($info->fk_branch_id)->branch_code?></td>
				                        
				                    </tr>
				                    <tr>
				                       <td><strong>Semester</strong></td>
				                       <td><?php echo $this->mdl_semester->get_single_value_by_id('semester',$info->fk_semester_id,'semester_name');?></td>
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
					<h5><span class="text-capitalize">Payment </span> History</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover datatav">
							<thead>
								<tr>
									<th>Receipt / Trans No.</th>
									<th>Fee Type</th>
									<th>Payment Date</th>
									<th>Paid Amount</th>
									<th>Payment Mode</th>
									<th>Reference No.</th>
									<th class="hiddens">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if($payment_history == false) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="8"><strong>NO RECORDS AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($payment_history as $payment_history) { ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
									<td>
										<?= '<span class="badge badge-primary">'.htmlspecialchars($payment_history->payment_p_id." / ". $payment_history->payment_id,ENT_QUOTES,'UTF-8').'</span>' ?></td>
									<td>
										<?php $feeTypes = explode(",", $payment_history->fee_types_id); 
											
											
											foreach($feeTypes as $ftps){
												
												$length = strlen($ftps);
												$result = substr($ftps,0, 2);
												
												if($result == "ac"){
													
													$result1 = substr($ftps, 2, $length);
													
													$academic_fees = $this->mdl_accountant->day_statement_academic_fee($result1);
													
													$fff = $this->mdl_fee_type->get($academic_fees->fk_fee_type_id)->fee_type_name." - ".$academic_fees->fee_amount."  Rs.";

												}elseif($result == "hs"){
													
													$result1 = substr($ftps, 2, $length);
													
													$hostel_charge = $this->mdl_accountant->day_statement_hostel_fee($result1);
													
													$fff = $this->mdl_fee_type->get($hostel_charge->fk_fee_type_id)->fee_type_name." ".$hostel_charge->hostel_charge_month." - ( ".$hostel_charge->fee_amount." + ".$hostel_charge->late_fine ." )  Rs. ";

												}elseif($result =="li"){

													$result1 = substr($ftps, 2, $length);
													
													$library_fees = $this->mdl_accountant->day_statement_library_fee($result1);
													
													$fff = $this->mdl_fee_type->get($library_fees->fine_type_id)->fee_type_name." - ".$payment_history->paid_amount."  Rs.";
														
												}elseif($result =="gr"){

													$result1 = substr($ftps, 2, $length);
													
													$fff = $this->mdl_fee_type->get($result1)->fee_type_name." - ".$this->mdl_fee_type->get($result1)->fee_type_amount."  Rs.";	
												}elseif($result =="ot"){
				                                   if(!empty($payment_history->fk_semester_id)){
														$fff = $payment_history->other_fee." - ".   $this->mdl_semester->get($payment_history->fk_semester_id)->semester_name;
													}else{

														$fff = $payment_history->other_fee ;
													}
				                                }
												
												echo $fff."<br>";
											}


									?></td>
									
									<td><?= htmlspecialchars($this->misc->reformatDate($payment_history->created_on),ENT_QUOTES,'UTF-8') ?></td>
									 
									<td><?= htmlspecialchars($payment_history->paid_amount,ENT_QUOTES,'UTF-8') ?></td>
									<td><?php echo $this->mdl_payment->get_type_name_by_id('payment_mode',$payment_history->payment_mode,'payment_mode_name'); ?></td>
									<td><?= htmlspecialchars($payment_history->reference_no,ENT_QUOTES,'UTF-8') ?></td>
									<td class="hiddens">
										<a href="<?php echo site_url("{$this->misc->_getClassName()}/payment_invoice/{$payment_history->payment_p_id}"); ?>" class="btn btn-primary btn-xs" target='_blank'>
											<i class="fa fa-eye"></i>
										</a>
										<a href="<?php echo site_url("{$this->misc->_getClassName()}/payment_sms/{$payment_history->payment_p_id}/0/{$this->uri->segment('3')}"); ?>" class="btn btn-primary btn-xs" target='_blank'>
											<i class="fa fa-send"></i>
										</a>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Receipt / Trans No.</th>
									<th>Fee Type</th>
									<th>Payment Date</th>
									<th>Paid Amount</th>
									<th>Payment Mode</th>
									<th>Reference No.</th>
									<th class="hiddens">Action</th>
								</tr>
							</tfoot>
						</table>
						<input type="button" onclick="printDiv('printableArea')" value="Print" class="btn btn-info hiddens"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
</script> 
<script type="text/javascript">

function balance_validate(){

   var payAmount = document.getElementById("payAmount").value;
   var due = document.getElementById("dueBalance").value;
   var errmsg;
   if(payAmount > due || payAmount == 0){
   	errmsg = "Due Amount : " + due;   
   	document.getElementById("due").innerHTML = errmsg;
   	document.getElementById("submitPayment").disabled = true;
   }else{
   	errmsg = "";
   	document.getElementById("due").innerHTML = errmsg;
   	document.getElementById("submitPayment").disabled = false;
   }
   
}

$(document).ready(function(){
	
	var checkAmount = document.getElementById("payAmount").value;
  	if(checkAmount == 0){
  		$('form input,select,button[type="submit"]').prop("disabled", true);
  	}
});
</script>