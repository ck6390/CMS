<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace("_", " ", $this->misc->_getMethodName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?php site_url("{$this->misc->_getClassName()}");?>"><span class="text-capitalize"><?= str_replace("_", " ", $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<a href="<?= site_url("{$this->misc->_getClassName()}/faculty_profile/{$this->uri->segment('3')}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Lecture History</strong>
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
					<h5><span class="text-capitalize"><?= str_replace("_", " ", $this->misc->_getMethodName()); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
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
									<th>LECTURE DATE</th>
									<th>ATTANDANCE DATE</th>
									<th>PERIOD</th>
									<th>SUBJECT</th>
									<th>BRANCH - SEMESTER</th>
									<th>EMPLOYEE INFO</th>
									<th>PRESENT(%)</th>
									<th>ABSENT(%)</th>
									<th>TOTAL</th>
									<th>ACTION</th>
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
								$i = 0;
								foreach ($lists as $list) {
								$i++; ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
									<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->created_on,ENT_QUOTES,'UTF-8').'</span>' ?></td>

									<td><?= '<span class="badge badge-primary">'.htmlspecialchars($list->lacture_date,ENT_QUOTES,'UTF-8').'</span>' ?></td>

									<td><?php 
										$periodId = $this->mdl_lecture->get($list->lecture_p_id)->fk_period_id;

										echo $this->mdl_period->get($periodId)->period_name ;
									?></td>

									<td><?php $subject = $this->mdl_lecture->get($list->lecture_p_id)->fk_subject_id ;

										echo $this->mdl_subject->get($subject)->subject_name." - ".$this->mdl_subject->get($subject)->subject_code ;
									?>
									</td>
									<td>
										<?php 
										$semester = $this->mdl_lecture->get($list->lecture_p_id)->fk_semester_id;

										$branch = $this->mdl_lecture->get($list->lecture_p_id)->fk_branch_id;

										echo $this->mdl_branch->get($branch)->branch_code." - ".$this->mdl_semester->get($semester)->semester_name?>
									</td>

									<td>
										<?php 
										echo  $this->mdl_employee->get($list->employee_id)->emp_name." - ".$this->mdl_employee->get($list->employee_id)->username;

										?>
									</td>

									<td>
										<?php $all_students = json_decode($list->student_attandance); 
										$present_student = 0;
										$total_student = 0;

										foreach($all_students as $student){
											 $total_student = $total_student+1;
										}

										foreach($all_students as $student){

											if($student->attance_status =="P"){
												$present_student = $present_student+1;
											}
										}
										$present_present = ($present_student/$total_student)*100;
										echo $present_student." ( ".number_format((float)$present_present, 2, '.', '')."% ) ";

										?>
									</td>
									<td>
										<?php
										$absent = $total_student - $present_student;
										$absent_present = ($absent/$total_student)*100;
										echo $absent." ( ".number_format((float)$absent_present, 2, '.', '')."% ) ";
										?>
									</td>
									<td>
										<?php 
										echo $total_student;

										?>
									</td>
									<td> <span data-toggle="modal" onclick="student_attendance_list(<?php echo $list->lecture_p_id;?>)" class="btn btn-primary btn-xs"> <i class="fa fa-eye"></i> </span>

										<a href="<?php echo site_url("{$this->misc->_getClassName()}/edit_lecture_attandance/{$list->employee_id}/{$list->lecture_p_id}"); ?>" class="btn btn-success btn-xs">
											<i class="fa fa-pencil"></i>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th width="40px">S. NO.</th>
									<th>LECTURE DATE</th>
									<th>ATTANDANCE DATE</th>
									<th>PERIOD</th>
									<th>SUBJECT</th>
									<th>BRANCH - SEMESTER</th>
									<th>EMPLOYEE INFO</th>
									<th>PRESENT(%)</th>
									<th>ABSENT(%)</th>
									<th>TOTAL</th>
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
<div class="modal inmodal fade" id="lecture-model" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h6 class="modal-title">Lecture Details</h6>
                
            </div>
            <div class="modal-body">
            	<div id="lecture_info"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
function student_attendance_list(lectureId)
{
	var lectureId = lectureId;
	var formData = {'lectureId':lectureId};
	$.ajax({
		url: base_url + "index.php/employees/student_on_lecture/",
		type: "POST",
		data : formData,
		success:function(data)
		{	
			$("#lecture-model").modal('show');
			$('#lecture_info').html(data);
		}
	});
} 
</script>