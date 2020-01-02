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

	echo form_open("{$this->misc->_getClassName()}/academic_progress", $attr); ?>

		<div class="row">

			<div class="col-sm-12">

				<div class="ibox float-e-margins">

					<div class="ibox-title">

						<h5>Acamedic Progress </h5>

					</div>

					<div class="ibox-content">

						<div class="row">

							<div class="col-md-12">



								<div class="col-sm-3">

									<div class=" <?php if(form_error('month-from')) echo 'has-error'; ?>" id="inputhMonth">										

									<?php echo form_label('Semester <small class="text-danger">*</small>', 'semester');



										$_semester = $this->mdl_semester->dropdown('semester_name');

										echo form_dropdown(array(

											'name' => 'semester',

											'id' => 'semester',

											'class' => 'form-control select2_one'

										), $_semester);



										echo form_error('semester');  ?>

									</div>

								</div>

								<div class="col-sm-3">

									<div class=" <?php if(form_error('month-to')) echo 'has-error'; ?>" id="inputhMonth">

									<?php

										echo form_label('Branch <small class="text-danger">*</small>', 'branch');

										$_branch = $this->mdl_branch->dropdown('branch_code');

										echo form_dropdown(array(

											'name' => 'branch',

											'id' => 'branch',

											'class' => 'form-control select2_one'

										), $_branch);



										echo form_error('branch'); ?>

										

									</div>

								</div>

								<div class="col-sm-5">

									<div class=" <?php if(form_error('subject-id')) echo 'has-error'; ?>">

									<?php echo form_label('Subject <small class="text-danger">*</small>', 'subject-id', array('class' => ' control-label')); ?>

									<select name="subject-id" class="form-control d-none select2_one select2-hidden-accessible" id="subjectId">

										

									</select>

									<!--select name="subject-id" class="form-control d-none select2_one select2-hidden-accessible">

										<option value="">Please Select</option>

									<!- -?php 

									$_subjects = $this->mdl_subject->get_all();

									foreach($_subjects as $subject){ ?>

										

										 <option value="<!- -?php echo $subject->subject_p_id;?>"><!- -?php echo $subject->subject_name." - ".$subject->subject_code;?></option>

									

									<!- -?php } ?>

									</select-->

										

									</div>	

								</div>

								<div class="col-sm-1 text-center">

									<div style="margin-top:10px;" class=" <?php if(form_error('department-id')) echo 'has-error'; ?>">

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



	<div class="row" id="printablediv">

		<div class="col-sm-12">

			<div class="ibox float-e-margins">

				<div class="ibox-title">

					<h5><span class="text-capitalize">Academic Progress Report</span></h5>

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

								<tr>

									<?php 

										$i=0;
									    if(!empty($lists)){
										foreach ($lists as $list) {

											$i++

									?>

									<th class="text-center">Semester - <?= $list->semester_name." || Branch - ".$list->branch_code." || Subject - ".$list->subject_name ?></th>

									<?php

										break;

									 }  }?>

								</tr>

							</tbody>

						</table>

						<table id="day_statement" class="table table-striped table-bordered table-hover ">

							<thead>

								<tr>

									<th>S. No.</th>

									<th>Employee Info</th>

									<th>Subject</th>

									<th>Subject Unit</th>

									<th>Start Date</th>

									<th>End Date</th>

									<th>Lecture Delivered</th>
									<th>Lecture Required</th>

								</tr>

							</thead>

							<?php if(!empty($lists)): ?>

							<tbody>

							<?php 
								$total_lect = '';
								$total_req_lect = '';
								$i=0; foreach ($lists as $list) : $i++; 
								$total_lect += $list->count_unit;
								$total_req_lect += $list->lecture_required;
							?>

								

								<tr>

									<td>

										<?php  echo '<span class="badge badge-primary"><strong>'.$i.' .</strong></span>'; ?>

									</td>

									<td>

										<?= htmlspecialchars($this->mdl_employee->get($list->employee_id)->emp_name." - ".$this->mdl_employee->get($list->employee_id)->employee_id,ENT_QUOTES,'UTF-8') ?>

									 </td>

									

									<td><?= htmlspecialchars($this->mdl_subject->get($list->fk_subject_id)->subject_name." - ".$this->mdl_subject->get($list->fk_subject_id)->subject_code,ENT_QUOTES,'UTF-8') ?></td></td>

									<td>

										<?= htmlspecialchars($this->mdl_subject_unit->get($list->unit)->unit_number,ENT_QUOTES,'UTF-8') ?>

									</td>

									<td>

										<?= htmlspecialchars(date('d-m-Y',strtotime($list->startDt)),ENT_QUOTES,'UTF-8') ?>

									</td>

									<td>

										<?= htmlspecialchars(date('d-m-Y',strtotime($list->endDt)),ENT_QUOTES,'UTF-8') ?>

									</td>

									<td>

										<?=

											htmlspecialchars($list->count_unit,ENT_QUOTES,'UTF-8')  

											//echo $unit_count = $this->mdl_super_Admin->count_subject_unit($list->unit);



										?>

									</td>
									<td>
										<?= htmlspecialchars($list->lecture_required,ENT_QUOTES,'UTF-8') ?>
										
									</td>

								</tr>

								<?php endforeach; ?>

							</tbody>

							<tfoot>
								<tr><th colspan="6" class="text-right">Total</th>
									<td><?= $total_lect ?></td>
									<td><?= $total_req_lect ?></td>
								</tr>
								<tr>

									<th colspan="8" class=" text-center"> <button onclick="printDiv('printablediv')">Print Report</button></th>

								</tr>

							</tfoot>

							<?php endif; ?>							

						</table>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

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