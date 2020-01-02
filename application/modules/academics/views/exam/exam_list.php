<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			
			<li>
				<a href="<?= site_url("academic/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("academic/{$this->misc->_getClassName()}/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
									<th>Full Name</th>
									<th>Username/Email</th>
									<th>User Role</th>
									<th>Last Login</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="6"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($lists as $list) { ?>
								<tr>
									<td>
										<strong><?= htmlspecialchars($list->user_full_name,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									<td><?= htmlspecialchars($list->user_email,ENT_QUOTES,'UTF-8') ?></td>
									<td>
										<span class="badge badge-info"><?= htmlspecialchars($this->mdl_role->get($list->user_role_id)->role_name,ENT_QUOTES,'UTF-8') ?></span>
									</td>
									<td><?= htmlspecialchars($list->last_login,ENT_QUOTES,'UTF-8') ?></td>
									<td><?php echo ($list->is_active) ? anchor("academic/{$this->misc->_getClassName()}/deactivate/{$list->exam_p_id}", '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("academic/{$this->misc->_getClassName()}/activate/{$list->exam_p_id}", '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td>
									<td>
										<a href="<?php echo site_url("academic/{$this->misc->_getClassName()}/edit/{$list->exam_p_id}"); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<button class="btn btn-xs btn-danger deleteRow" value="<?= $list->exam_p_id ?>">
											<i class="fa fa-trash"></i>
										</button>
										<?php if($this->auth->_isDeveloper()) { ?>
											<a href="<?php echo site_url("academic/{$this->misc->_getClassName()}/force_delete/{$list->exam_p_id}"); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Full Name</th>
									<th>Username/Email</th>
									<th>User Role</th>
									<th>Last Login</th>
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