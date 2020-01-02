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
									<th>Student Id</th>
									<th>Session</th>
									<th>Year</th>
									<th>Branch</th>
									<th>Fee Type</th>
									<th>Due Amount</th>
									<th>Payment status</th>
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
								foreach ($lists as $list) { $i++; ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="accounting/<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
									<td><?= '<strong> '.htmlspecialchars($list->student_unique_id,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->session_name,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->course_year_name,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->branch_code,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->fee_type_name,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->fee_amount-$list->due_amount,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->paid_status,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>									
									<td>
										<a href="<?php echo site_url("accounting/".$this->misc->_getClassName()."/view/".$list->invoice_p_id); ?>" class="btn btn-primary btn-xs">
											<i class="fa fa-eye"></i>
										</a>
										<a href="<?php echo site_url("accounting/".$this->misc->_getClassName()."/edit/".$list->invoice_p_id); ?>" class="btn btn-primary btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<button class="btn btn-xs btn-danger deleteRow" value="<?= $list->invoice_p_id ?>">
											<i class="fa fa-trash"></i>
										</button>
										
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Student Id</th>
									<th>Session</th>
									<th>Year</th>
									<th>Branch</th>
									<th>Fee Type</th>
									<th>Amount</th>
									<th>Payment status</th>
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