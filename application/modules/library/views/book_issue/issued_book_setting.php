<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getMethodName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Library</li>
			<li>
				<a href="<?= site_url("library/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ' , $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong>Setting</strong>
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
					<h5><span class="text-capitalize">Return Date setting<!-- <?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span> List --> <small> (Please use the table below to navigate or filter the results.)</small></h5>
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
									<th>Book Title</th>
									<th>Student</th>
									<th>Student ID</th>
									<th>Issue On</th>
									<th>Return On</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="12"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($lists as $list) { ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="library/<?= str_replace('_', ' ', $this->misc->_getClassName()); ?>">
									<td>
										<strong><?= '<span class="badge badge-primary">'.htmlspecialchars($list->book_issue_p_id,ENT_QUOTES,'UTF-8').'</span><br/>' ?></strong>
									</td>
									<td><?= htmlspecialchars($list->book_name,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($list->student_full_name,ENT_QUOTES,'UTF-8') ?></td>
									<td><?= htmlspecialchars($list->student_unique_id,ENT_QUOTES,'UTF-8') ?></td>
									<td><div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<?php 
											//$date = new DateTime($list->issue_date);
												echo form_input(array(
													'type' => 'text',	
													'name' => 'issue-date',
													'id' => 'data_1'.$list->book_issue_p_id,
													'class' => 'form-control',
													'onchange'=>'updateIssueDate('.$list->book_issue_p_id.')',
													'value' => set_value('issue-date', $list->issue_date)
												));
											?>
										</div>
									</td>
									<td><div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<?php 
											//$date = new DateTime($list->return_date);
												echo form_input(array(
													'type' => 'text',	
													'name' => 'return-date',
													'id' => 'data_2'. $list->book_issue_p_id,
													'class' => 'form-control',
													'onchange'=>'updateReturnDate('.$list->book_issue_p_id.')',
													'value' => set_value('return-date', $list->return_date)
												));
											?>
										</div>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Book Title</th>
									<th>Student</th>
									<th>Student ID</th>
									<th>Issue On</th>
									<th>Return On</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function updateIssueDate(id) {
	
	var issueDate = $('#data_1'+id).val();
	var formData = {'issue-date':issueDate};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/library/book_issues/update_issue_date/" + id,
		success: function(data)
		{
			$("#alert_msg").html(data);
			$("#alert_msg").fadeIn(1000);
			 window.setTimeout(function () {
                        $("#alert_msg").fadeOut(1000);
                    }, 6000);
		},
		error: function(xhr,status,strErr)
		{
			//alert(issueDate);
		}	
	});
}

function updateReturnDate(id) {
	
	var returnDate = $('#data_2'+id).val();
	var formData = {'return-date':returnDate};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/library/book_issues/update_return_date/" + id,
		success: function(data)
		{
			$("#alert_msg").html(data);
			$("#alert_msg").fadeIn(1000);
			 window.setTimeout(function () {
                        $("#alert_msg").fadeOut(1000);
                    }, 6000);
		},
		error: function(xhr,status,strErr)
		{
			//alert(issueDate);
		}	
	});
}
</script>