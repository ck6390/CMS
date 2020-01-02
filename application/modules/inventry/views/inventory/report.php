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
	</style>
<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', 'Inventory Report'); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("inventry/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', 'Inventory Report'); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= $this->misc->_getMethodName(); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php
	 ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content" id="dvContainer">
						<div class="table-responsive">
							<div class="col-sm-12 layout-box col-100">
                        <p class="school">
                            <div class="center">
                                <div class="col-xs-12 col-100">
                                <?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>               
                                       <img src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>" class="img-thumbnail img-circle logo" width="108px" style="float:left;margin-left:100px;margin-bottom:20px;border-radius: 25px;">
                                      <p style="font-size:25px;margin-top:10px;margin-left: 230px;padding-top:8px;"><strong> Ganga Memorial College Of Polytechnic</strong></p><p style="margin-left: 250px;margin-top:-9px;" class="addStyle">AT NH-31, HARNAUT, NALANDA, BIHAR - 803110</p>
                                </div>
                             </div>                            
                        </p>
                    </div>
						<table id="day_statement" class="table table-striped table-bordered table-hover ">
							<thead>
								<?php
							if(count($inventories) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="5"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else { foreach($inventories as $inventory){
								?>

								<tr>
									<th colspan="3" >
									Date Of Purchasing :- <?php echo $inventory->item_on_date;?><br>
									Item Name :- <?php echo $inventory->item_name;?><br/>
									Quantity :- <?php echo $inventory->quantity;?><br/>
									Unit Price :- <?php echo $inventory->purchase_price;?>
									<br/>
									Sale Price :- <?php echo $inventory->sale_price;?>
									<br/>
									Total Amount :- <?php echo $inventory->total_amount;?>

							      </th>
								<th colspan="3" class="theadStyle">
									Agency Name :- <?php echo $inventory->agency_name; ?><br/>
										Bill No :- <?php echo $inventory->bill_ref_no; ?><br>
								  <?php echo "Pay Mode:- ".$inventory->payment_mode_name; ?><br/>
									Transaction No :- <?php echo $inventory->transaction_no;?>
								</th>
									<!-- <th>Amount</th> -->
								</tr>
								<?php }  }?>
							</thead>
							<tbody>
								<tr>
									<th>Student Id</th>
									<th>Student Name</th>
									<th>Item</th>
									<th>Quantity</th>
									<th>Per Unit Price</th>
									<th>Amount</th>
								</tr>
							<?php 
								$inv_id = $this->uri->segment(4);	
								//var_dump($inv_id);
								foreach ($reports as $report) {
									$item_info = json_decode($report->sale_info, true);
									foreach ($item_info['items'] as $items) {
									if($items['inventory_id'] == $inv_id){
										$item['item_name'] = $items['item_name'];
										$item['quantity'] = $items['quantity'];
										$item['unit_price'] = $items['unit_price'];
										$item['sub_price'] = $items['sub_price'];
							?>
								<tr>
									<td><?= $report->student_id ?></td>
									<td><?= $report->student_full_name ?></td>
									<td><?= $item['item_name'] ?></td>
									<td><?= $item['quantity'] ?></td>
									<td><?= $item['unit_price'] ?></td>
									<td><?= $item['sub_price'] ?></td>
								</tr>
							<?php } } }?>
							</tbody>
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
		</div>
	<?php echo form_close(); ?>
</div>
<script>
    $(document).ready(function(){
        $("#btnPrint").click(function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=8.5in;width=8.5in;');
           printWindow.document.write('<html><head><title></title><style media="print">.hiddens{display:none!important}.table-bordered{border-width: 1px;border-style:solid;border-color: rgb(0, 0, 0);font-size:18px;border-image:initial;margin-top:60px;!important;width:100%;border-collapse:collapse;}.table > thead > tr > th{text-align:left;padding-left:20px;!important;border-width: 1px;border-style:solid;border-color: rgb(0, 0, 0);padding-top:12px!important;padding-bottom:12px!important;},.table > tbody > tr > td{text-align:center;}, .table > tfoot > tr > td{border-top: 1px solid #000!important;}.table-bordered > tbody > tr > th, .table-bordered > t > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td,.table-bordered > tbody > tr > td{border-width: 1px;border-style: solid;border-color: rgb(0, 0, 0);border-image:initial;line-height: 1.52857;vertical-align: top;padding: 2px;}.addStyle{margin-top:-9px!important;}.th_remark{float:left;margin-left:10px;margin-top:1px!important;}.pStyle{margin: 0 0 1px !important;text-align:left!important;margin-left:10px!important;}</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>