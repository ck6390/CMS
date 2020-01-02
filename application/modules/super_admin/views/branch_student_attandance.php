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
	echo form_open("{$this->misc->_getClassName()}/student_branch_attandance", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Student Branch Attendance Report</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12">
							
								<div class="col-sm-3">
									<div class="col-sm-12">
									<div class=" form-group <?php if(form_error('semester-id')) echo 'has-error'; ?>">
									<?php echo form_label('Semester<small class="text-danger">*</small>', 'semester-id', array('class' => ' control-label'));
										
										
										$_semester = $this->mdl_semester->dropdown('semester_name');
										echo form_dropdown(array(
											'name' => 'semester-id',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_semester);

										echo form_error('semester-id'); ?>
										
									</div>	
								</div>
							</div>

								<div class="col-sm-3">
									<div class="col-sm-12">
									<div class="form-group <?php if(form_error('branch-id')) echo 'has-error'; ?>">
									<?php echo form_label('Branch<small class="text-danger">*</small>', 'branch-id', array('class' => ' control-label'));
										
										
										$_branch = $this->mdl_branch->dropdown('branch_code');
										echo form_dropdown(array(
											'name' => 'branch-id',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_branch);

										echo form_error('branch-id'); ?>
										</div>
									</div>	
								</div>

								<div class="col-sm-3">
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
								<div class="col-sm-3">
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

	<?php 
	//var_dump($report);
	if(!empty($lists)):
		$rows = array();

		$all = array();

		$unique = array();
		$student_id_get = "";
		foreach ($lists as $list) {
			//var_dump($list);
			$sub = json_decode($list->student_attandance);
			$student_id_get = json_decode($list->student_attandance);
			if(!empty($sub)){
				foreach ($sub as $single) {
					
					array_push($all, $single);
					if($single->attance_status){

						array_push($unique, $single->student_id);
					}
				}
			}
		} 
        
        $unique = array_unique($unique);	
		

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
									<td><strong>Date Range</strong></td>
									<td>
										<?php  if(!empty($report['end_date'])) {
											echo $this->misc->reformatDate($report['start_date'])." - ".$this->misc->reformatDate($report['end_date']);	
										}else{

											echo $this->misc->reformatDate($report['start_date']);
										} ?>
									</td>
								</tr>
								<tr>
									<td><strong>No. of Days</strong></td>
									<td>
										<?php 
											$startDt = strtotime($report['start_date']);
											$endDt = strtotime($report['end_date']);
											//echo $datediff =  $endDt - $startDt."<br/>";
											//echo $datediff / 86400;
											$timeDiff = abs($endDt - $startDt);
											
											//var_dump($timeDiff);

											$numberDays = $timeDiff/86400;  // 86400 seconds in one day

											// and you might want to convert to integer
											if(!empty($report['end_date'])){
												
												echo $numberDays = intval($numberDays)." Days";	
											}else{

												echo "1 Days";
											}
											
											
										?>
									</td>
								</tr>
								<tr>
									<td><strong>No. of Working Days</strong></td>
									<td>
										<?php 
										$get_holiday = get_holidays(date('Y-m-d',strtotime($report['start_date'])),date('Y-m-d',strtotime($report['end_date'])));
										
										$get_all_sun = getSundays(date('Y-m-d',strtotime($report['start_date'])),date('Y-m-d',strtotime($report['end_date'])));
										$get_h_sun = 0;	
										$sum = 0;									
										foreach ($get_holiday as $key=> $obj) {
										    $sum += $obj->days;
											$get_holiday_sun = getSundays($obj->start_date ,$obj->end_date);
											//echo count($get_holiday_sun)."<br/>";
											$get_h_sun = count($get_holiday_sun)+$get_h_sun;
											
												
										
										//echo $numberDays - count($get_all_sun) - $total_holiday; 
										}
										$total_holiday = $sum-$get_h_sun;
										echo $numberDays - $total_holiday - count($get_all_sun);
										//echo count($sun_get);
										//echo sizeof($workingDays); ?>
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
									<th>No of Classes Attendance</th>
									<th>Percentage Of Attendance </th>
								</tr>
							</thead>
							
							<tbody>
							<?php 
								$i=0; 
								//echo json_encode($all);
								//var_dump($unique);
								foreach($unique as $info){
									
									$student = $info; 
									$i++; 							
										
								?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="admin/<?= $this->misc->_getClassName(); ?>">
									<?php if(getStudents($student) != null){?>
									<td></i><?= $i ?> </td>
									<?php } if(getStudents($student) != null){?>
									<td>
										<?=  getStudents($student)->student_roll." - ".getStudents($student)->student_unique_id;?>
									</td>
									<?php } if(getStudents($student) != null){?>
									<td>
										<?=  getStudents($student)->student_full_name;?>
									</td>
									<?php } if(getStudents($student) != null){?>
									<td><?= $total_lecture = count($lists); ?>
										<?php
											/*$count_student_lect = get_student_lect($student,date('Y-m-d',strtotime($report['start_date'])),date('Y-m-d',strtotime($report['end_date'])));*/
											//var_dump($count_student_lect1);
											/*foreach ($count_student_lect as $val) {
												echo $val->total_count;
											}*/
											
											
											//var_dump(in_array($student, $student_id_get));
											//foreach ($student_id_get as $value) {
												//echo $value->student_id."<br/>";

												/*if($value->student_id == $student){
												 echo $value->student_id;
												}*/
											//}
										// $total_lecture = count($student);
										 ?>
									</td>
									<?php } if(getStudents($student) != null){?>
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
									<?php } if(getStudents($student) != null){?>

									<td>
										 <?php  
											if($present_attendance !='0'){

												echo $attandance = round(($present_attendance/$total_lecture)*100,2)." % "; 
											}else{
												echo "0 %";
											}	
										?> 
									</td>
									<?php } ?>
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

