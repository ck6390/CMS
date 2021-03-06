<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Office</li>
			<li>
				<a href="<?= site_url("office/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
	echo form_open("office/{$this->misc->_getClassName()}/edit/" . $info->component_p_id, $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Employment Status <span class="text-success">[<?= $info->component_name ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10 col-sm-12">
								<div class="form-group <?php if(form_error('component-name')) echo 'has-error'; ?>">
									<?php echo form_label('Salary Component Name <small class="text-danger">*</small>', 'component-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_input(array(
											'type' => 'text',
											'name' => 'component-name',
											'class' => 'form-control',
											'placeholder' => 'Salary Component Name',
											'value' => set_value('component-name', $info->component_name),
											'required' => 'true'
										));

										echo form_error('component-name'); ?>
									</div>
								</div>

								<div class="form-group">
									<?php echo form_label('Component Type <small class="text-danger">*</small><br/><small class="text-navy">Add or Deduct the amount?</small>', 'component-type', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="i-checks">
											<label> <?php echo form_radio('component-type', 'CR', $info->component_type == 'CR' ? true:false)." Credit "; ?> </label>
										</div>
										<div class="i-checks">
											<label> <?php echo form_radio('component-type', 'DR', $info->component_type == 'DR' ? true:false)." Debit "; ?> </label>
										</div>
									</div>
								</div>

								<div class="form-group">
									<?php echo form_label('Add To <small class="text-danger">*</small><br/><small class="text-navy">Amount will be add to which one?</small>', 'add-to', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="i-checks">
											<label> <?php echo form_checkbox('payable-amount', '1', $info->payable_amount == '1' ? true:false)." Payable Amount "; ?> </label>
										</div>
										<div class="i-checks">
											<label> <?php echo form_checkbox('ctc', '1', $info->cost_to_company == '1' ? true:false)." Cost To Company (CTC) "; ?> </label>
										</div>
									</div>
								</div>

								<div class="form-group">
									<?php echo form_label('Component Value Type <small class="text-danger">*</small><br/><small class="text-navy">Value in amount or percentage?</small>', 'value-type', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<div class="i-checks">
											<label> <?php echo form_radio('value-type', 'amt', $info->value_type == 'amt' ? true:false)." Amount "; ?> </label>
										</div>
										<div class="i-checks">
											<label> <?php echo form_radio('value-type', 'per', $info->value_type == 'per' ? true:false)." Percantage "; ?> </label>
										</div>
									</div>
								</div>


								<div class="form-group">
									<?php echo form_label('Description', 'description', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										echo form_textarea(array(
											'name' => 'description',
											'class' => 'form-control',
											'placeholder' => 'Enter Description',
											'value' => set_value('description', $info->description),
											'rows' => '3'
										)); ?>
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