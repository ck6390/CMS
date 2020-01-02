<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getMethodName()); ?></strong>
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
	echo form_open("{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Visitor Info</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> Add  Visitor Info </a></li>
                            
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="col-md-10">
                                    	<div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
											<?php echo form_label('Name  <small class="text-danger">*</small>', 'name', array('class' => 'col-sm-3 control-label')); ?>
											<div class="col-sm-9">
												<?php 
												echo form_input(array(
													'name' => 'name',
													'class' => 'form-control',
													'placeholder' => 'Name',
													'value' => set_value('name'),
													'required' => 'true'
													
												));

												echo form_error('name'); ?>
											</div>
										</div>

										<div class="form-group <?php if(form_error('phone')) echo 'has-error'; ?>">
											<?php echo form_label('Phone  <small class="text-danger">*</small>', 'phone', array('class' => 'col-sm-3 control-label')); ?>
											<div class="col-sm-9">
												<?php 
												echo form_input(array(
													'name' => 'phone',
													'class' => 'form-control',
													'placeholder' => 'Phone',
													'value' => set_value('phone'),
													'required' => 'true'
													
												));

												echo form_error('phone'); ?>
											</div>
										</div>

										<div class="form-group <?php if(form_error('comming-from')) echo 'has-error'; ?>">
											<?php echo form_label('Comming From  <small class="text-danger">*</small>', 'comming-from', array('class' => 'col-sm-3 control-label')); ?>
											<div class="col-sm-9">
												<?php 
												echo form_input(array(
													'name' => 'comming-from',
													'class' => 'form-control',
													'placeholder' => 'Comming From',
													'value' => set_value('comming-from'),
													'required' => 'true'
													
												));

												echo form_error('comming-from'); ?>
											</div>
										</div>

										<div class="form-group <?php if(form_error('user-role')) echo 'has-error'; ?>">
											<?php echo form_label('User Role <small class="text-danger">*</small>', 'user-role', array('class' => 'col-sm-3 control-label')); ?>
											<div class="col-sm-9">
												<?php 
													$_user_role = $this->mdl_role->dropdown('role_name');
													echo form_dropdown(array(
														'name' => 'user-role',
														'class' => 'form-control select2_one'
													), $_user_role);
													echo form_error('user-role'); ?>
											</div>
										</div>
								
										

										<div class="form-group <?php if(form_error('to-meet')) echo 'has-error'; ?>">
											<?php echo form_label('To Meet <small class="text-danger">*</small>', 'to-meet', array('class' => 'col-sm-3 control-label')); ?>
											<div class="col-sm-9">
												<select name="to-meet" class="form-control" required="true"> </select>
												<?php echo form_error('to-meet'); ?>
											</div>
										</div>

										<div class="form-group <?php if(form_error('message')) echo 'has-error'; ?>">
											<?php echo form_label('Note ', 'message', array('class' => 'col-sm-3 control-label')); ?>
											<div class="col-sm-9">
												<?php 
												echo form_textarea(array(
													'name' => 'message',
													'class' => 'form-control',
													'rows' => '3',
													'placeholder' => 'Message',
													'value' => set_value('message'),
													
												));

												echo form_error('message'); ?>
											</div>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
							</div>
						</div>

						<div class="hr-line-dashed"></div>
						<div class="text-right">
							<button id="invoiceBtn" class="btn btn-primary" type="submit">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>


<script type="text/javascript">
$(document).ready(function() {
	$('select[name="user-role').on('change', function() {
		var roleID = $(this).val();
		$.ajax({
			url: base_url + "index.php/visitors/userList/" + roleID,
			type: "POST",
			success:function(data)
			{
				$('select[name="to-meet"]').empty();
				$('select[name="to-meet"]').html('<option value="" selected="true">== Please select one option ==</option>');
				var dataObj = jQuery.parseJSON(data);
				if(dataObj) {
					$(dataObj).each(function() {
						var option = $('<option />');
						if(this.user_p_id){
							option.attr('value', this.user_full_name+'[ '+this.role_name+' ]').text(this.user_full_name+'[ '+this.role_name+' ]');
							$('select[name="to-meet"]').append(option);
						}else if(this.student_p_id){
							option.attr('value', this.student_full_name+'[ '+this.student_unique_id+' ]').text(this.student_full_name+'[ '+this.student_unique_id+' ]');
							$('select[name="to-meet"]').append(option);
						}else{
							option.attr('value', this.emp_name+' [ '+this.employee_id+' ] ').text(this.emp_name+' [ '+this.employee_id+' ] ');
							$('select[name="to-meet"]').append(option);	
						}
						
					});
				} else {
					$('select[name="to-meet"]').empty();
				}
			}
		});
	});
});
</script>