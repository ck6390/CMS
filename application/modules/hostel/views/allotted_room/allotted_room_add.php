<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Hostel</li>
			<li>
				<a href="<?= site_url("hostel/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize">Allotted Rooms<!-- <?= $this->misc->_getClassName(); ?> --></span></a>
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
	echo form_open("hostel/{$this->misc->_getClassName()}/add/$info->student_p_id", $attr); ?>
		<div class="row">

			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add Allotted Hostel Room</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6 b-r">
									<div class="col-md-12">
										<div class="form-group <?php if(form_error('building-name')) echo 'has-error'; ?>">

											<?php echo form_label('Student ID / No. <small class="text-danger">*</small>', 'student-id'); 
											echo form_input(array(
												'type' => 'text',
												'name' => 'student-unique-id',
												'class' => 'form-control',
												'value' => set_value('student-unique-id',$info->student_unique_id),
												'required' => 'true',
												'readonly' => 'true',
											));
											echo form_input(array(
												'type' => 'hidden',
												'name' => 'student-id',
												'class' => 'form-control',
												'value' => set_value('student-id',$info->student_p_id),
												'required' => 'true',
												'readonly' => 'true',
											));

											echo form_error('student-id'); ?>

										</div>

										<div class="form-group <?php if(form_error('building-name')) echo 'has-error'; ?>">

											<?php echo form_label('Building <small class="text-danger">*</small>', 'building-name');
											$_building = $this->mdl_building->dropdown('building_name');
												echo form_dropdown(array(
													'name' => 'building-name',
													'class' => 'form-control select2_one',
													'required' => 'true'
												), $_building);
												echo form_error('building-name'); ?>

										</div>

										<div class="form-group <?php if(form_error('building-name')) echo 'has-error'; ?>">

											<?php echo form_label('Block <small class="text-danger">*</small>', 'building-name'); ?>
											<div id="blockDropdown">
												<select name="block-name" class="form-control select2_one"> </select>
										</div>
										<? echo form_error('block-name'); ?>

										</div>

										<div class="form-group <?php if(form_error('floor-number')) echo 'has-error'; ?>">
											
											<?php echo form_label('Floor', 'floor-number');?>
												<div id="floorDropdown">
														<select name="floor-number" class="form-control select2_one"> </select>
												</div>

												<?php echo form_error('floor-number'); ?>
										</div>

										<div class="form-group <?php if(form_error('room-id')) echo 'has-error'; ?>">
											
											<?php echo form_label('Room Number', 'room-id');?>
												<div id="roomDropdown">
														<select name="room-id" class="form-control select2_one"> </select>
												</div>

												<?php echo form_error('room-id'); ?>
											<div id="bookedBed"></div>	
										</div>
										
										<div class="form-group <?php if(form_error('room-rent')) echo 'has-error'; ?>">
											<?php echo form_label('Rent Per Month <small class="text-danger">*</small>', 'room-rent');

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
								
										<div class="form-group <?php if(form_error('security-money')) echo 'has-error'; ?>">
											<?php echo form_label('Security Money <small class="text-danger">*</small>', 'security-money');

											echo form_input(array(
												'type' => 'text',
												'name' => 'security-money',
												'class' => 'form-control',
												'placeholder' => 'Security Money',
												'value' => set_value('security-money'),
												'required' => 'true'
											));

											echo form_error('security-money'); ?>
										</div>

										<div class="form-group <?php if(form_error('allotment-date')) echo 'has-error'; ?>">
											<?php echo form_label('Date of Allotment <small class="text-danger">*</small>', 'allotment-date'); ?>
											
											<div class="input-group date">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<?php 
												echo form_input(array(
													'type' => 'text',	
													'name' => 'allotment-date',
													'id' => 'data_1',
													'class' => 'form-control',
													'placeholder' => 'Date of Allotment',
													'value' => set_value('allotment-date'),
													'required' => 'true'
												));
												echo form_error('allotment-date'); ?>
											</div>	
										</div>

										<div class="form-group"<?php if(form_error('send-sms')) echo 'has-error'; ?>">
											<?php echo form_label('Send SMS <small class="text-danger">*</small>', 'send-sms');?>
									
											<div class="form-control">
												<div class="i-checks">
													<label> <?php echo form_radio('send-sms', 'yes')." Yes "; ?> </label>
										
													<label> <?php echo form_radio('send-sms', 'no', true)." No "; ?> </label>
												</div>
											</div>
											<?php echo form_error('send-sms'); ?>
										</div>
									</div>	
								</div>
								<div class="col-md-6">
									<table class="col-sm-12" style="display:inline;font-size:smaller;color:#545454;margin-bottom:10px;">
										<tbody>
											<tr>
												<td class="legendColorBox"><div style="border:1px solid #000000;padding:1px"><div style="width:4px;height:0;border:5px solid #1ab394;overflow:hidden"></div></div></td>
												<td class="legendLabel">Bed Available</td><td class="legendColorBox" style="padding-left: 10px;"><div style="border:1px solid #000000;padding:1px"><div style="width:4px;height:0;border:5px solid #ed5565;overflow:hidden"></div></div></td>
												<td class="legendLabel">Bed Not Available</td>
											</tr>
										</tbody>
									</table>
									<div id="roomList"></div>
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



	$('select[name="room-id"]').on('change', function() {
		var roomID = $(this).val();
		if(roomID) {
			$.ajax({
				url: base_url + "index.php/hostel/rooms/get_booked_bed/" + roomID,
				type: "POST",
				success:function(data)
				{
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						$(dataObj).each(function() {

							var option = $('<input type="hidden" name="booked-bed"/>');
							option.attr('value', this.booked_bed).text(this.booked_bed);
							$('#bookedBed').html(option);
						});
					} else {
						$('#bookedBed').html("");
					}
				}
			});
		} 
	});


	$('select[name="floor-number"]').on('change', function() {
		var floorID = $(this).val();
		var buildingID = $('select[name="building-name"]').val();
		var blockID = $('select[name="block-name"]').val();
		if(floorID) {
			$.ajax({
				url: base_url + "index.php/hostel/rooms/get_room_list_by_floor",
				type: "POST",
				data: {buildingID:buildingID,floorID:floorID,blockID:blockID, },
				success:function(data)
				{	
					$('#roomDropdown .select2_one').select2('val','');
					$('select[name="room-id"]').html('<option value="" selected="true">== Please select one option ==</option>');
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						var htmlData = '';
						$(dataObj).each(function() {
							var totalBed = this.total_bed;
							var bookedBed = this.booked_bed;
							var availableBed = totalBed - bookedBed;
							var option = $('<option />');
							
							if(availableBed > 0){
								option.attr('value', this.room_p_id).text(this.room_number);
							}
							$('select[name="room-id"]').append(option);
							 htmlData +='<div class="col-md-4"><div class="ibox"><div class="ibox-content text-center product-box '+(availableBed==0 ? 'bg-danger' :'bg-primary')+'"><div class="product-desc">'+this.room_number+' <i class="fa fa-long-arrow-right"></i> '+ availableBed +'</div></div></div></div>';
							
							
						});
						$('#roomList').html(htmlData);
					} else {
						$('#roomList').html("");
						$('#roomDropdown .select2_one').select2('val','');
					}
				}
			});
		} else {
			$('#roomDropdown .select2_one').select2('val','');
		}
	});
});
</script>