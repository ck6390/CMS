<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize">Return Book<!-- <?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?> --></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("library/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li>
				<a href="<?= site_url("library/{$this->misc->_getClassName()}/profile/{$info->student_p_id}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Book return</strong>
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
	                <img alt="image" class="img-responsive img-thumbnail" style=" width: 100%;height: 207px;"src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_photo}") ?>">

	                <img alt="image" class="img-responsive img-thumbnail m-t" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_sign}") ?>">

	            </div>
	            <div class="ibox-content profile-content">
	                <h4><strong><?php echo $lists->student_full_name; ?></strong></h4>
	                <h5><strong>Student ID</strong></h5>
	                <h4 class="text-info"><strong><?php echo $lists->student_unique_id; ?></strong></h4>
	                <h5><strong>Admission No.</strong></h5>
	                <h4 class="text-info"><strong><?php echo $lists->admission_no; ?></strong></h4>
	                
                    <div class="bg-danger p-xs b-r-sm m-t"> Library Fine : <?php echo $library_dues->library_fine ? $library_dues->library_fine : 0.00; ?>  </div>
	                
	            </div>
	        </div>    
    	</div>
    	<div class="col-md-9">
		    <div class="row">
				<div class="col-sm-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Return Book </h5>
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
								'class' => 'form-horizontal'
							);
							
							echo form_open("library/{$this->misc->_getClassName()}/mannual_book_return/{$info->student_p_id}/{$lists->book_id}/{$lists->book_issue_p_id}", $attr); ?>
							<?php 

							echo form_input(array(
								'name' => 'stock',
								'class' => 'form-control',
								'type' => 'hidden',
								'value' => set_value('stock', $lists->stock),
								'readonly' => 'true'
							));
							?>
							<div class="col-md-12">
								<div class="form-group <?php if(form_error('book-title')) echo 'has-error'; ?>">
									<?php
										echo form_label('Book Title <small class="text-danger">*</small>', 'book-title');

										echo form_input(array(
											'name' => 'book-title',
											'class' => 'form-control',
											'value' => set_value('book-title', $lists->book_name),
											'readonly' => 'true'
										));
										echo form_error('book-title'); ?>

								</div>

								<div class="form-group <?php if(form_error('accession-no')) echo 'has-error'; ?>">
									<?php echo form_label('Accession No.', 'accession-no');

										echo form_input(array(
											'type' => 'text',	
											'name' => 'accession-no',
											'class' => 'form-control',
											'value' => set_value('accession-no', $lists->acc_no),
											'placeholder' => 'Accession No.',
											'readonly' => 'true'
										));?>
												
									<?php
										echo form_error('accession-no'); ?>
								</div>

								<div class="form-group <?php if(form_error('call-no')) echo 'has-error'; ?>">
									<?php echo form_label('Call No.', 'call-no');

										echo form_input(array(
											'type' => 'text',	
											'name' => 'call-no',
											'class' => 'form-control',
											'value' => set_value('call-no', $lists->book_call_no),
											'placeholder' => 'Call No.',
											'readonly' => 'true'
										));

										echo form_error('call-no'); ?>
								</div>

								<div class="form-group <?php if(form_error('author-name')) echo 'has-error'; ?>">
									<?php echo form_label('Author Name', 'author-name');

										echo form_input(array(
											'type' => 'text',	
											'name' => 'author-name',
											'class' => 'form-control',
											'value' => set_value('author-name', $lists->auth_name),
											'placeholder' => 'Author Name',
											'readonly' => 'true'
										));

										echo form_error('author-name'); ?>
								</div>

								<div class="form-group <?php if(form_error('stream')) echo 'has-error'; ?>">
									<?php echo form_label('Stream', 'stream');

										echo form_input(array(
											'type' => 'text',	
											'name' => 'stream',
											'class' => 'form-control',
											'value' => set_value('stream', $lists->stream),
											'placeholder' => 'Stream',
											'readonly' => 'true'
										));

										echo form_error('stream'); ?>
								</div>

								<div class="form-group <?php if(form_error('course')) echo 'has-error'; ?>">
									<?php echo form_label('Course', 'course');

										echo form_input(array(
											'type' => 'text',	
											'name' => 'course',
											'class' => 'form-control',
											'value' => set_value('course', $lists->course),
											'placeholder' => 'Course',
											'readonly' => 'true'
										));

										echo form_error('course'); ?>
								</div>

								<div class="form-group <?php if(form_error('issue-date')) echo 'has-error'; ?>">
									<?php echo form_label('Issue Date <small class="text-danger">*</small>', 'issue-date'); ?>
											
									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<?php 
										$date = new DateTime($lists->issue_date);
											echo form_input(array(
												'type' => 'text',	
												'name' => 'issue-date',
												'id' => 'data_1',
												'class' => 'form-control',
												'value' => set_value('issue-date', $date->format('d/m/Y')),
												'placeholder' => 'Issue Date',
												'required' => 'true',
												'readonly' => 'true'
											));

											echo form_error('issue-date'); ?>

									</div>
								</div>

								<div class="form-group <?php if(form_error('submit-date')) echo 'has-error'; ?>">
									<?php echo form_label('Submit Date <small class="text-danger">*</small>', 'submit-date');?>
													
									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<?php 
										$date = new DateTime($lists->return_date);

											echo form_input(array(
												'type' => 'text',	
												'name' => 'submit-date',
												'id' => 'data_1',
												'class' => 'form-control',
												'value' => set_value('return-date', $date->format('d/m/Y')),
												'placeholder' => 'Submit Date',
												'required' => 'true',
												'readonly' => 'true'
											));

											echo form_error('submit-date'); ?>
									</div>
								</div>

								<div class="form-group <?php if(form_error('days-over')) echo 'has-error'; ?>">
									<?php echo form_label('Over Days', 'days-over');

									$date1 = new DateTime($lists->return_date);
									$date2 = new DateTime("now");

									if($date1 > $date2){
										$date_over = $date2->diff($date2);
									}else{
										$date_over = $date1->diff($date2);
									}
									
										echo form_input(array(
											'type' => 'text',	
											'name' => 'days-over',
											'class' => 'form-control',
											'value' => set_value('days-over', $date_over->format('%R%a days')),
											'placeholder' => 'Over Days',
											'readonly' => 'true'
										));

										echo form_error('days-over');
									?>
								</div>

								<div class="form-group <?php if(form_error('fine')) echo 'has-error'; ?>">
									<?php echo form_label('Fine', 'fine');
	
									$fine_amount = $lists->fee_type_amount;
									$date1 = new DateTime($lists->return_date);
									$date2 = new DateTime("now");
									if($date1 > $date2){
										$date_over = $date2->diff($date2);
									}else{
										$date_over = $date1->diff($date2);
									}
									//$date_over = $date1->diff($date2);
									$fine = $date_over->format('%a days') * $fine_amount;

										echo form_input(array(
											'type' => 'text',	
											'name' => 'fine',
											'class' => 'form-control',
											'value' => set_value('fine', $fine),
											'placeholder' => 'Fine',
											'readonly' => 'true'
										));

										echo form_error('fine'); ?>
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
</div>
