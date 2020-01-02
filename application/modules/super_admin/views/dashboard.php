<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-5">
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
	<div class="col-md-7"><br/>
		<ul class="list-inline">
			<li><strong>Shrink Attendance</strong></li>
			<li><input placeholder="Select Date" type="text" name="selected_date" id="selected_date" class="form-control" required="true"></li>
			<li>
				<a href="#" class="btn btn-warning" target="_new" id="add_date_in">In Time</a>
			</li>
			<li>
				<a href="#" class="btn btn-warning" target="_new" id="add_date_out">Out Time</a>
			</li>
		</ul>
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
		echo form_open("{$this->misc->_getClassName()}/faculty_search", $attr); ?>
    <div class="row animated fadeInRight">
        <div class="col-md-6 col-md-offset-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Enter Faculty Id</h5>
                </div>
                <div>
                   	<div class="ibox-content">
                   		
	                    <div class="input-group">
	                        <input type="text" name="search" placeholder="Enter Faculty id " class="input form-control">
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
<div class="wrapper wrapper-content">
	<?php
		$attr = array(
			'role' => 'form',
			'method' => 'post',
			'name' => 'add-form',
			'class' => 'form-horizontal'
		);
		echo form_open("{$this->misc->_getClassName()}/student_search", $attr); ?>
    <div class="row animated fadeInRight">
    	 <div class="col-md-6 col-md-offset-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Enter Student Id</h5>
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
	</div>
	<?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function() { 
   		var ToEndDate = new Date();     
        $( "#selected_date" ).datepicker({
            format: "dd-mm-yyyy",
            autoclose:true,
            defaultDate: ToEndDate,
            endDate: ToEndDate,
        }).on('changeDate', dateChanged);
    });

function dateChanged(ev) {
	var selected_date = $(this).val();
	$('#add_date_in').attr('href','<?= base_url(); ?>index.php/attandance_bio_manual?type=in&selected_date='+selected_date);
	$('#add_date_out').attr('href','<?= base_url(); ?>index.php/attandance_bio_manual?type=out&selected_date='+selected_date);
}
</script>