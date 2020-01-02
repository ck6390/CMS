<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize">Fee Structure</span></h2>
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
		'name' => 'add-form',
		'class' => 'form-horizontal'
	);
	echo form_open("accounting/{$this->misc->_getClassName()}/add", $attr); ?>

		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Generate Fee Structure</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								
								<div class="col-md-3 ">
									<div class="col-md-12">
										<div class="form-group ">
									
											<?php echo form_label('Fee Structure Title', 'fee-title');
											
											echo form_input(array(
												'name' => 'fee-title',
												'class' => 'form-control',
												'placeholder' => 'Fee title',
												'required' => 'true'
											));

											echo form_error('fee-title'); ?>
										</div>
									</div>
								</div>
								<div class="col-md-3 ">
									<div class="col-md-12">
									<div class="form-group ">
								
										<?php echo form_label('Session <small class="text-danger">*</small>', 'year');
								
										$_session = $this->mdl_session->dropdown('session_name');
										
										echo form_dropdown(array(
											'name' => 'session',
											'class' => 'form-control select2_one'
										), $_session);

										echo form_error('session'); ?>
									</div>
									</div>
								</div>
								<div class="col-md-3 ">
									<div class="col-md-12">
										<div class="form-group ">
									
											<?php echo form_label('Fee Structure Type <small class="text-danger">*</small>', 'fee-type');
											$feetypes = array(
												'' => 'Please Select',
												'annual' => 'Annual',
												'semester' => 'Semester'
											);
											echo form_dropdown(array(
												'name' => 'fee-type',
												'class' => 'form-control select2_one'
											), $feetypes);
											echo form_error('fee-type'); ?>
										</div>
									</div>
								</div>
								<div class="col-md-3 " id="courseYear">
									<div class="col-md-12">
										<div class="form-group ">
									
											<?php echo form_label('Course Year <small class="text-danger">*</small>', 'year');
											$_course_year = $this->mdl_course_year->dropdown('course_year_name');
											echo form_dropdown(array(
												'name' => 'year',
												'class' => 'form-control select2_one'
											), $_course_year);
											echo form_error('year'); ?>
										</div>
									</div>
								</div>
								<div id="semesterFee">
									<div class="col-md-3 " >
										<div class="col-md-12">
											<div class="form-group ">
										
												<?php echo form_label('Course Year <small class="text-danger">*</small>', 'course-year');
												$_course_year = $this->mdl_course_year->dropdown('course_year_name');
												echo form_dropdown(array(
													'name' => 'course-year',
													'class' => 'form-control select2_one'
												), $_course_year);
												echo form_error('course-year'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-3 " >
										<div class="col-md-12">
											<div class="form-group ">
										
												<?php echo form_label('Semester <small class="text-danger">*</small>', 'semester-id');
												$semester = $this->mdl_semester->dropdown('semester_name');
												echo form_dropdown(array(
													'name' => 'semester-id',
													'class' => 'form-control select2_one'
												), $semester);
												echo form_error('semester-id'); ?>
											</div>
										</div>
									</div>
									<div class="col-md-3 ">
										<div class="col-md-12">
											<div class="form-group ">
										
												<?php echo form_label('Semester Fee<small class="text-danger">*</small>', 'semester-fee');
												$semesterFee = array(
													'' => 'Please Select',
													'20' => 'Semester Fee',
												);
												echo form_dropdown(array(
													'name' => 'semester-fee',
													'class' => 'form-control select2_one'
												), $semesterFee);
												echo form_error('semester-fee'); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="hr-line-dashed"></div>
						<div class="row">
							<div class="col-sm-12">
								<div id="feeTypeList">
									
								</div>
								<div class="col-md-6 ">
									<div class="col-md-12">
										<div class="form-group ">
									
										<?php echo form_label('Other fee', 'other-fee');
										
										echo form_input(array(
											'name' => 'other-fee',
											'class' => 'form-control fee',
											'placeholder' => 'other fee'
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
<script type="text/javascript">
$(document).ready(function() {
	$('select[name="fee-type"]').on('change', function() {
		var feeStructuretype = $(this).val();
		if(feeStructuretype == "annual"){
			$('#courseYear').show();
			$('#semesterFee').hide();
	
		}else{
			$('#courseYear').hide();	
			$('#semesterFee').show();
			$('#feeTypeList').empty();
		
		}
	});
	$('#semesterFee').hide();
	$('#courseYear').hide();


	$('select[name="semester-fee"]').on('change', function() {
		var semestersFee = $(this).val();
		$.ajax({
				url: base_url + "index.php/accounting/fee_structures/get_semester_fee/",
				type: "POST",
				data: {semestersFee:semestersFee},
				success:function(data)
				{	

					$('#feeTypeList').empty();
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {
							var inputName = this.fee_type_name;
							var name = inputName.toLowerCase();
							var firstWord=name.split(" ");
							$('#feeTypeList').append('<div class="col-md-6 "><div class="col-md-12"><div class="form-group "><label for='+firstWord[0]+'>'+this.fee_type_name+' <small class="text-danger">*</small></label><input type="text" name='+firstWord[0]+' value='+this.fee_type_amount+' class="form-control fee"  required="true"></div></div></div>');

								var sum = 0;
								$(".fee").each(function(){
									sum += +$(this).val();
								});
								$(".total").val(sum);
							});
					} else {
						
					}
				}
			});

	});
	$('select[name="year"]').on('change', function() {
		var year = $(this).val();
		if(year) {
			$.ajax({
				url: base_url + "index.php/accounting/fee_structures/get_fee/",
				type: "POST",
				data: {year:year},
				success:function(data)
				{	

					$('#feeTypeList').empty();
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {
							var inputName = this.fee_type_name;
							var name = inputName.toLowerCase();
							var firstWord=name.split(" ");
							$('#feeTypeList').append('<div class="col-md-6 "><div class="col-md-12"><div class="form-group "><label for='+firstWord[0]+'>'+this.fee_type_name+' <small class="text-danger">*</small></label><input type="text" name='+firstWord[0]+' value='+this.fee_type_amount+' class="form-control fee"  required="true"></div></div></div>');

								var sum = 0;
								$(".fee").each(function(){
									sum += +$(this).val();
								});
								$(".total").val(sum);
							});
					} else {
						
					}
				}
			});
			
		} else {
			$('#feeTypeList').append('<h3>Please Select Admission Fee Group</h3>')
		}


	});

	
});
</script>
<script >
$(document).on("blur", ".fee", function() {		
	var sum = 0;
	$(".fee").each(function(){
		sum += +$(this).val();
	});
	$(".total").val(sum);
});
</script>