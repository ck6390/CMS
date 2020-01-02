<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Admin</li>
			<li>
				<a href="<?= site_url("admin/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
	echo form_open("admin/{$this->misc->_getClassName()}/edit/" . $info->role_p_id, $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Role <span class="text-success">[<?= $info->role_name ?>]</span></h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group <?php if(form_error('role-name')) echo 'has-error'; ?>">
									<?php
									echo form_label('Role Name <small class="text-danger">*</small>', 'role-name', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_input(array(
											'type' => 'text',
											'name' => 'role-name',
											'class' => 'form-control',
											'placeholder' => 'Role Name',
											'value' => set_value('role-name', $info->role_name),
											'required' => 'true'
										));

										echo form_error('role-name'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
									<?php
									echo form_label('Description <small class="text-danger">*</small>', 'description', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php
										echo form_textarea(array(
											'rows' => '2',
											'name' => 'description',
											'class' => 'form-control',
											'placeholder' => 'Name',
											'value' => set_value('description', $info->description),
											'required' => 'true'
										));

										echo form_error('description'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Assign Permissions <small>Tick the boxes applicable for this role.</small></h5>
					</div>
					<?php
					foreach ($permissions as $permission) {
						$moduleList[] = $permission->module_name;
					}
					$modules = array_unique($moduleList);
					foreach ($role_permissions as $role_permission) {
						$haystack[] = $role_permission->permission_ID;
					}; ?>
					<div class="ibox-content">
						<?php foreach ($modules as $module) { ?>
						<div class="row">
							<h5><strong class="text-uppercase p-w-sm"><?= $module ?></strong></h5><hr/>
							<?php foreach ($permissions as $permission) {
								if($permission->module_name == $module) { ?>
								<div class="col-md-3">
									<div class="form-group">
										<?php echo form_label($permission->display_name, 'permission', array('class' => 'col-sm-10 control-label')); ?>
										<div class="col-sm-2">
											<label class="checkbox-inline i-checks">
												<input type="checkbox" name="permission[]" value="<?= $permission->permission_p_id ?>"
												<?= !empty($haystack) ? in_array($permission->permission_p_id, $haystack) ? 'checked' : '' : '' ?>>
											</label>
										</div>
									</div>
								</div>
								<?php
								}
							} ?>
						</div>
						<?php } ?>

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
