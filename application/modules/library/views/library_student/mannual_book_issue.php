<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize">Issue Book<!-- <?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?> --></span></h2>
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
				<strong>Mannual Issue</strong>
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
	                <img alt="image" class="img-responsive img-thumbnail" style="width: 100%;height: 207px;" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_photo}") ?>">

	                <img alt="image" class="img-responsive img-thumbnail m-t" src="<?= base_url("assets/img/students/{$info->student_unique_id}/{$info->student_sign}") ?>">

	            </div>
	            <div class="ibox-content profile-content">
	                <h4><strong><?php echo $info->student_full_name; ?></strong></h4>
	                <h5><strong>Student ID</strong></h5>
	                <h4 class="text-info"><strong><?php echo $info->student_unique_id; ?></strong></h4>
	                <h5><strong>Admission No.</strong></h5>
	                <h4 class="text-info"><strong><?php echo $info->admission_no; ?></strong></h4>
                    <!-- <div class="bg-danger p-xs b-r-sm"> Admin Due : <?php echo $fee_dues->due_amount ? $fee_dues->due_amount : 0.00; ?>  </div> -->
                    <div class="bg-danger p-xs b-r-sm m-t"> Library Fine : <?php echo $library_dues->library_fine ? $library_dues->library_fine : 0.00; ?>  </div>
	                
	            </div>
	        </div>    
    	</div>
    	<div class="col-md-9">
		    <div class="row">
				<div class="col-sm-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>Mannual Issue Book </h5>
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
							echo form_open("library/{$this->misc->_getClassName()}/mannual_issue/{$info->student_p_id}", $attr); ?>
							<div class="col-md-12">
								<div class="form-group <?php if(form_error('book-accession')) echo 'has-error'; ?>">
									<?php
										echo form_label('Accession No. <small class="text-danger">*</small>', 'book-accession');

										echo form_input(array(
											'type' => 'text',
											'name' => 'book-accession',
											'id' => 'accession_id',
											'class' => 'form-control',
											'placeholder' => 'Accession no.',
											'required' => 'true'
										));
										echo form_error('book-accession'); ?>
								</div>

								<div class="form-group <?php if(form_error('book-title')) echo 'has-error'; ?>">
									<?php
										echo form_label('Book Title', 'book-title');

										echo form_input(array(
											'type' => 'text',
											'name' => 'book-title',
											'class' => 'form-control',
											'placeholder' => 'Book Title',
											'readonly' => 'true'
										));

										echo form_input(array(
											'type' => 'hidden',
											'name' => 'book-id',
											'class' => 'form-control',
											'placeholder' => 'Book ID',
										));
										echo form_error('book-title'); ?>
								</div>

								<div class="form-group">
									<?php echo form_label('Book Stock', 'stock');

										echo form_input(array(
											'type' => 'text',	
											'name' => 'stock',
											'class' => 'form-control',
											'placeholder' => 'Book Availability',
											'readonly' => 'true'
										));?>
												
									<?php
										echo form_error('stock'); ?>
										<div id="stock"></div>
								</div>

								<div class="form-group <?php if(form_error('call-no')) echo 'has-error'; ?>">
									<?php echo form_label('Call No.', 'call-no');

										echo form_input(array(
											'type' => 'text',	
											'name' => 'call-no',
											'class' => 'form-control',
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
											'placeholder' => 'Course',
											'readonly' => 'true'
										));

										echo form_error('course'); ?>
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

<script type="text/javascript">
$(document).ready(function() {

	$('#accession_id').on('change', function() {
		var accessionID = $(this).val();
		if(accessionID) {
			$.ajax({
				url: base_url + "index.php/library/books/get_book_detail/" + accessionID,
				type: "POST",
				success:function(data)
				{
					var dataObj = jQuery.parseJSON(data);
					if(dataObj) {
						
						$('input[name="book-id"]').attr('value', dataObj.book_p_id);
						$('input[name="book-title"]').attr('value', dataObj.book_name);
						$('input[name="stock"]').attr('value', dataObj.stock);
						$('input[name="call-no"]').attr('value', dataObj.call_no);
						$('input[name="author-name"]').attr('value', dataObj.author_name);
						$('input[name="stream"]').attr('value', dataObj.stream);
						$('input[name="course"]').attr('value', dataObj.course);
						
						var stock = $('input[name="stock"]').val();
						if(stock == 0){
							$("#stock").html("<span class='text-danger'>Book Not In Stock, Can't Issue To Student</span>");
							$(".btn").prop('disabled', true);
						}else{
							$("#stock span").remove();
							$(".btn").prop('disabled', false);	
						}

					} else {
						$('input[name="book-id"]').attr('value', '');
						$('input[name="book-title"]').attr('value', '');
						$('input[name="stock"]').attr('value', '');
						$('input[name="accession-no"]').attr('value', '');
						$('input[name="call-no"]').attr('value', '');
						$('input[name="author-name"]').attr('value', '');
						$('input[name="stream"]').attr('value', '');
						$('input[name="course"]').attr('value', '');

					}
				}
			});
		} else {
			$('input[name="book-id"]').attr('value', '');
			$('input[name="book-title"]').attr('value', '');
			$('input[name="stock"]').attr('value', '');
			$('input[name="accession-no"]').attr('value', '');
			$('input[name="call-no"]').attr('value', '');
			$('input[name="author-name"]').attr('value', '');
			$('input[name="stream"]').attr('value', '');
			$('input[name="course"]').attr('value', '');
			$("#stock span").remove();
			$(".btn").prop('disabled', false);	
		}
	});
});
</script>
