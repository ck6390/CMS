<!-- page -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/attendance.js"></script>
<style>
	td > input[type="checkbox"] {
		margin-top: 1px!important;
		cursor: pointer;
		width: 30px;
		height: 30px;
		-moz-transform: scale(2); /* FF */
		border-width: 0;
		transition: all .3s linear;
	}
	.presentChkBox, .absentChkBox { float: left; }

	div[id="leave"], div[id="timing"] { display: none; }
	input[class="absentChkBox"]:checked ~ div[id="leave"] { display:block; }
	input[class="presentChkBox"]:checked ~ div[id="timing"] { display:block; }
</style>
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
	
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Lecture Detail</h5>
					<div class="ibox-tools">
						<small><code>*</code> Required Fields.</small>
					</div>
				</div>
				<div class="ibox-content">
					<table class="table table-bordered table-hover">
						<tbody>
		                    <tr>
		                       <td><strong>Subject</strong></td>
		                       <td>
		                       		<h4 class="text-info">
		                       			<strong>
		                       			<?php echo $info->subject_name; ?>
		                       			</strong>
		                       		</h4>
		                       	</td>
		                       	<td><strong>Lecture Date</strong></td>

		                       	<td><?php echo $this->misc->reformatDate(date('Y-m-d')); ?></td> 
		                    </tr>

		                    <tr>
		                    	<td><strong>Lecturer (Employee)  Name</strong></td>
		                       	<td><?php echo $info->emp_name ." - ". $info->username;  ?></td>
		                       	<td><strong>Period</strong></td>
		                       <td>
		                       <?php echo $info->period_name;  ?>
		                       </td> 
		                    </tr>

		                    <tr>
		                       <td><strong>Semester</strong></td>
		                       <td>
		                       <?php echo $info->semester_name; ?>
		                       </td>
		                       <td><strong>Branch</strong></td>
		                       <td><?php echo $info->branch_code; ?>
		                       </td>  
		                    </tr>
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Set Attadance</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					
					<div class="table-responsive">
						<?php
						$attr = array(
							'role' => 'form',
							'method' => 'post',
							'name' => 'form',
							'class' => 'form-horizontal'
						);
						echo form_open($this->misc->_getClassName()."/lecture_student_attadance/{$info->employee_id}/{$info->lecture_p_id}", $attr); ?>
						<div class="row">

						</div>
						<input type="hidden" name="faculty-id" value="<?php echo $info->employee_id; ?>">
							<table class="table table-striped table-bordered table-hover dataTablesView1">
								<thead>
									<tr>
										<th width="10%">Sr No.</th>
										<th width="10%">STUDENT ROLL</th>
										<th width="10%">STUDENT ID</th>
										<th width="25%">STUDENT NAME</th>
										<th width="40%">
											<label class="">
												<input type="checkbox" class="selectedChkBox" id="presentAll"> ATTENDANCE 
											</label>
										</th>
										<th width="25%">
											<label class="">
												<input type="checkbox" class="selectedChkBox" id="absentAll"> ABSENT 
											</label>
										</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								//$lists =  $this->mdl_lecture->student_list($info->fk_branch_id,$info->fk_semester_id);
								$i = 0;

								//var_dump($lists);
								foreach ($lists as $list) { $i++;?>
									<tr>
										<td><?= "<span class='badge badge-primary'>".htmlspecialchars($i,ENT_QUOTES,'UTF-8')."</span>" ?></td>
										<td><?= "<span class='badge badge-primary'>".htmlspecialchars($list['student_roll'],ENT_QUOTES,'UTF-8')."</span>" ?></td>

										<td><?= "<span class='badge badge-primary'>".htmlspecialchars($list['student_unique_id'],ENT_QUOTES,'UTF-8')."</span>" ?></td>
										<td>
											<input type="hidden" name="student_id[]" value="<?php echo $list['student_p_id'] ?>" />
											<input type="hidden" name="lecture_id" value="<?php echo $info->lecture_p_id ?>" />
											<?= "<strong>".htmlspecialchars($list['student_full_name'],ENT_QUOTES,'UTF-8')."</strong>" ?>
										</td>
										<td>
											<input type="checkbox" name="attendance[]" id="<?= $list['student_p_id'] ?>" <?php if($list['attandance'] == "P"){
												echo "checked"; }; ?> value="P" class="presentChkBox"/>
										</td>
										<td>
											<input type="checkbox" name="attendance[]" id="<?= $list['student_p_id'] ?>" <?php if($list['attandance'] == "A"){
												echo "checked"; }; ?> value="A" class="absentChkBox" />
										</td>
									</tr>
								<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<th width="10%">Sr No.</th>
										<th width="10%">STUDENT ROLL</th>
										<th>STUDENT ID</th>
										<th>STUDENT NAME</th>
										<th>ATTENDANCE</th>
										<th>ABSENT</th>
									</tr>
								</tfoot>
							</table>

							<div class="hr-line-dashed"></div>

							<div class="text-right">
								<button type="submit" class="btn bg-danger"> <i class="fa fa-save"></i> Update</button>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>


<script type="text/javascript">
$(document).ready(function() {
	
	$('select[name="unit-id"]').on('change', function() {
		var unitID = $(this).val();
		var empID = $('input[name="emp-id"]').val();
		var subjectID = $('input[name="subject-id"]').val();
		var formData = {'unitID':unitID,'empID':empID,'subjectID':subjectID};
		if(unitID!=null){
			$.ajax({
			url: base_url + "index.php/ajax/unit_details",
			data : formData,
			type: "POST",
			success:function(data)
			{	
				$("#Dt").val(data);
			}
		});	
		}else{
			$("#Dt").val('');	
		}
		
		
	});

    $('.dataTablesView1').DataTable( {
        "order": [[ 2, "asc" ]],
        "pageLength": 100       
    } );
});
</script>