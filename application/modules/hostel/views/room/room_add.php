<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Hostel</li>
			<li>
				<a href="<?= site_url("hostel/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
	echo form_open("hostel/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Hostel Room</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('room-number')) echo 'has-error'; ?>">
									<?php echo form_label('Room Name / No. <small class="text-danger">*</small>', 'room-number', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'room-number',
											'class' => 'form-control',
											'placeholder' => 'Room Name / No.',
											'value' => set_value('room-number'),
											'required' => 'true'
										));

										echo form_error('room-number'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('building-name')) echo 'has-error'; ?>">

									<?php echo form_label('Building', 'building-name', array('class' => 'col-sm-3 control-label'));?>
									<div class="col-sm-9">
										<?php
										$_building = $this->mdl_building->dropdown('building_name');								
										echo form_dropdown(array(
											'name' => 'building-name',
											'class' => 'form-control select2_one',
											
										), $_building);
										echo form_error('building-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('block-name')) echo 'has-error'; ?>">

									<?php echo form_label('Block', 'block-name', array('class' => 'col-sm-3 control-label'));?>
									<div class="col-sm-9">
										<div id="blockDropdown">
											<select name="block-name" class="form-control select2_one"> </select>
										</div>
										<?php
										//$_block = $this->mdl_block->dropdown('block_name');
										//var_dump($_block);
										//echo form_dropdown(array(
											//'name' => 'block-name',
											//'class' => 'form-control select2_one',
											
										//), $_block);
										echo form_error('block-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('floor-number')) echo 'has-error'; ?>">
									
									<?php echo form_label('Floor', 'floor-number', array('class' => 'col-sm-3 control-label'));?>									
									<div class="col-sm-9">
										<div id="floorDropdown">
											<select name="floor-number" class="form-control select2_one"> </select>
										</div>

										<?php
										//$_floor = $this->mdl_floor->dropdown('floor_name');
										//var_dump($_floor);
										//echo form_dropdown(array(
										//	'name' => 'floor-number',
										//	'class' => 'form-control select2_one',
											
										//), $_floor);
										echo form_error('floor-number'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('bed-number')) echo 'has-error'; ?>">
									<?php echo form_label('No. of Bed <small class="text-danger">*</small>', 'bed-number', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'bed-number',
											'class' => 'form-control',
											'placeholder' => 'No. of Bed',
											'value' => set_value('bed-number'),
											'required' => 'true'
										));

										echo form_error('bed-number'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('room-rent')) echo 'has-error'; ?>">
									<?php echo form_label('Rent Per Month <small class="text-danger">*</small>', 'room-rent', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'room-rent',
											'class' => 'form-control',
											'placeholder' => 'Rent per month',
											'value' => set_value('room-rent'),
											'required' => 'true'
										));

										echo form_error('room-rent'); ?>
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

	$('select[name="building-name"]').on('change', function() {
		var blockID = $(this).val();
		if(blockID) {
			$.ajax({
				url: base_url + "index.php/setting/blocks/get_block_list_by_building/" + blockID,
				type: "POST",
				success:function(data)
				{
					$('#blockDropdown .select2_one').select2('val','');
					$('select[name="block-name"]').html('<option value="" selected="true">== Please select one option ==</option>');
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {
							var option = $('<option />');
							option.attr('value', this.block_p_id).text(this.block_name);
							$('select[name="block-name"]').append(option);
						});
					} else {
						$('#blockDropdown .select2_one').select2('val','');
					}
				}
			});
		} else {
			$('#blockDropdown .select2_one').select2('val','');
		}
	});

	$('select[name="block-name"]').on('change', function() {
		var blockID = $(this).val();
		if(blockID) {
			$.ajax({
				url: base_url + "index.php/setting/floors/get_floor_list_by_block/" + blockID,
				type: "POST",
				success:function(data)
				{
					$('#floorDropdown .select2_one').select2('val','');
					$('select[name="floor-number"]').html('<option value="" selected="true">== Please select one option ==</option>');
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {
							var option = $('<option />');
							option.attr('value', this.floor_p_id).text(this.floor_name);
							$('select[name="floor-number"]').append(option);
						});
					} else {
						$('#floorDropdown .select2_one').select2('val','');
					}
				}
			});
		} else {
			$('#floorDropdown .select2_one').select2('val','');
		}
	});
});
</script>