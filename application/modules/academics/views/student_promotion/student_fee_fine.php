<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}/student_profile/{$info->student_p_id}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Add Fine</strong>
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
	                <img alt="image" class="img-responsive img-thumbnail" style="    width: 100%;height: 207px;"src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_photo}") ?>">

	                <img alt="image" class="img-responsive img-thumbnail m-t" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_sign}") ?>">

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
							<h5>Add Fine </h5>
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
							echo form_open("{$this->misc->_getClassName()}/student_add_fine/{$info->student_p_id}", $attr); ?>

							<div class="col-md-12">
								<div class="form-group <?php if(form_error('fee-group')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Group <small class="text-danger">*</small>', 'fee-group');

									$_fee_group = $this->mdl_fee_group->dropdown('fee_group_name');

										echo form_dropdown(array(
											'name' => 'fee-group',
											'class' => 'form-control select2_one',
											'required' => 'true'
										), $_fee_group);

										echo form_error('fee-group'); ?>
								</div>

								<div class="form-group <?php if(form_error('fee-type')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Type <small class="text-danger">*</small>', 'fee-type'); ?>
									
									<div id="feeTypeDropdown">
										<select name="fee-type" class="form-control select2_one"> </select>
									</div>
								</div>

								<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
									<?php echo form_label('Amount <small class="text-danger">*</small>', 'amount');

										echo form_input(array(
											'type' => 'text',
											'name' => 'amount',
											'class' => 'form-control',
											'placeholder' => 'Amount',
											'value' => set_value('amount'),
											'required' => 'true'
										));

										echo form_error('amount'); ?>
								</div>

								<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
									<?php echo form_label('Remarks ', 'remarks');

										echo form_input(array(
											'type' => 'text',
											'name' => 'remarks',
											'class' => 'form-control',
											'placeholder' => 'Remarks',
											'value' => set_value('remarks'),
											
										));

										echo form_error('remarks'); ?>
								</div>
								<div class="form-group <?php if(form_error('due-on')) echo 'has-error'; ?>">
									<?php echo form_label('Due On <small class="text-danger">*</small>', 'due-on'); ?>
														
									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<?php 
										echo form_input(array(
											'type' => 'text',	
											'name' => 'due-on',
											'id' => 'data_1',
											'class' => 'form-control',
											'placeholder' => 'Due On',
											'value' => set_value('due-on'),
											'required' => 'true'
										));

										echo form_error('due-on'); ?>

									</div>
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

    <div class="row animated fadeInRight">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Fine List</h5>
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
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

	$('select[name="fee-group"]').on('change', function() {
		var feeGroupID = $(this).val();
		if(feeGroupID) {
			$.ajax({
				url: base_url + "index.php/accounting/fee_types/get_feeType_list_by_group/" + feeGroupID,
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
				url: base_url + "index.php/accounting/fee_types/get_feeType_amount/" + feeTypeID,
				type: "POST",
				success:function(data)
				{
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						
						$('input[name="amount"]').attr('value', dataObj.fee_type_amount);
					
					} else {
						$('input[name="amount"]').attr('value', '');
					}
				}
			});
		} else {
			$('input[name="amount"]').attr('value', '');
		}
	});
});
</script>
