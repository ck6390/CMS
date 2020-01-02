<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li> 
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong>Fee Deposit</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
            <a href="<?= site_url("{$this->misc->_getClassName()}/accountant_invoice_breakUp/{$info->student_p_id}"); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Invoice </a>
        </div>
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'class' => 'form-horizontal'
	);
	echo form_open("{$this->misc->_getClassName()}/fee_deposit/{$info->student_p_id}", $attr); ?>
		<div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                     <?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>
                                     <img class="img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>" style="width:100px;">
                                       
                                        <h3 style="text-align:center;margin-bottom:20px;margin-top:0px;"><span class="text-success" > <?php echo $instituteInfo->inst_name; ?></span>
                                        </h3>
                                        <p class="text-center">AT NH-31, HARNAUT, NALANDA, BIHAR - 803110, Ph 0612-2237111, 9473000022</p>
                                    </td>  
                                </tr>
                            </tbody>
                        </table>
                            <hr>
                            <div class="table-responsive  m-t">
                                 <table class="table table-bordered ">
                                   <tr>
                               <td><strong>Student Id</strong></td>
                               <td><h4 class="text-info"><strong><?php echo $info->student_unique_id; ?></strong></h4></td>
                               <td><strong> Student Name</strong></td>
                               <td> <h4 class="text-info"><strong><?php echo $info->student_full_name; ?></strong></h4></td>
                                
                            </tr>
                            <tr>
                               <td><strong>Session</strong></td>
                               <td><h4 class="text-info"><strong><?php echo $info->session_name; ?></strong></h4></td>
                               <td><strong> Branch</strong></td>
                               <td> <h4 class="text-info"><strong><?php echo $info->branch_code; ?></strong></h4></td>
                                
                            </tr>
                            <tr>
                               <td><strong>Registration No.</strong></td>
                               <td><h4 class="text-info"><strong><?php echo $info->registration_no; ?></strong></h4></td>
                               <td><strong> Date of admission</strong></td>
                               <td> <h4 class="text-info"><strong><?php echo $this->misc->reformatDate($info->admission_date); ?></strong></h4></td>
                                
                            </tr>
                        </table>
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Fee Type</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody id="feeListTable">
                                    <input type="hidden" name="table_data" id="table_length" >
                                       <?php
                            
                                foreach ($academicFeeList as $academicFee) { ?>

                                    <tr>
                                        <input type="hidden" value="<?php echo $academicFee->due_amount?>" name="TotalFee">
                                        <td><input class="feeDuesList" type="checkbox"  value="ac<?php echo $academicFee->invoice_p_id;?>" name="fee-type[]">
                                            </td>
                                        <td class="align-left"><div><strong><?php echo $academicFee->fee_type_name." ".$academicFee->remarks ?></strong></div></td>

                                        <td class="dueAmount"> <?php 
                                            
                                            if($academicFee->paid_status == "unpaid"){
                                            $dueFee = $academicFee->fee_amount;
                                           
                                            }else{
                                                $dueFee = $academicFee->fee_amount-$academicFee->due_amount;
                                            }

                                            echo form_input(array(
                                            'type' => 'text',
                                            'name' => 'paid-fee[]',
                                            'id' => 'feeList',
                                            'value' => set_value('paid-fee[]',$dueFee),
                                            'class' => 'form-control row-price',
                                            'required' => 'true'
                                            
                                        ));

                                        echo form_input(array(
                                            'type' => 'hidden',
                                            'name' => 'full-fee[]',
                                            'value' => set_value('full-fee[]',$dueFee),
                                            'class' => 'form-control',
                                            'required' => 'true'
                                            
                                        ));
                                       ?>  </td>
                                        
                                    </tr>
                                    
                                <?php  }  
                         
                             
                                foreach ($hostelFeeList as $list) {  ?>
                                    <tr>
                                       
                                     <td>
                                        <input class="feeDuesList" type="checkbox"  value="hs<?php echo $list->hostel_fee_p_id;?>" name="fee-type[]"> 
                                        </td>
                                        <td class="align-left"><div><strong>
                                            <?php 
                                            $month = date("F", strtotime($list->hostel_charge_month));
                                            $year = date("Y", strtotime($list->hostel_charge_month));

                                        echo $list->fee_type_name ." For ".$month."-".$year; ?></strong></div></td>
                                        
                                        <td class="dueAmount">
                                        <?php 
              
                                              
                                        if($list->paid_status == "unpaid"){
                                            $dueFee = $list->fee_amount + $this->misc->hostelFine($list->hostel_charge_month);
                                           
                                        }else{
                                            $dueFee = $list->fee_amount+$list->late_fine-$list->due_amount;
                                        }
                                        

                                        echo form_input(array(
                                            'type' => 'text',
                                            'name' => 'paid-fee[]',
                                            'id' => 'feeList',
                                            'value' => set_value('paid-fee[]',$dueFee),
                                            'class' => 'form-control row-price',
                                            'required' => 'true'
                                            
                                        ));

                                        echo form_input(array(
                                            'type' => 'hidden',
                                            'name' => 'full-fee[]',
                                            'value' => set_value('full-fee[]',$dueFee),
                                            'class' => 'form-control',
                                            'required' => 'true'
                                            
                                        ));

                                        echo form_input(array(
                                            'type' => 'hidden',
                                            'name' => 'late-fine[]',
                                            'value' => set_value('late-fine[]',$this->misc->hostelFine($list->created_on)),
                                            'class' => 'form-control',
                                            'required' => 'true'
                                            
                                        ));
                                        ?>
                                    </td>
                                    </tr> 
                                <?php  }  
                               
                                foreach ($libraryFeeList as $libraryFee) {
                                    $fine_amount = $this->mdl_fee_type->get($libraryFee->fine_type_id)->fee_type_amount;
                                    $date1 = new DateTime($libraryFee->return_date);
                                    $date2 = new DateTime("now");
                                    if($date1 > $date2){
                                        $date_over = $date2->diff($date2);
                                    }else{
                                        $date_over = $date1->diff($date2);
                                    }
                                    $fine_days = $date_over->format('%a');
                                    $fine =  $fine_days * $fine_amount;
                                    $total_fine = $fine-$libraryFee->library_fine;
                                    
                                    if($total_fine > 0){  ?>
                                    <tr>
                                        <td><input class="feeDuesList" type="checkbox"  value="li<?php echo $libraryFee->book_issue_p_id;?>" name="fee-type[]">
                                            </td>
                                        <td class="align-left"><div><strong><?php echo $libraryFee->fee_type_name ?></strong></div></td>
                                        
                                        <td class="dueAmount"> <?php 
                                            echo form_input(array(
                                            'type' => 'text',
                                            'name' => 'paid-fee[]',
                                            'id' => 'feeList',
                                            'value' => set_value('paid-fee[]',$total_fine),
                                            'class' => 'form-control row-price',
                                            'required' => 'true'
                                            
                                        ));

                                        echo form_input(array(
                                            'type' => 'hidden',
                                            'name' => 'full-fee[]',
                                            'value' => set_value('full-fee[]',$total_fine),
                                            'class' => 'form-control',
                                            'required' => 'true'
                                            
                                        ));
                                       ?>  </td>
                                    </tr>
                                <?php  }  } ?>

                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->
                            <div class="row">
                                
                                <div class="form-group col-sm-12 p-r-none<?php if(form_error('pay_method')) echo 'has-error'; ?>">
                                    <div class="col-sm-8">
                                        <?php 
                                         echo form_label('Sub Total <small class="text-danger">*</small>', 'payble-amount',array('class'=>'pull-right'));
                                        ?>
                                    </div>
                                     <div class="col-sm-4 p-r-none">
                                        <?php
                                       
                                        echo form_input(array(
                                            'type' => 'text',
                                            'name' => 'payble-amount',
                                            'id' => 'amount',
                                            'class' => 'form-control',
                                            'readonly' => 'true'
                                            
                                        ));

                                        echo form_error('payble-amount'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 p-r-none<?php if(form_error('pay_method')) echo 'has-error'; ?>">
                                    <div class="col-sm-8">
                                        <?php 
                                         echo form_label('Payment Mode <small class="text-danger">*</small>', 'pay-method',array('class'=>'pull-right'));
                                        ?>
                                    </div>
                                     <div class="col-sm-4 p-r-none">
                                        <?php
                                   
                                        $_paymethod = $this->mdl_pay_mode->dropdown('payment_mode_name');
                                        
                                        echo form_dropdown(array(
                                            'name' => 'pay-method',
                                            'id' => 'pay_method',
                                            'class' => 'form-control',
                                        ), $_paymethod);

                                        echo form_error('pay-method'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 p-r-none<?php if(form_error('pay_method')) echo 'has-error'; ?>">
                                    <div class="col-sm-8">
                                        <?php 
                                          echo form_label('Ref No. ', 'reference-no',array('class'=>'pull-right'));
                                        ?>
                                    </div>
                                     <div class="col-sm-4 p-r-none">
                                       <?php
                                       
                                        echo form_input(array(
                                            'type' => 'text',
                                            'name' => 'reference-no',
                                            'class' => 'form-control',
                                            'placeholder' => 'Refenrence no.',
                                            
                                        ));
                                        echo form_error('reference-no'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                               <button  class="btn btn-primary" type="submit"><i class="fa fa-rupee"></i>Make A Payment</button>
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
    $("input[name='paid-fee[]']").prop('disabled', true);
    $("input[name='full-fee[]']").prop('disabled', true);
    function calculateSum(){
     var sumTotal=0;
     var table_row = 0;
        $('table tbody tr').each(function() {
          var $tr = $(this);

          if ($tr.find('input[type="checkbox"]').is(':checked')) {
            table_row = table_row+1;
            $("#table_length").val(table_row);
            var $columns = parseInt($tr.find('input[name="paid-fee[]"]').val());
            sumTotal+=$columns;
            $tr.find('td').next('td').find('input').prop('disabled', false);
            
          }
        });

        $("#amount").val(sumTotal);
           
    }

    $("input[name='paid-fee[]']").keyup(function() {
         calculateSum();

    });
      
    $("input[type='checkbox']").change(function() {
         calculateSum();

    });



});  

  
</script>
