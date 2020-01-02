
<script src="<?= base_url(); ?>assets/js/jquery-v1.9.1.js"></script> 
<script src="<?= base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker-v1.5.0.js"></script>
<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize">Academic session</span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("setting/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
		'class' => 'form-horizontal edit-form',	
	);
	echo form_open("setting/{$this->misc->_getClassName()}/edit/$info->financial_p_id", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<!-- <div class="ibox-title">
						<h5>Edit Session <span class="text-success">[<?= $info->session_name ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div> -->
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('start_year')) echo 'has-error'; ?>">
									<?php echo form_label(' Start Year <small class="text-danger">*</small>', 'start_year', array('class' => 'col-sm-4 control-label')); ?>

									<div class="col-sm-5">
										<?php 
										echo form_input(array(
											'type' => 'text',	
											'name' => 'start_year',
											'class' => 'form-control date-own',
											'placeholder' => '2019',
											'id' => 'start_year',
											'value' => set_value('start_year',$info->start_year),
											'required' => 'true'
										));

										echo form_error('start_year'); ?>
									</div>
								</div>
								
							
								<div class="form-group <?php if(form_error('end_year')) echo 'has-error'; ?>">
									<?php echo form_label('End Year <small class="text-danger">*</small>', 'end_year', array('class' => 'col-sm-4 control-label')); ?>
									<div class="col-sm-5">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'end_year',
											'class' => 'form-control date-own',
											'id' => 'end_year',
											'placeholder' => '2022',
											'value' => set_value('end_year',$info->end_year),
											'required' => 'true'
										));

										echo form_error('end_year'); ?>
										<p id="demo" class="text-danger"></p>
									</div>
								</div>
								

								<div class="form-group <?php if(form_error('start_month')) echo 'has-error'; ?>">
									<?php echo form_label(' Start Month <small class="text-danger">*</small>', 'start_month', array('class' => 'col-sm-4 control-label')); ?>

									<div class="col-sm-5">
										<?php 
										echo form_input(array(
											'type' => 'text',	
											'name' => 'start_month',
											'class' => 'form-control date-own',
											'placeholder' => '2019',
											'id' => 'start_month',
											'value' => set_value('start_month',$info->start_month),
											'required' => 'true'
										));

										echo form_error('start_month'); ?>
									</div>
								</div>
								
							
								<div class="form-group <?php if(form_error('end_month')) echo 'has-error'; ?>">
									<?php echo form_label('End Month <small class="text-danger">*</small>', 'end_month', array('class' => 'col-sm-4 control-label')); ?>
									<div class="col-sm-5">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'end_month',
											'class' => 'form-control date-own',
											'id' => 'end_year',
											'placeholder' => '2022',
											'value' => set_value('end_month',$info->end_month),
											'required' => 'true'
										));

										echo form_error('end_month'); ?>
										<p id="demo" class="text-danger"></p>
									</div>
								</div>
								
							
							<!-- <div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
									<?php echo form_label('Description ', 'description', array('class' => 'col-sm-4 control-label')); ?>
									<div class="col-sm-8">
										<?php 
										echo form_textarea(array(
											'name' => 'description',
											'class' => 'form-control',
											'rows' => '3',
											'placeholder' => 'Description',
											'value' => set_value('description',$info->description),
										));

										echo form_error('description'); ?>
									</div>
								</div> -->
								</div>
						</div>

						<div class="hr-line-dashed"></div>
						<div class="col-sm-12 text-right">
							<a class="btn bg-warning" id="editTab1"><i class="fa fa-pencil"></i> Edit</a>
							<a class="btn bg-danger" id="cancelTab1" style="display: none;"><i class="fa fa-times"></i> Cancel</a>&nbsp;
							<button class="btn btn-primary" id="saveTab1" type="submit" style="display: none;"><i class="fa fa-save"></i> Save</button>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
<script>
	$(document).ready(function () {
		var form = $('.edit-form');
		$('form input,select,textarea,button.remCF,button[type="submit"]').prop("disabled", true);
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
</script>
<script type="text/javascript">
  $('.date-own').datepicker({
     minViewMode: 2,
     format: 'yyyy',
   });
  $("#end_session_year").on("change",function(){
        var end_session_year = $(this).val();
        var start_session_year = document.getElementById("start_session_year").value;
        if(end_session_year <= start_session_year){
            var text = "Academic End Session Year Must Be Greater Than Start Session Year ";
            
            document.getElementById("demo").innerHTML = text;
        }else{
            var text = " ";
            document.getElementById("demo").innerHTML = text;
        }
        
    });
</script>
