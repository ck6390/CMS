<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace("_"," ",$this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url($this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= str_replace("_"," ",$this->misc->_getClassName()); ?></span></a>
			</li>
			<li>
				<a href="<?= site_url($this->misc->_getClassName()."/".$this->misc->_getMethodName()); ?>"><span class="text-capitalize"><?= $this->misc->_getMethodName(); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
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
					<h5><span class="text-capitalize"><?= $this->misc->_getMethodName(); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
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
									<th>ATTENDENCE ID</th>
									<th>EMPLOYEE INFO</th>
									<th>USERNAME</th>
									<th>PASSWORD</th>
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
									<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>

									<td><?= '<span class="badge badge-primary">'.htmlspecialchars("3".$list->employee_id,ENT_QUOTES,'UTF-8').'</span>' ?></td>

									<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->employee_id,ENT_QUOTES,'UTF-8').'</span><br/><strong>'.htmlspecialchars($list->emp_name,ENT_QUOTES,'UTF-8').'</strong>' ?></td>

									<td><?= '<strong><i class="fa fa-phone fa-fw text-muted"></i> : '.htmlspecialchars($list->emp_phone,ENT_QUOTES,'UTF-8').'<br/><i class="fa fa-envelope fa-fw text-muted"></i> : '.htmlspecialchars($list->emp_email,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<span class="">'.htmlspecialchars($list->view_pass,ENT_QUOTES,'UTF-8').'</span>' ?></td>


									<td><?php echo ($list->is_active) ? anchor("{$this->misc->_getClassName()}/deactivate/" . $list->emp_p_id, '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("{$this->misc->_getClassName()}/activate/" . $list->emp_p_id, '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td>
									<td>
										<a href="<?php echo site_url("{$this->misc->_getClassName()}/emp_edit/{$list->emp_p_id}"); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>

										<a href="<?php echo site_url("{$this->misc->_getClassName()}/employee_delete/{$list->emp_p_id}"); ?>" class="btn btn-danger btn-xs">
											DEl
										</a>

										<?php if($this->auth->_isDeveloper()) { ?>
											<a href="<?php echo site_url("{$this->misc->_getClassName()}/force_delete/{$list->emp_p_id}"); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th width="40px">S. NO.</th>
									<th>ATTENDENCE ID</th>
									<th>EMPLOYEE INFO</th>
									<th>USERNAME</th>
									<th>PASSWORD</th>
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
