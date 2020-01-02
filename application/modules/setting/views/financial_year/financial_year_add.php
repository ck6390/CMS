
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
				<a href="<?= site_url("setting/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
		'class' => 'form-horizontal',	
	);
	echo form_open("setting/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Academic Financials</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('start_year')) echo 'has-error'; ?>">
									<?php echo form_label('Start Year <small class="text-danger">*</small>', 'session_start', array('class' => 'col-sm-4 control-label')); ?>

									<div class="col-sm-5">
										<?php 
										echo form_input(array(
											'type' => 'text',	
											'name' => 'start_year',
											'class' => 'form-control date-own',
											'placeholder' => '2019',
											'id' => 'start_year',
											'value' => set_value('start_year'),
											'required' => 'true'
										));

										echo form_error('start_year'); ?>
									</div>
								</div>	
							
								<div class="form-group <?php if(form_error('end_year')) echo 'has-error'; ?>">
									<?php echo form_label(' End Year<small class="text-danger">*</small>', 'end_year', array('class' => 'col-sm-4 control-label')); ?>
									<div class="col-sm-5">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'end_year',
											'class' => 'form-control date-own',
											'id' => 'end_year',
											'placeholder' => '2022',
											'value' => set_value('end_year'),
											'required' => 'true'
										));

										echo form_error('end_year'); ?>
										<p id="demo" class="text-danger"></p>
									</div>
								</div>
								

								<div class="form-group <?php if(form_error('start_month')) echo 'has-error'; ?>">
									<?php echo form_label('Start Month <small class="text-danger">*</small>', 'session_start', array('class' => 'col-sm-4 control-label')); ?>

									<div class="col-sm-5">
										<?php 
										echo form_input(array(
											'type' => 'text',	
											'name' => 'start_month',
											'class' => 'form-control ',
											'placeholder' => 'March',
											'id' => 'start_month',
											'value' => set_value('start_month'),
											'required' => 'true'
										));

										echo form_error('start_month'); ?>
									</div>
								</div>	
							
								<div class="form-group <?php if(form_error('end_month')) echo 'has-error'; ?>">
									<?php echo form_label(' End Month<small class="text-danger">*</small>', 'end_month', array('class' => 'col-sm-4 control-label')); ?>
									<div class="col-sm-5">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'end_month',
											'class' => 'form-control ',
											'id' => 'end_month',
											'placeholder' => 'February',
											'value' => set_value('end_month'),
											'required' => 'true'
										));

										echo form_error('end_month'); ?>
										<p id="demo" class="text-danger"></p>
									</div>
								</div>
								
							<!-- 
							<div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
									<?php echo form_label('Description ', 'description', array('class' => 'col-sm-4 control-label')); ?>
									<div class="col-sm-8">
										<?php 
										echo form_textarea(array(
											'name' => 'description',
											'class' => 'form-control',
											'cols' => '20',
											'rows' => '3',
											'placeholder' => 'Description',
											'value' => set_value('description'),
											
										));

										echo form_error('description'); ?>
									</div>
								</div> -->
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
  $('.date-own').datepicker({
     minViewMode: 2,
     format: 'yyyy',
   });
  $("#end_session_year").on("change",function(){
        var end_session_year = $(this).val();
        var start_session_year = document.getElementById("start_session_year").value;
        if(end_session_year <= start_session_year){
            var text = "Academic End Session Year Must Be Greater Than Start Session Year";
            
            document.getElementById("demo").innerHTML = text;
        }else{
            var text = " ";
            document.getElementById("demo").innerHTML = text;
        }
        
    });
</script>
