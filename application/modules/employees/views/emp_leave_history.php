<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace("_", " ", $this->misc->_getMethodName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<a href="<?= site_url("{$this->misc->_getClassName()}/profile/{$this->uri->segment('3')}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Leave History</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= str_replace("_", " ", $this->misc->_getMethodName()); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
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
									<th width="40px">S. NO.</th>
									<th>LEAVE FROM</th>
									<th>LEAVE TO</th>
									<th>LEAVE TYPE</th>
									<th>DESCRIPTION</th>
									<th>ADMIN REMARK</th>
									<th>STATUS</th>	
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="9"><strong>NO RECORDS AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								$i = 0;
								foreach ($lists as $list) {
								$i++; ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
									<td>
										<?= '<span class="badge badge-primary">'.htmlspecialchars($this->misc->reformatDate($list->leave_from),ENT_QUOTES,'UTF-8').'</span>' ?>
									</td>
									<td>
										<?= '<span class="badge badge-primary">'.htmlspecialchars($this->misc->reformatDate($list->leave_to),ENT_QUOTES,'UTF-8').'</span>' ?>
									</td>

									<td>
										<?= htmlspecialchars($this->mdl_leave_type->get($list->fk_leave_type_id)->leave_name,ENT_QUOTES,'UTF-8'); ?>
									</td>
									<td>
										<?= htmlspecialchars($list->description,ENT_QUOTES,'UTF-8'); ?>
									</td>
									<td>
										<?= htmlspecialchars($list->admin_remark,ENT_QUOTES,'UTF-8'); ?>
									</td>
									<td>
			                       		<?php if($list->is_active == '1'){
			                       			echo '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Approved </span>';
			                       		}else{
			                       			echo '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Not Approved</span>';
			                       		} ?>
			                       	</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th width="40px">S. NO.</th>
									<th>LEAVE FROM</th>
									<th>LEAVE TO</th>
									<th>LEAVE TYPE</th>
									<th>DESCRIPTION</th>
									<th>ADMIN REMARK</th>
									<th>STATUS</th>	
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
