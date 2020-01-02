<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a href="<?= site_url("{$this->misc->_getClassName()}/add") ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= $this->misc->_getClassName(); ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<div class="tabs-container">
                        <ul class="nav nav-tabs">
	                    <?php if(isset($branches) && !empty($branches)){ ?>  
                            <ul  class="nav nav-tabs bordered sub-tabs">
                                <?php foreach($branches as $key=>$obj){ ?>
                                    <li class="<?php if($key == 0){ echo 'active'; } ?>"><a href="#tab_section_<?php echo $obj->branch_code; ?>"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"> </i> <?php echo $this->lang->line('section'); ?> <?php echo $obj->branch_code; ?></a> </li>
                                <?php } ?>
                            </ul>
	                    <?php } ?>
                        </ul>
                        <div class="tab-content">
                            <?php if(isset($branches) && !empty($branches)){ ?>   
                                <?php foreach($branches as $key=>$obj){ 
                                	?>   
                                   	<div  class="tab-pane fade in <?php if($key == 0){ echo 'active'; } ?>" id="tab_section_<?php echo $obj->branch_code; ?>" >
                                       <div class="x_content">
                                           	<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                               	<tbody>
                                               	<?php $days = $this->misc->get_week_days();  
                                                    foreach($days as $day){ ?>
                                                       	<tr>
                                                           	<td width="100"><?php echo $day; ?>
                                                           	</td>
                                                           	<td>
                                                           	<?php 
                                                           	$routines = $this->mdl_routine->get_routines_by_day($day, $semester_id, $obj->branch_p_id); ?>
                                                           	<ul class="sortable-list connectList agile-list ui-sortable">
                                                            <?php 	foreach($routines as $routine){ ?>
                                                           		
                                                           			<li class="ui-sortable-handle col-lg-2 text-center">
                                                           			<?php echo $routine->start_time." - ".$routine->end_time; ?><br>
                                                                    <?php echo $this->mdl_subject->get($routine->cr_subject_id)->subject_code?>
                                                                     <br><?php echo $this->mdl_employee->get($routine->cr_teacher_id)->username;?> <br>
                                                                     <a class="btn btn-success btn-xs	" href="<?php echo site_url("routines/edit/{$routine->routine_p_id}"); ?>"><i class="fa fa-pencil"></i> 	</a>

                                                                     <button class="btn btn-xs btn-danger deleteRow" value="<?= $routine->routine_p_id ?>">
																	<i class="fa fa-trash"></i>
																	</button>
                                                                   </li>
                                                               
                                                               <?php  }
                                                           	?> 
                                                           	</ul>
                                                           </td>

                                                        </tr>
                                                        <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
								<?php } } ?>
							</div>
				</div>
			</div>
		</div>
	</div>
</div>
