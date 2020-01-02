<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize">Guest <?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Library</li>
			<li>
				<a href="<?= site_url("library/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong>Guest</strong>
			</li>
		</ol>
	</div>
	
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-12">
            <div class="row">
				<div class="col-sm-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Book Basic Details</h5>
							<div class="ibox-tools">
								<small><code>*</code> Required Fields.</small>
							</div>
						</div>

						<div class="ibox-content">
							<table class="table table-bordered table-hover">
                                
                            	<tbody>
				                    <tr>
				                       <td><strong>Accession No.</strong></td>
				                       <td><h4 class="text-info"><strong><?php echo $info->accession_no; ?></strong></h4></td>
				                       <td><strong>Call No.</strong></td>
				                       <td> <h4 class="text-info"><strong><?php echo $info->call_no; ?></strong></h4></td>
				                        
				                    </tr>
				                    <tr>
				                       <td><strong>Book Name</strong></td>
				                       <td><?php echo $info->book_name; ?></td>
				                       <td><strong>Author Name</strong></td>
				                       <td><?php echo $info->author_name; ?></td>
				                        
				                    </tr>
				                    <tr>
				                       <td><strong>Stock</strong></td>
				                       <td>
				                       	<?php echo $info->stock; ?>
				                       	<div id="stock">
				                       		<input type="hidden" name="stock" value="<?php echo $info->stock; ?>">
				                       	</div>
				                       </td>
				                       <td><strong>Publication</strong></td>
				                       <td><?php echo $info->publication; ?></td>
				                        
				                    </tr>
				                    <tr>
				                       <td><strong>Edition</strong></td>
				                       <td><?php echo $info->edition; ?></td>
				                       <td><strong>Volume</strong></td>
				                       <td><?php echo $info->volume; ?></td>
				                        
				                    </tr>
                            	</tbody>
                        	</table>
						</div>

						<div class="ibox float-e-margins m-t">
							<div class="ibox-title">
								<h5>Please Fill Guest Details</h5>
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
								echo form_open("library/{$this->misc->_getClassName()}/guest/{$info->book_p_id}", $attr); ?>
								
										<div class="form-group <?php if(form_error('guest-name')) echo 'has-error'; ?>">
											<?php echo form_label('Guest Name <small class="text-danger">*</small>', 'guest-name',array('class'=>'col-sm-3 control-label')); ?>
											<div class="col-sm-8">
												<?php 
											$_employee = $this->mdl_employee->dropdown('employee_id');

											echo form_dropdown(array(
												'type' => 'text',	
												'name' => 'guest-id',
												'class' => 'form-control',
												'value' => set_value('guest-id'),
												'required' => 'true'
											),$_employee);

											echo form_input(array(
												'type' => 'hidden',	
												'name' => 'book-id',
												'class' => 'form-control',
												'value' => set_value('book-id',$info->book_p_id),
												'required' => 'true'
											));

											echo form_error('guest-name'); ?>

											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
											<?php echo form_label('Remarks', 'remarks',array('class'=>'col-sm-3 control-label'));
											?>
											<div class="col-sm-8">
												<?php 
											echo form_input(array(
												'type' => 'text',	
												'name' => 'remarks',
												'class' => 'form-control',
												'placeholder' => 'Remarks',
											));

											

											echo form_error('remarks'); ?>
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

<script type="text/javascript">
	var stock = $('input[name="stock"]').val();
	if(stock == 0){
		$("#stock").html("<span class='text-danger'>Book Not In Stock, Can't Issue To Guest</span>");
		$(".btn").prop('disabled', true);
	}else{
		$("#stock span").remove();
		$(".btn").prop('disabled', false);	
	}
</script>