<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong>Profile</strong>
			</li>
		</ol>
	</div>
</div>
<div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                <div class="col-md-12">
                   <div class="row">
						<div class="col-sm-12">
							<div class="ibox float-e-margins">
								<div class="ibox-title">
									<h5>Student Profile</h5>
								</div>
								<div class="ibox-content" id="dvContainer">
								<div class="table-responsive">
									<div class="col-sm-12 layout-box col-100">
				                        <p class="school">
				                            <div class="center">
				                                <div class="col-xs-12 col-100">
				                                <?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>               
				                                       <img src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>" class="img-thumbnail img-circle logo" width="108px" style="float:left;margin-left:100px;margin-bottom:20px;border-radius: 25px;">
				                                      <p style="font-size:25px;margin-top:10px;margin-left: 230px;padding-top:8px;"><strong> Ganga Memorial College Of Polytechnic</strong></p><p style="margin-left: 250px;margin-top:-9px;" class="addStyle">AT NH-31, HARNAUT, NALANDA, BIHAR - 803110</p>
				                                </div>
				                             </div>                            
				                        </p>
		                    		</div>
		                    	</div>
		                    	
									<table class="table table-bordered table-hover">
			                            <tbody>
			                            	<tr class="trHeight">
			                            	 	<td>
			                            	 		<?php if(!empty($info->student_photo)){?>
			                            	 		<img alt="image" class="stuimg" style="width: 100%;height: 150px;"src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_photo}") ?>">
			                            	 		<?php }?>
			                            	 	</td>                  	 	
			                            	 	
						                    	<td colspan="3">
						                    		<?php if(!empty($info->student_sign)){?>
                              						<img alt="image" class="img-responsive img-thumbnail m-t stuimg" style="width: 40%;height: 150px;margin-top: 0px;" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_sign}") ?>">
                              						<?php } ?>
                              						<?php if(!empty($info->student_left_thumb)){?>
                              						<img alt="image" class="img-responsive img-thumbnail m-t" style="width: 40%;height: 150px;margin-top: 0px;" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_left_thumb}") ?>">
                              						<?php } ?>
						                    	</td>
			                            	 </tr>
			                            	 <tr>
						                    	<td colspan="4"> <h4 class="text-center headStyle"><strong>STUDENT BASIC DETAILS</strong></h4></td>
						                    </tr>
			                            	 <tr>
						                       <td><strong>Student Name</strong></td>
						                       <td><?php echo $info->student_full_name; ?></td>
						                       <td><strong>Contact No</strong></td>
						                       <td><?php echo $info->student_sms_no; ?></td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Date Of Birth</strong></td>
						                       <td><?php echo $info->dob; ?></td>
						                       <td><strong>Email ID</strong></td>
						                       <td><?php echo $info->student_email; ?></td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Gender</strong></td>
						                       <td><?php echo $info->gender; ?></td>
						                       <td><strong>Blood Group</strong></td>
						                       <td><?php echo $info->blood_group; ?></td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Nationality</strong></td>
						                       <td><?php echo $info->nationality; ?></td>
						                       <td><strong>Identification Mark</strong></td>
						                       <td><?php echo $info->identification_mark; ?></td>
						                        
						                    </tr>

						                    <tr>
						                    	<td colspan="4"> <h4 class="text-center headStyle"><strong>COURSE AND COLLEGE DETAILS</strong></h4></td>
						                    </tr>

						                    <tr>
						                       <td><strong>Student Id</strong></td>
						                       <td class="text-info"><strong><?php echo $info->student_unique_id; ?></strong></td>
						                       <td><strong>Admission No.</strong></td>
						                       <td class="text-info"><strong><?php echo $info->admission_no; ?></strong></td>
						                    </tr>
						                    <tr>
						                       <td><strong>Registaion No</strong></td>
						                       <td><?php echo $info->registration_no;?></td>
						                       <td><strong>Roll No</strong></td>
						                       <td><?php echo $info->student_roll; ?></td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Session</strong></td>
						                       <td><?php echo $info->session_name;?></td>
						                       <td><strong>Branch</strong></td>
						                       <td><?php echo $info->branch_code; ?></td>
						                        
						                    </tr>
						                    <tr>
						                    	<td><strong>Admission Date<strong></td>
						                       <td><?php echo $info->admission_date; ?></td>
						                       <td><strong>Semester</strong></td>
						                       <td><?php echo $info->semester_name; ?></td>
						                   </tr>
						                   <tr>
						                    	<td colspan="4"> <h4 class="text-center headStyle"><strong>QUALIFICATION DETAILS</strong></h4></td>
						                    </tr>
						                    <tr>
						                       <td><strong>Name of Exam</strong></td>
						                       <td><strong>Subject/Stream</strong></td>
						                       <td><strong>Year of Passing</strong></td>
						                       <td><strong>Marks%/CGPA</strong></td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Matriculation (10th)<?php echo $info->hsc_board;?><strong></td>
						                       	<td><?php echo $info->hsc_stream; ?></td>
						                       <td><?php echo $info->hsc_passing_year; ?></td>
						                       <td><?php echo $info->hsc_percentage_marks; ?></td>
						                   </tr>
						                   <tr>
						                       <td><strong>Intermediate (12th)<?php echo $info->ssc_board;?><strong></td>
						                       	<td><?php echo $info->ssc_stream; ?></td>
						                       <td><?php echo $info->ssc_passing_year; ?></td>
						                       <td><?php echo $info->ssc_percentage_marks; ?></td>
						                       
						                   </tr>
						                   <tr>
						                       <td><strong>ITI<?php echo $info->graduate_board;?><strong></td>
						                       <td><?php echo $info->graduate_stream; ?></td>
						                       <td><?php echo $info->graduate_passing_year; ?></td>
						                       <td><?php echo $info->graduate_percentage_marks; ?></td>
						                   </tr>
						                   <tr>
						                    	<td colspan="4"> <h4 class="text-center headStyle"><strong>STUDENT DETAILS AND REFERENCE</strong></h4></td>
						                    </tr>
						                   <tr>
						                       <td><strong>Father's Name</strong></td>
						                       <td><?php echo $info->father_name; ?></td>
						                       <td><strong>Mother's Name.</strong></td>
						                       <td><?php echo $info->father_name; ?></td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Parent Contact No</strong></td>
						                       <td><?php echo $info->student_parents_no; ?></td>
						                       <td><strong>Parent Alternate No</strong></td>
						                       <td><?php echo $info->parents_mobile_2; ?></td>
						                    </tr>
						                    <tr>
						                       <td><strong>Local Guardian</strong></td>
						                       <td><?php echo $info->local_guardian; ?></td>
						                       <td><strong>Relationship With Guardian</strong></td>
						                       <td><?php echo $info->guardian_relationship; ?></td>
						                    </tr>
						                    <tr>
						                       <td><strong>Local Address</strong></td>
						                       <td><?php echo $info->l_locality ; ?>,<br>
						                       	<strong>P.O : </strong><?php echo $info->local_post_office ; ?>,<br>
						                       	<strong>District : </strong><?php echo $info->local_district ; ?>,<br>
						                       	<strong>State : </strong><?php echo $info->local_state ."-". $info->local_pin_code; ?><br>
						                       </td>
						                       <td><strong>Permanent Address</strong></td>
						                       <td><?php echo $info->p_locality ; ?>,<br>
						                       	<strong>P.O : </strong><?php echo $info->p_post_office ; ?>,<br>
						                       	<strong>District : </strong><?php echo $info->p_district ; ?>,<br>
						                       	<strong>State : </strong><?php echo $info->p_state ."-". $info->p_pin_code; ?><br>
						                       </td>
						                        
						                    </tr>

						                    <!-- <tr>
						                    	<td colspan="4"> <h4 class="text-center headStyle"><strong>PAYMENT DETAILS</strong></h4></td>
						                    </tr>
						                    <tr>
						                       <td><strong>DD/CHEQU No.</strong></td>
						                       <td><?php //echo $info->registration_no;?></td>
						                       <td><strong>Date</strong></td>
						                       <td><?php //echo $info->student_roll; ?></td>
						                        
						                    </tr>
						                    <tr>
						                       <td><strong>Bank Name</strong></td>
						                       <td><?php //echo $info->session_name;?></td>
						                       <td><strong>IFSC</strong></td>
						                       <td><?php //echo $info->branch_code; ?></td>
						                        
						                    </tr>
						                    <tr>
						                    	<td><strong>Branch Name/place<strong></td>
						                       <td><?php //echo $info->admission_date; ?></td>
						                       <td></td>
						                       <td></td>
						                   </tr> -->
						                   <tr>
						                    	<td colspan="4"> <h4 class="text-center headStyle"><strong>CERTIFICATE DETAILS</strong></h4></td>
						                    </tr>
						                   <tr>
						                       <td><strong>Matriculation</strong></td>
						                       <td colspan="3">
						                       	<?php if(!empty($info->hsc_marksheet)){echo $info->hsc_marksheet == "1" ? "Marksheet" :"";}?><br/>
						                       	<?php if(!empty($info->hsc_slc)){echo $info->hsc_slc == "1" ? "SLC" :"";}?><br/>
						                       	<?php if(!empty($info->hsc_provisional)){echo $info->hsc_provisional == "1" ? "Provisional" :"";}?><br/>
						                       	<?php if(!empty($info->hsc_migration)){echo $info->hsc_migration == "1" ? "Migration" :"";}?><br/>
						                       	<?php if(!empty($info->hsc_admit_card)){echo $info->hsc_admit_card == "1" ? "Admit Card" :"";}?><br/>
						                       	</td>
						                    </tr>
						                    <tr>
						                    	<td><strong>Intermediate<strong></td>
						                       <td colspan="3">
						                       <?php if(!empty($info->ssc_marksheet)){echo $info->ssc_marksheet == "1" ? "Marksheet" :"";}?><br/>
						                       	<?php if(!empty($info->ssc_slc)){echo $info->ssc_slc == "1" ? "SLC" :"";}?><br/>
						                       	<?php if(!empty($info->ssc_provisional)){echo $info->ssc_provisional == "1" ? "Provisional" :"";}?><br/>
						                       	<?php if(!empty($info->ssc_migration)){echo $info->ssc_migration == "1" ? "Migration" :"";}?><br/>
						                       	<?php if(!empty($info->ssc_admit_card)){echo $info->ssc_admit_card == "1" ? "Admit Card" :"";}?><br/>
						                       	</td>
						                   </tr>
			                            </tbody>
			                        </table>
			                        <div class="row no-print">
						                <div class="col-xs-12 text-right">
						                    <button class="btn btn-default hiddens" id="btnPrint"><i class="fa fa-print"></i> <?php echo 'print'; ?></button>
						                </div>
				            		</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>

<script>
    $(document).ready(function(){
        $("#btnPrint").click(function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=8.5in;width=8.5in;');
           printWindow.document.write('<html><head><title></title><style media="print">.hiddens{display:none!important}.table-bordered{border-width: 1px;border-style:solid;border-color: rgb(0, 0, 0);font-size:13px;border-image:initial;margin-top:20px;width:100%;border-collapse:collapse;}.table > thead > tr > th{text-align:left;padding-left:20px;!important;border-width: 1px;border-style:solid;border-color: rgb(0, 0, 0);padding-top:12px!important;padding-bottom:12px!important;},.table > tbody > tr > td{text-align:center;}, .table > tfoot > tr > td{border-top: 1px solid #000!important;}.table-bordered > tbody > tr > th, .table-bordered > t > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td,.table-bordered > tbody > tr > td{border-width: 1px;border-style: solid;border-color: rgb(0, 0, 0);border-image:initial;line-height: 1.22857;vertical-align: top;padding: 2px;padding-left: 2px;}.addStyle{margin-top:-9px!important;}.headStyle{text-align:center;margin-bottom:0px !important;}.stuimg{width:220px !important;height:150px!important;margin-left:4px !important;text-align: center;}</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>