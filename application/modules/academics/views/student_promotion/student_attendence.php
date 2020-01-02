<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				Academics
				<!-- <a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a> -->
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}/student_profile/{$info->student_p_id}") ?>"><span class="text-capitalize"> Student Profile</span></a>
			</li>
			<li class="active">
				<strong>Attendence</strong>
			</li>
		</ol>
	</div>
	
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Student Detail</h5>
                </div>
	            <div class="ibox-content no-padding border-left-right">
	                <img alt="image" class="img-responsive img-thumbnail" style="    width: 100%;height: 207px;"src="http://192.168.2.50/manoj/ciGANGA/assets/img/P140008.jpg">

	                <img alt="image" class="img-responsive img-thumbnail m-t" src="http://192.168.2.50/manoj/ciGANGA/assets/img/s140008.jpg">

	            </div>
	            <div class="ibox-content profile-content">
	                <h4><strong><?php echo $info->student_full_name; ?></strong></h4>
	                <h5><strong>Student ID</strong></h5>
	                <h4 class="text-info"><strong><?php echo $info->student_unique_id; ?></strong></h4>
	                <h5><strong>Admission No.</strong></h5>
	                <h4 class="text-info"><strong><?php echo $info->admission_no; ?></strong></h4>
	                <div class="bg-danger p-xs b-r-sm"> Admin Due : <?php echo $fee_dues->due_amount ? $fee_dues->due_amount : 0.00; ?>  </div>
                    <div class="bg-danger p-xs b-r-sm m-t"> Library Fine : <?php echo $library_dues->library_fine ? $library_dues->library_fine : 0.00; ?>  </div>
	                
	            </div>
	        </div>    
    	</div>
    	<div class="col-md-9">
		    <div class="row">
				<div class="col-sm-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Class Attendence </h5>
							<div class="ibox-tools">
								<small><code>*</code> Required Fields.</small>
							</div>
						</div>

						<div class="ibox-content">
							<?php
							$attr = array(
								'role' => 'form',
								'method' => 'post',
								'name' => 'add-form',
								'class' => 'form-horizontal'
							);
							echo form_open("{$this->misc->_getClassName()}/attendence/{$info->student_p_id}", $attr); ?>

							<div class="col-md-12">
								<div class="form-group <?php if(form_error('session')) echo 'has-error'; ?>">
									<?php echo form_label('Session <small class="text-danger">*</small>', 'session');

									$_session = $this->mdl_session->dropdown('session_name');

										echo form_dropdown(array(
											'name' => 'session',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_session);

										echo form_error('session'); ?>
								</div>

								<div class="form-group <?php if(form_error('subject-code')) echo 'has-error'; ?>">
									<?php echo form_label('Subject Code <small class="text-danger">*</small>', 'subject-code');

										echo form_input(array(
											'type' => 'text',
											'name' => 'subject-code',
											'class' => 'form-control',
											'placeholder' => 'Subject Code',
											'value' => set_value('subject-code'),
											'required' => 'true'
										));

										echo form_error('subject-code'); ?>
								</div>

								<div class="form-group <?php if(form_error('attend-class')) echo 'has-error'; ?>">
									<?php echo form_label('Total Attend Class <small class="text-danger">*</small>', 'attend-class');

										echo form_input(array(
											'type' => 'text',
											'name' => 'attend-class',
											'class' => 'form-control',
											'placeholder' => 'Total Attend Class',
											'value' => set_value('attend-class'),
											'required' => 'true'
											
										));

										echo form_error('attend-class'); ?>
								</div>

								<div class="form-group <?php if(form_error('month')) echo 'has-error'; ?>">
									<?php echo form_label('Month <small class="text-danger">*</small>', 'month');

										echo form_input(array(
											'type' => 'text',	
											'name' => 'month',
											'class' => 'form-control date-own',
											'placeholder' => '2019',
											'id' => 'start_session_year',
											'value' => set_value('month'),
											'required' => 'true'
										));

										echo form_error('month'); ?>
								</div>

								<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
									<?php echo form_label('Remarks', 'remarks');

										echo form_input(array(
											'type' => 'text',
											'name' => 'remarks',
											'class' => 'form-control',
											'placeholder' => 'Remarks',
											'value' => set_value('remarks')
											
										));

										echo form_error('remarks'); ?>
								</div>
							</div>
							<!-- <div class="hr-line-dashed"></div> -->
							<div class="text-right">
								<button class="btn btn-primary" type="submit">Save</button>
							</div>
							<?php echo form_close(); ?>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- <div class="row animated fadeInRight">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List Of Class Attend By Student</h5>
                </div>
                <div class="ibox-content">
                	<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Fee Type </th>
									<th>Remarks</th>
									<th>Amount</th>
									<th>Due Date</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="4"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								$i = 0;
								foreach ($lists as $list) { $i++; ?>
								<tr>
									<td><?php echo $i ;?></td>
									<td>
										<strong><?= htmlspecialchars($list->fee_type_name,ENT_QUOTES,'UTF-8') ?></strong>
									</td>

									<td><?= htmlspecialchars($list->remarks,ENT_QUOTES,'UTF-8') ?></td>

									<td><?= htmlspecialchars($list->fine_amount,ENT_QUOTES,'UTF-8') ?></td>
									
									<td><?= htmlspecialchars($list->due_date,ENT_QUOTES,'UTF-8') ?></td>
									
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Fee Type </th>
									<th>Remarks</th>
									<th>Amount</th>
									<th>Due Date</th>
								</tr>
							</tfoot>
						</table>
					</div>
                </div>
            </div>
        </div>
    </div> -->
</div>

<script type="text/javascript">
$(document).ready(function() {

    $('.date-own').datepicker({
     	minViewMode: "months",
     	startView: "year", 
   		format: "MM-yyyy"
   	});
});
</script>
