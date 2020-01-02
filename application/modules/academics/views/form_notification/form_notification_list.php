<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				academics
			</li>
			<li>
				<a href="<?= site_url("academics/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
									<th>Group</th>
									<th>Type</th>
									<th>Session</th>
									<th>Semester</th>
									<th>Fee</th>
									<th>Start On</th>
									<th>Close On</th>
									<th>Fine</th>
									<th>End On</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="11"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($lists as $list) { ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="admin/<?= $this->misc->_getClassName(); ?>">
									<td>
										<strong><?php echo $this->mdl_fee_group->get_single_value_by_id('fee_group',$list->form_group,'fee_group_name', ENT_QUOTES,'UTF-8');?></strong>
									</td>
									<td><?php echo $this->mdl_fee_type->get_single_value_by_id('fee_type',$list->form_type,'fee_type_name', ENT_QUOTES,'UTF-8');?>
									</td>
									<td><?php echo $this->mdl_session->get_single_value_by_id('session',$list->session_ID,'session_name', ENT_QUOTES,'UTF-8');?>
									</td>
									<td><?php echo $this->mdl_semester->get_single_value_by_id('semester',$list->semester_ID,'semester_name', ENT_QUOTES,'UTF-8');?>
									</td>
									<td><?php echo $list->fee ?></td>
									<td><?php echo $list->start_date ?></td>
									<td><?php echo $list->close_date ?></td>
									<td><?php echo $list->fine_per_days ?></td>
									<td><?php echo $list->ends_on ?></td>
									<td><?php echo ($list->is_active) ? anchor("academics/{$this->misc->_getClassName()}/deactivate/{$list->form_notify_p_id}", '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("academics/{$this->misc->_getClassName()}/activate/{$list->form_notify_p_id}", '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td>
									<td>
										<a href="<?php echo site_url("academics/{$this->misc->_getClassName()}/edit/{$list->form_notify_p_id}"); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<!-- <button class="btn btn-xs btn-danger deleteRow" value="<?= $list->form_notify_p_id ?>">
											<i class="fa fa-trash"></i>
										</button> -->
										<?php if($this->auth->_isDeveloper()) { ?>
											<a href="<?php echo site_url("academics/{$this->misc->_getClassName()}/force_delete/{$list->form_notify_p_id}"); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Group</th>
									<th>Type</th>
									<th>Session</th>
									<th>Semester</th>
									<th>Fee</th>
									<th>Start On</th>
									<th>Close On</th>
									<th>Fine</th>
									<th>End On</th>
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