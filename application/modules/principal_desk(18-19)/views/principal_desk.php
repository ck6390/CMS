<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace("_" , " " ,$this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url($this->misc->_getClassName()); ?>"><span class="text-capitalize"><?= str_replace("_" , " " ,$this->misc->_getClassName()); ?></span></a>
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
	echo form_open("{$this->misc->_getClassName()}", $attr); ?>
	<div class="ibox float-e-margins">
		<div class="ibox-content">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="col-sm-8">
						<div class=" <?php if(form_error('month-from')) echo 'has-error'; ?>" id="inputhMonth">
						<?php echo form_label('Select Date<small class="text-danger">*</small>', 'month-from', array('class' => 'control-label col-sm-4')); ?>
							<div class="input-group col-sm-8">
								<?php 
									echo form_input(array(
										'type' => 'date',
										'name' => 'month-from',
										'id' => 'month_from', 
										'class' => 'form-control',
										'required' => 'true',
										'value' => set_value('month-from')
									));
								?>
							</div>
							<?php echo form_error('month-from'); ?>
						</div>
					</div>
					<div class="col-sm-4 ">
						<div class=" <?php if(form_error('department-id')) echo 'has-error'; ?>">
							<?php 

							echo form_submit('submit', 'Go', 'class="btn btn-sm m-t  btn-primary"'); ?>
							
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
	<?php echo form_close(); ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"></span> Employee Attandance List </h5>
					 
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table id="day_statement" class="table table-striped table-bordered table-hover ">
							<thead>
								<tr>
									<th>S. No.</th>
									<th>Date</th>
									<th>Employee Info</th>
									<th>Log In Time</th>
									<th>Log Out Time</th>
								</tr>
							</thead>
							<?php if(!empty($month_attadance)){ ?>
							<tbody>
							<?php $i=0; foreach ($month_attadance as $day_attadance) : 
								$i++;
								$attendaence_data = json_decode($day_attadance->attendance_data,true);

								$employeeId = $this->mdl_emp_attendance->employee_info($day_attadance->employee_id);
								//print_r($employeeId);
								foreach($attendaence_data as $today_attandance){
									//print_r($employeeId->emp_p_id);
									$holidays = $this->mdl_emp_attendance->get_holiday($today_attandance['attendance_date']);
									if(!empty($holidays)){
										$office_leave = $this->mdl_emp_attendance->get_office_leave($today_attandance['attendance_date'],$employeeId->emp_p_id);
									}
									
									
									if(!empty($given_date)){
										$current_date = $given_date;
									}else{
										$current_date = date('Y-m-d');
									}

									if($today_attandance['attendance_date'] == $current_date){
										
									if($this->misc->isWeekend($today_attandance['attendance_date'])==1){ ?>
										 <tr>
										 	<td>
												<?php  echo '<span class="badge badge-primary"><strong>'.$i.' .</strong></span>'; ?>
												
											</td>
											<td>
												<?= htmlspecialchars($this->misc->reformatDate($today_attandance['attendance_date']),ENT_QUOTES,'UTF-8'); ?>
											</td>
											<td>
												<?= htmlspecialchars($day_attadance->employee_id,ENT_QUOTES,'UTF-8') ?>
											</td>
											<td colspan="2" class="text-center">
											<?php 
											
												echo '<span class="text-danger"><strong> Weekend Holiday - Sunday</strong></span>';
											?>
											</td>
										</tr>
									<?php }elseif(empty($holidays)){ ?>
										<tr>

											<td>
												<?php  echo '<span class="badge badge-primary"><strong>'.$i.' .</strong></span>'; ?>
												
											</td>
										 	<td>
												<?= htmlspecialchars($this->misc->reformatDate($today_attandance['attendance_date']),ENT_QUOTES,'UTF-8'); ?>
											</td>
											<td>
												<?= htmlspecialchars($day_attadance->employee_id,ENT_QUOTES,'UTF-8') ?>
											</td>
											<td colspan="2" class="text-center">
											<?php 
												foreach($holidays as $holiday){
													echo '<span class="text-danger"><strong> Holiday - '.$holiday->event_name.'</strong></span>';
												}
											?>
											</td>
										</tr>
									<?php  }elseif(!empty($office_leave)){  ?>
										<tr>
											<td>
												<?php  echo '<span class="badge badge-primary"><strong>'.$i.' .</strong></span>'; ?>
												
											</td>
										 	<td>
												<?= htmlspecialchars($this->misc->reformatDate($today_attandance['attendance_date']),ENT_QUOTES,'UTF-8'); ?>
											</td>
											<td>
												<?= htmlspecialchars($day_attadance->employee_id,ENT_QUOTES,'UTF-8') ?>
											</td>
											<td colspan="2" class="text-center">
											<?php 
												foreach($office_leave as $leave){
													echo '<span class="text-danger"><strong>'.$this->mdl_leave_type->get($leave->fk_leave_type_id)->leave_code.'</strong></span>';
												}
											?>
											</td>
										</tr>										
									<?php  }elseif($today_attandance['attendance'] == "P"){  ?>
										<tr>
											<td>
												<?php  echo '<span class="badge badge-primary"><strong>'.$i.' .</strong></span>'; ?>
												
											</td>
											<td>
												<?= htmlspecialchars($this->misc->reformatDate($today_attandance['attendance_date']),ENT_QUOTES,'UTF-8'); ?>
											</td>
											<td>
												<?= htmlspecialchars($day_attadance->employee_id,ENT_QUOTES,'UTF-8') ?>
											</td>

											<td>
												<?= htmlspecialchars($today_attandance['attendance_time'],ENT_QUOTES,'UTF-8') ?>
											</td>

											<td>
												<?php if(!empty($today_attandance['out_time'])){
														echo $today_attandance['out_time']; 
													}else{
														echo "No checkout";
												} ?>
											</td>
										</tr>
								<?php } elseif($today_attandance['attendance'] == "A"){  ?>
									<tr>
											<td>
												<?php  echo '<span class="badge badge-primary"><strong>'.$i.' .</strong></span>'; ?>
												
											</td>
											<td>
												<?= htmlspecialchars($this->misc->reformatDate($today_attandance['attendance_date']),ENT_QUOTES,'UTF-8'); ?>
											</td>
											<td>
												<?= htmlspecialchars($day_attadance->employee_id,ENT_QUOTES,'UTF-8') ?>
											</td>

											<td colspan="2" class="text-center">
												<span class="badge badge-danger"><strong>ABSENT</strong></span>
											</td>
										</tr>
								<?php } } } endforeach; ?>
							</tbody>
							<?php }else{ ?>
								<tr class="text-center text-uppercase">
									<td colspan="5"><strong>NO RECORDS AVAILABLE</strong></td>
								</tr>
							<?php } ?>
							<tfoot>
					            <tr>
					            	<th>S. No.</th>
					            	<th>Date</th>
									<th>Employee Info</th>
									<th>Log In Time</th>
									<th>Log Out Time</th>
					            </tr>
					        </tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	
	</div>
</div>