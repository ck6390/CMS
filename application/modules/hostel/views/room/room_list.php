<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Hostel</li>
			<li>
				<a href="<?= site_url("hostel/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("hostel/{$this->misc->_getClassName()}/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Room Name/No.</th>
									<th>Building</th>
									<th>Block</th>
									<th>Floor</th>
									<th>Total Bed</th>
									<th>Available Bed</th>
									<th>Rent/Month</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="10"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($lists as $list) { ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="hostel/<?= $this->misc->_getClassName(); ?>">
									<td>
										<strong><span class="badge badge-primary"><?= htmlspecialchars($list->room_p_id,ENT_QUOTES,'UTF-8') ?></span></strong>
									</td>
									<td><?= htmlspecialchars($list->room_number,ENT_QUOTES,'UTF-8') ?></td>

									<td>

										<?php if(!empty($list->building_id)){
											echo $this->mdl_building->get($list->building_id)->building_name;
										}?>

									</td>

									<td>
									<?php if(!empty($list->block_id)){
											echo $this->mdl_block->get($list->block_id)->block_name;
										}?>
									</td>

									<td>
										<?php if(!empty($list->floor_id)){
											echo $this->mdl_floor->get($list->floor_id)->floor_name;
										}?>
									</td>

									<td><?= htmlspecialchars($list->total_bed) ?></td>
									<td><?= htmlspecialchars($list->total_bed - $list->booked_bed)?></td>
									<td><?= htmlspecialchars($list->room_rent) ?></td>
									<td><?php echo ($list->is_active) ? anchor("hostel/{$this->misc->_getClassName()}/deactivate/{$list->room_p_id}", '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("hostel/{$this->misc->_getClassName()}/activate/{$list->room_p_id}", '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td>
									<td>
										<a href="<?php echo site_url("hostel/{$this->misc->_getClassName()}/edit/{$list->room_p_id}"); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<button class="btn btn-xs btn-danger deleteRow" value="<?= $list->room_p_id ?>">
											<i class="fa fa-trash"></i>
										</button>
										<?php if($this->auth->_isDeveloper()) { ?>
											<a href="<?php echo site_url("hostel/{$this->misc->_getClassName()}/force_delete/{$list->room_p_id}"); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Room Name/No.</th>
									<th>Building</th>
									<th>Block</th>
									<th>Floor</th>
									<th>Total Bed</th>
									<th>Available Bed</th>
									<th>Rent/Month</th>
									<th>Status</th>
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