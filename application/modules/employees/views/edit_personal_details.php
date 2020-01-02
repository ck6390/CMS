<!-- personal detail form -->
	<div class="col-sm-12">
		<h4 class="bg-primary p-xs">Personal Details</h4>
	</div>
	<div class="col-md-6 b-r">
		<div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
			<?php
			echo form_label('Full Name <small class="text-danger">*</small>', 'name');

			echo form_input(array(
				'type' => 'text',
				'name' => 'name',
				'class' => 'form-control',
				'placeholder' => 'Full Name',
				'value' => set_value('name', $info->emp_name),
				'required' => 'true'
			));

			echo form_error('name'); ?>
		</div>

		<div class="form-group <?php if(form_error('father-name')) echo 'has-error'; ?>">
			<?php
			echo form_label('Father Name <small class="text-danger">*</small>', 'name');

			echo form_input(array(
				'type' => 'text',
				'name' => 'father-name',
				'class' => 'form-control',
				'placeholder' => 'Father Name',
				'value' => set_value('father-name', $info->father_name),
				'required' => 'true'
			));

			echo form_error('father-name'); ?>
		</div>

		<div class="form-group <?php if(form_error('mother-name')) echo 'has-error'; ?>">
			<?php
			echo form_label('Mother Name <small class="text-danger">*</small>', 'mother-name');

			echo form_input(array(
				'type' => 'text',
				'name' => 'mother-name',
				'class' => 'form-control',
				'placeholder' => 'Mother Name',
				'value' => set_value('mother-name', $info->mother_name),
				'required' => 'true'
			));

			echo form_error('mother-name'); ?>
		</div>

		<div class="form-group <?php if(form_error('dob')) echo 'has-error'; ?>">
			<?php
			echo form_label('Date of Birth <small class="text-danger">*</small>', 'dob');

			echo form_input(array(
				'type' => 'date',
				'name' => 'dob',
				'class' => 'form-control',
				'placeholder' => 'D.O.B.',
				'value' => set_value('dob', $info->emp_dob),
				'required' => 'true'
			));

			echo form_error('date'); ?>
		</div>

		<div class="form-group <?php if(form_error('gender')) echo 'has-error'; ?>">
			<?php
			$options = array(
				'Male' => 'Male',
				'Female' => 'Female',
			);
			echo form_label('Gender <small class="text-danger">*</small>', 'gender');

			echo form_dropdown(array(
				'name' => 'gender',
				'class' => 'form-control',
				'required' => 'true'
			), $options, $info->emp_gender);

			echo form_error('gender'); ?>
		</div>

		<div class="form-group <?php if(form_error('cast-category')) echo 'has-error'; ?>">
			<?php echo form_label('Cast Category <small class="text-danger">*</small>', 'cast-category');

			$_cast_category = $this->mdl_cast_category->dropdown('cast_category');
			
				echo form_dropdown(array(
					'name' => 'cast-category',
					'class' => 'form-control select2_one',
					'value' => set_value('cast-category'),
				),$_cast_category,$info->fk_cast_category);

				echo form_error('cast-category'); ?>
		</div>
		<div class="form-group <?php if(form_error('religion')) echo 'has-error'; ?>">
			<?php
			$options = array(
				'null' => '== Please select one option ==',
				'Hinduism' => 'Hinduism',
				'Islam' => 'Islam',
				'Christianity' => 'Christianity',
				'Sikhism' => 'Sikhism',
				'Buddhism' => 'Buddhism',
				'Jainism' => 'Jainism'
			);
			echo form_label('Religion', 'religion');

			echo form_dropdown(array(
				'name' => 'religion',
				'class' => 'form-control'
			), $options, $info->emp_religion);

			echo form_error('religion'); ?>
		</div>

		<div class="form-group <?php if(form_error('marital-status')) echo 'has-error'; ?>">
			<?php
			$options = array(
				'null' => '== Please select one option ==',
				'Single' => 'Single',
				'Married' => 'Married',
				'Divorced' => 'Divorced'
			);
			echo form_label('Marital Status', 'marital-status');

			echo form_dropdown(array(
				'name' => 'marital-status',
				'class' => 'form-control'
			), $options, $info->emp_marital_status);

			echo form_error('marital-status'); ?>
		</div>

		<div class="form-group">
			<?php
			$options = array(
				'null' => '== Please select one option ==',
				'A+' => 'A+',
				'A-' => 'A-',
				'B+' => 'B+',
				'B-' => 'B-',
				'AB+' => 'AB+',
				'AB-' => 'AB-',
				'O+' => 'O+',
				'O-' => 'O-'
			);
			echo form_label('Blood Group', 'blood-group');

			echo form_dropdown(array(
				'name' => 'blood-group',
				'class' => 'form-control',
				'required' => 'true'
			), $options, $info->emp_blood_group); ?>
		</div>
	</div>

	<div class="col-md-6">
		
		<input type="hidden" name="emp-photo" value="<?= $info->emp_photo ?>"> 

		<div class="form-group <?php if(form_error('photo')) echo 'has-error'; ?>">
									
			<?php
			echo form_label('Photo', 'photo');?>

			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
    			<div class="form-control" data-trigger="fileinput">
        			<i class="glyphicon glyphicon-file fileinput-exists"></i>
    				<span class="fileinput-filename"></span>
    			</div>
    			<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Select file</span>
						<span class="fileinput-exists">Change</span>
									
						<?php echo form_input(array(
							'type' => 'file',
							'name' => 'photo',
							'id' => 'photo_id',
							'onchange' => 'fileImage(this);',

						));

						echo form_input(array(
							'type' => 'hidden',
							'name' => 'previous-photo',
							'value' => set_value('photo', $info->emp_photo)
													
						));
						echo form_error('photo');?>
				</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>

			<img id="preview_photo" class="img-responsive" width="150px;" />
			<img src="<?= base_url().'assets/img/employees/'.$info->emp_photo ?>" id="preview_imgs" class="img-responsive" width="150px;">
									
		</div>

		<input type="hidden" name="emp-signature" value="<?= $info->emp_signature ?>"> 
		<div class="form-group <?php if(form_error('signature')) echo 'has-error'; ?>">
									
			<?php
			echo form_label('Signature', 'signature');?>

			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
    			<div class="form-control" data-trigger="fileinput">
        			<i class="glyphicon glyphicon-file fileinput-exists"></i>
    				<span class="fileinput-filename"></span>
    			</div>
    			<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Select file</span>
						<span class="fileinput-exists">Change</span>
									
						<?php echo form_input(array(
							'type' => 'file',
							'name' => 'signature',
							'id' => 'signature_id',
							'onchange' => 'fileImageSig(this);',

						));

						echo form_input(array(
							'type' => 'hidden',
							'name' => 'previous-signature',
							'value' => set_value('signature', $info->emp_signature)
													
						));
						echo form_error('signature');?>
				</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>

			<img id="preview_signature" class="img-responsive" width="150px;" />
			<img src="<?= base_url().'assets/img/employees/'.$info->emp_signature ?>" id="preview_sig" class="img-responsive" width="150px;">
									
		</div>
	</div>

	<div class="clearfix"></div><br/>

	<div class="col-md-12">
		<h4 class="bg-primary p-xs">Contact Details</h4>
	</div>
	<div class="col-md-6 b-r">
		<div class="form-group <?php if(form_error('phone')) echo 'has-error'; ?>">
			<?php
			echo form_label('Phone No.<small class="text-danger">*</small>', 'phone');

			echo form_input(array(
				'type' => 'text',
				'name' => 'phone',
				'class' => 'form-control',
				'placeholder' => 'Phone No.',
				'value' => set_value('phone', $info->emp_phone),
				'required' => 'true'
			));

			echo form_error('phone'); ?>
		</div>

		<div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
			<?php
			echo form_label('Email Id <small class="text-danger">*</small>', 'email');

			echo form_input(array(
				'type' => 'email',
				'name' => 'email',
				'class' => 'form-control',
				'placeholder' => 'Email Id',
				'value' => set_value('email', $info->emp_email),
				'required' => 'true'
			));

			echo form_error('email'); ?>
		</div>

		<div class="form-group <?php if(form_error('alt-phone')) echo 'has-error'; ?>">
			<?php
			echo form_label('Alternate Phone No.', 'alt-phone');

			echo form_input(array(
				'type' => 'text',
				'name' => 'alt-phone',
				'class' => 'form-control',
				'placeholder' => 'Alternate Phone No.',
				'value' => set_value('alt-phone', $info->alternate_phone)
			));

			echo form_error('alt-phone'); ?>
		</div>

		<div class="form-group <?php if(form_error('pan-number')) echo 'has-error'; ?>">
			<?php
			echo form_label('PAN Number', 'pan-number');

			echo form_input(array(
				'type' => 'text',
				'name' => 'pan-number',
				'class' => 'form-control',
				'placeholder' => 'PAN Number',
				'value' => set_value('pan-number', $info->emp_pan)
			));

			echo form_error('pan-number'); ?>
		</div>
		<div class="form-group <?php if(form_error('adhar-number')) echo 'has-error'; ?>">
			<?php
			echo form_label('Adhar Number <small class="text-danger">*</small>', 'adhar-number');

			echo form_input(array(
				'type' => 'text',
				'name' => 'adhar-number',
				'class' => 'form-control',
				'placeholder' => 'Adhar Number',
				'value' => set_value('adhar-number', $info->emp_adhar),
				'required' => 'true'
			));

			echo form_error('adhar-number'); ?>
		</div>
		<div class="form-group <?php if(form_error('work-phone')) echo 'has-error'; ?>">
			<?php
			echo form_label('Work Phone No.', 'work-phone');

			echo form_input(array(
				'type' => 'text',
				'name' => 'work-phone',
				'class' => 'form-control',
				'placeholder' => 'Phone No.',
				'value' => set_value('work-phone', $info->work_phone)
			));

			echo form_error('work-phone'); ?>
		</div>

	</div>

	<div class="col-md-6">
		
		<div class="form-group <?php if(form_error('work-email')) echo 'has-error'; ?>">
			<?php
			echo form_label('Work Email Id', 'work-email');

			echo form_input(array(
				'type' => 'email',
				'name' => 'work-email',
				'class' => 'form-control',
				'placeholder' => 'Work Email Id',
				'value' => set_value('work-email', $info->work_email)
			));

			echo form_error('work-email'); ?>
		</div>
		<div class="form-group <?php if(form_error('city')) echo 'has-error'; ?>">
			<?php
			echo form_label('City <small class="text-danger">*</small>', 'city');

			echo form_input(array(
				'type' => 'text',
				'name' => 'city',
				'class'=> 'form-control',
				'placeholder' => 'City',
				'value' => set_value('city', $info->emp_city),
				'required' => 'true'
			));

			echo form_error('city'); ?>
		</div>

		<div class="form-group <?php if(form_error('state')) echo 'has-error'; ?>">
			<?php
			$options =  array(
				'Andhra Pradesh' => 'Andhra Pradesh',
				'Arunachal Pradesh' => 'Arunachal Pradesh',
				'Assam' => 'Assam',
				'Bihar' => 'Bihar',
				'Chhattisgarh' => 'Chhattisgarh',
				'Goa' => 'Goa',
				'Gujarat' => 'Gujarat',
				'Haryana' => 'Haryana',
				'Himachal Pradesh' => 'Himachal Pradesh',
				'Jammu and Kashmir' => 'Jammu and Kashmir',
				'Jharkhand' => 'Jharkhand',
				'Karnataka' => 'Karnataka',
				'Kerala' => 'Kerala',
				'Madhya Pradesh' => 'Madhya Pradesh',
				'Maharashtra' => 'Maharashtra',
				'Manipur' => 'Manipur',
				'Meghalaya' => 'Meghalaya',
				'Mizoram' => 'Mizoram',
				'Nagaland' => 'Nagaland',
				'Odisha' => 'Odisha',
				'Punjab' => 'Punjab',
				'Rajasthan' => 'Rajasthan',
				'Sikkim' => 'Sikkim',
				'Tamil Nadu' => 'Tamil Nadu',
				'Telangana' => 'Telangana',
				'Tripura' => 'Tripura',
				'Uttar Pradesh' => 'Uttar Pradesh',
				'Uttarakhand' => 'Uttarakhand',
				'West Bengal' => 'West Bengal'
			);
			echo form_label('State <small class="text-danger">*</small>', 'state');

			echo form_dropdown(array(
				'name' => 'state',
				'class' => 'form-control',
				'required' => 'true'
			), $options, $info->emp_state);

			echo form_error('state'); ?>
		</div>

		<div class="form-group <?php if(form_error('pincode')) echo 'has-error'; ?>	">
			<?php
			echo form_label('Pincode <small class="text-danger">*</small>', 'pincode');

			echo form_input(array(
				'type' => 'text',
				'name' => 'pincode',
				'class' => 'form-control',
				'placeholder' => 'Pincode',
				'value' => set_value('pincode', $info->emp_pincode),
				'required' => 'true'
			));

			echo form_error('pincode');
			?>
		</div>

		<div class="form-group <?php if(form_error('address')) echo 'has-error'; ?>">
			<?php
			echo form_label('Address <small class="text-danger">*</small>', 'address');

			echo form_textarea(array(
				'rows' => '5',
				'name' => 'address',
				'class' => 'form-control',
				'placeholder' => 'Adress',
				'value' => set_value('address', $info->emp_address),
				'required' => 'true'
			));

			echo form_error('address'); ?>
		</div>
	</div>

	<div class="col-md-12">
		<h4 class="bg-primary p-xs">Qualification And Experience </h4>
	</div>
	<div class="col-md-6 b-r">
		<div class="form-group <?php if(form_error('qualification')) echo 'has-error'; ?>">
			<?php
			echo form_label('Qualification <small class="text-danger">*</small>', 'qualification');

			echo form_input(array(
				'type' => 'text',
				'name' => 'qualification',
				'class' => 'form-control',
				'placeholder' => 'Education Qualification',
				'value' => set_value('qualification',$info->emp_qualification),
				'required' => 'true'
			));

			echo form_error('qualification'); ?>
		</div>

		<div class="form-group <?php if(form_error('experience')) echo 'has-error'; ?>">
			<?php
			echo form_label('Experience( In Year) <small class="text-danger">*</small>', 'experience');

			echo form_input(array(
				'type' => 'text',
				'name' => 'experience',
				'class' => 'form-control',
				'value' => set_value('experience',$info->emp_experience),
				'required' => 'true'
			));

			echo form_error('experience'); ?>
		</div>

		<div class="form-group <?php if(form_error('prev_org')) echo 'has-error'; ?>">
			<?php
			echo form_label('Organization Name', 'prev_org');

			echo form_input(array(
				'type' => 'text',
				'name' => 'prev_org',
				'class' => 'form-control',
				'placeholder' => 'Account Holder Name',
				'value' => set_value('prev_org',$info->emp_prev_organization)
			));

			echo form_error('prev_org'); ?>
		</div>
	</div>

	<div class="col-md-6">
		
		<div  class="form-group <?php if(form_error('month-start')) echo 'has-error'; ?>">	
			<?php
			echo form_label('Duration', 'month-start'); ?>

			<div class="input-daterange input-group" id="datepicker">
            	<?php 
					echo form_input(array(
						'type' => 'date',
						'name' => 'month-start',
						'class' => 'input-sm form-control',
						'placeholder' => 'From',
						'value' => set_value('month-start',$info->emp_prev_org_from)
					));
					?>
			<span class="input-group-addon">to</span>
            <?php 
				echo form_input(array(
					'type' => 'date',
					'name' => 'month-end',
					'class' => 'input-sm form-control',
					'placeholder' => 'To',
					'value' => set_value('month-end',$info->emp_prev_org_to)
				));
					
            	echo form_error('month-end'); ?>
        	</div>
		</div>
		<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
			<?php
			echo form_label('Remarks', 'remarks');

			echo form_input(array(
				'type' => 'text',
				'name' => 'remarks',
				'class' => 'form-control',
				'placeholder' => 'remarks',
				'value' => set_value('remarks',$info->emp_remark)
			));

			echo form_error('remarks'); ?>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="hr-line-dashed"></div>

	<div class="col-sm-12 text-right">
		<a class="btn bg-warning" id="editTab1"><i class="fa fa-pencil"></i> Edit</a>
		<a class="btn bg-danger" id="cancelTab1" style="display: none;"><i class="fa fa-times"></i> Cancel</a>&nbsp;
		<button class="btn btn-primary" id="saveTab1" type="submit" style="display: none;"><i class="fa fa-save"></i> Save</button>
	</div>

	<!-- script -->
	<script>
	$(document).ready(function () {
		var form = $('.tab-1');

		$('#editTab1').click(function(event) {
			form.find(':disabled').each(function() {
				$(this).removeAttr('disabled');
			});
			$('#cancelTab1').show();
			$('#saveTab1').show();
			$('#editTab1').hide();
		});

		$('#cancelTab1').click(function(event) {
			form.find(':enabled').each(function() {
				$(this).attr("disabled", "disabled");
			});
			$('#cancelTab1').hide();
			$('#saveTab1').hide();
			$('#editTab1').show();
		});
	});

    function fileImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('#preview_photo').attr('src', e.target.result);
           
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

     function fileImageSig(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('#preview_signature').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function(){
		$("#photo_id").click(function(){	
		   	$("#preview_imgs").hide();
		    		
		});

		$("#signature_id").click(function(){	
		   	$("#preview_sig").hide();
		    		
		});

		$('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
        });

		$('.clockpicker').clockpicker();
	});


	</script>
