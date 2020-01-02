<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?> Roll</span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
	echo form_open("{$this->misc->_getClassName()}/roll/$info->student_p_id", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add Student Roll</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-8 ">
								
								<div class="form-group <?php if(form_error('student-id')) echo 'has-error'; ?>">
										<?php echo form_label('Student ID <small class="text-danger">*</small>', 'student-id');
										echo form_input(array(
											'type' => 'text',
											'name' => 'student-id',
											'class' => 'form-control',
											'value' => set_value('roll',$info->student_unique_id),
											'required' => 'true',
											'readonly' => 'true',
										));

										echo form_error('student-id');
										?>
								</div>
								<div class="form-group <?php if(form_error('roll')) echo 'has-error'; ?>">
										<?php echo form_label('Roll', 'roll');
										echo form_input(array(
											'type' => 'text',
											'name' => 'roll',
											'class' => 'form-control',
											'placeholder' => 'Roll No.',
											'value' => set_value('roll',$info->student_roll),
										));

										echo form_error('roll');
										?>
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