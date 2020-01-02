<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("accounting/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
	<div class="row">
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Subject Unit Edit</h5>
					<div class="ibox-tools">
						<small><code>*</code> Required Fields.</small>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-sm-12">
							<div class="tabs-container">
                    
                    <div class="tab-content">
                    	
			            <div id="tab-2" class="tab-pane active">
			                <div class="panel-body">
			                    <div class="col-md-1"></div>
			                    <div class="col-md-8">
											
									<?php
									$attr = array(
										'role' => 'form',
										'method' => 'post',
										'name' => 'add-form',
										'class' => 'form-horizontal'
									);
									echo form_open("{$this->misc->_getClassName()}/subject_unit_edit/{$info->emp_subject_unit_p_id}", $attr); ?>

									<div class="col-md-12">
										<div class="form-group <?php if(form_error('subject-id')) echo 'has-error'; ?>">
											<?php echo form_label('Subject <small class="text-danger">*</small>', 'subject-id');
											
											$_subject = $this->mdl_subject->get($info->fk_subject_id)->subject_name;
											echo form_input(array(
												'name' => 'subject-id',
												'class' => 'form-control',
												'required' => 'true',
												'readonly' => 'true',
												'value' => set_value('unit-id',$_subject)
											));

											echo form_error('subject-id'); ?>
										</div>

										<div class="form-group <?php if(form_error('unit-id')) echo 'has-error'; ?>">
											<?php echo form_label('Unit <small class="text-danger">*</small>', 'unit-id');
											
											$_unit = $this->mdl_unit->get($info->unit_id)->unit_number;
											echo form_input(array(
												'name' => 'unit-id',
												'class' => 'form-control',
												'required' => 'true',
												'readonly' => 'true',
												'value' => set_value('unit-id',$_unit)
											));

												echo form_error('unit-id'); ?>
										</div>

										<div class="form-group <?php if(form_error('lecture-required')) echo 'has-error'; ?>">
											<?php echo form_label('lecture Required<small class="text-danger">*</small>', 'lecture-required');
											
											echo form_input(array(
												'name' => 'lecture-required',
												'class' => 'form-control',
												'required' => 'true',
												'readonly' => 'true',
												'value' => set_value('lecture-required',$info->lecture_required)
											));

												echo form_error('lecture-required'); ?>
										</div>

										<div class="form-group <?php if(form_error('extra-lecture')) echo 'has-error'; ?>">
											<?php echo form_label('Extra lecture <small class="text-danger">*</small>', 'extra-lecture');
											
											echo form_input(array(
												'name' => 'extra-lecture',
												'class' => 'form-control',
												'required' => 'true',
												'value' => set_value('extra-lecture',$info->extra_lecture)
											));

												echo form_error('extra-lecture'); ?>
										</div>
									</div>
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
					</div>

						
			</div>
		</div>
	</div>
</div>
</div>
