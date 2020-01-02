<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Library</li>
			<li>
				<a href="<?= site_url("library/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
	echo form_open("library/{$this->misc->_getClassName()}/edit/{$info->book_p_id}", $attr); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Edit Book Details</h5>
						<div class="ibox-tools">
							<small><code>*</code> Required Fields.</small>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6 b-r">
									<div class="col-md-12">
										
										<div class="form-group <?php if(form_error('accession-no')) echo 'has-error'; ?>">
											<?php echo form_label('Accession No. <small class="text-danger">*</small>', 'accession-no');

											echo form_input(array(
												'type' => 'text',
												'name' => 'accession-no',
												'class' => 'form-control',
												'placeholder' => 'Accession No.',
												'value' => set_value('accession-no', $info->accession_no),
												'required' => 'true',
												'readonly' => 'true'
											));

											echo form_error('accession-no'); ?>

										</div>

										<div class="form-group <?php if(form_error('book-type')) echo 'has-error'; ?>">
											<?php
											echo form_label('Book Type', 'book-type');

											$_type = $this->mdl_Book_type->dropdown('book_type');

											echo form_dropdown(array(
												'name' => 'book-type',
												'class' => 'form-control select2_one'
											), $_type, $info->book_type_id);
											echo form_error('book-type'); ?>
										</div>

										<div class="form-group <?php if(form_error('book-name')) echo 'has-error'; ?>">
											<?php echo form_label('Book Name <small class="text-danger">*</small>', 'book-name');

											echo form_input(array(
												'type' => 'text',
												'name' => 'book-name',
												'class' => 'form-control',
												'value' => set_value('book-name', $info->book_name),
												'placeholder' => 'Book Name',
												'required' => 'true'
											));

											echo form_error('book-name'); ?>

										</div>

										<div class="form-group <?php if(form_error('author-name')) echo 'has-error'; ?>">
											<?php echo form_label('Author Name <small class="text-danger">*</small>', 'author-name');

											echo form_input(array(
												'type' => 'text',
												'name' => 'author-name',
												'class' => 'form-control',
												'value' => set_value('author-name', $info->author_name),
												'placeholder' => 'Author Name',
												'required' => 'true'
											));

											echo form_error('author-name'); ?>

										</div>

										<div class="form-group <?php if(form_error('publication')) echo 'has-error'; ?>">
											<?php echo form_label('Publication', 'publication');

											echo form_input(array(
												'type' => 'text',
												'name' => 'publication',
												'class' => 'form-control',
												'value' => set_value('publication', $info->publication),
												'placeholder' => 'Publication',
											));

											echo form_error('publication'); ?>

										</div>

										<div class="form-group <?php if(form_error('volume')) echo 'has-error'; ?>">
											<?php echo form_label('Volume', 'volume');

											echo form_input(array(
												'type' => 'text',
												'name' => 'volume',
												'class' => 'form-control',
												'value' => set_value('volume', $info->volume),
												'placeholder' => 'Volume',
											));

											echo form_error('volume'); ?>

										</div>

										<div class="form-group <?php if(form_error('place')) echo 'has-error'; ?>">
											<?php echo form_label('Place', 'place');

											echo form_input(array(
												'type' => 'text',
												'name' => 'place',
												'class' => 'form-control',
												'value' => set_value('place', $info->place),
												'placeholder' => 'Place',
											));

											echo form_error('place'); ?>

										</div>

										<div class="form-group <?php if(form_error('total-page')) echo 'has-error'; ?>">
											<?php echo form_label('Total Pages', 'total-page');

											echo form_input(array(
												'type' => 'text',
												'name' => 'total-page',
												'class' => 'form-control',
												'value' => set_value('total-page', $info->total_page),
												'placeholder' => 'Total Pages',
											));

											echo form_error('total-page'); ?>

										</div>

										<div class="form-group <?php if(form_error('isbn-no')) echo 'has-error'; ?>">
											<?php echo form_label('ISBN No. <small class="text-danger">*</small>', 'isbn-no');

											echo form_input(array(
												'type' => 'text',
												'name' => 'isbn-no',
												'class' => 'form-control',
												'value' => set_value('isbn-no', $info->isbn_no),
												'placeholder' => 'ISBN Number',
												'required' => 'true'
											));

											echo form_error('isbn-no'); ?>
										</div>

										<div class="form-group <?php if(form_error('language')) echo 'has-error'; ?>">
											<?php echo form_label('Language', 'language');

											echo form_input(array(
												'type' => 'text',
												'name' => 'language',
												'class' => 'form-control',
												'value' => set_value('language', $info->language),
												'placeholder' => 'Language'
											));

											echo form_error('language'); ?>
										</div>

										<div class="form-group <?php if(form_error('stream')) echo 'has-error'; ?>">
											<?php echo form_label('Stream', 'stream');

											echo form_input(array(
												'type' => 'text',
												'name' => 'stream',
												'class' => 'form-control',
												'value' => set_value('stream', $info->stream),
												'placeholder' => 'Stream'
											));

											echo form_error('stream'); ?>
										</div>

										<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
											<?php echo form_label('Remarks', 'remarks');

											echo form_input(array(
												'type' => 'text',
												'name' => 'remarks',
												'class' => 'form-control',
												'value' => set_value('remarks', $info->remarks),
												'placeholder' => 'Remarks',
											));

											echo form_error('remarks'); ?>

										</div>
									</div>	
								</div>
								<div class="col-md-6">
									<div class="col-md-12">
										<div class="form-group <?php if(form_error('call-no')) echo 'has-error'; ?>">
											<?php echo form_label('Call No. <small class="text-danger">*</small>', 'call-no');

											echo form_input(array(
												'type' => 'text',
												'name' => 'call-no',
												'class' => 'form-control',
												'value' => set_value('call-no', $info->call_no),
												'placeholder' => 'Call No.',
												'required' => 'true'
											));

											echo form_error('call-no'); ?>

										</div>

										<div class="form-group <?php if(form_error('book-source')) echo 'has-error'; ?>">
											<?php
											echo form_label('Book Source', 'book-source');

											$_source = $this->mdl_book_source->dropdown('source_name');

											echo form_dropdown(array(
												'name' => 'book-source',
												'class' => 'form-control select2_one'
											), $_source, $info->book_source_id);
											echo form_error('book-source'); ?>
										</div>

										<div class="form-group <?php if(form_error('book-category')) echo 'has-error'; ?>">
											<?php
											echo form_label('Book Category', 'book-category');

											$_category = $this->mdl_book_category->dropdown('category_name');

											echo form_dropdown(array(
												'name' => 'book-category',
												'class' => 'form-control select2_one'
											), $_category, $info->book_category_id);
											echo form_error('book-category'); ?>
										</div>

										<div class="form-group <?php if(form_error('quantity')) echo 'has-error'; ?>">
											<?php echo form_label('Quantity', 'quantity');

											echo form_input(array(
												'type' => 'text',
												'name' => 'quantity',
												'class' => 'form-control',
												'value' => set_value('quantity', $info->quantity),
												'placeholder' => 'Quantity',
											));

											echo form_error('quantity'); ?>

										</div>
										<?php 
											echo form_input(array(
												'type' => 'hidden',
												'name' => 'prev-quantity',
												'class' => 'form-control',
												'value' => set_value('prev-quantity', $info->quantity),
												'placeholder' => 'Pre Quantity',
											));

											echo form_error('prev-quantity'); ?>

										<?php 
											echo form_input(array(
												'type' => 'hidden',
												'name' => 'prev-stock',
												'class' => 'form-control',
												'value' => set_value('prev-stock', $info->stock),
												'placeholder' => 'Pre Stock',
											));

											echo form_error('prev-stock'); ?>

										<div class="form-group <?php if(form_error('publisher')) echo 'has-error'; ?>">
											<?php echo form_label('Publisher', 'publisher');

											echo form_input(array(
												'type' => 'text',
												'name' => 'publisher',
												'class' => 'form-control',
												'value' => set_value('publisher', $info->publisher),
												'placeholder' => 'Publisher',
											));

											echo form_error('publisher'); ?>

										</div>

										<div class="form-group <?php if(form_error('edition')) echo 'has-error'; ?>">
											<?php echo form_label('Edition', 'edition');

											echo form_input(array(
												'type' => 'text',
												'name' => 'edition',
												'class' => 'form-control',
												'value' => set_value('edition', $info->edition),
												'placeholder' => 'Edition',
											));

											echo form_error('edition'); ?>

										</div>

										<div class="form-group <?php if(form_error('month')) echo 'has-error'; ?>">
											<?php echo form_label('Month', 'month');

											echo form_input(array(
												'type' => 'text',
												'name' => 'month',
												'class' => 'form-control',
												'value' => set_value('month', $info->month),
												'placeholder' => 'Month',
											));

											echo form_error('month'); ?>

										</div>

										<div class="form-group <?php if(form_error('price')) echo 'has-error'; ?>">
											<?php echo form_label('Price <small class="text-danger">*</small>', 'price');

											echo form_input(array(
												'type' => 'text',
												'name' => 'price',
												'class' => 'form-control',
												'placeholder' => 'Price',
												'value' => set_value('price', $info->price),
												'required' => 'true'
											));

											echo form_error('price'); ?>

										</div>

										<div class="form-group <?php if(form_error('csir-no')) echo 'has-error'; ?>">
											<?php echo form_label('CSIR No.', 'csir-no');

											echo form_input(array(
												'type' => 'text',
												'name' => 'csir-no',
												'class' => 'form-control',
												'value' => set_value('csir-no', $info->csir_no),
												'placeholder' => 'CSIR number',
											));

											echo form_error('csir-no'); ?>

										</div>

										<div class="form-group <?php if(form_error('course')) echo 'has-error'; ?>">
											<?php echo form_label('Course', 'course');

											echo form_input(array(
												'type' => 'text',
												'name' => 'course',
												'class' => 'form-control',
												'value' => set_value('course', $info->course),
												'placeholder' => 'Course',
											));

											echo form_error('course'); ?>

										</div>

										<div class="form-group <?php if(form_error('bill-no')) echo 'has-error'; ?>">
											<?php echo form_label('Bill No.', 'bill-no');

											echo form_input(array(
												'type' => 'text',
												'name' => 'bill-no',
												'class' => 'form-control',
												'value' => set_value('bill-no', $info->bill_no),
												'placeholder' => 'Bill No.',
											));

											echo form_error('bill-no'); ?>

										</div>

										<div class="form-group <?php if(form_error('book-description')) echo 'has-error'; ?>">
											<?php echo form_label('Description', 'book-description');

											echo form_textarea(array(
												'name' => 'book-description',
												'class' => 'form-control',
												'cols' => '20',
												'rows' => '3',
												'value' => set_value('book-description', $info->description),
												'placeholder' => 'Book Description'
											));

											echo form_error('book-description'); ?>
										</div>
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
