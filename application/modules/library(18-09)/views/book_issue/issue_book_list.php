<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Library</li>
			<li>
				<a href="<?= site_url("library/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ' , $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<!-- <div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("library/".$this->misc->_getClassName())."/add" ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div> -->
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
					<!-- PAGE CONTENT BEGINS -->
					<div id="alert_msg"></div>
					
						<script type="text/javascript">
							<?php if($this->session->flashdata('success')) { ?>
								toastr.success("<?php echo $this->session->flashdata('success'); ?>");
							<?php } else if($this->session->flashdata('error')) { ?>
								toastr.error("<?php echo $this->session->flashdata('error'); ?>");
							<?php } else if($this->session->flashdata('warning')) { ?>
								toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
							<?php } else if($this->session->flashdata('info')) { ?>
								toastr.info("<?php echo $this->session->flashdata('info'); ?>");
							<?php } ?>
						</script>
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Accesssion No.</th>
									<th>Book Title</th>
									<th>Student</th>
									<th>Student ID</th>
									<th>Issue On</th>
									<th>Return On</th>
									<th>Submit On</th>
									<th>Fine</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="12"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else { $i=0;
								foreach ($lists as $list) { $i++; ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="library/<?= str_replace('_', ' ', $this->misc->_getClassName()); ?>">
									<td>
										<strong><?= '<span class="badge badge-primary">'.htmlspecialchars($i,ENT_QUOTES,'UTF-8').'</span><br/>' ?></strong>
									</td>
									<td><?= htmlspecialchars($list->acc_no,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($list->book_name,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($list->student_full_name,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($list->student_unique_id,ENT_QUOTES,'UTF-8') ?></td>
									<td><?php echo $list->issue_date ? $this->misc->reformatDate($list->issue_date) : null; ?></td>
									<td><?php echo $list->return_date ? $this->misc->reformatDate($list->return_date) : null; ?></td>
									<td><?php echo $list->submit_date ? $this->misc->reformatDate($list->submit_date) : null; ?></td>
									<td><?= htmlspecialchars($list->library_fine,ENT_QUOTES,'UTF-8') ?></td>

									<td><?php echo ($list->is_active) ? '<span class="btn btn-info btn-xs"><i class="fa fa-ban"></i> Not Return</span>' : '<span class="btn btn-xs btn-success"><i class="fa fa-check"></i> Returned</span>'; ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Accesssion No.</th>
									<th>Book Title</th>
									<th>Student</th>
									<th>Student ID</th>
									<th>Issue On</th>
									<th>Return On</th>
									<th>Submit On</th>
									<th>Fine</th>
									<th>Status</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>