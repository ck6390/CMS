<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getMethodName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<span><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span>
			</li>
			<li>
				<a href="<?= site_url("academics/{$this->misc->_getMethodName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getMethodName()); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
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
					
						<script>
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
									<th>Registration No.</th>
									<th>Branch</th>
									<th>Session</th>
									<th>Year</th>
									<th>Semester</th>
									<th>Admission Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="9"><strong>NO RECORD AVAILABLE</strong></td>
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

									<td><?= htmlspecialchars($list->registration_no,ENT_QUOTES,'UTF-8') ?></td>

									<td><?= htmlspecialchars($list->branch_code,ENT_QUOTES,'UTF-8') ?></td>

									<td><?= htmlspecialchars($list->session_name,ENT_QUOTES,'UTF-8') ?></td>

									<td><?php $year = $this->mdl_course_year->dropdown('course_year_name');
									 	echo form_dropdown(array(
											'id'=> 	'academic_year'.$list->student_p_id,
											'name' => 'year',
											'class' => 'form-control select2_one',
											'onchange'=>'updateYear('.$list->student_p_id.')',
										),$year, $list->fk_course_year_id);?>
											
									</td>
									<td><?php $_semester = $this->mdl_semester->dropdown('semester_name');
									 	echo form_dropdown(array(
											'id'=> 	'semester'.$list->student_p_id,
											'name' => 'semester',
											'class' => 'form-control select2_one',
											'onchange'=>'updateSemester('.$list->student_p_id.')',
										),$_semester, $list->fk_semester_id);?>
											
									</td>

									<td><?php 
										$_admission = array(
											'provisional' => 'provisional',
											'pending' => 'pending',
											'passout' => 'passout',
											'junk' => 'junk',
											'final' => 'final',

										);
										echo form_dropdown(array(
											'id'=> 'status'.$list->student_p_id,
											'name' => 'admission-status',
											'class' => 'form-control select2_one',
											'onchange'=>'updateAdmissionStatus('.$list->student_p_id.')',
										), $_admission, $list->admission_status);?>
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
									<th>Registration No.</th>
									<th>Branch</th>
									<th>Session</th>
									<th>Year</th>
									<th>Semester</th>
									<th>Admission Status</th>
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

<script>


function updateSemester(id) {

	var semester = $('#semester'+id).val();
	var formData = {'semester':semester};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/academics/update_semester/" + id,
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
			alert(semester);
		}	
	});
}


function updateYear(id) {

	var year = $('#academic_year'+id).val();
	var formData = {'year':year};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/academics/update_year/" + id,
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
			alert(year);
		}	
	});
}
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