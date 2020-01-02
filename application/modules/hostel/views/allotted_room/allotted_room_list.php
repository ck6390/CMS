<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Hostel</li>
			<li>
				<a href="<?= site_url("hostel/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("hostel/hostel_student") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
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
									<th>Student Id</th>
									<th>Booking Date</th>
									<th>Checkout Date</th>
									<th>Rent/Month</th>
									<th>Security Money</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							//var_dump($lists);
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="8"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($lists as $list) { ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="hostel/<?= $this->misc->_getClassName(); ?>">
									<td>
										<strong><span class="badge badge-primary"><?= htmlspecialchars($list->allotted_room_p_id,ENT_QUOTES,'UTF-8') ?></span></strong>
									</td>
									<td><?php echo $this->mdl_room->get_single_value_by_id('room',$list->room_id,'room_number');?></td>

									<td><?php echo $this->mdl_room->get_single_value_by_id('student',$list->student_id,'student_unique_id');?></td>
									<td><?= htmlspecialchars($list->booking_date) ?></td>
									<td><?= htmlspecialchars($list->checkout_date) ?></td>
									<td><?= htmlspecialchars($list->room_rent) ?></td>
									<td><?= htmlspecialchars($list->security_money) ?></td>
									<td><?php echo ($list->is_active) ? '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i>Continue</span>' : '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i>Release</span>'; ?>
									</td>
									<td>
			                       		<a href="<?=base_url().'index.php/hostel/allotted_rooms/room_status/'.$list->allotted_room_p_id."/".$list->status?>">
			                       			<?php echo $list->status != '1' ? '<span class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Active</span>' : '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'?></a>
			                       		
			                       	</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Room Name/No.</th>
									<th>Student Id</th>
									<th>Booking Date</th>
									<th>Checkout Date</th>
									<th>Rent/Month</th>
									<th>Security Money</th>
									<th>Status</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>