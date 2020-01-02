<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li class="active">
				<strong>Dashboard</strong>
			</li>
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content">
	
    <div class="row animated fadeInRight">
    	<div class="row">
    		<div class="col-md-12">
    	<div class="col-lg-3 col-md-offset-1">
            <div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h5>Total Books</h5>
	            </div>
	            <div class="ibox-content">
	                <h1 class="no-margins"><?php echo $lists->quantity ? $lists->quantity : '0'; ?></h1>
	            </div>
	        </div>
        </div>
        <div class="col-lg-3">
           	<div class="ibox float-e-margins">
               	<div class="ibox-title">
                   	<h5>Available Books</h5>
               	</div>
               	<div class="ibox-content">
                   	<h1 class="no-margins"><?php echo $lists->stock ? $lists->stock : '0'; ?></h1>
               	</div>
           	</div>
       	</div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Issued Books</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">
                        <?php 
                            echo $lists->quantity - $lists->stock;
                            // $issued_books = $this->mdl_book_issue->total_issue_book();
                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form By Student ID -->
    <?php
		$attr = array(
			'role' => 'form',
			'method' => 'post',
			'name' => 'add-form',
			'class' => 'form-horizontal'
		);
		echo form_open("{$this->misc->_getClassName()}/library_search", $attr); ?>
        <div class="col-md-9 col-md-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Enter Student ID</h5>
                </div>
                <div class="ibox-content">
                   		
	       	        <div class="input-group">
	                    <input type="text" name="search" placeholder="Enter Student id " class="input form-control">
	       	            <span class="input-group-btn">
	                        <button type="submit" name="submit" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
	                    </span>
	                </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
        <!-- form end -->

        <!-- search form by book accession no. -->
        <?php
		$attr = array(
			'role' => 'form',
			'method' => 'post',
			'name' => 'add-form',
			'class' => 'form-horizontal'
		);
		echo form_open("{$this->misc->_getClassName()}/guest_issue", $attr); ?>
        <div class="col-md-9 col-md-offset-1">
            <div class="ibox float-e-margins">
            	<div class="ibox-title">
            		<h5 style="color: blue">Issued / Submit A Book for Guest</h5>
            	</div>
                <div class="ibox-title">
                    <h5>Enter Book Acc No.</h5>
                </div>
                <div class="ibox-content">
                   		
	       	        <div class="input-group">
	                    <input type="text" name="accession_search" placeholder="Enter Book Accession No." class="input form-control">
	       	            <span class="input-group-btn">
	                        <button type="submit" name="submit" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
	                    </span>
	                </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
