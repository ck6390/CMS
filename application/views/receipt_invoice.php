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
        <tbody>
        <tr>
         <?php //var_dump($info);?>
                <th colspan="4">
                <p class="pStyle"><?php echo 'Student Id:- '.$receipt->student_id;?></p>
                <p class="pStyle"><?php echo 'Student Name:- '.$receipt->student_full_name;?></p>
                <p class="pStyle"><?php echo 'Admission No:- '.$receipt->admission_no;?></p>
                                               
                </th>
                <th>Receipt Date :- <?php echo $receipt->sell_on_date;?></th>
            </tr>
            <tr>
                <th>Sno</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Per Unit Price</th>
                <th>Amount</th>
            </tr>
            <?php 
            $sn=1;
            //var_dump($receipt);die();
            if(!empty($receipt->sell_info)){
                        $sell_infos = json_decode($receipt->sell_info, true);
                            $items = $sell_infos['items'];
                            foreach ($items as $item) {
                            ?>
            <tr>
                <td><?php echo $sn;?></td>
                <td><?php echo $item['stock_name']?></td>
                <td><?php echo $item['quantity']?></td>
                <td><?php echo $item['unit_price']?></td>
                <td><?php echo $item['sub_price']?></td>
            </tr>
            <?php $sn++;} ?>
            <tr>
                <th colspan="3"><p class="th_remark">Payment Mode :- <?php echo $this->mdl_pay_mode->get($sell_infos['pay_mode'])->payment_mode_name;?><br/>
                    Transaction No :- <?php if(!empty($sell_infos['transaction_no']) && isset($sell_infos['transaction_no'])){echo $sell_infos['transaction_no'];}?></p> 
                </th>
                <th>Total Amount :-</th>
                <th><p><?php echo $sell_infos['total_price'];?></p></th>
            </tr>
            <tr>
                <th colspan="5" height="60px;" ><p class="th_remark">Remark :- <?php echo $sell_infos['remark'];?></p></th>
                
            </tr>
            <?php } ?>
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
            <tbody>
        <tr>
         <?php //var_dump($info);?>
                <th colspan="4">
                <p class="pStyle"><?php echo 'Student Id:- '.$receipt->student_id;?></p>
                <p class="pStyle"><?php echo 'Student Name:- '.$receipt->student_full_name;?></p>
                <p class="pStyle"><?php echo 'Admission No:- '.$receipt->admission_no;?></p>
                                               
                </th>
                <th>Receipt Date :- <?php echo $receipt->sell_on_date;?></th>
            </tr>
            <tr>
                <th>Sno</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Per Unit Price</th>
                <th>Amount</th>
            </tr>
            <?php 
            $sn=1;
            //var_dump($receipt);die();
            if(!empty($receipt->sell_info)){
                        $sell_infos = json_decode($receipt->sell_info, true);
                            $items = $sell_infos['items'];
                            foreach ($items as $item) {
                            ?>
            <tr>
                <td><?php echo $sn;?></td>
                <td><?php echo $item['stock_name']?></td>
                <td><?php echo $item['quantity']?></td>
                <td><?php echo $item['unit_price']?></td>
                <td><?php echo $item['sub_price']?></td>
            </tr>
            <?php $sn++;} ?>
            <tr>
                <th colspan="3"><p class="th_remark">Payment Mode :- <?php echo $this->mdl_pay_mode->get($sell_infos['pay_mode'])->payment_mode_name;?><br/>
                    Transaction No :- <?php if(!empty($sell_infos['transaction_no']) && isset($sell_infos['transaction_no'])){echo $sell_infos['transaction_no'];}?></p> 
                </th>
                <th>Total Amount :-</th>
                <th><p><?php echo $sell_infos['total_price'];?></p></th>
            </tr>
            <tr>
                <th colspan="5" height="60px;" ><p class="th_remark">Remark :- <?php echo $sell_infos['remark'];?></p></th>
                
            </tr>
            <?php } ?>
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
            <!-- <a href="<?php echo site_url("{$this->misc->_getClassName()}/payment_sms/{$payment_invoice->payment_p_id}/0"); ?>" class="btn btn-danger">Send SMS</a> -->
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
