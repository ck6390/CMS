<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Accounting</a>
			</li> 
			<li>
				<a href="<?= site_url("accounting/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong>View</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
                        <a href="<?= site_url("hostel/{$this->misc->_getClassName()}/h_print/{$info->invoice_p_id}"); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Invoice </a>
                    </div>
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'edit-form',
		'class' => 'form-horizontal'
	);
	echo form_open("accounting/{$this->misc->_getClassName()}/view/{$info->invoice_p_id}", $attr); ?>
		<div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td><h4>Invoice No. -   <span class="text-navy" ><?php echo $info->invoice_id; ?></span></h4>
                                    
                                    <h4>Payment Status : <span class="text-navy" ><?php echo $info->paid_status; ?></span></h4>
                                    <p>
                                        <span><strong>Invoice Date:</strong> <?php echo $this->misc->reformatDate($info->created_on); ?></span>
                                    </p>
                                </td>
                                <td>
                                    <h4>Student ID :    <span class="text-navy" ><?php echo $info->student_unique_id; ?></span></h4>                                    
                                    <h4>Session : <span class="text-navy" ><?php echo $info->session_name; ?></span></h4>

                                    <h4>Branch : <span class="text-navy" ><?php echo $info->branch_code; ?></span></h4>
                                    <h4>Semester : <span class="text-navy" ><?php echo $info->semester_name; ?></span></h4>
                                </td>
                                <td><?php 

                                        $instituteInfo = $this->mdl_general_setting->get('6'); ?>
                                    <img class="pull-right img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>">
                                    <h4><span class="text-navy" > <?php echo $instituteInfo->inst_name ; ?></span></h4>
                                    <h4> Affiliatition Number : <span class="text-navy" ><?php echo $instituteInfo->inst_affiliation_no ; ?></span></h4>
                                </td>
                               
                            </tr>
                            </tbody>
                        </table>
                            <hr>
                            <div class="table-responsive  m-t">
                                <table class="table table-bordered invoice-table ">
                                    <thead>
                                    <tr>
                                        <th>Fee Type</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <tr>
                                        <td><div><strong><?php echo $info->fee_type_name ." For ".$info->hostel_charge_month; ?></strong></div></td>
                                        
                                        <td><i class="fa fa-rupee"></i><?php echo $info->fee_amount; ?>  </td>
                                    </tr>
                                    
                                    
                                    

                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>SUB TOTAL :</strong></td>
                                    <td><i class="fa fa-rupee"></i>  <?php echo $info->fee_amount; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>DUE AMOUNT :</strong></td>
                                    <td><i class="fa fa-rupee"></i>  <?php echo $info->due_amount; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>PAYBLE AMOUNT :</strong></td>
                                    <td><i class="fa fa-rupee"></i>  <?php echo $info->due_amount; ?> </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                               <a href="<?= site_url("hostel/{$this->misc->_getClassName()}/hostel_invoice_payment/{$info->invoice_p_id}/{$info->student_p_id}"); ?>" class="btn btn-primary"><i class="fa fa-rupee"></i> Make A Payment </a>
                            </div>

                            <div class="well m-t"><strong>This is system generated invoice</strong>
                                
                            </div>
                        </div>
                </div>
            </div>
        </div>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
$(document).ready(function() {
    calculateAmount();    
});
$(".invid").change(function() {    
        calculateAmount()
});
function calculateAmount(){
    var  tamount = 0;
    var  tpaid_amount = 0;
        $('input.invid:checked').each(function() {
             amount = parseInt($(this).data('amount'));  
             tamount = parseInt(tamount) + parseInt(amount);
             console.log(tamount);
        });
        $('input.invid:unchecked').each(function() {
            paid_amount = parseInt($(this).data('amount'));  
            tpaid_amount = parseInt(tpaid_amount) + parseInt(paid_amount);
            console.log(tpaid_amount);
        });
        $(".subtotal").text(tamount);
        $(".total").text(tamount);
        $(".paid_amount").text(tpaid_amount);
        $(".due").text(tamount);
        
    }
</script>