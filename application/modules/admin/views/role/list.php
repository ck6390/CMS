<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Admin</li>
			<li>
				<a href="<?= site_url("admin/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("admin/{$this->misc->_getClassName()}/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
									<th width="40px">S. NO.</th>
									<th>ROLE NAME</th>
									<th>DESCRIPTION</th>
									<th>STATUS</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="5"><strong>NO RECORDS AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								$i = 0;
								foreach ($lists as $list) {
								$i++; ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="admin/<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
									<td>
										<strong><?= htmlspecialchars($list->role_name,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									<td><?= htmlspecialchars($list->description,ENT_QUOTES,'UTF-8') ?></td>
									<td><?php echo ($list->is_active) ? anchor("admin/{$this->misc->_getClassName()}/deactivate/{$list->role_p_id}", '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("admin/{$this->misc->_getClassName()}/activate/{$list->role_p_id}", '<span class="btn btn-xs btn-danger"><i class="fa fa-ban"></i> Inactive</span>'); ?></td>
									<td>
										<a href="<?php echo site_url("admin/{$this->misc->_getClassName()}/edit/{$list->role_p_id}") ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<?php if($this->auth->_isDeveloper()) { ?>
											<button class="btn btn-xs btn-danger deleteRow" value="<?= $list->role_p_id ?>">
												<i class="fa fa-trash"></i>
											</button>
											<a href="<?php echo site_url("admin/{$this->misc->_getClassName()}/force_delete/{$list->role_p_id}"); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th width="40px">S. NO.</th>
									<th>ROLE NAME</th>
									<th>DESCRIPTION</th>
									<th>STATUS</th>
									<th>ACTION</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>