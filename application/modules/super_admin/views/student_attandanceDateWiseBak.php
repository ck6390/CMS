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
	echo form_open("{$this->misc->_getClassName()}/student_attandance", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Student Attendance Report Date Wise</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12">
								<div class="col-sm-1"></div>
								<div class="col-sm-3">
									<div class="col-sm-12">
										<div class=" form-group <?php if(form_error('semester-id')) echo 'has-error'; ?>">
										<?php echo form_label('Student Id<small class="text-danger">*</small>', 'studentid', array('class' => ' control-label'));
											
											
											echo form_input(array(
												'name' => 'studentid',
												'class' => 'form-control',
												'required' => 'true',
												'value' => set_value('studentid')
											));

											echo form_error('studentid'); ?>
											
										</div>	
									</div>
								</div>

								<div class="col-sm-3">
									<div class="col-sm-12">
										<div class="form-group <?php if(form_error('start-date')) echo 'has-error'; ?>" >
										<?php echo form_label('Start Date<small class="text-danger">*</small>', 'start-date', array('class' => 'control-label')); ?>
											<div class="input-group date ">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<?php 
													echo form_input(array(
														'type' => 'text',
														'name' => 'start-date',
														'id' => 'startDate',
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
										<div class="form-group <?php if(form_error('end-date')) echo 'has-error'; ?>">
										<?php echo form_label('End Date', 'end-date', array('class' => 'control-label')); ?>
											<div class="input-group date ">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<?php 
													echo form_input(array(
														'type' => 'text',
														'name' => 'end-date',
														'id' => 'endDate',
														'class' => 'form-control',
														'value' => set_value('end-date')

													));
												?>
												
											</div>
										
											<?php echo form_error('end-date'); ?>
										</div>
									</div>
								</div>
								<div class="col-sm-2">
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

<?php if(!empty($result)){ ?>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table  table-striped table-bordered table-hover day_attandance">
							<tbody>
								<tr>
									<td><strong>Branch</strong></td>
									<td>
										<?= $this->mdl_branch->get($report['branch'])->branch_name; ?>
									</td>
								</tr>
								<!-- <tr>
									<td><strong>Semester</strong></td>
									<td>
										<?= $this->mdl_semester->get($report['fk_semester_id'])->semester_name; ?>
									</td>
								</tr> -->
								<tr>
									<td><strong>Date Range</strong></td>
									<td>
										<?php  if($report['startDate'] != $report['endDate']){
											 echo $this->misc->reformatDate($report['endDate'])." - ".$this->misc->reformatDate($report['startDate']); }
											 else{

											 	echo $this->misc->reformatDate($report['endDate']);
											 }  ?>
									</td>
								</tr>
								<tr>
									<td><strong>No. of Days</strong></td>
									<td>
										<?php 
											$startDt = strtotime($report['startDate']);
											$endDt = strtotime($report['endDate']);
											//$datediff =  $endDt - $startDt;
											
											$timeDiff = abs($endDt - $startDt);
											
											//var_dump($timeDiff);

											$numberDays = $timeDiff/86400;  // 86400 seconds in one day

											// and you might want to convert to integer
											if($startDt != $endDt){
												
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
										<?php echo $report['workingDays']; ?>
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
						<table  class="table  table-striped table-bordered table-hover day_attandance ">
							<thead>
								<tr>
									<th>Sl.No.</th>
									<th>Date</th>
									<th>Student Name</th>
									<th>Semester </th>
									<th>Branch </th>
									<th>Subject</th>
									<th>Period</th>
									<th>Attandance</th>
								</tr>
							</thead>
							<tbody>
							<?php
							//var_dump($result);
							if(count($result) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="4"><strong>NO RECORDS AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								$i= 1;
								foreach ($result as $list) { ?>
								<tr>
									<td><?= $i++ ?></td>
									<td><?= '<span class="badge badge-primary">'.htmlspecialchars($this->misc->reformatDate($list['date']),ENT_QUOTES,'UTF-8').'</span><br/>' ?></td>
									<td><?= '<strong> '.htmlspecialchars($list['name']." [".$list['uniqueId']." ]",ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<strong> '.htmlspecialchars($list['semester_name'],ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list['branch_code'],ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<strong> '.htmlspecialchars($list['subject_name'],ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<strong> '.htmlspecialchars($list['period_name'],ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									<td><?= '<strong> '.htmlspecialchars($list['att_status'],ENT_QUOTES,'UTF-8').'</strong>'; ?></td>

									
									
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Sl.No.</th>
									<th>Date</th>
									<th>Student  Name</th>
									<th>Semester </th>
									<th>Branch </th>
									<th>Subject</th>
									<th>Period</th>
									<th>Attandance</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }else{ ?>
	<h1 class="text-center">No Record Availabe</h1>
<?php } ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	var from = $('#startDate').val();
	
	var to = $('#endDate').val();
	
    $('.day_attandance').DataTable ( {
    	<?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>
       	dom: 'Bfrtip',
	    buttons: [
	       
	        { 
	        	extend: 'print',
	         	footer:true, 
	         	title: '',
	         	 
	         	message: '<table style="margin-top:0;padding-top:0;"class="table table-bordered"><tbody><tr><td><img class="img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>"  style="float:left;border:0;padding:0;width:100px; height:80px;"><div style="width:80%;float:left;text-align:center;display:table;"><h3 style="text-align:center;font-size:20px;margin-bottom:10px;padding-top:8px;"> Ganga Memorial College Of Polytechnic</h3><p >AT NH-31, HARNAUT, NALANDA, BIHAR - 803110</p></div></td></tr><tr class="text-center"><td>Attandance Date : '+from+' To : '+ to+'  </td><tr></tr></tbody></table>',

	         customize: function ( win ) {
	                $(win.document.body)
	                    .css( 'font-size', '10px' )
	                    .css( 'margin-left', '80px' )
	                    .css( 'margin-top', '0px' )
	                $(win.document.body).find( 'table tbody tr td' )
	            	 .css( 'padding', '2px' )
	            	 .css( 'font-size', '12px')
	                $(win.document.body).find( 'table thead' )
	                	 .css( 'font-size', '12px' )
	                $(win.document.body).find( 'table tfoot' )
	                    .css( 'display','table-row-group');
	                $(win.document.body).find( 'table tfoot' )
	                     .css( 'font-size', '12px' )
	            }
	        }
	    ],
        
    } );
} );
</script>