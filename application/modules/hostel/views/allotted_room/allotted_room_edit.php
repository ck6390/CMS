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
		'name' => 'edit-form',
		'class' => 'form-horizontal'
	);
	echo form_open("hostel/{$this->misc->_getClassName()}/edit/{$info->room_p_id}", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Hostel Room</h5>
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
											'value' => set_value('room-number', $info->room_number),
											'required' => 'true'
										));

										echo form_error('room-number'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('building-name')) echo 'has-error'; ?>">

									<?php echo form_label('Building / Block <small class="text-danger">*</small>', 'building-name', array('class' => 'col-sm-3 control-label'));?>
									<div class="col-sm-9">
										<?php
										$_blocks = $this->mdl_building->dropdown('block_name');
										echo form_dropdown(array(
											'name' => 'building-name',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_blocks, $info->block_id);
										echo form_error('building-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('floor-number')) echo 'has-error'; ?>">
									
									<?php echo form_label('Floor', 'floor-number', array('class' => 'col-sm-3 control-label'));?>
									<div class="col-sm-9">
										<div id="floorDropdown">
												<select name="floor-number" class="form-control select2_one">
													<option value="<?php echo $info->floor_id?>"><?php echo $this->mdl_room->get_single_value_by_id('floor',$info->floor_id,'floor_name');?></option>
												</select>
										</div>

										<?php echo form_error('floor-number'); ?>
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
											'value' => set_value('bed-number', $info->no_of_bed),
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
											'value' => set_value('room-rent', $info->room_rent),
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
				url: base_url + "index.php/hostel/floors/get_floor_list_by_blocks/" + blockID,
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
