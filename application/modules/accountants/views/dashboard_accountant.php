<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
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
		echo form_open("{$this->misc->_getClassName()}/accountant_search", $attr); ?>
    <div class="row animated fadeInRight">
        <div class="col-md-6 col-md-offset-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Enter Student ID</h5>
                </div>
                <div>
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
        </div>
    	<div class="col-md-6 col-md-offset-3">
    		<div class="ibox-content">
    			<table class="table table-bordered m-t">
                    <tbody>
		                <tr>
		                    <td><a href="<?= site_url("accountants/hostel_room_due/17") ?>"><div class="bg-primary text-center p-xs b-r-sm"><strong>Hostel Due</strong></div> </a></td>
		                    <td><a href="<?= site_url("accountants/hostel_room_due/18") ?>"><div class="bg-primary text-center p-xs b-r-sm"><strong>Fooding Due</strong></div> </a></td>
		                    <td><a href="<?= site_url("accountants/library_fee_due") ?>"><div class="bg-primary text-center p-xs b-r-sm"><strong>Library Due</strong></div> </a></td>
		                </tr>
		                <tr>
		                    
		                    <td colspan="3"><a href="accountants/academic_fee_due"><div class="bg-primary text-center p-xs b-r-sm"><strong>Academic Fee Dues</strong></div></a> </td>
		                </tr>
                 	</tbody>
             	</table>
    		</div>
    	</div>
	</div>
	<?php echo form_close(); ?>
</div>