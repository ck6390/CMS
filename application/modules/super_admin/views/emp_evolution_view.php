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
		                    		<th class="text-center">PERFORMANCE REPORT TEACHING </th>
		                    		<th><span class="text-right">Date : <?php echo date('d-m-Y'); ?> </span></th>
		                    	</tr>
			                    <tr>
			                    	<td><strong>Employee Name</strong></td>
			                       	<td><?php echo $info->emp_name." ( ".$info->username." ) "; ?></td>
			                    </tr>
			                    <tr>
			                    	<td><strong>Department</strong></td>
									<td><?php echo $this->mdl_dept->get($info->emp_department_ID)->dept_name; ?></td>
			                    </tr>
			                    <tr>
			                    	<td><strong>Designation</strong></td>
			                       	<td><?php echo $this->mdl_desg->get($info->emp_designation_ID)->desg_name; ?></td>
			                    </tr>
			                    <tr>
			                    	<td><strong>Joined Date</strong></td>
			                       	<td><?php echo date('d-m-Y',strtotime($info->emp_joined_date)); ?></td>
			                    </tr>
			                    <tr>
			                    	<td><strong>Review Period</strong></td>
			                       	<td><?php $financial_year = get_financial_year(); 
			                       		//print_r($financial_year);
			                       		echo '01-'.$financial_year->start_month.'-'.$financial_year->start_year.' to 30-'.$financial_year->end_month.'-'.$financial_year->end_year;
			                       		?>
			                       	</td>
			                    </tr>
			                    <tr>
			                    	<td><strong>Evaluation Purpose</strong></td>
			                       	<td></td>
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
									<td class="col-md-3">
										<?php echo $clients_appraisal->tech_skill;?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('AVERAGE NO OF STUDENT CLEAR THE RESPECTIVE SUBJECT IN SEMESTER ', 'avg_stu_sub_sem');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3">
										<?php echo $clients_appraisal->avg_stu_sub_sem;?>
									</td>
								</tr>
								<tr>
									<td><?php //EXTRA CORECULAM ACTIVITY
									 echo form_label('INVOLVEMENT IN EXTRACARICULAM ACTIVITY', 'inv_ext_act');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3">
										<?php echo $clients_appraisal->inv_ext_act; ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('DEDICATION TOWARDS INSTITUTION ', 'dedi_towadrs_insti');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 ">
										<?php echo $clients_appraisal->dedi_towadrs_insti; ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('STUDENT FACULTY RELATION', 'stud_fac_rel');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3 ">
										<?php echo $clients_appraisal->stud_fac_rel; ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('LATE ATTENDANCE', 'moral_behaviors');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3">
										<?php echo $clients_appraisal->moral_behaviors; ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('NUMBER OF STUDENT PERSENT IN CLASS ', 'no_of_stud_in_class');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3">
										<?php echo $clients_appraisal->no_of_stud_in_class; ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('CASUAL LEAVE');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3">
										<?php echo $clients_appraisal->casual_leave; ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('LEAVE WITHOUT PAY', 'leave_without_pay');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3">
										<?php echo $clients_appraisal->leave_without_pay; ?>
									</td>
								</tr>
								<tr>
									<td><?php echo form_label('YEAR OF EXPERIENCE IN GANGA MEMORIAL COLLEGE OF POLYTECHNIC', 'experience');?></td>
									<td class="total_point">10</td>
									<td class="col-md-3">
										<?php echo $clients_appraisal->experience; ?>
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
									<th class="text-right">Obtained Point</th>
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
											'value' => set_value('total_obt_sum',$clients_appraisal->total_points),
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
										?>
									</th>
								</tr>
								<tr>
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
									<th colspan="3">Date : <?php // echo date('d-m-Y'); ?></th>
								</tr>
							</tfoot>
						</table>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	@media print {
	
	}
</style>
 <div class="wrapper wrapper-content text-right">
	<input type="button" onclick="printDiv('printableArea')" value="Print" class="btn btn-info" />
</div>
<!-- <script>
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
		var sum = 0;
	    $('.total_obt_point').each(function(){
		    if($(this).val() != ''){
		       sum += parseFloat($(this).val());
		    }
	    });	    
	    $(".total_obt_sum").val(sum);
	}

});
</script> -->
<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
</script>