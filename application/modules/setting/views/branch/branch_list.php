<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-5">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("setting/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-7">
		<div class="title-action">
			<a href="<?= site_url("setting/{$this->misc->_getClassName()}/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
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
									<th>Serial No.</th>
									<th>Branch Name</th>
									<th>Branch Code</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="4"><strong>NO RECORDS AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($lists as $list) { ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="setting/<?= $this->misc->_getClassName(); ?>">
									<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->branch_p_id,ENT_QUOTES,'UTF-8').'</span><br/>' ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->branch_name,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<strong> '.htmlspecialchars($list->branch_code,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?php echo ($list->is_active) ? anchor("setting/{$this->misc->_getClassName()}/deactivate/{$list->branch_p_id}", '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("setting/{$this->misc->_getClassName()}/activate/{$list->branch_p_id}", '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td>
									
									<td>
										<a href="<?php echo site_url("setting/".$this->misc->_getClassName()."/edit/".$list->branch_p_id); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<!-- <button class="btn btn-xs btn-danger deleteRow" value="<?= $list->branch_p_id ?>">
											<i class="fa fa-trash"></i>
										</button> -->
										<?php if($this->auth->_isDeveloper()) { ?>
											<button class="btn btn-danger btn-xs deleteRow" value="<?= $list->branch_p_id ?>">
												<i class="fa fa-trash"></i>
											</button> 
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Branch Name</th>
									<th>Branch Code</th>
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