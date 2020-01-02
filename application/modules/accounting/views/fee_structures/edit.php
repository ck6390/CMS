<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Accounting</a>
			</li>
			<li>
				<a href="<?= site_url("accounting/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= $this->misc->_getMethodName(); ?></strong>
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
		'name' => 'edit-form',
		'class' => 'form-horizontal'
	);
	echo form_open("accounting/{$this->misc->_getClassName()}/edit/{$info->fee_structure_p_id}", $attr); ?>
	<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Fee [<?=  $info->fee_structure_title ?>]</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								
								<div class="col-md-4 ">
									<div class="col-md-12">
										<div class="form-group ">
									
											<?php echo form_label('Fee Structure Title', 'fee-title');
											
											echo form_input(array(
												'name' => 'fee-title',
												'class' => 'form-control',
												'placeholder' => 'Fee title',
												'required' => 'true',
												'value' => set_value('tution-fee', $info->fee_structure_title),
											));

											echo form_error('fee-title'); ?>
										</div>
									</div>
								</div>
								<div class="col-md-4 ">
									<div class="col-md-12">
									<div class="form-group ">
								
										<?php echo form_label('Session <small class="text-danger">*</small>', 'year');
								
										$_session = $this->mdl_session->dropdown('session_name');
										
										echo form_dropdown(array(
											'name' => 'session',
											'class' => 'form-control select2_one'
										), $_session,$info->session_ID);

										echo form_error('session'); ?>
									</div>
									</div>
								</div>
								<div class="col-md-4 ">
									<div class="col-md-12">
										<div class="form-group ">
									
											<?php echo form_label('Course Year <small class="text-danger">*</small>', 'year');
											$_course_year = $this->mdl_course_year->dropdown('course_year_name');
											echo form_dropdown(array(
												'name' => 'year',
												'class' => 'form-control select2_one'
											), $_course_year,$info->course_year);
											echo form_error('year'); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-md-6 b-r">
									<div class="col-md-12">
										

										<div class="form-group <?php if(form_error('tution-fee')) echo 'has-error'; ?>">
											<?php
											echo form_label('Tution Fee <small class="text-danger">*</small>', 'tution-fee');
											echo form_input(array(
												'type' => 'text',
												'name' => 'tution-fee',
												'class' => 'form-control fee',
												'value' => set_value('tution-fee', $info->tution_fee),
												'required' => 'true'
											));

											echo form_error('tution-fee'); ?>	
										</div>

										<div class="form-group <?php if(form_error('library-fee')) echo 'has-error'; ?>">
											<?php
											echo form_label('Library Fee <small class="text-danger">*</small>', 'library-fee');
											echo form_input(array(
												'type' => 'text',
												'name' => 'library-fee',
												'class' => 'form-control fee',
												'value' => set_value('library-fee', $info->library_fee),
												'required' => 'true'
											));

											echo form_error('library-fee'); ?>	
										</div>

										<div class="form-group <?php if(form_error('exam-fee')) echo 'has-error'; ?>">
											<?php
											echo form_label('Exam Fee (Internal)  <small class="text-danger">*</small>', 'exam-fee');
											echo form_input(array(
												'type' => 'text',
												'name' => 'exam-fee',
												'class' => 'form-control fee',
												'value' => set_value('exam-fee', $info->exam_fee_internal),
												'required' => 'true'
											));

											echo form_error('exam-fee'); ?>	
										</div>

										<div class="form-group <?php if(form_error('medical-exam-fee')) echo 'has-error'; ?>">
											<?php
											echo form_label('Medical Exam. Fee  <small class="text-danger">*</small>', 'medical-exam-fee');
											echo form_input(array(
												'type' => 'text',
												'name' => 'medical-exam-fee',
												'class' => 'form-control fee',
												'value' => set_value('medical-exam-fee', $info->medical_exam_fee),
												'required' => 'true'
											));

											echo form_error('medical-exam-fee'); ?>	
										</div>

										<div class="form-group <?php if(form_error('miscellaneous-fee')) echo 'has-error'; ?>">
											<?php
											echo form_label('Miscellaneous Fee  <small class="text-danger">*</small>', 'miscellaneous-fee');
											echo form_input(array(
												'type' => 'text',
												'name' => 'miscellaneous-fee',
												'class' => 'form-control fee',
												'value' => set_value('miscellaneous-fee', $info->miscellaneous_fee),
												'required' => 'true'
											));

											echo form_error('miscellaneous-fee'); ?>	
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-12">

										<div class="form-group <?php if(form_error('admission-fee')) echo 'has-error'; ?>">
											<?php
											echo form_label('Admission Fee <small class="text-danger">*</small>', 'admission-fee');
											echo form_input(array(
												'type' => 'text',
												'name' => 'admission-fee',
												'class' => 'form-control fee',
												'value' => set_value('admission-fee', $info->admission_fee),
												'required' => 'true'
											));

											echo form_error('admission-fee'); ?>	
										</div>

										
										<div class="form-group <?php if(form_error('magazine-fee')) echo 'has-error'; ?>">
											<?php
											echo form_label('Magazine Fee <small class="text-danger">*</small>', 'magazine-fee');
											
											echo form_input(array(
												'type' => 'text',
												'name' => 'magazine-fee',
												'class' => 'form-control fee',
												'value' => set_value('library-fee', $info->magazine_fee),
												'required' => 'true'
											));

											echo form_error('magazine-fee'); ?>	
										</div>

										<div class="form-group <?php if(form_error('sports-fee')) echo 'has-error'; ?>">
											<?php
											echo form_label('Sports', 'sports-fee');
											echo form_input(array(
												'type' => 'text',
												'name' => 'sports-fee',
												'class' => 'form-control fee',
												'value' => set_value('library-fee', $info->sports_fee),
											));

											echo form_error('sports-fee'); ?>
										</div>

										<div class="form-group <?php if(form_error('development-fee')) echo 'has-error'; ?>">
											<?php
											echo form_label('Development & Establishment Fee', 'sports-fee');
											echo form_input(array(
												'type' => 'text',
												'name' => 'development-fee',
												'class' => 'form-control fee',
												'value' => set_value('development-fee', $info->developement_fee),
											));

											echo form_error('development-fee'); ?>
										</div>
										<div class="form-group <?php if(form_error('other-fee')) echo 'has-error'; ?>">
											<?php
											echo form_label('Other Fee', 'other-fee');
											echo form_input(array(
												'type' => 'text',
												'name' => 'other-fee',
												'class' => 'form-control fee',
												'value' => set_value('other-fee', $info->other_fee),
											));

											echo form_error('other-fee'); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-md-6 ">
									<div class="col-md-12">
										<div class="form-group ">
									
										<?php echo form_label('Total fee<small class="text-danger">*</small>', 'total-fee');
										
										echo form_input(array(
											'name' => 'total-fee',
											'class' => 'form-control total',
											'placeholder' => 'total fee',
											'value' => set_value('other-fee', $info->total_fee),
											'required' => 'true',
										));

										echo form_error('total-fee'); ?>
										</div>
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
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
<script >
$(document).on("blur", ".fee", function() {		
	var sum = 0;
	$(".fee").each(function(){
		sum += +$(this).val();
	});
	$(".total").val(sum);
});
</script>