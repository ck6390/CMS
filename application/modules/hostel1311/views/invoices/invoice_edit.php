<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Hostel</a>
			</li> 
			<li>
				<a href="<?= site_url("hostel/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
	echo form_open("hostel/{$this->misc->_getClassName()}/edit/{$info->hostel_fee_p_id}", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Hostel Invoice</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> Hostel Fee </a></li>
                            
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="col-md-10">
								
								
								<div class="form-group <?php if(form_error('month')) echo 'has-error'; ?>">
									<?php echo form_label('Month <small class="text-danger">*</small>', 'month', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 

										echo form_input(array(
											'type' => 'month',	
											'name' => 'month',
											'class' => 'form-control',
											'placeholder' => '2019',
											'value' => set_value('month',$info->hostel_charge_month),
											'required' => 'true'
										));

										echo form_error('month'); ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('month')) echo 'has-error'; ?>">
									<?php echo form_label('status <small class="text-danger">*</small>', 'month', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 
										$paid = array(
											
											'paid' => 'paid',
											'partial' => 'partial',
											'unpaid' => 'unpaid'
										); 
										echo form_dropdown(array(
												
											'name' => 'status',
											'class' => 'form-control',
											'placeholder' => '2019',
											'value' => set_value('month'),
											'required' => 'true'
										),$paid,$info->paid_status);

										echo form_error('month'); ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('month')) echo 'has-error'; ?>">
									<?php echo form_label('Fine <small class="text-danger">*</small>', 'month', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 

										echo form_input(array(
											'type' => 'text',	
											'name' => 'late-fine',
											'class' => 'form-control',
											'placeholder' => '2019',
											'value' => set_value('late-fine',$info->late_fine),
											'required' => 'true'
										));

										echo form_error('month'); ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('due_amount')) echo 'has-error'; ?>">
									<?php echo form_label('Due amount <small class="text-danger">*</small>', 'due_amount', array('class' => 'col-sm-3 control-label')); ?>
									<div class="col-sm-9">
										<?php 

										echo form_input(array(
											'type' => 'text',	
											'name' => 'due_amount',
											'class' => 'form-control',
											'placeholder' => '2019',
											'value' => set_value('due_amount',$info->due_amount),
											'required' => 'true'
										));

										echo form_error('due_amount'); ?>
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
