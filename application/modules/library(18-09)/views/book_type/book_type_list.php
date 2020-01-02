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
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("library/".$this->misc->_getClassName())."/add" ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
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
									<th>Book Type</th>
									<th>Description</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="4"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($lists as $list) { ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="library/<?= str_replace('_', ' ', $this->misc->_getClassName()); ?>">
									<!-- <td>
										<strong><?= '<span class="badge badge-primary">'.htmlspecialchars($list->book_category_p_id,ENT_QUOTES,'UTF-8').'</span><br/>' ?></strong>
									</td> -->
									<td><?= htmlspecialchars($list->book_type,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($list->type_description,ENT_QUOTES,'UTF-8') ?></td>

									<td><?php echo ($list->is_active) ? anchor("library/{$this->misc->_getClassName()}/deactivate/{$list->book_type_p_id}", '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("library/{$this->misc->_getClassName()}/activate/{$list->book_type_p_id}", '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td>
									
									<td>
										<a href="<?php echo site_url("library/{$this->misc->_getClassName()}/edit/{$list->book_type_p_id}"); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<button class="btn btn-xs btn-danger deleteRow" value="<?= $list->book_type_p_id ?>">
											<i class="fa fa-trash"></i>
										</button>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Book Type</th>
									<th>Description</th>
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