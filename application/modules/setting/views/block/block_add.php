<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
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
		'class' => 'form-horizontal'
	);
	echo form_open("setting/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Block</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">

								<div class="form-group <?php if(form_error('block-id')) echo 'has-error'; ?>">
									<?php echo form_label('Block Id <small class="text-danger">*</small>', 'block-id', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'block-id',
											'class' => 'form-control',
											'value' => 'BLOCK-'.$lastId,
											'required' => 'true',
											'readonly' => 'true',
										));

										echo form_error('block-id'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('block-name')) echo 'has-error'; ?>">
									<?php echo form_label('Block Name <small class="text-danger">*</small>', 'block-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'block-name',
											'class' => 'form-control',
											'placeholder' => 'Block Name',
											'value' => set_value('block-name'),
											'required' => 'true'
										));

										echo form_error('block-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('building-name')) echo 'has-error'; ?>">
									<?php
									
									echo form_label('Building Name <small class="text-danger">*</small>', 'building-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										$_building = $this->mdl_building->dropdown('building_name');
										
										echo form_dropdown(array(
											'name' => 'building-name',
											'class' => 'form-control select2_one'
										), $_building);

										echo form_error('building-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('block-description')) echo 'has-error'; ?>">
									<?php echo form_label('Description', 'block-description', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_textarea(array(
											'name' => 'block-description',
											'class' => 'form-control',
											'rows' => '3',
											'placeholder' => 'Block Description',
											'value' => set_value('block-description')
										));

										echo form_error('block-description'); ?>
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