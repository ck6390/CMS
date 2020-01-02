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
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', 'Inventory'); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("inventry/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', 'Inventory'); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("inventry/{$this->misc->_getClassName()}/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= str_replace('_', ' ', 'Inventory'); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
					<?php if(count($lists) != 0) { ?>
					<div class="ibox-tools">
						<?php
						$attr = array(
							'role' => 'form',
							'method' => 'post',
							'name' => 'add-form',
							'class' => 'form-horizontal'
						);
						echo form_open("inventry/{$this->misc->_getClassName()}/index", $attr); ?>
				
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
									<th>SL.No</th>
									<th>Date Of Purchasing</th>
									<th>Stock Name</th>
									<th>Quantity</th>
									<th>Purchase Price</th>
									<th>Total Amount</th>
									<th>Selling Price</th>
									<th>Available Quantity</th>
									<th class="thStyle">Payment Info</th>
									<th>Attach File</th>
									<th>Remark</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="5"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($lists as $list) { ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="inventry/<?= $this->misc->_getClassName(); ?>">
									<td>
										<strong><span class="badge badge-primary"><?= htmlspecialchars($list->id,ENT_QUOTES,'UTF-8') ?></span></strong>
									</td>
									<td>
										<?= htmlspecialchars($list->stock_on_date,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?= htmlspecialchars($list->stock_name,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?= htmlspecialchars($list->quantity,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?= htmlspecialchars($list->purchase_price,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?= htmlspecialchars($list->total_amount,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?= htmlspecialchars($list->sell_price,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?php 
										if(!empty($list->available_quantity) && isset($list->available_quantity) && $list->available_quantity != '0'){ ?>
											<span class="btn btn-info btn-xs"><?php echo $list->available_quantity;?></span>
										<?php }elseif($list->available_quantity == '0'){?>
												<span class="btn btn-danger btn-xs"><?php echo $list->available_quantity;?></span>
										<?php }?>
									</td>
									<td class="thStyle">
										<span class="badge badge-primary"><?php echo "Agency Name :- ".$list->agency_name; ?></span><br/>
										<span class="badge badge-info"><?php echo "Bill No :- ".$list->bill_ref_no; ?></span><br>
										<span class="badge badge-default"><?php echo "Pay Mode:- ".$this->mdl_pay_mode->get($list->pay_mode)->payment_mode_name; ?></span><br>
										<span class="badge badge-default"><?php echo "Transcation No :- ".$list->transaction_no;?></span>
									</td>
									<td>
										<?php if(!empty($list->bill_add) && isset($list->bill_add)){ ?>
										<strong><a href="<?php echo base_url().'assets/img/inventory/'.$list->bill_add; ?>" target="_blank"><span class="btn btn-info btn-xs">View File</span></a></strong>
										<?php } ?>
									</td>
									<td>
										<?= htmlspecialchars($list->remark,ENT_QUOTES,'UTF-8') ?>
									</td>
																		
									<td>
										<a href="<?php echo site_url("inventry/{$this->misc->_getClassName()}/inventryReport/{$list->id}"); ?>" class="btn btn-success btn-xs">
											<span>Report</span>
										</a>
									</td> 
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>SL.No</th>
									<th>Date Of Purchasing</th>
									<th>Stock Name</th>
									<th>Quantity</th>
									<th>Purchase Price</th>
									<th>Total Amount</th>
									<th>Selling Price</th>
									<th>Available Quantity</th>
									<th class="thStyle">Payment Info</th>
									<th>Attach File</th>
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