<style type="text/css">
	.d-none{
		display: none;
	}
	 
	 @media print {
          .hiddens {
            display: none! important; 
          }
          .dataTables_filter, .dataTables_paginate, .dataTables_length, .dataTables_info{
          	display: none!important;
      		}
	      .dt-buttons{
	      	display: none !important;
	      }
          .d-none{
          	display: block !important;
          }
        }
</style>
	<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
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
<div class="wrapper wrapper-content" id="printableArea">
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Student Payment Details</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content" id="dvContainer">
						<div class="table-responsive">
							<div class="col-sm-12 layout-box col-100">
	                        <p class="school">
	                            <div class="center">
	                                <div class="col-xs-12 col-100 d-none">
	                                <?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>               
	                                       <img src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>" class="img-thumbnail img-circle logo" width="108px" style="float:left;margin-left:100px;margin-bottom:20px;border-radius: 25px;">
	                                      <p style="font-size:25px;margin-top:10px;margin-left: 230px;padding-top:8px;"><strong> Ganga Memorial College Of Polytechnic</strong></p><p style="margin-left: 250px;margin-top:-9px;" class="addStyle">AT NH-31, HARNAUT, NALANDA, BIHAR - 803110</p>
	                                </div>
	                             </div>                            
	                        </p>
	                    </div>
					<table class="table table-bordered table-hover">
                        <tbody>
		                    <tr>
		                    	<td rowspan="3" class="rowHeight"> <img alt="image" class="img-responsive img-thumbnail stuimg" style="width: 30%;height: 107px;" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_photo}") ?>"></td>
		                       <td><strong class="tdStyle">Student Id</strong></td>
		                       <td><h4 class="text-info"><strong><?php echo $info->student_unique_id; ?></strong></h4></td>
		                       <td><strong class="tdStyle">Admission No.</strong></td>
		                       <td> <h4 class="text-info"><strong><?php echo $info->admission_no; ?></strong></h4></td>
		                    </tr>
		                    <tr>
		                       <td><strong class="tdStyle">Student Name</strong></td>
		                       <td><?php echo $info->student_full_name; ?></td>
		                       <td><strong class="tdStyle">Father's Name</strong></td>
		                       <td><?php echo $info->father_name; ?></td>
		                        
		                    </tr>
		                    <tr>
		                       <td><strong class="tdStyle">Session</strong></td>
		                       <td><?php echo $this->mdl_student->get_single_value_by_id('session',$info->fk_session_id,'session_name');?></td>
		                       <td><strong class="tdStyle">Branch</strong></td>
		                       <td><?= $this->branch->get($info->fk_branch_id)->branch_code?></td>
		                        
		                    </tr>
		                    <tr>
		                    	<td rowspan="2" class="rowHeight"><img alt="image" class="img-responsive img-thumbnail m-t stuimg" style="width: 30%;height: 70px;margin-top: 0px!important;" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_sign}") ?>"></td>
		                       <td><strong class="tdStyle">Semester</strong></td>
		                       <td><?php echo $this->mdl_semester->get_single_value_by_id('semester',$info->fk_semester_id,'semester_name');?></td>
		                       <td><strong class="tdStyle">Contact No.</strong></td>
		                       <td><?php echo $info->student_sms_no; ?></td>
		                        
		                    </tr>
		                    <tr>
		                       <td><strong class="tdStyle">Student Status</strong></td>
		                       <td>
		                       		<?php echo ($info->is_active) ? '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>' : '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'?>
		                       	</td>
		                       <td><strong class="tdStyle">Admission Status</strong></td>
								<td><p>
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
					<table class="table table-striped table-bordered table-hover dataTablesView theadStyle">
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
						<tfoot class="hiddens">
							<tr>
								<th>Receipt / Trans No.</th>
								<th>Fee Type</th>
								<th>Payment Date</th>
								<th>Paid Amount</th>
								<th>Payment Mode</th>
								<th>Reference No.</th>
								<th >Action</th>
							</tr>
						</tfoot>
					</table>
					</div>
					<div class="row no-print">
		                <div class="col-xs-12 text-right">
		                    <button class="btn btn-default hiddens" id="btnPrint"><i class="fa fa-print"></i> <?php echo 'print'; ?></button>
		                </div>
            		</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
<script>
    $(document).ready(function(){
        $("#btnPrint").click(function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=8.5in;width=8.5in;');
           printWindow.document.write('<html><head><title></title><style media="print">.hiddens{display:none!important}.table-bordered{border-width: 1px;border-style:solid;border-color: rgb(0, 0, 0);font-size:18px;border-image:initial;margin-top:0px;!important;width:100%;border-collapse:collapse;}.table-bordered > thead > tr > th{border-width: 1px;border-style:solid;border-color: rgb(0, 0, 0);}.theadStyle{margin-top:5px!important;}.table > tbody > tr > td{text-align:center;}, .table > tfoot > tr > td{border-top: 1px solid #000!important;}.table-bordered > tbody > tr > th, .table-bordered > t > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td,.table-bordered > tbody > tr > td{border-width: 1px;border-style: solid;border-color: rgb(0, 0, 0);border-image:initial;line-height: 1.52857;vertical-align: top;padding: 2px;}.addStyle{margin-top:-9px!important;}.stuimg{float:left;margin-left:2px;margin-top:1px!important;width:100px!important}.dataTables_filter{display:none!important}.dataTables_paginate{display:none!important}.dataTables_length{display:none!important}.dataTables_info{display:none!important}.dt-buttons{display:none!important}.rowHeight{height:20px!important;width:108px!important;}.tdStyle{float:left;margin-left:2px!important;}</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    });
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
