<style>
		.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
            border-top: 1px solid #000 !important;

        }
        .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{
            border: 1px solid #555 !important;

        }
         .custom-form{
        	width: 155px !important;
        }
        .pStyle{
        	margin: 0 0 1px;
        }

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
            display: none!important; 
          }
        }
	</style>
<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', 'Receipt'); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("inventry/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', 'Receipt'); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= $this->misc->_getMethodName(); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		
	</div>
</div>

<div class="wrapper wrapper-content" id="printableArea">
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
                 <p class="pStyle"><?php echo 'Student Id:- '.$info->student_id;?></p>
                <p class="pStyle"><?php echo 'Student Name:- '.$stud_name[$info->student_id];?></p>
                <p class="pStyle"><?php echo 'Admission No:- '.$stud_add[$info->student_id];?></p>                        
                </th>
                <th>Receipt Date :- <?php echo $info->sell_on_date;?></th>
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
            if(!empty($info->sell_info)){
                        $sell_infos = json_decode($info->sell_info, true);
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
        <table class="table table_data table-bordered m-b-none">
        <tbody>
        <tr>
         <?php //var_dump($info);?>
                <th colspan="4">
                <p class="pStyle"><?php echo 'Student Id:- '.$info->student_id;?></p>
                <p class="pStyle"><?php echo 'Student Name:- '.$stud_name[$info->student_id];?></p>
                <p class="pStyle"><?php echo 'Admission No:- '.$stud_add[$info->student_id];?></p>
                                               
                </th>
                <th>Receipt Date :- <?php echo $info->sell_on_date;?></th>
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
            if(!empty($info->sell_info)){
                        $sell_infos = json_decode($info->sell_info, true);
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
    <div class="container text-center hiddens">
        <div class="col-sm-12" style="margin-top: 20px;">
            <input type="button" onclick="printDiv('printableArea')" value="Print" class="btn btn-info" id="printbtn" />
            <!-- <a href="<?php echo site_url("{$this->misc->_getClassName()}/payment_sms/{$payment_invoice->payment_p_id}/0"); ?>" class="btn btn-danger">Send SMS</a> -->
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
 