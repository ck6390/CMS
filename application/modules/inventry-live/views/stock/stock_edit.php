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
		'name' => 'edit-form',
		'class' => 'form-horizontal'
	);
	echo form_open("inventry/{$this->misc->_getClassName()}/edit/{$info->id}", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Stock [<?= $info->stock_name ?>]</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group <?php if(form_error('stock_name')) echo 'has-error'; ?>">
									<?php echo form_label('Stock Name <small class="text-danger">*</small>', 'stock_name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'stock_name',
											'class' => 'form-control',
											'placeholder' => 'Stock Name',
											'value' => set_value('stock_name', $info->stock_name),
											'required' => 'true'
										));

										echo form_error('stock_name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
									<?php echo form_label('Description', 'description', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_textarea(array(
											'name' => 'description',
											'class' => 'form-control',
											'rows' => '3',
											'placeholder' => 'Stock Description',
											'value' => set_value('description', $info->description)
										));

										echo form_error('description'); ?>
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