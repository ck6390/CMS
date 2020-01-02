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
		'name' => 'add-form',
		'class' => 'form-horizontal'
	);
	echo form_open("library/{$this->misc->_getClassName()}/add", $attr); ?>
		<div class="row">

			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Add New Book</h5>
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
												'value' => set_value('accession-no'),
												'required' => 'true',
											));

											echo form_error('accession-no'); ?>

										</div>

										<div class="form-group <?php if(form_error('book-type')) echo 'has-error'; ?>">
											<?php
											echo form_label('Book Type', 'book-type');

											$_type = $this->mdl_Book_type->dropdown('book_type');

											echo form_dropdown(array(
												'name' => 'book-type',
												'class' => 'form-control select2_one',
												'value' => set_value('book-type'),
											), $_type);
											echo form_error('book-type'); ?>
										</div>

										<div class="form-group <?php if(form_error('book-name')) echo 'has-error'; ?>">
											<?php echo form_label('Book Name <small class="text-danger">*</small>', 'book-name');

											echo form_input(array(
												'type' => 'text',
												'name' => 'book-name',
												'class' => 'form-control',
												'placeholder' => 'Book Name',
												'value' => set_value('book-name'),
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
												'placeholder' => 'Author Name',
												'value' => set_value('author-name'),
												'required' => 'true'
											));

											echo form_error('author-name'); ?>

										</div>

										<div class="form-group <?php if(form_error('publication')) echo 'has-error'; ?>">
											<?php echo form_label('Publication <small class="text-danger">*</small>', 'publication');

											echo form_input(array(
												'type' => 'text',
												'name' => 'publication',
												'class' => 'form-control',
												'value' => set_value('publication'),
												'placeholder' => 'Publication',
												'required' => 'true'
											));

											echo form_error('publication'); ?>

										</div>

										<div class="form-group <?php if(form_error('volume')) echo 'has-error'; ?>">
											<?php echo form_label('Volume', 'volume');

											echo form_input(array(
												'type' => 'text',
												'name' => 'volume',
												'class' => 'form-control',
												'value' => set_value('volume'),
												'placeholder' => 'Volume',
											));

											echo form_error('volume'); ?>

										</div>

										<div class="form-group <?php if(form_error('place')) echo 'has-error'; ?>">
											<?php echo form_label('Place <small class="text-danger">*</small>', 'place');

											echo form_input(array(
												'type' => 'text',
												'name' => 'place',
												'class' => 'form-control',
												'value' => set_value('place'),
												'placeholder' => 'Place',
												'required' => 'true'
											));

											echo form_error('place'); ?>

										</div>

										<div class="form-group <?php if(form_error('total-page')) echo 'has-error'; ?>">
											<?php echo form_label('Total Pages <small class="text-danger">*</small>', 'total-page');

											echo form_input(array(
												'type' => 'text',
												'name' => 'total-page',
												'class' => 'form-control',
												'value' => set_value('total-page'),
												'placeholder' => 'Total Pages',
												'required' => 'true'
											));

											echo form_error('total-page'); ?>

										</div>

										<div class="form-group <?php if(form_error('isbn-no')) echo 'has-error'; ?>">
											<?php echo form_label('ISBN No. <small class="text-danger">*</small>', 'isbn-no');

											echo form_input(array(
												'type' => 'text',
												'name' => 'isbn-no',
												'class' => 'form-control',
												'placeholder' => 'ISBN Number',
												'value' => set_value('isbn-no'),
												'required' => 'true'
											));

											echo form_error('isbn-no'); ?>
										</div>

										<div class="form-group <?php if(form_error('language')) echo 'has-error'; ?>">
											<?php echo form_label('Language <small class="text-danger">*</small>', 'language');

											echo form_input(array(
												'type' => 'text',
												'name' => 'language',
												'class' => 'form-control',
												'value' => set_value('language'),
												'placeholder' => 'Language',
												'required' => 'true'
											));

											echo form_error('language'); ?>
										</div>

										<div class="form-group <?php if(form_error('stream')) echo 'has-error'; ?>">
											<?php echo form_label('Stream <small class="text-danger">*</small>', 'stream');

											echo form_input(array(
												'type' => 'text',
												'name' => 'stream',
												'class' => 'form-control',
												'value' => set_value('stream'),
												'placeholder' => 'Stream',
												'required' => 'true'
											));

											echo form_error('stream'); ?>
										</div>

										<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
											<?php echo form_label('Remarks', 'remarks');

											echo form_input(array(
												'type' => 'text',
												'name' => 'remarks',
												'class' => 'form-control',
												'value' => set_value('remarks'),
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
												'placeholder' => 'Call No.',
												'value' => set_value('call-no'),
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
												'class' => 'form-control select2_one',
												'value' => set_value('book-source'),
											), $_source);
											echo form_error('book-source'); ?>
										</div>

										<div class="form-group <?php if(form_error('book-category')) echo 'has-error'; ?>">
											<?php
											echo form_label('Book Category', 'book-category');

											$_category = $this->mdl_book_category->dropdown('category_name');

											echo form_dropdown(array(
												'name' => 'book-category',
												'class' => 'form-control select2_one',
												'value' => set_value('book-category'),
											), $_category);
											echo form_error('book-category'); ?>
										</div>

										<div class="form-group <?php if(form_error('quantity')) echo 'has-error'; ?>">
											<?php echo form_label('Quantity <small class="text-danger">*</small>', 'quantity');

											echo form_input(array(
												'type' => 'text',
												'name' => 'quantity',
												'class' => 'form-control',
												'placeholder' => 'Quantity',
												'value' => set_value('quantity'),
												'required' => 'true'
											));

											echo form_error('quantity'); ?>

										</div>

										<div class="form-group <?php if(form_error('publisher')) echo 'has-error'; ?>">
											<?php echo form_label('Publisher <small class="text-danger">*</small>', 'publisher');

											echo form_input(array(
												'type' => 'text',
												'name' => 'publisher',
												'class' => 'form-control',
												'value' => set_value('publisher'),
												'placeholder' => 'Publisher',
												'required' => 'true'
											));

											echo form_error('publisher'); ?>

										</div>

										<div class="form-group <?php if(form_error('edition')) echo 'has-error'; ?>">
											<?php echo form_label('Edition <small class="text-danger">*</small>', 'edition');

											echo form_input(array(
												'type' => 'text',
												'name' => 'edition',
												'class' => 'form-control',
												'value' => set_value('edition'),
												'placeholder' => 'Edition',
												'required' => 'true'
											));

											echo form_error('edition'); ?>

										</div>

										<div class="form-group <?php if(form_error('month')) echo 'has-error'; ?>">
											<?php echo form_label('Month', 'month');

											echo form_input(array(
												'type' => 'text',
												'name' => 'month',
												'class' => 'form-control',
												'value' => set_value('month'),
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
												'value' => set_value('price'),
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
												'placeholder' => 'CSIR number',
												'value' => set_value('csir-no'),
											));

											echo form_error('csir-no'); ?>

										</div>

										<div class="form-group <?php if(form_error('course')) echo 'has-error'; ?>">
											<?php echo form_label('Course', 'course');

											echo form_input(array(
												'type' => 'text',
												'name' => 'course',
												'class' => 'form-control',
												'placeholder' => 'Course',
												'value' => set_value('course')
											));

											echo form_error('course'); ?>

										</div>

										<div class="form-group <?php if(form_error('bill-no')) echo 'has-error'; ?>">
											<?php echo form_label('Bill No. <small class="text-danger">*</small>', 'bill-no');

											echo form_input(array(
												'type' => 'text',
												'name' => 'bill-no',
												'class' => 'form-control',
												'value' => set_value('bill-no'),
												'placeholder' => 'Bill No.',
												'required' => 'true'
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
												'value' => set_value('book-description'),
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
