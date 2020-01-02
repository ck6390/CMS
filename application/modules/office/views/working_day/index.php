<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Office</li>
			<li class="active">
				<strong class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></strong>
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
	echo form_open("office/{$this->misc->_getClassName()}/save/", $attr); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Set Working Days</h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-10 col-sm-12">
								<div class="form-group">
									<?php echo form_label('Working Days<br/><small class="text-navy">Check the working days for office.</small>', 'working-days', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php foreach ($days as $day) { ?>
											<div class="i-checks">
												<label> <?php echo form_checkbox('working-days[]', $day->wd_p_id, $day->flag == '1' ? true:false), $day->day_name; ?> </label>
											</div>
											<input type="hidden" name="days[]" value="<?php echo $day->wd_p_id ?>">
										<?php } ?>
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
