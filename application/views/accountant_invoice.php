<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title ?></title>
        <meta name="description" content="">
        <!-- tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <!-- jQuery -->
        <script src="<?= base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
        <!-- bootstrap -->
        <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
        <!-- style css -->
        <link href="<?= base_url() ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
    <style>
        .table tr td{
            font-size: 14px;
            padding: 3px 5px !important;
        }

        body{
            margin:0;
            padding: 0;
        }
        @media print {
          .hiddens{
            display: none! important; 
          }
        }
       /* .auto_hide {
            -webkit-animation: seconds 1.0s forwards;
             -webkit-animation-iteration-count: 1;
              -webkit-animation-delay: 5s;
              animation: seconds 1.0s forwards;
              animation-iteration-count: 1;
              animation-delay: 5s;
              position: relative; 
        }
        @-webkit-keyframes seconds {
          0% {
            opacity: 1;
          }
          100% {
            opacity: 0;
            left: -9999px; 
          }
        }
        @keyframes seconds {
          0% {
            opacity: 1;
          }
          100% {
            opacity: 0;
            left: -9999px;
          }
        }*/
    </style>
    </head>

<body class="white-bg" style="padding:0;" id="printableArea">
    <div class="">
     <?php if (!empty($this->session->flashdata('success'))) {
        //var_dump($success);
        echo   "<div class='alert alert-success border-0 auto_hide hiddens'><i class='fa fa-ban'></i>
                <b>Success</b> :".$this->session->flashdata('success')."</div>";
        }?>

    <div class="col-sm-6 col-xs-6">
        <table class="table  table-bordered m-b-none">
            <tbody>
                <tr>
                    <td>
                        <div style="float:left;width:20%;">
                            <?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>
                            <img class="img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>" style="border:0;padding:0;">
                         </div>
                         <div style="float:right;width:80%;">
                                <h3 style="text-align:center;margin-bottom:10px;"><span class="text-success" > <?php echo $instituteInfo->inst_name; ?></span>
                            </h3>
                            <p class="text-center" style="font-size:12px;">AT NH-31, HARNAUT, NALANDA, BIHAR - 803110, Mo - 9473000022</p>
                        </div>
                    </td> 
                </tr>     
            
            </tbody>
        </table>
        <table class="table table_data table-bordered m-b-none ">
            <tr class="text-center">
                <td colspan="2"><strong>Student Copy</strong></td>
            </tr>
            <tr>
                <td>Receipt No.</td>
                
                <td id="total1"><?php echo $payment_invoice->payment_p_id." / ( ". $this->misc->reformatDate($payment_invoice->created_on)." )" ; ?></td>
            </tr>
            <tr>
               <td>Student Name</td>
               <td> <?php echo $payment_invoice->student_full_name." ( ".$payment_invoice->student_unique_id." )"; ?></td>
                
            </tr>
            <tr>
               <td>Admission Number</td>
               <td><?php echo $payment_invoice->admission_no; ?></td>
                
            </tr>
            <tr>
                <td>Mode Of Payment </td>
                
                <td id="total1"><?php echo $payment_invoice->payment_mode_name; ?> </td>
            </tr>
            <tr>
                <td>Reference No. / Remark </td>
                
                <td id="total1"><?php echo $payment_invoice->reference_no; ?> </td>
            </tr>
        </table>
        <table class="table table-bordered m-b-none">
            <thead>
                <tr>
                    <th>Trans No.</th>
                    <th>Particulars / Fee Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                     <td id="total1"><?php echo $payment_invoice->payment_id; ?> </td>
                
                    <td> <?php 

                    $feeTypes = explode(",", $payment_invoice->fee_types_id); 
                                        
                                        
                        foreach($feeTypes as $ftps){
                            
                            $length = strlen($ftps);
                            $result = substr($ftps,0, 2);
                            
                            if($result == "ac"){
                                
                                $result1 = substr($ftps, 2, $length);
                                
                                $academic_fees = $this->mdl_accountant->day_statement_academic_fee($result1);
                                
                                $fff = $this->mdl_fee_type->get($academic_fees->fk_fee_type_id)->fee_type_name;

                            }elseif($result == "hs"){
                                
                                $result1 = substr($ftps, 2, $length);
                                
                                $hostel_charge = $this->mdl_accountant->day_statement_hostel_fee($result1);
                                
                                $fff = $this->mdl_fee_type->get($hostel_charge->fk_fee_type_id)->fee_type_name." For ".$hostel_charge->hostel_charge_month;

                            }elseif($result =="li"){

                                $result1 = substr($ftps, 2, $length);
                                                
                                                $library_fees = $this->mdl_accountant->day_statement_library_fee($result1);
                                                
                                                $fff = $this->mdl_fee_type->get($library_fees->fine_type_id)->fee_type_name." - ".$payment_invoice->paid_amount."  Rs.";  
                            }elseif($result =="gr"){

                                $result1 = substr($ftps, 2, $length);
                                
                                $fff = $this->mdl_fee_type->get($result1)->fee_type_name; 
                            }elseif($result =="ot"){
                                if(!empty($payment_invoice->fk_semester_id)){
                                                    $fff = $payment_invoice->other_fee." - ".   $this->mdl_semester->get($payment_invoice->fk_semester_id)->semester_name;
                                                }else{

                                                    $fff = $payment_invoice->other_fee ;
                                                }
                            }
                            
                            echo $fff."<br>";
                        }?></td>
                        <td id="total1">
                        <?php 
                        if($result =="ot"){
                            echo $payment_invoice->paid_amount;
                        }else{
                          $allFee = json_decode($payment_invoice->fee_info);
                            //print_r($allFee);
                            foreach($allFee as $feeInfo){
                               // print_r($feeInfo);
                                echo $feeInfo->amount."<br>";
                            }  
                        }
                            
                         ?> </td>
                </tr>
                <tr>
                    <td  class="text-right" colspan="2"><strong>Total Amount <strong></td>
                    <td id="total1"><strong><?php echo $payment_invoice->paid_amount; ?> <strong></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center"> <?php echo  $this->misc->convertToIndianCurrency($payment_invoice->paid_amount); ?> </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered m-b-none">
            <tbody>
                <tr style="height:80px;">
                    <td colspan="4" style='font-size:13px;'><span>&#8226;</span>&ensp;This is a computer generated receipt<br>&ensp;&ensp;Signature not required.<br><span>&#8226;</span>&ensp;Subject to realization of cheque / DD.</td>
                    <td>Signature</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-sm-6 col-xs-6">
        <table class="table  table-bordered m-b-none">
            <tbody>
                <tr>
                    <td>
                        <div style="float:left;width:20%;">
                            <?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>
                            <img class="img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>" style="border:0;padding:0;">
                         </div>
                         <div style="float:right;width:80%;">
                                <h3 style="text-align:center;margin-bottom:10px;"><span class="text-success" > <?php echo $instituteInfo->inst_name; ?></span>
                            </h3>
                            <p class="text-center" style="font-size:12px;">AT NH-31, HARNAUT, NALANDA, BIHAR - 803110, Mo - 9473000022</p>
                        </div>
                    </td> 
                </tr>
        </tbody>
        </table>
        <table class="table table_data table-bordered m-b-none ">
            <tr class="text-center">
                <td colspan="2"><strong>Office Copy</strong></td>
            </tr>
            <tr>
                <td>Receipt No.</td>
                
                <td id="total1"><?php echo $payment_invoice->payment_p_id." / ( ". $this->misc->reformatDate($payment_invoice->created_on)." )" ; ?></td>
            </tr>
            <tr>
               <td>Student Name</td>
               <td> <?php echo $payment_invoice->student_full_name." ( ".$payment_invoice->student_unique_id." )"; ?></td>
                
            </tr>
            <tr>
               <td>Admission Number</td>
               <td><?php echo $payment_invoice->admission_no; ?></td>
                
            </tr>
            <tr>
                <td>Mode Of Payment</td>
                
                <td id="total1"><?php echo $payment_invoice->payment_mode_name; ?> </td>
            </tr>
            <tr>
                <td>Reference No. / Remark </td>
                
                <td id="total1"><?php echo $payment_invoice->reference_no; ?> </td>
            </tr>
        </table>
        <table class="table table-bordered m-b-none">
            <thead>
                <tr>
                    <th>Trans No.</th>
                    <th>Particulars / Fee Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                     <td id="total1"><?php echo $payment_invoice->payment_id; ?> </td>
                
                    <td> <?php 

                         $feeTypes = explode(",", $payment_invoice->fee_types_id); 
                                        
                                        
                        foreach($feeTypes as $ftps){
                            
                            $length = strlen($ftps);
                            $result = substr($ftps,0, 2);
                            
                            if($result == "ac"){
                                
                                $result1 = substr($ftps, 2, $length);
                                
                                $academic_fees = $this->mdl_accountant->day_statement_academic_fee($result1);
                                
                                $fff = $this->mdl_fee_type->get($academic_fees->fk_fee_type_id)->fee_type_name;

                            }elseif($result == "hs"){
                                
                                $result1 = substr($ftps, 2, $length);
                                
                                $hostel_charge = $this->mdl_accountant->day_statement_hostel_fee($result1);

                                $fff = $this->mdl_fee_type->get($hostel_charge->fk_fee_type_id)->fee_type_name." For ".$hostel_charge->hostel_charge_month;

                            }elseif($result =="li"){

                                $result1 = substr($ftps, 2, $length);
                                                
                                                $library_fees = $this->mdl_accountant->day_statement_library_fee($result1);
                                                
                                                $fff = $this->mdl_fee_type->get($library_fees->fine_type_id)->fee_type_name." - ".$payment_invoice->paid_amount."  Rs.";  
                            }elseif($result =="gr"){

                                $result1 = substr($ftps, 2, $length);
                                
                                $fff = $this->mdl_fee_type->get($result1)->fee_type_name; 
                            }elseif($result =="ot"){
                                if(!empty($payment_invoice->fk_semester_id)){
                                                    $fff = $payment_invoice->other_fee." - ".   $this->mdl_semester->get($payment_invoice->fk_semester_id)->semester_name;
                                                }else{

                                                    $fff = $payment_invoice->other_fee ;
                                                }
                            }
                            
                            echo $fff."<br>";
                        }?></td>
                        <td id="total1">
                        <?php 
                        if($result =="ot"){
                            echo $payment_invoice->paid_amount;
                        }else{
                          $allFee = json_decode($payment_invoice->fee_info);
                            //print_r($allFee);
                            foreach($allFee as $feeInfo){
                               // print_r($feeInfo);
                                echo $feeInfo->amount."<br>";
                            }  
                        }
                            
                         ?> </td>
                </tr>
                <tr>
                    <td  class="text-right" colspan="2"><strong>Total Amount <strong></td>
                    <td id="total1"><strong><?php echo $payment_invoice->paid_amount; ?> <strong></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center"> <?php echo  $this->misc->convertToIndianCurrency($payment_invoice->paid_amount); ?> </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered m-b-none">
            <tbody>
                <tr style="height:80px;">
                    <td colspan="4" style='font-size:13px;'><span>&#8226;</span>&ensp;This is a computer generated receipt<br>&ensp;&ensp;Signature not required.<br><span>&#8226;</span>&ensp;Subject to realization of cheque / DD.</td>
                    <td>Signature</td>
                </tr>
            </tbody>
        </table>
    </div>
   </div>
    <div class="container text-center hiddens">
        <div class="col-sm-12" style="margin-top: 20px;">
            <input type="button" onclick="printDiv('printableArea')" value="Print" class="btn btn-info"/>
            <a href="<?php echo site_url("{$this->misc->_getClassName()}/payment_sms/{$payment_invoice->payment_p_id}/0"); ?>" class="btn btn-danger">Send SMS</a>
            <a href="<?php echo site_url("{$this->misc->_getClassName()}/accountants/"); ?>" class="btn btn-success">Goto Dashboard</a>

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
</body>

</html>
