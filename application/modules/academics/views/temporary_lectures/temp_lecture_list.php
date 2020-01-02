<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-5">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Academic</a>
			</li>
			<li>
				<a href="<?= site_url("academics/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-7">
		<div class="title-action">
			<a href="<?= site_url("academics/{$this->misc->_getClassName()}/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
									<th>Faculty Info</th>
									<th>Engaged Of</th>
									<th>Lecture Type</th>
									<th>Subject</th>
									<th>Period Time</th>
									<th>Semester</th>
									<th>Branch</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Status</th>
									<th>Action</th>
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
								foreach ($lists as $list) { $i++; ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="academics/<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
									<td><?= '<span class="badge badge-primary">'.htmlspecialchars($this->mdl_employee->get($list->employee_id)->emp_name." - ".$this->mdl_employee->get($list->employee_id)->username,ENT_QUOTES,'UTF-8').'</span><br/>' ?></td>

									<td><?= '<span class="badge badge-primary">'.htmlspecialchars($this->mdl_employee->get($list->engaged_of_faculty)->emp_name." - ".$this->mdl_employee->get($list->engaged_of_faculty)->username,ENT_QUOTES,'UTF-8').'</span><br/>' ?></td>
									
									<td><?= '<strong> '.htmlspecialchars($list->lecture_category,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<strong> '.htmlspecialchars($this->mdl_subject->get($list->fk_subject_id)->subject_name,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($this->mdl_period->get($list->fk_period_id)->period_name." [ ".$this->mdl_period->get($list->fk_period_id)->start_time." - ".$this->mdl_period->get($list->fk_period_id)->end_time." ]",ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<strong> '.htmlspecialchars($this->mdl_semester->get($list->fk_semester_id)->semester_name,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($this->mdl_branch->get($list->fk_branch_id)->branch_name,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($this->misc->reformatDate($list->start_date),ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($this->misc->reformatDate($list->end_date),ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?php echo ($list->is_active) ? anchor("academics/{$this->misc->_getClassName()}/deactivate/{$list->lecture_p_id}", '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("academics/{$this->misc->_getClassName()}/activate/{$list->lecture_p_id}", '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td>
									
									<td>
										<a href="<?php echo site_url("academics/{$this->misc->_getClassName()}/edit/".$list->lecture_p_id); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Faculty Info</th>
									<th>Engaged Of</th>
									<th>Lecture Type</th>
									<th>Subject</th>
									<th>Period Time</th>
									<th>Semester</th>
									<th>Branch</th>
									<th>Start Date</th>
									<th>End Date</th>
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