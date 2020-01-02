<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-5">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("accounting/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-7">
		<div class="title-action">
			<a href="<?= site_url("accounting/".$this->misc->_getClassName().'/college_fee') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
									<th>Name</th>
									<th>Phone</th>
									<th>Comin From</th>
									<th>To Meet</th>
									<th>Reason</th>
									<th>Description</th>
									<th>Check In</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="10"><strong>NO RECORDS AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								$i = 0;
								foreach ($lists as $list) { $i++; 
									
									?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
									<td><?= '<strong> '.htmlspecialchars($list->name,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->phone,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->comming_from,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->to_meet,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->reason,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->discription,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->created_on,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									
									<td>
										<button class="btn btn-xs btn-danger deleteRow" value="<?= $list->visitor_p_id ?>">
											<i class="fa fa-trash"></i>
										</button>
										<?php if($this->auth->_isDeveloper()) { ?>
											<a href="<?php echo site_url("{$this->misc->_getClassName()}/force_delete/{$list->visitor_p_id}"); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Name</th>
									<th>Phone</th>
									<th>Comin From</th>
									<th>To Meet</th>
									<th>Reason</th>
									<th>Description</th>
									<th>Check In</th>
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