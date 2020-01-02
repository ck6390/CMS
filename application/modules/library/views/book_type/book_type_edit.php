<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Library</li>
			<li>
				<a href="<?= site_url("library/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
	echo form_open("library/{$this->misc->_getClassName()}/edit/{$info->book_type_p_id}", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Book Type</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6 b-r">
									<div class="col-md-12">
										
										<div class="form-group <?php if(form_error('book-type')) echo 'has-error'; ?>">
											<?php echo form_label('Book Type <small class="text-danger">*</small>', 'book-type');

											echo form_input(array(
												'type' => 'text',
												'name' => 'book-type',
												'class' => 'form-control',
												'placeholder' => 'Book Type',
												'value' => set_value('book-type', $info->book_type),
												'required' => 'true'
											));

											echo form_error('book-type'); ?>

										</div>
									</div>	
								</div>
								<div class="col-md-6">
									<div class="col-md-12">
										<div class="form-group <?php if(form_error('type-description')) echo 'has-error'; ?>">
											<?php echo form_label('Description', 'category-description');

											echo form_textarea(array(
												'name' => 'type-description',
												'class' => 'form-control',
												'cols' => '20',
												'rows' => '3',
												'value' => set_value('type-description', $info->type_description),
												'placeholder' => 'Book Type Description'
											));

											echo form_error('type-description'); ?>
										</div>
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
