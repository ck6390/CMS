<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', 'Receipt Stock'); ?></span></h2>
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
					<div class="ibox-tools">
						<?php
						$attr = array(
							'role' => 'form',
							'method' => 'post',
							'name' => 'add-form',
							'class' => 'form-horizontal'
						);
						echo form_open("inventry/{$this->misc->_getClassName()}/index", $attr); ?>
						<?php
							echo form_input(array(
								'type' => 'date',
								'name' => 'start_date',
								//'class' => 'form-control',
								'placeholder' => 'Date',
								'value' =>  set_value('start_date'),
								'required' => 'true',
							));?>
						<?php
							echo form_input(array(
								'type' => 'date',
								'name' => 'end_date',
								//'class' => 'form-control',
								'placeholder' => 'Date',
								'value' =>  set_value('end_date'),
								'required' => 'true',
							));?>
						<input type="submit" name="search" value="search" class="btn btn-info btn-xs">
						<?php echo form_close(); ?>
					</div>
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
									<!-- <th>Status</th> -->
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
								foreach ($lists as $list) { 
									// var_dump(json_decode($list->sell_info,JSON_FORCE_OBJECT));
									?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="inventry/<?= $this->misc->_getClassName(); ?>">
									<td>
										<strong><span class="badge badge-primary"><?= htmlspecialchars($list->id,ENT_QUOTES,'UTF-8') ?></span></strong>
									</td>
									<td>
										<?= htmlspecialchars($list->sell_on_date,ENT_QUOTES,'UTF-8') ?>
									</td>
									<td>
										<?= htmlspecialchars($stu[$list->student_id],ENT_QUOTES,'UTF-8') ?>
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
											if(!empty($list->sell_info)){
											$sell_infos = json_decode($list->sell_info, true);
												$items = $sell_infos['items'];
												foreach ($items as $item) {
												?>
													<td><?php echo $sn;?></td>
													<td><?php echo $item['stock_name']?></td>
													<td><?php echo $item['quantity']?></td>
													<td><?php echo $item['unit_price']?></td>
													<td><?php echo $item['sub_price']?></td>
												</tr>
											<?php $sn++;} ?>
												<tr>
													<th colspan="4">Total Amount:-</th>
													<th colspan=""><?php echo $sell_infos['total_price'];?></th>
												</tr>
												<tr>
													<th colspan="4">Pay Mode:-</th>
													<th colspan=""><?php echo $this->mdl_pay_mode->get($sell_infos['pay_mode'])->payment_mode_name;?></th>
												</tr>
												<tr>
													<th colspan="4">Transaction No:-</th>
													<th colspan=""><?php echo $sell_infos['transaction_no'];?></th>
												</tr>
												<tr>
													<th colspan="4">Remark:-</th>
													<th colspan=""><?php echo $sell_infos['remark'];?></th>
												</tr>
											<?php } ?>
										</table>
										
									</td>
									
									<!-- <td><?php echo ($list->is_active) ? anchor("inventry/{$this->misc->_getClassName()}/deactivate/{$list->id}", '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("inventry/{$this->misc->_getClassName()}/activate/{$list->id}", '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td> -->
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
									<th>Sell Info</th>
									<!-- <th>Status</th> -->
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