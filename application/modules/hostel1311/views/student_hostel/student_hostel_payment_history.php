<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("hostel/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li>
				<a href="<?= site_url("hostel/{$this->misc->_getClassName()}/profile/{$info->student_p_id}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Payment History</strong>
			</li>
		</ol>
	</div>
	
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Student Photo</h5>
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
	                            </tbody>
	                        </table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="row animated fadeInRight">
        <div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize">Unpaid Fee</span></h5>
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
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Invoice No.</th>
									<th>Fee Type</th>
									<th>Month</th>
									<th>Due Amount</th>
									<th>Payment status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="10"><strong>NO RECORDS AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								$i = 0;
								foreach ($lists as $list) { $i++; ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
									<td><?= '<strong> '.htmlspecialchars($list->invoice_id,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->fee_type_name ,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									
									<td><?= '<strong> '.htmlspecialchars($list->hostel_charge_month,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->due_amount,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->paid_status,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>									
									<td>
										<a href="<?php echo site_url("hostel/hostel_invoices/view_hostel_invoice/".$list->invoice_p_id); ?>" class="btn btn-primary btn-xs">
											<i class="fa fa-eye"></i>
										</a>
										<button class="btn btn-xs btn-danger deleteRow" value="<?= $list->invoice_p_id ?>">
											<i class="fa fa-trash"></i>
										</button>
										
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Invoice No.</th>
									<th>Fee Type</th>
									<th>Month</th>
									<th>Amount</th>
									<th>Payment status</th>
									<th>Action</th>
								</tr>
							</tfoot>
						</table>
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
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Payment Entry</th>
									<th>Invoice No.</th>
									<th>Payment Date</th>
									<th>Paid Amount</th>
									<th>Payment Mode</th>
									<th>Fee Type</th>
									<th>Reference No.</th>
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
									<td><?= '<span class="badge badge-primary">'.htmlspecialchars($payment_history->payment_id,ENT_QUOTES,'UTF-8').'</span>' ?></td>
									<td><?= '<span class="badge badge-primary">'.htmlspecialchars($payment_history->invoice_id,ENT_QUOTES,'UTF-8').'</span>' ?></td>
									<td><?= htmlspecialchars($this->misc->reformatDate($payment_history->payment_date),ENT_QUOTES,'UTF-8') ?></td>
									 
									<td><?= htmlspecialchars($payment_history->paid_amount,ENT_QUOTES,'UTF-8') ?></td>
									<td><?php echo $this->mdl_payment->get_type_name_by_id('payment_mode',$payment_history->payment_mode,'payment_mode_name'); ?></td>
									<td><?= htmlspecialchars($payment_history->fee_type_name,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($payment_history->reference_no,ENT_QUOTES,'UTF-8') ?></td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Payment Entry</th>
									<th>Invoice No.</th>
									<th>Payment Date</th>
									<th>Paid Amount</th>
									<th>Payment Mode</th>
									<th>Fee Type</th>
									<th>Reference No.</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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