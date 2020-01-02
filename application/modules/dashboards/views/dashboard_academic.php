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
            	<div class="col-lg-2 col-md-offset-2">
                    <div class="ibox float-e-margins">
        	            <div class="ibox-title">
        	                <h5>Pending</h5>
        	            </div>
        	            <div class="ibox-content">
        	                <h1 class="no-margins"><?php $result = $this->db->query("SELECT admission_status FROM students WHERE admission_status = 'pending'");
                                echo $result->num_rows();  ?>   
                            </h1>
                            <small>Students</small>
        	            </div>
        	        </div>
                </div>
                <div class="col-lg-2">
                   	<div class="ibox float-e-margins">
                       	<div class="ibox-title">
                           	<h5>Provisional</h5>
                       	</div>
                       	<div class="ibox-content">
                            <h1 class="no-margins"><?php $result = $this->db->query("SELECT admission_status FROM students WHERE admission_status = 'provisional'");
                                echo $result->num_rows(); ?></h1>
                                <small>Students</small>
                       	</div>
                   	</div>
               	</div>
                <div class="col-lg-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Final</h5>
                        </div>
                        <div class="ibox-content">
                            
                            <h1 class="no-margins"><?php $result = $this->db->query("SELECT admission_status FROM students WHERE admission_status = 'final'"); 
                                echo $result->num_rows(); ?></h1>
                                <small>Students</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Junk</h5>
                        </div>
                        <div class="ibox-content">
                            
                            <h1 class="no-margins"><?php $result = $this->db->query("SELECT admission_status FROM students WHERE admission_status = 'junk'");
                                echo $result->num_rows(); ?></h1>
                                <small>Students</small>
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
                    echo form_open("{$this->misc->_getClassName()}/academic_search", $attr); ?>
                    <div class="col-md-8 col-md-offset-2">
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
                    <?php echo form_close();
                ?>
                    <!-- form end -->
            </div>
        </div>
    </div>
</div>
