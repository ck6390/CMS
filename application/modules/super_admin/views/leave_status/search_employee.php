<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("super_admin/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
			</li> 
			<li class="active">
				<strong>Dashboard</strong>
			</li>
		</ol>
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
		echo form_open("super_admin/{$this->misc->_getClassName()}", $attr); ?>
    <div class="row animated fadeInRight">
        <div class="col-md-6 col-md-offset-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Enter Faculty Id For Leave status</h5>
                </div>
                <div>
                   	<div class="ibox-content">
                   		
	                    <div class="input-group">
	                        <input type="text" name="search-faculty" placeholder="Enter Faculty id " class="input form-control">
	           	            <span class="input-group-btn">
	                            <button type="submit" name="submit" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
	                        </span>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<?php echo form_close(); ?>
</div>