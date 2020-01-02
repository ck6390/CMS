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
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}/faculty_profile/{$this->uri->segment('3')}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Evolution Report</strong>
			</li>
		</ol>
	</div>	
</div>
<div class="wrapper wrapper-content hidden">
	<div class="ibox-title">
		<h5>Employee Basic Details</h5>
		<div class="ibox-tools">
			<small><code>*</code> Required Fields.</small>
		</div>
	</div>
</div>
<div class="wrapper wrapper-content" id="printableArea">
    <div class="row animated fadeInRight">
        <div class="ibox float-e-margins">			
			<div class="ibox-content hidden">
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
				<table class="table table-bordered table-hover">
                    <tbody>
                    	<tr>
                    		<th class="text-center" colspan="2">PERFORMANCE REPORT TEACHING</th>
                    	</tr>
	                    <tr>
	                    	<td><strong>Employee Name</strong></td>
	                       	<td><?php echo $info->emp_name." ( ".$info->username." ) "; ?></td>
	                    </tr>
	                    <tr>
	                    	<td><strong>Designation</strong></td>
							<td><?php echo $this->mdl_dept->get($info->emp_department_ID)->dept_name; ?></td>
	                    </tr>
	                    <tr>
	                    	<td><strong>Department</strong></td>
	                       	<td><?php echo $this->mdl_desg->get($info->emp_designation_ID)->desg_name; ?></td>
	                    </tr>
	                    <tr>
	                    	<td><strong>Employee Type</strong></td>
	                       	<td><?php echo $this->mdl_empe_type->get($info->emp_type)->employee_type_name; ?></td>
	                    </tr>
                    </tbody>
                </table>
			</div>
		</div>
    </div>
    <div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title hidden">
					<h5>Attributes List</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
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
						<table class="table table-bordered table-hover">
		                    <tbody>
		                    	<tr>
		                    		<th class="text-center" colspan="2">PERFORMANCE REPORT TEACHING</th>
		                    	</tr>
			                    <tr>
			                    	<td><strong>Employee Name</strong></td>
			                       	<td><?php echo $info->emp_name." ( ".$info->username." ) "; ?></td>
			                    </tr>
			                    <tr>
			                    	<td><strong>Designation</strong></td>
									<td><?php echo $this->mdl_dept->get($info->emp_department_ID)->dept_name; ?></td>
			                    </tr>
			                    <tr>
			                    	<td><strong>Department</strong></td>
			                       	<td><?php echo $this->mdl_desg->get($info->emp_designation_ID)->desg_name; ?></td>
			                    </tr>
			                    <tr>
			                    	<td><strong>Employee Type</strong></td>
			                       	<td><?php echo $this->mdl_empe_type->get($info->emp_type)->employee_type_name; ?></td>
			                    </tr>
		                    </tbody>
		                </table>
		                <?php
						$attr = array(
							'role' => 'form',
							'method' => 'post',
							'name' => 'add-form',
							'id' => 'add-form',
							'class' => 'form-horizontal'
						);
						echo form_open("{$this->misc->_getClassName()}/save_evolution", $attr); ?>
						<table class="table table-striped table-bordered table-hover" id="table_sum">
							<thead>
								<tr>
								
									<th>Attributes</th>
									<th>Max Points </th>
									<th>Obtained Points</th>
									
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td><?php echo form_label('TEACHING SKILLS', 'tech_skill');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 <?php if(form_error('tech_skill')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'tech_skill',
											'class' => 'form-control total_obt_point',
											'id'=>'',
											'placeholder' => 'student attendance',
											'value' => set_value('tech_skill', !empty($clients_appraisal_data->tech_skill)? $clients_appraisal_data->tech_skill: ''),
											'required' => 'true'
										));
										echo form_error('tech_skill'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('AVERAGE NO OF STUDENT CLEAR THE RESPECTIVE SUBJECT IN SEMESTER ', 'avg_stu_sub_sem');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 <?php if(form_error('avg_stu_sub_sem')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'avg_stu_sub_sem',
											'class' => 'form-control total_obt_point',
											'id'=>'',
											'placeholder' => 'student attendance',
											'value' => set_value('avg_stu_sub_sem', !empty($clients_appraisal_data->avg_stu_sub_sem)? $clients_appraisal_data->avg_stu_sub_sem: ''),
											'required' => 'true'
										));
										echo form_error('avg_stu_sub_sem'); ?>
									</td>
								</tr>
								<tr>
									<td><?php //EXTRA CORECULAM ACTIVITY
									 echo form_label('INVOLVEMENT IN EXTRACARICULAM ACTIVITY', 'inv_ext_act');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 <?php if(form_error('inv_ext_act')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'inv_ext_act',
											'class' => 'form-control total_obt_point',
											'id'=>'',
											'placeholder' => 'student attendance',
											'value' => set_value('inv_ext_act', !empty($clients_appraisal_data->inv_ext_act)? $clients_appraisal_data->inv_ext_act: ''),
											'required' => 'true'
										));
										echo form_error('inv_ext_act'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('DEDICATION TOWARDS INSTITUTION ', 'dedi_towadrs_insti');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 <?php if(form_error('dedi_towadrs_insti')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'dedi_towadrs_insti',
											'class' => 'form-control total_obt_point',
											'id'=>'',
											'placeholder' => 'student attendance',
											'value' => set_value('dedi_towadrs_insti', !empty($clients_appraisal_data->dedi_towadrs_insti)? $clients_appraisal_data->dedi_towadrs_insti: ''),
											'required' => 'true'
										));
										echo form_error('dedi_towadrs_insti'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('STUDENT FACULTY RELATION', 'stud_fac_rel');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 <?php if(form_error('stud_fac_rel')) echo 'has-error'; ?>">
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'stud_fac_rel',
											'class' => 'form-control total_obt_point',
											'placeholder' => 'student attendance',
											'id'=>'',
											'value' => set_value('stud_fac_rel', !empty($clients_appraisal_data->stud_fac_rel)? $clients_appraisal_data->stud_fac_rel: ''),
											'required' => 'true'
										));
										echo form_error('stud_fac_rel'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('LATE ATTENDANCE', 'moral_behaviors');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 <?php if(form_error('moral_behaviors')) echo 'has-error'; ?>">
										<?php 
										$financial_year_attendances = getEmployeeAttendances($info->employee_id,$info->emp_login_time,$info->emp_logout_time); 
										$financial_year_attendances = ($financial_year_attendances / $this->config->item('point_all'));
										echo form_input(array(
											'type' => 'text',
											'name' => 'moral_behaviors',
											'class' => 'form-control total_obt_point',
											'id'=>'',
											'placeholder' => 'student attendance',
											'value' => set_value('moral_behaviors',number_format((float)$financial_year_attendances, 2, '.', '')),
											'required' => 'true'
										));
										echo form_error('moral_behaviors'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('NUMBER OF STUDENT PERSENT IN CLASS ', 'no_of_stud_in_class');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 <?php if(form_error('no_of_stud_in_class')) echo 'has-error'; ?>">
										<?php 
										$financial_year = get_financial_year();
										//var_dump($financial_year->start_year.'-'.$financial_year->end_year);
										$total_student = 0;
										$present_student = 0;
										//var_dump($info->emp_p_id);
										$cl_emp_leaves = get_emp_by_leaves($info->emp_p_id,$financial_year->start_year,$financial_year->end_year,$financial_year->start_month,$financial_year->end_month,$this->config->item('cl'));

										$lwp_emp_leaves = get_emp_by_leaves($info->emp_p_id,$financial_year->start_year,$financial_year->end_year,$financial_year->start_month,$financial_year->end_month,$this->config->item('lwp'));
										$get_student_ratio = get_student_ratio($info->emp_p_id,$financial_year->start_year,$financial_year->end_year,$financial_year->start_month,$financial_year->end_month);
										//var_dump($get_student_ratio);
										//$json_data = json_decode($get_student_ratio,true);
										$present_att = 0;
										$absent_att = 0;
										if(!empty($get_student_ratio)){
											foreach ($get_student_ratio as $value) {
												//$value->student_attandance;
												$json_data = json_decode($value->student_attandance,true);
												//var_dump($json_data);		
												if($json_data != null){							
													foreach ($json_data as $obj) {
														//echo $obj[$key];
														//echo $obj['attance_status']."12<br/>";
														if($obj['attance_status'] == "P"){
															$present_att += count($obj['attance_status']);
															
														}	
														if($obj['attance_status'] == "A"){
															$absent_att += count($obj['attance_status']);
															
														}												
													}
												}
											} 
											/*echo $present_att." - P<br/>"; 
											echo $absent_att." - A<br/>"; 
											echo $present_att + $absent_att." - All";*/
											$atta_point = ($this->config->item('point_all') / ($present_att + $absent_att)) * $present_att;
										}else{
											$atta_point = 0;
										}
										/*foreach($lists as $list)
										{
											$obj = json_decode($list->lecture_student_attendance,true);
											var_dump($obj);
											$total_student = $total_student + count($obj);
											foreach($obj as $student)
											{
												if($student['attance_status'] == "P"){

													$present_student = $present_student + count($student['attance_status']);
												}
												
											}
										}
										if($total_student != '0'){
											$point = (($present_student)/($total_student))*10;
										}else{
											$point ='0';
										}*/
										
										echo form_input(array(
											'type' => 'text',
											'name' => 'no_of_stud_in_class',
											'class' => 'form-control total_obt_point',
											'id'=>'student_attan',
											'placeholder' => 'student attendance',
											'value' => set_value('no_of_stud_in_class',number_format((float)$atta_point, 2, '.', '')),
											'required' => 'true'
										));
										echo form_error('no_of_stud_in_class'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('CASUAL LEAVE ', 'casual_leave');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 <?php if(form_error('casual_leave')) echo 'has-error'; ?>">
										<?php 
											$leave_point  = $this->config->item('point_all')/$this->config->item('totol_cl');
											$totol_cl = ($this->config->item('totol_cl') - count($cl_emp_leaves)) * $leave_point;
										?>
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'casual_leave',
											'class' => 'form-control total_obt_point',
											'id'=>'cl',
											'placeholder' => 'cl',
											'value' => set_value('casual_leave',number_format((float)$totol_cl, 2, '.', '')),
											'required' => 'true'
										));
										echo form_error('casual_leave'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('LEAVE WITHOUT PAY', 'leave_without_pay');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 <?php if(form_error('leave_without_pay')) echo 'has-error'; ?>">
										<?php 
											$leave_point  = $this->config->item('point_all')/$this->config->item('totol_lwp');
											$totol_lwp = ($this->config->item('totol_lwp') - count($lwp_emp_leaves)) * $leave_point;
										?>
										<?php echo form_input(array(
											'type' => 'text',
											'name' => 'leave_without_pay',
											'class' => 'form-control total_obt_point',
											'id'=>'lwp',
											'placeholder' => 'LWP',
											'value' => set_value('leave_without_pay',number_format((float)$totol_lwp, 2, '.', '')),
											'required' => 'true'
										));
										echo form_error('leave_without_pay'); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('YEAR OF EXPERIENCE IN GANGA MEMORIAL COLLEGE OF POLYTECHNIC', 'experience');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 <?php if(form_error('experience')) echo 'has-error'; ?>">
										<?php 

										$datetime1 = new DateTime($info->emp_joined_date); 
 										$datetime2 = new DateTime();
 										$interval = $datetime1->diff($datetime2);
										echo form_input(array(
											'type' => 'text',
											'name' => 'experience',
											'class' => 'form-control total_obt_point',
											'id'=>'exp',
											'placeholder' => 'experience from date of joining',
											'value' => set_value('experience',number_format($interval->days / 365, 2)),
											'required' => 'true'
										));
										echo form_error('experience'); ?>
									</td>
								</tr>
							</tbody>
							<tfoot class="hidden">
					            <tr>
					                <td>Total:</td>
					                <td>Total:</td>
					                <td>Total:</td>
					            </tr>
					        </tfoot>	
							<tfoot class="">
								<tr>
									<th class="text-right">Total</th>
									<th class="total_sum"></th>
									<th>
									<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'total_points',
											'class' => 'form-control total_obt_sum',
											'id'=>'total_points',
											'style'=>'border:none',
											'placeholder' => '',
											'value' => set_value('total_obt_sum'),
											'required' => 'true'
										));
										echo form_input(array(
											'type' => 'hidden',
											'name' => 'emp_id',
											'class' => 'form-control',
											'id'=>'emp_id',
											'value' => set_value('emp_id',$info->emp_p_id),
											'required' => 'true'
										));
										echo form_input(array(
											'type' => 'array',
											'name' => 'emp_appraisal_id',
											'class' => 'form-control',
											'id'=>'emp_appraisal_id',
											'value' => set_value('emp_appraisal_id', !empty($clients_appraisal_data->id)? $clients_appraisal_data->id: '')
										));
										?>
									</th>
								</tr>
								<tr>
									<th colspan="3">
										<button type="submit" name="submit" class="btn btn btn-primary">Save</button>
									</th>
								</tr>
								<!-- <tr>
									<th colspan="3" class="text-uppercase">Recommendantions</th>
								</tr>
								<tr>
									<th colspan="3" class="text-uppercase"><br/><br/></th>
								</tr>
								<tr>
									<th colspan="2">Name of Employee : <?php echo $info->emp_name; ?></th>
									<th>Sig of Institution Authority</th>
								</tr>
								<tr>
									<th colspan="2">Signature : .............................</th>
									<th>....................................</th>
								</tr>
								<tr>
									<th colspan="3">Dated : <?= date('d-m-Y'); ?></th>
								</tr> -->
							</tfoot>
						</table>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--<style type="text/css">
	@media print {
	
	}
</style>
 <div class="wrapper wrapper-content text-right">
	<input type="button" onclick="printDiv12('printableArea')" value="Print" class="btn btn-info" />
</div> -->
<script>
     $(document).ready(function(){
      calculation ();
      var student_attan = $("#student_attan").val();
      var cl = $("#cl").val();
      var lwp = $("#lwp").val();
      var exp = $("#exp").val();
	  var result = [];
	  $('table tr').each(function(){
	    $('.total_point', this).each(function(index, val){
	        if(!result[index]) result[index] = 0;
	      result[index] += parseInt($(val).text());
	    });	   
	  });

	  $(result).each(function(){
	    $('.total_sum').append(this)
	  });  
	

	$('.total_obt_point').on('change', function(e){ 
		calculation ();
	});
	function calculation (){
		var sum = 0.0;
	    $('.total_obt_point').each(function(){
		    if($(this).val() != ''){
		       sum += parseFloat($(this).val());
		    }
		    console.log(sum);
	    });	    
	    $(".total_obt_sum").val(Number(sum).toFixed(2));
	}

});
</script>
<!-- <script type="text/javascript">
	function printDiv12(divName) {
		var formData = $("#add-form").serialize();
		$.ajax({
			type: "POST",
			data : formData,
			url: "<?php echo site_url();?>/super_admin/save_evolution",
			success: function(response) {
				if(response == true) {
					//swal("Deleted!", "Item has been deleted!", "success");
					//tr.remove();
				} else {
					//swal("Oops!", "Something went wrong!", "error");
				}
			},
			//error: function(xhr,status,strErr) {
				//alert(status);
			}
		});
     /*var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;*/
}
</script>