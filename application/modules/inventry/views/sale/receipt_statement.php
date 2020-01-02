<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', 'Receipt Statement'); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("inventry/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', 'Receipt'); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= str_replace('_', ' ', 'Receipt Statement'); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
	</div>
</div>
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
	</style>
<div class="wrapper wrapper-content">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'form',
		'class' => 'form-horizontal'
	);
	echo form_open("inventry/{$this->misc->_getClassName()}/receipt_statement", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Receipt Statement Report</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12">								
								<div class="col-sm-3">
									<div class=" <?php if(form_error('student_id')) echo 'has-error'; ?>">
									<?php echo form_label('Student Name<small class="text-danger">*</small>', 'student_id', array('class' => ' control-label')); ?>
										<div class="input-group">
											<?php 
											//var_dump($studs);
										$option[null] = '== Please select one option ==';
										$option['All'] = 'All';
										foreach ($studs as $stud) {
                                           $option[$stud->student_unique_id]=$stud->student_unique_id  . "   =>  "  .$stud->student_full_name;
										}
										echo form_dropdown(array(
											'name' => 'student_id',
											'class' => 'form-control',
											'required' => 'true'
										), $option);

										echo form_error('student_id'); ?>
										</div>
									</div>	
								</div>

								<div class="col-sm-4">
									<div class=" <?php if(form_error('start_date')) echo 'has-error'; ?>" id="inputhMonth" style="margin-left:55px;">
									<?php echo form_label('From Date<small class="text-danger">*</small>', 'start_date', array('class' => 'control-label')); ?>
										<div class="input-group">
											<?php 
												echo form_input(array(
													'type' => 'date',
													'name' => 'start_date',
													'id' => 'month_from', 
													'class' => 'form-control',
													'required' => 'true',
													'value' => set_value('start_date')
												));
											?>
										</div>
										<?php echo form_error('start_date'); ?>
									</div>
								</div>
								<div class="col-sm-4">
									<div class=" <?php if(form_error('end_date')) echo 'has-error'; ?>" id="inputhMonth" style="margin-left:-30px;">
									<?php echo form_label('To Date<small class="text-danger">*</small>', 'end_date', array('class' => 'control-label')); ?>
										<div class="input-group ">
											<?php 
												echo form_input(array(
													'type' => 'date',
													'name' => 'end_date',
													'id' => 'month_to', 
													'class' => 'form-control custom-form',
													'required' => 'true',
													'value' => set_value('end_date')

												));
											?>
											
										</div>
										<?php echo form_error('end_date'); ?>
									</div>
								</div>
								<div class="col-sm-1 text-center">
									<div style="margin-top:10px;margin-left:-280px;">
										<?php 
										echo form_submit('submit', 'Go', 'class="btn btn-sm m-t  btn-primary"'); ?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
	<?php if(!empty($infos)): ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
				<h5><span class="text-capitalize"><?= str_replace('_', ' ', 'Receipt Statement'); ?></span> </h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
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
						<table id="sell_statement" class="table table-striped table-bordered table-hover ">	
						  <tbody>								
								<tr>
									<th>Student Name/Id</th>
									<!-- <th>Addmission No</th> -->
									<th>Receipt Date</th>
									<th>Sale Info</th>
									<th>Payment Mode</th>
									<th>Transaction No</th>
									<th>Paid Amount</th>
								</tr>
							<?php 
								$sum="";
								foreach ($infos as $info) :
									$sum += $info->total_price;
									?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="admin/<?= $this->misc->_getClassName(); ?>">
									<td id="total1"><?php echo $info->student_full_name; ?><br><?php echo $info->student_id; ?></td>
									<td><?php echo $info->sale_on_date; ?> </td>
									<td>
									<table class="table table-striped table-bordered table-hover ">
											<tr>
												<th>Sl.no</th>
												<th>Items</th>
												<th>Quantity</th>
												<th>Unit Price</th>
												<th>Amount</th>
											</tr>
											<tr>
											<?php 
											$sn=1;
											if(!empty($info->sale_info)){
											$sale_infos = json_decode($info->sale_info, true);
												$items = $sale_infos['items'];
												foreach ($items as $item) {
												?>
													<td><?php echo $sn;?></td>
													<td><?php echo $item['item_name']?></td>
													<td><?php echo $item['quantity']?></td>
													<td><?php echo $item['unit_price']?></td>
													<td><?php echo $item['sub_price']?></td>
												</tr>
											<?php $sn++;} }?>
										</table>
									<td>
										<?php echo $info->payment_mode_name;?>
									</td>
									<td><?php echo $info->transaction_no;?></td>
									<td><?php echo $info->total_price;?></td>
								</tr>
								<?php endforeach; ?>
								<tr>
					                <th colspan="5" style="text-align:right">Filter Total</th>
					                <th><?php echo $sum;?></th>
					            </tr>
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
	<?php endif; ?>
</div>
<script>
    $(document).ready(function(){
        $("#btnPrint").click(function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=8.5in;width=8.5in;');
           printWindow.document.write('<html><head><title></title><style media="print">.hiddens{display:none!important}.table-bordered{border-width: 1px;border-style:solid;border-color: rgb(0, 0, 0);font-size:18px;border-image:initial;margin-top:0px;!important;width:100%;border-collapse:collapse;}.table > tbody > tr > td{text-align:center;}, .table > tfoot > tr > td{border-top: 1px solid #000!important;}.table-bordered > tbody > tr > th, .table-bordered > t > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td,.table-bordered > tbody > tr > td{border-width: 1px;border-style: solid;border-color: rgb(0, 0, 0);border-image:initial;line-height: 1.52857;vertical-align: top;padding: 2px;}.addStyle{margin-top:-9px!important;}.th_remark{float:left;margin-left:10px;margin-top:1px!important;}.pStyle{margin: 0 0 1px !important;text-align:left!important;margin-left:10px!important;}</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>