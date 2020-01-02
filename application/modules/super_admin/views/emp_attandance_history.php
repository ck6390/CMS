<!-- page -->

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-sm-8">

		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>

		<ol class="breadcrumb">

			<li>

				<a href="<?= base_url(); ?>">Home</a>

			</li>

			<li>

				<a href="#"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>

			</li>

			<li class="active">

				<strong>Profile</strong>

			</li>

		</ol>

	</div>

	

</div>

<div class="wrapper wrapper-content">

    <div class="row animated fadeInRight">

        <div class="ibox float-e-margins">

			<div class="ibox-title">

				<h5>Employee Salary Details</h5>

				<div class="ibox-tools">

					<small><code>*</code> Required Fields.</small>

				</div>

			</div>

			<div id="printablediv" class="ibox-content">

				<?php $instituteInfo = $this->mdl_general_setting->get('6');?>

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

		

				<table class="table table-bordered m-b-none table-hover">

                    <tbody>

	                    <tr>

	                    	<td><strong>Employee Id</strong></td>

	                    	<td><strong>Name Of Employee</strong></td>

	                    	<td><strong>Range Of Date</strong></td>

	                    </tr>

	                    <tr>

	                    	<td class="text-info"><?php echo $info->username; ?></td> 

	                       	<td><?php echo $info->emp_name; ?></td>

	                       	<td><?php 

	                       		$current_month = $lists->year."-".$lists->month."-01";

	                       		$d = new DateTime($current_month);

	                       		$start_date = $d->format("Y-m-d");

	                       		$last_date = $d->format("Y-m-t");

	                       		

	                       	echo  $this->misc->reformatDate($start_date)." <strong>To</strong> ".$this->misc->reformatDate($last_date);?></td>

	                    </tr>

	                     <tr>

	                    	<td><strong>Department</strong></td>

	                       	<td colspan="2"><?php echo $this->emp_department->get($info->emp_department_ID)->dept_name; ?></td>  

	                    </tr>

	                    <tr>

	                    	<td><strong>Designation</strong></td>

	                       	<td colspan="2"><?php echo $this->emp_designation->get($info->emp_designation_ID)->desg_name; ?></td>  

	                    </tr>

	                    <tr>

	                    	<td><strong>Working Payment Per Month</strong></td>

	                       	<td colspan="2"><?php 

	                       //	echo $info->emp_p_id;

	                       	$inreament_salary=get_increament($info->emp_p_id,$start_date);

	                       	if(empty($inreament_salary)){

	                       		echo number_format((float)$info->emp_salary, 2, '.', '');

	                       	}else{

	                       		echo number_format((float)$inreament_salary->emp_salary, 2, '.', '');

	                       	}

	                       	?></td>  

	                    </tr>

	                    <tr>

	                    	<td><strong>Other Allowance</strong></td>

	                       	<td colspan="2"><?php 

	                       	if(empty($inreament_salary)){

	                       		echo $allowance = $info->allowance; 

	                       	}else{

	                       		echo $allowance = $inreament_salary->allowance;

	                       	}

	                       	?></td>  

	                    </tr>

	                    <tr>

	                    	<td><strong>Gross Salary Per Month</strong></td>

	                       	<td colspan="2"><?php 

	                       	if(empty($inreament_salary)){

	                       		$gross_sal = $info->allowance+$info->emp_salary;

	                       		echo  number_format((float)$gross_sal, 2, '.', '');

	                       	}else{

	                       		$gross_sal = $inreament_salary->allowance+$inreament_salary->emp_salary;

	                       		echo  number_format((float)$gross_sal, 2, '.', '');

	                       	}

	                       	?></td>  

	                       	

	                    </tr>



	                     <tr>

	                     	<?php



	                    	 	$monthName = date('F', mktime(0, 0, 0, $lists->month, 10));

	                    	?>

	                    	<td><strong>Total Days ( <?php echo $monthName." - ".$lists->year; ?> )</strong></td>

	                       	<td colspan="2"><?php echo $day_in_month = cal_days_in_month(CAL_GREGORIAN,$lists->month,$lists->year)." Days"; ?></td> 

	                    </tr>



	                    <tr>

	                    	

	                    	<td><strong>Working days ( <?php echo $monthName." - ".$lists->year; ?> )</strong></td>

	                       	<td colspan="2">

	                       		<?php 

									$get_holiday = get_holidays($start_date,$last_date);	

									//var_dump($get_holiday);



									$get_all_sun = getSundays($start_date,$last_date);

									//var_dump($get_all_sun);

									$get_h_sun = 0;	

									$sum = 0;									

									foreach ($get_holiday as $key=> $obj) {

										if($last_date >= $obj->end_date){
											if($obj->start_date < $start_date){
											// New date calculation
											$obj_last_date = new DateTime($start_date);
											$obj_end_date = new DateTime($obj->end_date);
											$holiday_interval = $obj_last_date->diff($obj_end_date);
											$extra_days = $holiday_interval->format("%a");
											$sum += ($extra_days + 1);
											$get_holiday_sun = getSundays($start_date ,$obj->end_date);
											// End New date calculation
											}else{

											$sum += $obj->days;

											$get_holiday_sun = getSundays($obj->start_date ,$obj->end_date);
											}
											$get_h_sun = count($get_holiday_sun)+$get_h_sun;

										}else{

											//$date_diff = new Date($last_date) - ;

											//echo $last_date;



											$obj_last_date = new DateTime($last_date);

											$obj_end_date = new DateTime($obj->end_date);

											$holiday_interval = $obj_last_date->diff($obj_end_date);

											$extra_days = $holiday_interval->format("%a");

											$sum += ($obj->days - $extra_days);



											$get_holiday_sun = getSundays($obj->start_date ,$last_date);

											$get_h_sun = count($get_holiday_sun)+$get_h_sun;

										}							    			

									}

									//var_dump($sum);

									$total_holiday = $sum-$get_h_sun;

									echo $day_in_month - $total_holiday - count($get_all_sun);

								?>	                    



	                       	</td> 

	                    </tr>

	                   

	                    <tr>

	                    	<td><strong>Salary Per Days</strong></td>

	                       	<td colspan="2">

	                       		<?php 

	                       			if(empty($inreament_salary)){

	                       				$salary_per_days = $info->emp_salary / $day_in_month; 

	                       				echo $day_salary = number_format((float)$salary_per_days, 2, '.', '');

	                       			}else{

	                       				$salary_per_days = $inreament_salary->emp_salary / $day_in_month; 

	                       				echo $day_salary = number_format((float)$salary_per_days, 2, '.', '');

	                       			}

	                       			

	                       		?>

	                       	</td> 

	                    </tr>

	                    <tr>

	                    	<td><strong>Working Hours Per Days</strong></td>

	                       	<td colspan="2"> 

	                       		<?php                        		

	                       			$in_time = new DateTime($info->emp_login_time);

									$out_time = new DateTime($info->emp_logout_time);

									 $interval = $in_time->diff($out_time);



									echo $working_hrs = $interval->format('%hh %im');

								?>

	                       	</td> 

	                    </tr>

	                    <tr>

	                    	<td><strong>Salary Per Hours </strong></td>

	                       	<td colspan="2">

	                       		<?php 

	                       		//if(!empty($inreament_salary)){

	                       			$decimal_time = number_format((float)$working_hrs, 2, '.', '');	

	                       			$salary_per_hrs = $salary_per_days / $decimal_time ; 

	                       			echo $singleDaySalary = number_format((float)$salary_per_hrs, 2, '.', '');

	                       		/*}else{



	                       		}*/

	                       		?>

	                       	</td> 

	                    </tr>

	                    <tr>

	                    	<td><strong>In Time</strong></td>

	                       	<td colspan="2"><?php echo $info->emp_login_time; ?></td>

	                    </tr>

	                    <tr>

	                    	<td><strong>Out Time</strong></td>

	                       	<td colspan="2"><?php echo $info->emp_logout_time; ?></td> 

	                    </tr>

	                     <tr class="hidden">

	                    	<td><strong>Grace Time</strong></td>

	                       	<td colspan="2"><?= $instituteInfo->grace_time ? $instituteInfo->grace_time.' minutes' :''; ?></td> 

	                    </tr>

                    </tbody>

                </table>



                <table id="salary_statement " class="table table-striped m-b-none table-bordered table-hover ">

							<thead>

								<tr>

									<th colspan="9" class="text-center">Salary Sheet (Datewise)</th>

									

								</tr>

								<tr>

									<th>Date</th>

									<th>In Time</th>

									<th>Out Time </th>

									<th>Status</th>

									<th>Total Late IN/early OUT</th>

									<th>Total Working Hours</th>

									<th>Salary Per Day</th>

									<th>Deducted</th>

									<th>Day Salary</th>

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

								

								$attendance = json_decode($lists->attendance_data, true);

								//print_r($attendance);

								//die();

								//var_dump($lists->attendance_data);

								$i=0;



								foreach ($attendance as $list) { $i++;

									

									//echo $ff;

									$holidays = $this->mdl_emp_attendance->get_holiday($list['attendance_date']);

									//var_dump($holidays);

									//die();

									$office_leave = $this->mdl_emp_attendance->get_office_leave($list['attendance_date'],$info->emp_p_id);



									//$cnt = 0;

									if($list['attendance']=="A" && !($this->misc->isThisDayAWeekend($list['attendance_date'])==1) && empty($holidays)){

                                        @$workingays++;

									}

									

									if(!empty($office_leave) && $list['attendance']=="P"){

										foreach($office_leave as $leave){

										?>

										<tr>

									 		<td>

												<?= htmlspecialchars($this->misc->reformatDate($list['attendance_date']),ENT_QUOTES,'UTF-8'); ?>

											</td>

											<td colspan="5" class="text-center">

											<?php 

												echo '<span class="text-danger"><strong>'.$this->mdl_leave_type->get($leave->fk_leave_type_id)->leave_code.'</strong></span>';?>

											</td>

											<td>

			                       				<?php echo $day_salary;	?>

					                       	</td>

					                       	<td>

					                       		<?php 

					                       		$salary_deduct_leave = $this->mdl_leave_type->get($leave->fk_leave_type_id)->salary_deduct;



					                       		$leave_deduction_value = $this->mdl_leave_type->get($leave->fk_leave_type_id)->deduction_value;

					                       		if($salary_deduct_leave == 1){



					                       			echo $deductSalary = $leave_deduction_value*$day_salary;



					                       		}else{

					                       			echo " ";

					                       		}

					                       			?>

					                       	</td>

					                       	<td class="price">

					                       		<?php echo $day_salary-$deductSalary;?>

					                       	</td>

										</tr>

									<?php  } }elseif(!empty($list['attendance_date'])){

									if(empty($holidays) && $list['attendance']=="P"){ ?>

									<tr>

										<td>

											<?= htmlspecialchars($this->misc->reformatDate($list['attendance_date']),ENT_QUOTES,'UTF-8'); ?>

										</td>

										<td>

											<?php 

												$time_period = date('a',strtotime($list['attendance_time']));

												if($time_period == "pm"){

													echo "<strong class='text-danger'>No checkout</strong>";

												}else{

													echo htmlspecialchars($list['attendance_time'] != '' ? $list['attendance_time'] : "<strong class='text-danger'>No checkout</strong>",ENT_QUOTES,'UTF-8');

												}

											?>											

										</td>

										<td>

											<?php 

											$time_period_am = date('a',strtotime($list['out_time']));

											if($time_period_am == "am" || $list['out_time'] == ''){

												echo "<strong class='text-danger'>No checkout</strong>";

											}

											else{

												echo $list['out_time'];

											} ?>

										</td>

										<td>

											<?php 



												$dailyInTime = new DateTime($list['attendance_time']);

				                       			//echo $list['attendance_time']."<br/>";

				                       			$dailyOutTime = new DateTime($list['out_time']);



												// Salary cal

												$startTime = date("H:i", strtotime('+'.$instituteInfo->grace_time.' minutes', strtotime($info->emp_login_time)));

												$endTime = date("H:i", strtotime('-'.$instituteInfo->grace_time.' minutes', strtotime($info->emp_logout_time)));



												$startTime = new DateTime($startTime);

												$endTime = new DateTime($endTime);

				                       			$lateInTimeDiffSalary = $startTime->diff($dailyInTime);

												$beforeOutTimeDiffSalary = $endTime->diff($dailyOutTime);



												if(($dailyInTime >= $startTime) && ($dailyOutTime <= $endTime)){

				                       				 $deducted_whrs_salary = ceil($lateInTimeDiffSalary->format('%h.%i')) + ceil($beforeOutTimeDiffSalary->format('%h.%i'))."  Hour";

												 

				                       			}elseif($dailyInTime >= $startTime){

				                       				

				                       				 $deducted_whrs_salary = ceil($lateInTimeDiffSalary->format('%h.%i'))."  Hour";



				                       			}elseif($dailyOutTime < $endTime){

				                       			

				                       				$deducted_whrs_salary = ceil($beforeOutTimeDiffSalary->format('%h.%i'))."  Hour";

				                       			}else{



				                       				$deducted_whrs_salary = "";	

				                       			}

												// End Salary cal



				                       			

												

												$lateInTimeDiff = $in_time->diff($dailyInTime);



												$beforeOutTimeDiff = $out_time->diff($dailyOutTime);												

												if($dailyInTime > $in_time ){

													echo $lateInTime = '<span class="text-success"><strong>'.$lateInTimeDiff->format('%h:%i').' Hour Late</strong></span>';

												}

												if($dailyOutTime < $out_time ){

													 echo  $beforeOutTime = '/ <span class="text-success"><strong>'.$beforeOutTimeDiff->format('%hh %im').' Before</strong></span>';

													

												}

				                       		?>	

										</td>

										<td>

				                       		<?php 

				                       			if(($dailyInTime > $in_time) && ($dailyOutTime < $out_time)){

				                       					//echo "sd";

				                       				//echo ceil($lateInTimeDiff->format('%h.%i'))."<br/>";

				                       				//echo ceil($beforeOutTimeDiff->format('%h.%i'));



				                       				 //$lateInTimeDiff->format('%h.%i') ."<br/>";

				                       				 //$beforeOutTimeDiff->format('%h.%i');

				                       				 echo $deducted_whrs = ceil($lateInTimeDiff->format('%h.%i')) + ceil($beforeOutTimeDiff->format('%h.%i'))."  Hour";

												 

				                       			}elseif($dailyInTime > $in_time){

				                       				

				                       				 echo $deducted_whrs = ceil($lateInTimeDiff->format('%h.%i'))."  Hour";



				                       			}elseif($dailyOutTime < $out_time){

				                       			

				                       				echo $deducted_whrs = ceil($beforeOutTimeDiff->format('%h.%i'))."  Hour";

				                       			}else{



				                       				echo $deducted_whrs = "";	

				                       			}



				                       			 

											?>

				                       	</td>

				                       	<td>

			                       		<?php 

			                       		if(empty($list['out_time'])){

				                       					echo "0";

				                       		}elseif(($dailyInTime > $in_time) && ($dailyOutTime < $out_time)){



				                       			 $deducted_whrs = ceil($lateInTimeDiff->format('%h.%i')) + ceil($beforeOutTimeDiff->format('%h.%i'));



				                       			echo ceil($interval->format('%h.%i'))-$deducted_whrs."  Hour ";



				                       		}elseif($dailyInTime > $in_time ){



				                       			$deducted_whrs = ceil($lateInTimeDiff->format('%h.%i'));



				                       			echo ceil($interval->format('%h.%i'))-$deducted_whrs."  Hour ";

				                       		}elseif($dailyOutTime < $out_time){

				                       			

				                       			$deducted_whrs = ceil($beforeOutTimeDiff->format('%h.%i'));

				                       			

				                       			echo ceil($interval->format('%h.%i'))-$deducted_whrs."  Hour ";

				                       			

				                       		}else{

				                       			echo ceil($interval->format('%h.%i'))."  Hour ";

				                       		}

			                       		?>	

				                       	</td>

				                       	<td>

				                       		<?php echo $day_salary;	?>

				                       	</td>

				                       	<td>

				                       		<span class="text-danger"><strong>

				                       		<?php	

				                       			//echo $deducted_whrs;

				                       			//echo $instituteInfo->grace_time."GT<br/>";			                       		

				                       			//echo $lateInTimeDiff->format('%i')."LT<br/>";

				                       			if($list['attendance_time']!=$list['out_time']){

				                       				if(empty($list['out_time'])){

				                       					echo $deductSalary =$day_salary;

				                       				}elseif($deducted_whrs < $decimal_time){

				                       				/*if($instituteInfo->grace_time>=$lateInTimeDiff->format('%i')){	*/

				                       					$deductSalary = $deducted_whrs_salary*$singleDaySalary;

				                       					echo $deductSalary;

				                       				/*}else{

				                       					$deductSalary = $day_salary;

						                      		 	echo $deductSalary;

				                       				}*/

						                       		}else{

						                       			echo $deductSalary =$singleDaySalary;

						                       		}

						                       	}else{

						                       		$deductSalary = $day_salary;

						                       		echo $deductSalary;

						                       	}

						                    ?>

											</strong></span>

				                       	</td>

				                       	<td class="price">



				                       		<?php 

				                       		if($list['attendance_time']!=$list['out_time']){

					                       		if(empty($list['out_time'])){

				                       					echo "0";

				                       				}else{





					                       		echo number_format((float)($day_salary-$deductSalary), 2, '.', '');

					                       		}

					                       	}else{

					                       		echo $day_salary - $deductSalary .'.00';

					                       	}

				                       		?>

				                       	</td>

									</tr>

									<?php

									  } 

									 

									  elseif($this->misc->isThisDayAWeekend($list['attendance_date'])==1 && $list['attendance']=="A"){



									   ?>

									 	

									 	<tr>

											<td>

												<?= htmlspecialchars($this->misc->reformatDate($list['attendance_date']),ENT_QUOTES,'UTF-8'); ?>

											</td>

											<td colspan="5" class="text-center">

											<?php 

											

												echo '<span class="text-danger"><strong> Weekend Holiday - Sunday</strong></span>';

											?>

											</td>

											<td>

				                       			<?php echo $day_salary;	?>

					                       	</td>

					                       	<td>

					                       		

					                       	</td>

					                       	<td class="price">

					                       		<?php echo $day_salary;	?>

					                       	</td>

										</tr>



										<?php }elseif(!empty($holidays)){ ?>

											<tr>

										 		<td>

													<?= htmlspecialchars($this->misc->reformatDate($list['attendance_date']),ENT_QUOTES,'UTF-8'); ?>

												</td>

												<td colspan="5" class="text-center">

												<?php 

													foreach($holidays as $holiday){

														echo '<span class="text-danger"><strong> Holiday - '.$holiday->event_name.'</strong></span>';

													}

												?>

												</td>

												<td>

				                       				<?php echo $day_salary;	?>

						                       	</td>

						                       	<td>

						                       		

						                       	</td>

						                       	<td class="price">

						                       		<?php echo $day_salary;	?>

						                       	</td>

											</tr>

									<?php  }elseif(!empty($office_leave)){ 



										foreach($office_leave as $leave){

										?>

											<tr>

										 		<td>

													<?= htmlspecialchars($this->misc->reformatDate($list['attendance_date']),ENT_QUOTES,'UTF-8'); ?>

												</td>

												<td colspan="5" class="text-center">

												<?php 

													echo '<span class="text-danger"><strong>'.$this->mdl_leave_type->get($leave->fk_leave_type_id)->leave_code.'</strong></span>';

													

												?>

												</td>

												<td>

				                       				<?php echo $day_salary;	?>

						                       	</td>

						                       	<td>

						                       		<?php 

						                       		$salary_deduct_leave = $this->mdl_leave_type->get($leave->fk_leave_type_id)->salary_deduct;

						                       		//var_dump($salary_deduct_leave);

						                       		$leave_deduction_value = $this->mdl_leave_type->get($leave->fk_leave_type_id)->deduction_value;

						                       		//var_dump($leave_deduction_value);

						                       		if($salary_deduct_leave == 1){



						                       			//echo $leave_deduction_value;



						                       			echo $deductSalary = $leave_deduction_value*$day_salary;



						                       		}else{

						                       			echo " ";

						                       		}

						                       			?>

						                       		

						                       	</td>

						                       	<td class="price">

						                       		<?php 

						                       			if($salary_deduct_leave == 1){

						                       				echo $day_salary-$deductSalary;

						                       			}else{

						                       				echo $day_salary;	

						                       			}

						                       			

						                       		?>

						                       	</td>

											</tr>

											<?php  }  } if($list['attendance']=="A" && !($this->misc->isThisDayAWeekend($list['attendance_date'])==1) && empty($holidays) && empty($office_leave)){ ?>



												<tr>

											<td>

												<?= htmlspecialchars($this->misc->reformatDate($list['attendance_date']),ENT_QUOTES,'UTF-8'); ?>

											</td>

											<td colspan="5" class="text-center">

											<?php 

											

												echo '<span class="text-danger"><strong> Absent</strong></span>';

											?>

											</td>

											<td>

				                       			<?php echo $day_salary;	?>

					                       	</td>

					                       	<td>

					                       		<span class="text-danger">

					                       			<strong>

					                       			<?php echo $day_salary;	?>

					                       			</strong>

					                       		</span>

					                       	</td>

					                       	<td class="price">

					                       		<?php echo "0.00";	?>

					                       	</td>

										</tr>



											<?php } } } } ?>	

											<tr>

												<td colspan="8" style="text-align:right"><strong>Working Payment</strong></td>

					                			<td id="salary"></td>

											</tr>		

							</tbody>

						</table>

						<table class="table table-striped table-bordered m-b-none table-hover ">

							<thead>

								<tr>

									<th colspan="5" class="text-center">Extra Payment</th>

								</tr>

								<tr>

									<th>Date</th>

									<th>Work For (EMP ID)</th>

									<th>Type of Work</th>

									<th>Remark</th>

									<th>Amount</th>

								</tr>

							</thead>

							<tbody>

								<tr>

									<td></td>

									<td></td>

									<td></td>

									<td></td>

									<td></td>

								</tr>



							</tbody>

							<tfoot>

								<tr>

									<th colspan="4" class="text-right">Total Extra Pay</th>

									<th></th>

								</tr>

								<tr>

									<th colspan="4" class="text-right">Other Allowance</th>

									<th class="allowance"><?php echo $allowance; //$info->allowance; ?>
									</th>

								</tr>

								<tr>

									<th colspan="4"  class="text-right">Gross Salary</th>

									<th id="gross" class="gross"></th>

								</tr>

								<tr>

									<th colspan="5" id="in_word" class=" text-center"> </th>

								</tr>

								<tr>

									<th colspan="5" class=" text-center"> <button target="_blank" onclick="printDiv('printablediv')">Generate Salary</button></th>

								</tr>

							</tfoot>

						</table>

			</div>

		</div>

    </div>

</div>

<script type="text/javascript">

	function printDiv(divID) {

        //Get the HTML of div

        var divElements = document.getElementById(divID).innerHTML;

        //Get the HTML of whole page

        var oldPage = document.body.innerHTML;



        //Reset the page's HTML with div's HTML only

       document.body.innerHTML = "<html><head><title></title></head><body><style> body{font-size:10px;padding-left:70px;} .table > tbody > tr > td{padding:3px;}.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{border-top: 1px solid #000 !important;}.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{border: 1px solid #555 !important;}</style>" + 

          divElements + "</body>";





        //Print Page

        window.print();



        //Restore orignal HTML

        document.body.innerHTML = oldPage;

    }



    

	$(document).ready(function() {



		var sum = 0;



		// iterate through each td based on class and add the values

		$(".price").each(function() {

			var value = $(this).text();



		    // add only if the value is number

		    if(!isNaN(value) && value.length != 0) {

		        sum += parseFloat(value);

		    }

		});

		var final_sum = sum.toFixed(2);

		$('#salary').text(final_sum); 

		var salary = $(this).find("#salary").text(); 

		var allowance = $(this).find(".allowance").text(); 

		if(allowance==""){

			allowance= "0.00";

		}

		var gross_salary = parseFloat(salary) + parseFloat(allowance);

		//alert(allowance);

		var total_gross = Math.round(gross_salary)

		$('.gross').text(total_gross); 

		//$('#in_word').text('Rs. '+gross_salary+' Post / Generate Salary'); 

		$('#in_word').text(convertNumberToWords(total_gross)+' Only'); 

	});



	function convertNumberToWords(amount) {

    var words = new Array();

    words[0] = '';

    words[1] = 'One';

    words[2] = 'Two';

    words[3] = 'Three';

    words[4] = 'Four';

    words[5] = 'Five';

    words[6] = 'Six';

    words[7] = 'Seven';

    words[8] = 'Eight';

    words[9] = 'Nine';

    words[10] = 'Ten';

    words[11] = 'Eleven';

    words[12] = 'Twelve';

    words[13] = 'Thirteen';

    words[14] = 'Fourteen';

    words[15] = 'Fifteen';

    words[16] = 'Sixteen';

    words[17] = 'Seventeen';

    words[18] = 'Eighteen';

    words[19] = 'Nineteen';

    words[20] = 'Twenty';

    words[30] = 'Thirty';

    words[40] = 'Forty';

    words[50] = 'Fifty';

    words[60] = 'Sixty';

    words[70] = 'Seventy';

    words[80] = 'Eighty';

    words[90] = 'Ninety';

    amount = amount.toString();

    var atemp = amount.split(".");

    var number = atemp[0].split(",").join("");

    var n_length = number.length;

    var words_string = "";

    if (n_length <= 9) {

        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);

        var received_n_array = new Array();

        for (var i = 0; i < n_length; i++) {

            received_n_array[i] = number.substr(i, 1);

        }

        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {

            n_array[i] = received_n_array[j];

        }

        for (var i = 0, j = 1; i < 9; i++, j++) {

            if (i == 0 || i == 2 || i == 4 || i == 7) {

                if (n_array[i] == 1) {

                    n_array[j] = 10 + parseInt(n_array[j]);

                    n_array[i] = 0;

                }

            }

        }

        value = "";

        for (var i = 0; i < 9; i++) {

            if (i == 0 || i == 2 || i == 4 || i == 7) {

                value = n_array[i] * 10;

            } else {

                value = n_array[i];

            }

            if (value != 0) {

                words_string += words[value] + " ";

            }

            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {

                words_string += "Crores ";

            }

            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {

                words_string += "Lakhs ";

            }

            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {

                words_string += "Thousand ";

            }

            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {

                words_string += "Hundred and ";

            } else if (i == 6 && value != 0) {

                words_string += "Hundred ";

            }

        }

        words_string = words_string.split("  ").join(" ");

    }

    return words_string;

}

</script>

