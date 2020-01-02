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
         <script type="text/javascript">
        window.print();

    </script>
    <style>
        
        .table > tbody > tr > td{
             padding: 2px 8px;
             
        }
        .text-info{
            margin: 2px;
        }
        .well{
            padding: 8px 19px;
        }
        .table-bordered > thead > tr > th, .table-bordered > thead > tr > td{
            background-color: #F5F5F6;
        }
        
        .sig{
            position: absolute;
            right:15px;
            bottom:10px;
        }
        .white-bg{
            margin-left:60px;
        }
        
    </style>
    </head>

<body class="white-bg" id="dvContainer"">
    <div class="col-sm-12">
        <table class="table table-bordered m-b-none">
            <tbody>
                <tr>
                    <td>
                        <div style="float:left;width:20%;">
                            <?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>
                            <img class=" img-responsive" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>" style="border:0;padding:0px;padding-left: 8px;width:125px;height: 88px;">
                         </div>
                         <div style="float:right;width:80%;">
                                <h3 style="text-align:center;margin-bottom:10px;font-size: 18px;"><span class="text-success" > <?php echo $instituteInfo->inst_name; ?></span>
                            </h3>
                            <p class="text-center" style="font-size:12px;">AT NH-31, HARNAUT, NALANDA, BIHAR - 803110</p>
                            <p class="text-center">Website: <span class="text-success" >http://gangamemorial.com</span></p>
                        </div>
                    </td> 
                </tr>
        </tbody>
        </table>
        <table class="table table-bordered m-b-none ">
            <tr>
                <td>Receipt No.</td>
                <td id="total1"><?php echo $debit_invoice->debit_p_id." / ( ". $this->misc->reformatDate($debit_invoice->created_on)." )" ; ?></td>
            </tr>
            <tr>
               <td>Amount Paid To </td>
               <td> <?php echo $debit_invoice->paid_to; ?></td>  
            </tr>
            <tr>
               <td>Purpose</td>
               <td><?php echo $this->mdl_debit_purpose->get($debit_invoice->purpose)->purpose_name; ?></td>
            </tr>
        </table>
        <table class="table table-bordered m-b-none">
            <thead>
                <tr>
                    <th colspan="3" class="text-center">Payment Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td  colspan="2">Trans No. </td>
                    <td id="total1"><?php echo$debit_invoice->debit_id; ?> </td>
                </tr>
                <tr>
                    <td   colspan="2">Total Amount </td>
                    <td id="debitAmount"><?php echo $debit_invoice->amount; ?> </td>
                </tr>
                <tr>
                    <td  colspan="2"> Mode Of Payment </td>
                    <td id="total1"><?php echo $this->mdl_pay_mode->get($debit_invoice->fk_peyment_mode_id)->payment_mode_name; ?> </td>
                </tr>
                <tr>
                    <td  colspan="2">Reference No. / DD No. / Check No. </td>
                    <td id="total1"><?php echo $debit_invoice->payment_mode_reference?$debit_invoice->payment_mode_reference:""; ?> </td>
                </tr>
                <tr>
                    <td  colspan="2">Remarks</td>
                    <td id="total1"><?php echo $debit_invoice->remarks?$debit_invoice->remarks:""; ?> </td>
                </tr>
            
          
            </tbody>
        </table>
        <table class="table table-bordered m-b-none">
            <thead>
                <tr>
                    <th colspan="3" class="text-center"  style="font-size:14px;">
                        <?php echo "Amount in words ( ".$this->misc->convertToIndianCurrency($debit_invoice->amount) ." )";?>
                    </th>

                </tr>
                <tr>
                    <th>Received By</th>
                    <th>Prepared By</th>
                    <th>Authorized Sign</th>
                </tr>
            </thead>
            <tbody>
                <tr style="height:70px;">
                    <td >
                        <br><br>
                    </td>
                    <td><br><br></td>
                    <td><br><br></td>
                </tr>
            </tbody>
        </table>
    </div>     
</body>
</html>
