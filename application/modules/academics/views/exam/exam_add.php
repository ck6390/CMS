<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Academics</li>
			<li>
				<a href="<?= site_url("academics/student_profile/{$info->student_p_id}") ?>"><span class="text-capitalize">Student profile<!-- <?= $this->misc->_getClassName(); ?> --></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getMethodName()); ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		
	</div>
</div>

<!-- page -->
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Student Detail</h5>
                </div>
                <div>
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
                        <div class="bg-danger p-xs b-r-sm"> Admin Due : 200.00 </div>
                        <div class="bg-danger p-xs b-r-sm m-t"> Library Fine : 15.00 </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
				<div class="col-sm-12">
					<div class="ibox float-e-margins">
						<div class="ibox-content">
							<div class="wrapper wrapper-content">
								<?php
								$attr = array(
									'role' => 'form',
									'method' => 'post',
									'name' => 'add-form',
									'class' => 'form-horizontal'
								);
								echo form_open("{$this->misc->_getClassName()}/exam_add", $attr); ?>
									
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Apply New Form</h5>
										<div class="ibox-tools">
											<small><code>*</code> Required Fields.</small>
										</div>
									</div>
									<div class="ibox-content">
										<div class="row">
											<div class="col-md-6 b-r">
												<div class="col-md-12">
													<div class="form-group <?php if(form_error('student-id')) echo 'has-error'; ?>">
														<?php echo form_label('Student ID <small class="text-danger">*</small>', 'student-id');

														echo form_input(array(
															'type' => 'text',
															'name' => 'student-id',
															'class' => 'form-control',
															'placeholder' => 'Student ID',
															'value' => set_value('student-id', $info->student_unique_id),
															'required' => 'true'
														));

														echo form_error('student-id'); ?>
													</div>
													<div class="form-group <?php if(form_error('fee-group')) echo 'has-error'; ?>">
														<?php echo form_label('Group <small class="text-danger">*</small>', 'fee-group');

														$_fee_group = $this->mdl_fee_group->dropdown('fee_group_name');

															echo form_dropdown(array(
																'name' => 'fee-group',
																'class' => 'form-control select2_one',
																'required' => 'true'
															), $_fee_group);

															echo form_error('fee-group'); ?>
													</div>

													<div id="feeTypeDropdown" class="form-group <?php if(form_error('fee-type')) echo 'has-error'; ?>">
														<?php echo form_label('Type <small class="text-danger">*</small>', 'fee-type');
														$_fee_type = $this->mdl_fee_type->dropdown('fee_type_name');

															echo form_dropdown(array(
																'name' => 'fee-type',
																'class' => 'form-control select2_one',
																'required' => 'true'
															), $_fee_type);

															echo form_error('fee-type'); ?>
													</div>

													<div class="form-group <?php if(form_error('fee')) echo 'has-error'; ?>">
														<?php echo form_label('Fee <small class="text-danger">*</small>', 'fee');

															echo form_input(array(
																'type' => 'text',
																'name' => 'fee',
																'class' => 'form-control',
																'placeholder' => 'Fee Amount',
																'value' => set_value('fee'),
																'required' => 'true'
															));

															echo form_error('fee'); ?>
													</div>

													<div class="form-group <?php if(form_error('payment-mode')) echo 'has-error'; ?>">
														
														<?php echo form_label('Payment Mode <small class="text-danger">*</small>', 'payment-mode');

														$_payment = $this->mdl_pay_mode->dropdown('payment_mode_name');

															echo form_dropdown(array(
																'name' => 'payment-mode',
																'class' => 'form-control select2_one'
															), $_payment);

															echo form_error('payment-mode'); ?>
													</div>
													
												</div>
											</div>

											<div class="col-md-6">
												<div class="col-md-12">
													<div class="form-group <?php if(form_error('session')) echo 'has-error'; ?>">
														<?php
														echo form_label('Session <small class="text-danger">*</small>', 'session');

														$_session = $this->mdl_session->dropdown('session_name');
														echo form_dropdown(array(
															'name' => 'session',
															'class' => 'form-control select2_one'
														), $_session, $info->fk_session_id);

														echo form_error('branch'); ?>
																		
													</div>
													<div class="form-group <?php if(form_error('semester')) echo 'has-error'; ?>">
														<?php
														echo form_label('Semester <small class="text-danger">*</small>', 'semester');
														$_semester = $this->mdl_semester->dropdown('semester_name');
														echo form_dropdown(array(
															'name' => 'semester',
															'class' => 'form-control select2_one'
														), $_semester, $info->fk_semester_id);

														echo form_error('semester'); ?>
																		
													</div>

													<div class="form-group <?php if(form_error('subject')) echo 'has-error'; ?>">
														<?php echo form_label('Subject', 'subject');

															echo form_input(array(
																'type' => 'text',
																'name' => 'subject',
																'class' => 'form-control',
																'placeholder' => 'Subject',
																'value' => set_value('subject'),
																'required' => 'true'
															));

															echo form_error('subject'); ?>
													</div>

													<div class="form-group <?php if(form_error('fine')) echo 'has-error'; ?>">
														<?php echo form_label('Fine <small class="text-danger">*</small>', 'fine');
														echo form_input(array(
															'type' => 'text',
															'name' => 'fine',
															'class' => 'form-control',
															'placeholder' => 'Fine',
															'value' => set_value('fine'),
															'required' => 'true'
														));

														echo form_error('fine'); ?>
													</div>
													<div class="form-group <?php if(form_error('ref-number')) echo 'has-error'; ?>">
														<?php echo form_label('Ref. Number', 'ref-number'); 
															echo form_input(array(
																'type' => 'text',
																'name' => 'ref-number',
																'class' => 'form-control',
																'placeholder' => 'Ref. Number',
																'value' => set_value('ref-number'),
																'required' => 'true'
															));

															echo form_error('ref-number'); ?>
													</div>
												</div>
											</div>
										</div>

										<div class="hr-line-dashed"></div>
										<div class="text-right">
											<button class="btn btn-primary" type="submit">Save</button>
										</div>
									</div>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {

	$('select[name="fee-group"]').on('change', function() {
		var feeGroupID = $(this).val();
		if(feeGroupID) {
			$.ajax({
				url: base_url + "index.php/setting/fee_types/get_feeType_list_by_group/" + feeGroupID,
				type: "POST",
				success:function(data)
				{
					$('#feeTypeDropdown .select2_one').select2('val','');
					$('select[name="fee-type"]').html('<option value="" selected="true">== Please select one option ==</option>');
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {
							var option = $('<option />');
							option.attr('value', this.fee_type_p_id).text(this.fee_type_name);
							$('select[name="fee-type"]').append(option);
						});
					} else {
						$('#feeTypeDropdown .select2_one').select2('val','');
					}
				}
			});
		} else {
			$('#feeTypeDropdown .select2_one').select2('val','');
		}
	});


	$('select[name="fee-type"]').on('change', function() {
		var feeTypeID = $(this).val();
		if(feeTypeID) {
			$.ajax({
				url: base_url + "index.php/setting/fee_types/get_feeType_amount/" + feeTypeID,
				type: "POST",
				success:function(data)
				{
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						
						$('input[name="fee"]').attr('value', dataObj.fee_type_amount);
					
					} else {
						$('input[name="fee"]').attr('value', '');
					}
				}
			});
		} else {
			$('input[name="fee"]').attr('value', '');
		}
	});
});
</script>