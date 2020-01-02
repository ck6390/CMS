<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				academics
			</li>
			<li>
				<a href="<?= site_url("academics/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("academics/{$this->misc->_getClassName()}/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
									<th>Subject Code</th>
									<th>Subject</th>
									<th>Branch</th>
									<th>Semester</th>
									<th>PM(Internal)</th>
									<th>FM(Internal)</th>
									<th>PM(External)</th>
									<th>FM(External)</th>
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
									<td>
										<strong><?= '<span class="badge badge-primary">'.htmlspecialchars($list->subject_code,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									<td><?= htmlspecialchars($list->subject_name,ENT_QUOTES,'UTF-8') ?></td>
									<td>
										<?php echo $this->mdl_branch->get($list->fk_branch_id)->branch_code;?></span>
									</td>
									<td>
										<?php echo $this->mdl_semester->get($list->fk_semester_id)->semester_name;?></span>
										
									</td>
									<td><?= htmlspecialchars($list->pass_marks_internal,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($list->full_marks_internal,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($list->pass_marks_external,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($list->full_marks_external,ENT_QUOTES,'UTF-8') ?></td>
									<td><?php echo ($list->is_active) ? anchor("academics/{$this->misc->_getClassName()}/deactivate/{$list->subject_p_id}", '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("academics/{$this->misc->_getClassName()}/activate/{$list->subject_p_id}", '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td>
									<td>
										<a href="<?php echo site_url("academics/{$this->misc->_getClassName()}/edit/{$list->subject_p_id}"); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<?php if($this->auth->_isDeveloper()) { ?>
											<a href="<?php echo site_url("academics/{$this->misc->_getClassName()}/force_delete/{$list->subject_p_id}"); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Subject Code</th>
									<th>Subject</th>
									<th>Branch</th>
									<th>Semester</th>
									<th>PM(Internal)</th>
									<th>FM(Internal)</th>
									<th>PM(External)</th>
									<th>FM(External)</th>
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