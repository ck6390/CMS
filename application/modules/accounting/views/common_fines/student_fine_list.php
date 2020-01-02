<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Accounting</a>
			</li>
			<li>
				<a href="<?= site_url("accounting/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong>Student List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("accounting/".$this->misc->_getClassName())."/add" ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span> Student List <small>(Please use the table below to navigate or filter the results.)</small></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<!-- PAGE CONTENT BEGINS -->
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Student Id</th>
									<th>Student Name</th>
									<th>Branch</th>
									<th>Session</th>
									<th>Fine Type</th>
									<th>Fine Amount</th>
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
								$i = 0;
								foreach ($lists as $list) { $i++; ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="accounting/<?= $this->misc->_getClassName(); ?>">
									<td><?php echo $i ;?></td>
									<td>
										<strong><?= htmlspecialchars($this->mdl_student->get($list->student_id)->student_unique_id,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									<td><?= htmlspecialchars($this->mdl_student->get($list->student_id)->student_full_name,ENT_QUOTES,'UTF-8') ?></td>

									<td><?= htmlspecialchars($this->mdl_branch->get($list->fk_branch_id)->branch_code,ENT_QUOTES,'UTF-8') ?></td> 

									<td><?= htmlspecialchars($this->mdl_session->get($list->fk_session_id)->session_name,ENT_QUOTES,'UTF-8') ?></td>

									<td><?= htmlspecialchars($this->mdl_fee_type->get($list->fk_fee_type_id)->fee_type_name,ENT_QUOTES,'UTF-8') ?></td>

									<td><?= htmlspecialchars($list->fee_amount,ENT_QUOTES,'UTF-8') ?></td>
									<td>
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
									<th>Student Name</th>
									<th>Branch</th>
									<th>Session</th>
									<th>Fine Type</th>
									<th>Fine Amount</th>
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
