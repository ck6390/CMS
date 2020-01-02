<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong>Student List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url($this->misc->_getClassName())."/add" ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
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
									<th>Student Id</th>
									<th>Student Name</th>
									<th>Branch</th>
									<th>Session</th>
									<th>Status</th>
									<th>Admission Status</th>
									<th>Hostel Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="8"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($lists as $list) { ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="admin/<?= $this->misc->_getClassName(); ?>">
									<td>
										<strong><?= htmlspecialchars($list->student_unique_id,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									<td><?= htmlspecialchars($list->student_full_name,ENT_QUOTES,'UTF-8') ?></td>

									<td><?= htmlspecialchars($list->branch_code,ENT_QUOTES,'UTF-8') ?></td>

									<td><?= htmlspecialchars($list->session_name,ENT_QUOTES,'UTF-8') ?></td>

									<td><?php echo ($list->is_active) ? '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>' : '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>';?>
									</td>

									<td>
										<?php  if($list->admission_status == "provisional"){
											 echo '<span class="btn btn-info btn-xs"> Provisional</span>';
										}elseif($list->admission_status == "pending"){
											echo '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Pending</span>';
										}elseif($list->admission_status == "passout"){
											echo '<span class="btn btn-xs btn-danger"><i class="fa fa-ban"></i> Passout</span>';
										}elseif($list->admission_status == "junk"){
											echo '<span class="btn btn-xs btn-danger"><i class="fa fa-ban"></i> Junk</span>';
										}else{
											echo '<span class="btn btn-xs btn-primary"><i class="fa fa-check"></i> Final</span>';
										} ?>
										
									</td>

									<td><?php echo ($list->hostel_status == '0') ? '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>' :  '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i>Active</span>'; ?>
									</td>

									

									<td>
										<a href="<?php echo site_url("{$this->misc->_getClassName()}/student_profile/{$list->student_p_id}"); ?>" class="btn btn-primary btn-xs">
											<i class="fa fa-eye"></i>
										</a>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Student Id</th>
									<th>Student Name</th>
									<th>Branch</th>
									<th>Session</th>
									<th>Status</th>
									<th>Admission Status</th>
									<th>Hostel Status</th>
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

<script type="text/javascript">

function updateAdmissionStatus(id) {
	
	var status = $('#status'+id).val();
	var formData = {'status':status};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/students/update_admission_status/" + id,
		success: function(data)
		{
			$("#alert_msg").html(data);
			$("#alert_msg").fadeIn(200);
			 window.setTimeout(function () {
                        $("#alert_msg").fadeOut(500);
                    }, 6000);
		},
		error: function(xhr,status,strErr)
		{
			//alert(status);
		}	
	});
}
</script>