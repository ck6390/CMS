<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li> 
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong>Debit</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
           
        </div>
	</div>
</div>

<div class="wrapper wrapper-content">
	<?php
	$attr = array(
		'role' => 'form',
		'method' => 'post',
		'class' => 'form-horizontal',
	);
	echo form_open("{$this->misc->_getClassName()}/debit", $attr); ?>
		<div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                     <?php  $instituteInfo = $this->mdl_general_setting->get('6'); ?>
                                     <img class="img-thumbnail img-md col-sm-12" src="<?php echo base_url() ?>assets/img/institute/<?php echo $instituteInfo->inst_logo; ?>" style="width:120px;">
                                       
                                        <h3 style="text-align:center;margin-bottom:20px;margin-top:0px;"><span class="text-success" > <?php echo $instituteInfo->inst_name; ?></span>
                                        </h3>
                                        <p class="text-center">AT NH-31, HARNAUT, NALANDA, BIHAR - 803110, Mo - 9473000022</p>
                                        
                                    </td>  
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                            <div class="row">
                                <div class="col-sm-10">
                                    
                                    <div class="form-group  p-r-none<?php if(form_error('pay-to')) echo 'has-error'; ?>">
                                        <div class="col-sm-4">
                                            <?php 
                                             echo form_label('Amount Paid To <small class="text-danger">*</small>', 'pay-to',array('class'=>'pull-right'));
                                            ?>
                                        </div>
                                         <div class="col-sm-8 p-r-none">
                                            <?php
                                           
                                            echo form_input(array(
                                                'type' => 'text',
                                                'name' => 'pay-to',
                                                'class' => 'form-control',
                                                'required' =>'true'
                                                
                                            ));
                                            echo form_error('pay-to'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group  p-r-none<?php if(form_error('purpose')) echo 'has-error'; ?>">
                                        <div class="col-sm-4">
                                            <?php 
                                             echo form_label('Purpose <small class="text-danger">*</small>', 'purpose',array('class'=>'pull-right'));
                                            ?>
                                        </div>
                                         <div class="col-sm-8 p-r-none">
                                            <?php
                                            $_purpose = $this->mdl_debit_purpose->dropdown('purpose_name');
                                            echo form_dropdown(array(
                                                'type' => 'text',
                                                'name' => 'purpose',
                                                'class' => 'form-control',
                                                'rows' => '3',
                                                'required' =>'true'
                                                
                                            ),$_purpose);
                                            echo form_error('purpose'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group  p-r-none<?php if(form_error('remarks')) echo 'has-error'; ?>">
                                        <div class="col-sm-4">
                                            <?php 
                                             echo form_label('Remarks', 'remarks',array('class'=>'pull-right'));
                                            ?>
                                        </div>
                                         <div class="col-sm-8 p-r-none">
                                            <?php
                                           
                                            echo form_textarea(array(
                                                'type' => 'text',
                                                'name' => 'remarks',
                                                'class' => 'form-control',
                                                'rows' => '3'
                                                
                                            ));
                                            echo form_error('remarks'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group  p-r-none<?php if(form_error('pay_method')) echo 'has-error'; ?>">
                                        <div class="col-sm-4">
                                            <?php 
                                             echo form_label('Amount<small class="text-danger">*</small>', 'payble-amount',array('class'=>'pull-right'));
                                            ?>
                                        </div>
                                         <div class="col-sm-8 p-r-none">
                                            <?php
                                           
                                            echo form_input(array(
                                                'type' => 'text',
                                                'name' => 'payble-amount',
                                                'id' => 'amount',
                                                'class' => 'form-control',
                                                'required' =>'true'
                                                
                                            ));
                                            echo form_error('payble-amount'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group  p-r-none<?php if(form_error('pay_method')) echo 'has-error'; ?>">
                                        <div class="col-sm-4">
                                            <?php 
                                             echo form_label('Payment Mode <small class="text-danger">*</small>', 'pay-method',array('class'=>'pull-right'));
                                            ?>
                                        </div>
                                         <div class="col-sm-8 p-r-none">
                                            <?php
                                       
                                            $_paymethod = $this->mdl_pay_mode->dropdown('payment_mode_name');
                                            
                                            echo form_dropdown(array(
                                                'name' => 'pay-method',
                                                'id' => 'pay_method',
                                                'class' => 'form-control',
                                                'required' =>'true'
                                            ), $_paymethod);

                                            echo form_error('pay-method'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group p-r-none<?php if(form_error('pay_method')) echo 'has-error'; ?>">
                                        <div class="col-sm-4">
                                            <?php 
                                              echo form_label('Ref No./ Check No./ DD ', 'reference-no',array('class'=>'pull-right'));
                                            ?>
                                        </div>
                                         <div class="col-sm-8 p-r-none">
                                           <?php
                                           
                                            echo form_input(array(
                                                'type' => 'text',
                                                'name' => 'reference-no',
                                                'class' => 'form-control',
                                                'placeholder' => 'Refenrence no.',
                                                
                                            ));
                                            echo form_error('reference-no'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                         <button  class="btn btn-primary" type="submit"><i class="fa fa-rupee"></i> Make A Payment</button>
                                </div>
                            </div>
                            </div>
                            

                            <div class="well m-t"><strong>This is system generated invoice</strong>
                                
                            </div>
                        </div>
                </div>
            </div>
        </div>
	<?php echo form_close(); ?>

</div>
