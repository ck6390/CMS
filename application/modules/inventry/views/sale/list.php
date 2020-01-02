<style>
	.thStyle
	{
		width: 550px!important;
	}
	.dateForm{
		margin-top: -10px!important;
	}
	.search{
		margin-top: -10px!important;
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
				<a href="<?= site_url("inventry/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', 'Receipt '); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("inventry/{$this->misc->_getClassName()}/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Receipt</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= str_replace('_', ' ', 'Receipt'); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
					<?php if(count($lists) != 0) { ?>
					<div class="ibox-tools">
						<?php
						$attr = array(
							'role' => 'form',
							'method' => 'post',
							'name' => 'add-form',
							'class' => 'form-horizontal'
						);
						echo form_open("inventry/{$this->misc->_getClassName()}/", $attr); ?>
				
						<div class="col-sm-3">
						<?php
							echo form_input(array(
								'type' => 'date',
								'name' => 'start_date',
								'class' => 'form-control dateForm',
								'placeholder' => 'Date',
								'value' =>  set_value('start_date'),
								'required' => 'true',
							));?>
						</div>
						<div class="col-sm-3">
						<?php
							echo form_input(array(
								'type' => 'date',
								'name' => 'end_date',
								'class' => 'form-control dateForm',
								'placeholder' => 'Date',
								'value' =>  set_value('end_date'),
								'required' => 'true',
							));?>
						</div>
						<div class="col-sm-1">
						<input type="submit" name="search" value="search" class="btn btn-info btn-sm search">
					</div>
						<?php echo form_close(); ?>
					</div>
					<?php } ?>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Sl.No</th>
									<th>Receipt Date</th>
									<th>Student Name</th>
									<th>Sale Info</th>
									<th>Total Amount</th>
									<th>Payment Mode</th>
									<th>Tran No.</th>
									<th>Remark</th>									
									<th>Action</th> 
								</tr>
							</thead>
							<tbody>
							<?php
							$sl = 1;
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="9"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($lists as $list) { 
									?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="inventry/<?= $this->misc->_getClassName(); ?>">
									<td>
										<strong><span class="badge badge-primary"><?php echo $sl; ?></span></strong>
									</td>
									<td>
										<?= htmlspecialchars($list->sale_on_date,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?= htmlspecialchars($list->student_full_name,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<table class="table table-bordered">
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
											if(!empty($list->sale_info)){
											$sale_infos = json_decode($list->sale_info, true);
												$items = $sale_infos['items'];
												foreach ($items as $item) {
												?>
													<td><?php echo $sn;?></td>
													<td><?php echo $item['item_name']?></td>
													<td><?php echo $item['quantity']?></td>
													<td><?php echo $item['unit_price']?></td>
													<td><?php echo $item['sub_price']?></td>
												</tr>
											<?php $sn++;} } ?>
										</table>
										</td>
										<td>
										<?= htmlspecialchars($list->total_price,ENT_QUOTES,'UTF-8') ?>
									    </td>
									    <td>
										<?= htmlspecialchars($list->payment_mode_name,ENT_QUOTES,'UTF-8') ?>
									    </td>
									    <td>
										<?= htmlspecialchars($list->transaction_no,ENT_QUOTES,'UTF-8') ?>
									    </td>
									    <td>
										<?= htmlspecialchars($list->remark,ENT_QUOTES,'UTF-8') ?>
									    </td>
									<td>
										<a href="<?php echo site_url("inventry/{$this->misc->_getClassName()}/view/{$list->id}"); ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Sl.No</th>
									<th>Receipt Date</th>
									<th>Student Name</th>
									<th>Sale Info</th>
									<th>Total Amount</th>
									<th>Payment Mode</th>
									<th>Tran No.</th>
									<th>Remark</th>									
									<th>Action</th> 
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>