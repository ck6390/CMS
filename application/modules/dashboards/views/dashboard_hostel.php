<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li class="active">
				<strong>Dashboard</strong>
			</li>
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php
		$attr = array(
			'role' => 'form',
			'method' => 'post',
			'name' => 'add-form',
			'class' => 'form-horizontal'
		);
		echo form_open("{$this->misc->_getClassName()}/hostel_search", $attr); ?>
    <div class="row animated fadeInRight">
        <div class="col-md-6 col-md-offset-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Enter Student ID</h5>
                </div>
                <div class="ibox-content">
                   		
	       	        <div class="input-group">
	                    <input type="text" name="search" placeholder="Enter Student id " class="input form-control">
	       	            <span class="input-group-btn">
	                        <button type="submit" name="submit" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
	                    </span>
	                </div>
                </div>
            </div>
        </div>
    </div>
	<?php echo form_close(); ?>

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
							<th>Alloted Bed</th>
							<th>Available Bed</th>
							<th>Rent/Month</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(count($lists) == 0) { ?>
							<tr class="text-center text-uppercase">
								<td colspan="9"><strong>NO RECORD AVAILABLE</strong></td>
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
									<td><?= htmlspecialchars($list->total_bed,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($list->booked_bed,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($list->total_bed - $list->booked_bed)?></td>
									<td><?= htmlspecialchars($list->room_rent) ?></td>
								</tr>
							<?php }
						} ?>
					</tbody>
					<tfoot>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th>Total</th>
							<th><?= htmlspecialchars($info->total_bed,ENT_QUOTES,'UTF-8') ?></th>
							<th><?= htmlspecialchars($info->booked_bed,ENT_QUOTES,'UTF-8') ?></th>
							<th><?= htmlspecialchars($info->total_bed - $info->booked_bed,ENT_QUOTES,'UTF-8') ?></th>
							<th><?= htmlspecialchars($info->room_rent,ENT_QUOTES,'UTF-8') ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>