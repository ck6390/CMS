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
				<a href="<?= site_url("{$this->misc->_getClassName()}/profile/{$info->student_p_id}") ?>"><span class="text-capitalize">Profile</span></a>
			</li>
			<li class="active">
				<strong>Attach New File</strong>
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
							<h5>Add New File </h5>
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
							echo form_open("{$this->misc->_getClassName()}/attach_file/{$info->student_p_id}", $attr); ?>

							<div class="col-md-12">
								<div class="form-group <?php if(form_error('file-title')) echo 'has-error'; ?>">
									<?php echo form_label('File Title <small class="text-danger">*</small>', 'file-title');

										echo form_input(array(
											'type' => 'text',
											'name' => 'file-title',
											'class' => 'form-control',
											'placeholder' => 'File Title',
											'value' => set_value('file-title'),
											'required' => 'true',
										));
										echo form_input(array(
											'type' => 'hidden',
											'name' => 'student-id',
											'class' => 'form-control',
											'value' => set_value('student-id', $info->student_unique_id),
										));

										echo form_error('file-title'); ?>
								</div>

								<div class="form-group <?php if(form_error('attach-file')) echo 'has-error'; ?>">
									
									<?php
									echo form_label('File <small class="text-danger">*</small>', 'attach-file');?>

									<div class="fileinput fileinput-new input-group" data-provides="fileinput">
    									<div class="form-control" data-trigger="fileinput">
        									<i class="glyphicon glyphicon-file fileinput-exists"></i>
    										<span class="fileinput-filename"></span>
    									</div>
    									<span class="input-group-addon btn btn-default btn-file">
								        	<span class="fileinput-new">Select file</span>
								        	<span class="fileinput-exists">Change</span>
									
											<?php echo form_input(array(
												'type' => 'file',
												'name' => 'attach-file',
												'id' => 'file_id',
												'onchange' => 'fileImage(this);',

											));

											echo form_input(array(
												'type' => 'hidden',
												'name' => 'previous-file',
												'value' => set_value('attach-file')
													
											));
											echo form_error('attach-file');?>
										</span>
										<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
									</div>

									<img id="preview_file" class="img-responsive" width="150px;" />
										<!-- <img src="<?= base_url().'assets/img/attach_file/'.$info->student_unique_id.'/'.$lists->file ?>" id="preview" class="img-responsive" width="150px;"> -->
									
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
                    <h5>List File</h5>
                </div>
                <div class="ibox-content">
                	<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>File Title </th>
									<th>Description</th>
									<th>Dated</th>
									<th>File</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="5"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {

								foreach ($lists as $list) { ?>
								<tr>
									<td>
										<?= '<span class="badge badge-primary">'.htmlspecialchars($list->file_p_id,ENT_QUOTES,'UTF-8').'</span><br/>' ?>
									</td>

									<td><?= htmlspecialchars($list->file_title,ENT_QUOTES,'UTF-8') ?></td>
									
									<td><?= htmlspecialchars($list->description,ENT_QUOTES,'UTF-8') ?></td>

                                    <td><?php echo $list->date ? $this->misc->reformatDate($list->date) : null; ?></td>

                                    <td><a href="<?php echo base_url().'assets/img/attach_file/'.$info->student_unique_id.'/'.$list->file;?>" target="_blank"><i class="fa fa-file-image-o"> Image</i></a></td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>File Title </th>
									<th>Description</th>
									<th>Dated</th>
									<th>File</th>
								</tr>
							</tfoot>
						</table>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function fileImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('#preview_file').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function(){
		$("#file_id").click(function(){	
		   	$("#preview").hide();
		    		
		});
	});
</script>
