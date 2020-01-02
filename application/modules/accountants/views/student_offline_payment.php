<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}/student_profile/{$info->student_p_id}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Offline Payment</strong>
			</li>
		</ol>
	</div>
	
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Student Detail</h5>
                </div>
	            <div class="ibox-content no-padding border-left-right">
	                <img alt="image" class="img-responsive img-thumbnail" style="    width: 100%;height: 207px;"src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_photo}") ?>">

	                <img alt="image" class="img-responsive img-thumbnail m-t" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_sign}") ?>">

	            </div>
	            <div class="ibox-content profile-content">
	                <h4><strong><?php echo $info->student_full_name; ?></strong></h4>
                            <h5><strong>Student ID</strong></h5>
                            <h4 class="text-info"><strong><?php echo $info->student_unique_id; ?></strong></h4>
                            <h5><strong>Admission No.</strong></h5>
                            <h4 class="text-info"><strong><?php echo $info->admission_no; ?></strong></h4>
                            <div class="bg-danger p-xs b-r-sm"> Admin Due : <?php echo $fee_dues->due_amount ? $fee_dues->due_amount : 0.00; ?>  </div>
                            <div class="bg-danger p-xs b-r-sm m-t"> Library Fine : <?php echo $library_dues->library_fine ? $library_dues->library_fine : 0.00; ?>  </div>
	                
	            </div>
	        </div>    
    	</div>
    	<div class="col-md-9">
		    <div class="row">
				<div class="col-sm-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Offline Payment Entry</h5>
							<div class="ibox-tools">
								<small><code>*</code> Required Fields.</small>
							</div>
						</div>

						<div class="ibox-content">
							<?php
							$attr = array(
								'role' => 'form',
								'method' => 'post',
								'name' => 'add-form',
								'enctype' => 'multipart/form-data',
								'class' => 'form-horizontal'
							);
							echo form_open("{$this->misc->_getClassName()}/offline_payment/{$info->student_p_id}", $attr); ?>

							<div class="col-md-12">
								<div class="form-group <?php if(form_error('fee-group')) echo 'has-error'; ?>">
									<?php echo form_label('Fee Group <small class="text-danger">*</small>', 'fee-group');

									$_fee_group = $this->mdl_fee_group->dropdown('fee_group_name');

										echo form_dropdown(array(
											'type' => 'text',
											'name' => 'fee-group',
											'class' => 'form-control',
											'placeholder' => 'Fee Group',
											'required' => 'true',
										),$_fee_group);

										echo form_error('fee-group'); ?>
								</div>

								<div class="form-group <?php if(form_error('payment-title')) echo 'has-error'; ?>">
									<?php echo form_label('Payment Title <small class="text-danger">*</small>', 'payment-title');

									echo form_input(array(
										'type' => 'text',
										'name' => 'payment-title',
										'class' => 'form-control',
										'placeholder' => 'Payment Title',
										'required' => 'true',
									));
									echo form_error('payment-title'); ?>
								</div>

								<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
									<?php echo form_label('Amount <small class="text-danger">*</small>', 'amount');

									echo form_input(array(
										'type' => 'text',
										'name' => 'amount',
										'class' => 'form-control',
										'placeholder' => 'Amount',
										'required' => 'true',
									));
									echo form_error('amount'); ?>
								</div>

								<div class="form-group <?php if(form_error('payment-mode')) echo 'has-error'; ?>">
									<?php echo form_label('Payment Mode <small class="text-danger">*</small>', 'payment-mode');

									$_payment_mode = $this->mdl_pay_mode->dropdown('payment_mode_name');

										echo form_dropdown(array(
											'type' => 'text',
											'name' => 'payment-mode',
											'class' => 'form-control',
											'placeholder' => 'Payment Mode',
											'required' => 'true',
										),$_payment_mode);

										echo form_error('payment-mode'); ?>
								</div>

								<div class="form-group <?php if(form_error('ref-cheque-no')) echo 'has-error'; ?>">
									<?php echo form_label('UPI / Refrence / Cheque No.', 'ref-cheque-no');

									echo form_input(array(
										'type' => 'text',
										'name' => 'ref-cheque-no',
										'class' => 'form-control',
										'placeholder' => 'Refrence / Cheque No.',
									));
									echo form_error('ref-cheque-no'); ?>
								</div>

								<div class="form-group <?php if(form_error('date')) echo 'has-error'; ?>">
									<?php echo form_label('Date <small class="text-danger">*</small>', 'date'); ?>
												
									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<?php 
										echo form_input(array(
											'type' => 'text',	
											'name' => 'date',
											'id' => 'data_1',
											'class' => 'form-control',
											'value' => set_value('date'),
											'placeholder' => 'Date',
											'required' => 'true'
										));
										echo form_error('date'); ?>
													
									</div>
								</div>

								<div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
									<?php echo form_label('Description ', 'description');

									echo form_textarea(array(
										'name' => 'description',
										'class' => 'form-control',
										'rows' => '3',
										'placeholder' => 'Description',
										'value' => set_value('description')
									));
									echo form_error('description'); ?>
								</div>
							</div>
							<!-- <div class="hr-line-dashed"></div> -->
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
	<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>General Receipt List</h5>
                </div>
                <div class="ibox-content">
                	<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Payment Title </th>
									<th>Amount</th>
									<th>Payment Mode</th>
									<th>Date</th>
									<th>Description</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="6"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {

								foreach ($lists as $list) { ?>
								<tr>
									<td>
										<?= '<span class="badge badge-primary">'.htmlspecialchars($list->payment_p_id,ENT_QUOTES,'UTF-8').'</span><br/>' ?>
									</td>

									<td><?= htmlspecialchars($list->payment_title,ENT_QUOTES,'UTF-8') ?></td>
									
									<td><?= htmlspecialchars($list->amount,ENT_QUOTES,'UTF-8') ?></td>

									<td><?= htmlspecialchars($list->payment_mode_name,ENT_QUOTES,'UTF-8') ?></td>

                                    <td><?php echo $list->date ? $this->misc->reformatDate($list->date) : null; ?></td>

                                    <td><?= htmlspecialchars($list->description,ENT_QUOTES,'UTF-8') ?></td>

								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Receipt Title </th>
									<th>Amount</th>
									<th>Payment Mode</th>
									<th>Date</th>
									<th>Description</th>
								</tr>
							</tfoot>
						</table>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
