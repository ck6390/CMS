<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Setting</a>
			</li>
			<li>
				<a href="<?= site_url("setting/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
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
									<th>LOGO</th>
									<th>INSTITUTE INFO</th>
									<th width="18%">ADDRESS</th>
									<th>GRACE PERIOD TIME (Min.)</th>
									<th>STATUS</th>
									<th>ACTION</th>
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
								$i = 0;
								foreach ($lists as $list) {
								$i++; ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
									<td>
										<img src="<?= base_url("assets/img/institute/{$list->inst_logo}") ?>" style="width:100px;">
									</td>
									<td>
										<?= '<span class="badge badge-primary">'.htmlspecialchars($list->inst_id,ENT_QUOTES,'UTF-8').'</span>
										<br/>
										<span class="badge badge-info">'.htmlspecialchars($list->inst_affiliation_no,ENT_QUOTES,'UTF-8').'</span>
										<br/>
										<strong>'.htmlspecialchars($list->inst_name,ENT_QUOTES,'UTF-8').'</strong>
										<br/>
										<strong>'.htmlspecialchars($list->inst_phone,ENT_QUOTES,'UTF-8').', '.htmlspecialchars($list->inst_email,ENT_QUOTES,'UTF-8').'</strong>'; ?>
									</td>
									<td>
										<?= '<strong>'.htmlspecialchars($list->inst_address,ENT_QUOTES,'UTF-8').'<br/>'.htmlspecialchars($list->inst_city,ENT_QUOTES,'UTF-8').'-'.htmlspecialchars($list->inst_pincode,ENT_QUOTES,'UTF-8').', '.htmlspecialchars($list->inst_state,ENT_QUOTES,'UTF-8').', '.htmlspecialchars($list->inst_country,ENT_QUOTES,'UTF-8').'</strong>'; ?>
									</td>
									<td><?= $list->grace_time ?></td>									
									<td><?php echo ($list->is_active) ? anchor("setting/".$this->misc->_getClassName()."/deactivate/".$list->inst_p_id, '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("setting/".$this->misc->_getClassName()."/activate/". $list->inst_p_id, '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?></td>
									<td>
										<a href="<?php echo site_url("setting/".$this->misc->_getClassName()."/edit/".$list->inst_p_id); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th width="40px">S. NO.</th>
									<th>LOGO</th>
									<th>INSTITUTE INFO</th>
									<th width="18%">ADDRESS</th>
									<th>GRACE PERIOD TIME(Min.)</th>
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