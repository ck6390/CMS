<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= base_url(); ?>">Home</a>
            </li>
            <li>Admin</li>
            <li>
                <a href="<?= site_url("admin/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
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
    <?php echo form_open(site_url('admin/backup'), array('name' => 'backup', 'id' => 'backup', 'class'=>'form-horizontal form-label-left'), ''); ?>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <input type="hidden" value="0" name="hidden">
                <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-primary">Cancel</a>
                    <button id="send" type="submit" class="btn btn-success"><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?></button>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>