<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url($this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getMethodName()); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'name' => 'form',
		'class' => 'form-horizontal'
	);
	echo form_open("{$this->misc->_getClassName()}/student_subject_attandance", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Student Subject Attendance Report</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12">
							
								<div class="col-sm-6">
									<div class="col-sm-12">
									<div class=" form-group <?php if(form_error('semester-id')) echo 'has-error'; ?>">
									<?php echo form_label('Semester<small class="text-danger">*</small>', 'semester-id', array('class' => ' control-label'));
										
										
										$_semester = $this->mdl_semester->dropdown('semester_name');
										echo form_dropdown(array(
											'name' => 'semester-id',
											'class' => 'form-control select2_one',
											'required' => 'true',
											'id' => 'semester'
										), $_semester);

										echo form_error('semester-id'); ?>
										
									</div>	
								</div>
							</div>

								<div class="col-sm-6">
									<div class="col-sm-12">
									<div class="form-group <?php if(form_error('branch-id')) echo 'has-error'; ?>">
									<?php echo form_label('Branch<small class="text-danger">*</small>', 'branch-id', array('class' => ' control-label'));
										
										
										$_branch = $this->mdl_branch->dropdown('branch_code');
										echo form_dropdown(array(
											'name' => 'branch-id',
											'class' => 'form-control select2_one',
											'required' => 'true',
											'id' => 'branch'
										), $_branch);

										echo form_error('branch-id'); ?>
										</div>
									</div>	
								</div>

								<div class="col-sm-6">
									<div class="col-sm-12">
									<div class="form-group <?php if(form_error('subject-id')) echo 'has-error'; ?>">
									<?php echo form_label('Subject<small class="text-danger">*</small>', 'subject-id', array('class' => ' control-label'));
										
										?>
										<select name="subject-id" class="form-control d-none select2_one select2-hidden-accessible" id="subjectId">
										
										</select>
									<!-- 	/*$_subject = $this->mdl_subject->dropdown('subject_name');
										echo form_dropdown(array(
											'name' => 'subject-id',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_subject);*/
 -->
										<?php echo form_error('subject-id'); ?>
										</div>
									</div>	
								</div>

								<div class="col-sm-6">
									<div class="col-sm-12">
									<div class="form-group <?php if(form_error('session-id')) echo 'has-error'; ?>">
									<?php echo form_label('Session<small class="text-danger">*</small>', 'session-id', array('class' => ' control-label'));
										
										
										$_session = $this->mdl_session->dropdown('session_name');
										echo form_dropdown(array(
											'name' => 'session-id',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_session);

										echo form_error('session-id'); ?>
										</div>
									</div>	
								</div>

								<div class="col-sm-6">
									<div class="col-sm-12">
									<div class="form-group <?php if(form_error('start-date')) echo 'has-error'; ?>" id="inputhMonth">
									<?php echo form_label('Start Date<small class="text-danger">*</small>', 'start-date', array('class' => 'control-label')); ?>
										<div class="input-group date ">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<?php 
												echo form_input(array(
													'type' => 'text',
													'name' => 'start-date',
													'id' => 'month_from', 
													'class' => 'form-control',
													'required' => 'true',
													'value' => set_value('start-date')

												));
											?>
										</div>
										<?php echo form_error('start-date'); ?>
									</div>
								</div>
								</div>
								<div class="col-sm-6">
									<div class="col-sm-12">
									<div class="form-group <?php if(form_error('end-date')) echo 'has-error'; ?>" id="inputhMonth">
									<?php echo form_label('End Date', 'end-date', array('class' => 'control-label')); ?>
										<div class="input-group date ">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<?php 
												echo form_input(array(
													'type' => 'text',
													'name' => 'end-date',
													'id' => 'month_to', 
													'class' => 'form-control',
													'value' => set_value('end-date')

												));
											?>
											
										</div>
									
										<?php echo form_error('end-date'); ?>
									</div>
								</div>
								</div>
								<div class="col-sm-12 text-right">
									<div style="margin-top:10px;" class="form-group <?php if(form_error('department-id')) echo 'has-error'; ?>">
										<?php 

										echo form_submit('submit', 'Go', 'class="btn btn-sm m-t  btn-primary"'); ?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>

	<?php if(!empty($lists)):
		$rows = array();

		$all = array();

		$unique = array();

		$subject = array();
		foreach ($lists as $list) {
			$subject_id = $list->fk_subject_id;
			$sub = json_decode($list->student_attandance);
			if(!empty($sub)){
				foreach($sub as $single) {
				array_push($all, $single);
				if($single->attance_status){

					array_push($unique, $single->student_id);
				}
			}
			}
			
		} 
        
        $unique = array_unique($unique);
		$subject = $subject_id;
		//print_r($subject);

	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize">Attendance Report</span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div id="printablediv" class="ibox-content">
					
					<div class="table-responsive">
						<?php $instituteInfo = $this->mdl_general_setting->get('6'); ?>
						<table class="table table-bordered m-b-none">
							<tbody>
								<tr>
									<td>
										<ul class="list-inline text-center">
										    <li>
										    	<img class="img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>"  style="float:left;border:0;padding:0;"></li>
										    <li>
										    	<h3 style="text-align:center;font-size:20px;margin-bottom:10px;padding-top:8px;"> GANGA MEMORIAL COLLEGE OF POLYTECHNIC
										    	</h3>
										    	<p>AT NH-31, HARNAUT, NALANDA, BIHAR - 803110</p>
										    </li>
										   
										</ul>
									</td>
								</tr>
							</tbody>
						</table>

						<table class="table table-striped table-bordered table-hover ">
							<tbody>
								<tr>
									<td><strong>Session</strong></td>
									<td>
										<?= $this->mdl_session->get($report['fk_session_id'])->session_name; ?>
									</td>
								</tr>
								<tr>
									<td><strong>Branch</strong></td>
									<td>
										<?= $this->mdl_branch->get($report['fk_branch_id'])->branch_name; ?>
									</td>
								</tr>
								<tr>
									<td><strong>Semester</strong></td>
									<td>
										<?= $this->mdl_semester->get($report['fk_semester_id'])->semester_name; ?>
									</td>
								</tr>
								<tr>
									<td><strong>Subject</strong></td>
									<td>
										<?= $this->mdl_subject->get($report['fk_subject_id'])->subject_name; ?>
									</td>
								</tr>
								<tr>
									<td><strong>Date Range</strong></td>
									<td>
										<?= $report['end_date'] ? $this->misc->reformatDate($report['start_date'])." - ".$this->misc->reformatDate($report['end_date']): $this->misc->reformatDate($report['start_date']); ?>
									</td>
								</tr>

								<tr>
									<td><strong>Faculty Name / Faculty Id</strong></td>
									<td>
										<?= $this->mdl_employee->get($report['employee_id'])->emp_name." [ ".$this->mdl_employee->get($report['employee_id'])->username." ] "; ?>
									</td>
								</tr>
								
								<tr>
									<td><strong>Total No. of Lectures</strong></td>
									<td>
										<?= $total_lecture = count($lists); ?>
									</td>
								</tr>
							</tbody>
						</table>

						<table id="day_statement" class="table table-striped table-bordered table-hover ">
							<thead>
								<tr>
									<th>S. No.</th>
									<th>Roll (Student ID)</th>
									<th>Student Name</th>
									<th>Total No of Class</th>
									<th>No of Attend Class</th>
									<th>Attendance Percentage</th>
									<th>Report</th>
								</tr>
							</thead>
							
							<tbody>
							<?php 
								$i=0; 
								//echo json_encode($all);
								foreach($unique as $info){
									
									$student = $info; 
									$i++; 
								?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="admin/<?= $this->misc->_getClassName(); ?>">
									<td></i><?php echo  $i; ?> </td>
									
									<td>
										<?=  $this->mdl_student->get($student)->student_roll." - ".$this->mdl_student->get($student)->student_unique_id;?>
									</td>

									<td>
										<?=  $this->mdl_student->get($student)->student_full_name;?>
									</td>

									<td>
										<?= $total_lecture = count($lists); ?>
									</td>

									<td>
										<?php 
											
											$present_attendance = 0;
											foreach($all as $key=>$value)
											{
												 if($value->student_id == $student){
												 	
												 	if($value->attance_status == "P"){

												 		 $present_attendance = $present_attendance+count($value->attance_status);
												 	}
												 	
												 }
											}
											echo $present_attendance;
											
										 ?> 
									</td>


									<td>
										 <?php  
											if($present_attendance !='0'){

												echo $attandance = round(($present_attendance/$total_lecture)*100,2)." % "; 
											}else{
												echo "0 %";
											}	
										?> 
									</td>
									<td>
										 <span data-toggle="modal" onclick="student_subject_record(<?php echo $student.",".$subject;?>)" class="btn btn-primary btn-xs"> <i class="fa fa-eye"></i> </span>
									</td>
								</tr>
								<?php } ?>
							</tbody>
							
							<tfoot>
					            <tr>
									<th>S. No.</th>
									<th>Roll (Student ID)</th>
									<th>Student Name</th>
									<th>Total No of Class</th>
									<th>No of Attend Class</th>
									<th>Attendance Percentage</th>
									<th>Report</th>
								</tr>
								<tr>
									<th colspan="6" class=" text-center"> <button onclick="printDiv('printablediv')">Print Report</button></th>
								</tr>
					        </tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
<div class="modal inmodal fade" id="subject-record-model" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h6 class="modal-title">Attandance Details</h6>
                
            </div>
            <div class="modal-body">
            	<div id="sub_record"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
function student_subject_record(studentId,subjectId)
{
	var studentId = studentId;
	var subjectId = subjectId;
	//alert(studentId);
	var formData = {'studentId':studentId,'subjectId':subjectId};
	$.ajax({
		url: base_url + "index.php/ajax/subject_Att_record/",
		type: "POST",
		data : formData,
		success:function(data)
		{	
			$("#subject-record-model").modal('show');
			$('#sub_record').html(data);
		}
	});
} 
</script>

<script type="text/javascript">
	$(document).ready(function()
    {
    	//Get District on change drop box
	    $("#branch").change(function()
	    { 
	        var branch = $(this).val().toString();	
	        var semester = $("#semester").val();  
	        //alert(otherInput);      
	        $.ajax({
			    url: "<?= site_url();?>/principal_desk/get_subject_semester_by",
			    datatype:'json',
			    data:{branch:branch,semester:semester},				
			    type:"POST",
			    success: function(data){
			    	$("#subjectId").html(data);
			        },
			        error:function(data){
			        	alert("error");
			        }          
		    });
	    });   
		
	});
</script>