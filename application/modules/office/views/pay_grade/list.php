<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Office</li>
			<li>
				<a href="<?= site_url('office/'.$this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url('office/'.$this->misc->_getClassName().'/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Grade Name</th>
									<th>Grade Salary</th>
									<th>Description</th>
									<th>Status</th>
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
									<input type="hidden" name="cntrlName" id="cntrlName" value="office/<?= $this->misc->_getClassName(); ?>">
									<td>
										<strong><?= htmlspecialchars($list->grade_name,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									<td>
										<span class="badge badge-success">MINIMUM SALARY: <strong><?= htmlspecialchars($list->min_salary,ENT_QUOTES,'UTF-8') ?></strong></span>
										<br/>
										<span class="badge badge-success">MAXIMUM SALARY: <strong><?= htmlspecialchars($list->max_salary,ENT_QUOTES,'UTF-8') ?></strong></span>
									</td>
									<td><?= htmlspecialchars($list->description,ENT_QUOTES,'UTF-8') ?></td>
									<td><?php echo ($list->is_active) ? anchor("office/".$this->misc->_getClassName()."/deactivate/".$list->grade_p_id, '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("office/".$this->misc->_getClassName()."/activate/". $list->grade_p_id, '<span class="btn btn-warning btn-xs"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td>
									<td>
										<a href="<?php echo site_url("office/".$this->misc->_getClassName()."/edit/".$list->grade_p_id); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<button class="btn btn-danger btn-xs deleteRow" value="<?= $list->grade_p_id ?>">
											<i class="fa fa-trash"></i>
										</button>
										<?php if($this->auth->_isDeveloper()) { ?>
											<a href="<?php echo site_url("office/".$this->misc->_getClassName()."/force_delete/".$list->grade_p_id); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Grade Name</th>
									<th>Grade Salary</th>
									<th>Description</th>
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