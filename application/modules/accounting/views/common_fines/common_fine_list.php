<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-5">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Accounting</a>
			</li>
			<li>
				<a href="<?= site_url("accounting/".$this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-7">
		<div class="title-action">
			<a href="<?= site_url("accounting/".$this->misc->_getClassName().'/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
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
									<th>Fee Type</th>
									<th>Amount</th>
									<th>Due Date</th>
									<th>Fee Alltocated</th>
									<th>Session</th>
									<th>Branch</th>
									<th>Gender</th>
									<!-- <th>Status</th> -->
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
								$i=0;
								foreach ($lists as $list) { $i++;?>
								<tr>
									
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
									
									<td><?php echo $this->mdl_fee_type->get_single_value_by_id('fee_type',$list->fee_type_id,'fee_type_name');?></td>
									
									<td><?= '<strong> '.htmlspecialchars($list->fee_type_amount ,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<strong> '.htmlspecialchars($list->due_date ,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<strong> '.htmlspecialchars($list->fee_allocated ,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?php echo $this->mdl_session->get_single_value_by_id('session',$list->session,'session_name');?></td>

									<td></td>

									<td><?= '<strong> '.htmlspecialchars($list->gender ,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<!-- <td><?php echo ($list->is_active) ? anchor("{$this->misc->_getClassName()}/deactivate/{$list->fee_allocate_p_id}", '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("{$this->misc->_getClassName()}/activate/{$list->fee_allocate_p_id}", '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td> -->	
									
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Fee Type</th>
									<th>Amount</th>
									<th>Due Date</th>
									<th>Fee Alltocated</th>
									<th>Session</th>
									<th>Branch</th>
									<th>Gender</th>
									<!-- <th>Status</th> -->
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>