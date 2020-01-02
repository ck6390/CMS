<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><span class="text-capitalize">Guest <?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>Library</li>
			<li>
				<a href="<?= site_url("library/{$this->misc->_getClassName()}") ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()); ?></span></a>
			</li>
			<li class="active">
				<strong>Guest</strong>
			</li>
		</ol>
	</div>
	
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-12">
            <div class="row">
				<div class="col-sm-12">
					<div class="ibox float-e-margins">
						    <div class="ibox-title">
						
			                    <h5>Guest Issued Book List</h5>
			                </div>
				            <div class="ibox-content">
				             	<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover dataTablesView">
										<thead>
											<tr>
												<th>Serial No.</th>
												<th>Guest Name </th>
												<th>Book Title</th>
												<th>Acc. No.</th>
												<th>Call No.</th>
												<th>Issue Date</th>
												<th>Return Date</th>
												<th>Remarks</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if(count($lists) == 0) { ?>
												<tr class="text-center text-uppercase">
													<td colspan="9"><strong>NO RECORD AVAILABLE</strong></td>
												</tr>
											<?php
											} else {
												
												foreach ($lists as $list) { ?>
												<tr>
													<td>
														<strong><?= '<span class="badge badge-primary">'.htmlspecialchars($list->guest_p_id,ENT_QUOTES,'UTF-8').'</span><br/>' ?></strong>
													</td>
													<td><?= htmlspecialchars($this->mdl_employee->get($list->guest_id)->emp_name."[ ".$this->mdl_employee->get($list->guest_id)->employee_id." ]",ENT_QUOTES,'UTF-8') ?></td>

													<td><?= htmlspecialchars($this->mdl_book->get($list->book_id)->book_name,ENT_QUOTES,'UTF-8') ?></td>

													<td><?= htmlspecialchars($this->mdl_book->get($list->book_id)->accession_no,ENT_QUOTES,'UTF-8') ?></td>

													<td><?= htmlspecialchars($this->mdl_book->get($list->book_id)->call_no,ENT_QUOTES,'UTF-8') ?></td>
														
													<td><?php $date = new DateTime($list->issue_date);
					                                        echo $date->format('d/m/Y');?></td>

					                                <td><?php $date = new DateTime($list->return_date);
					                                        echo $date->format('d/m/Y');?></td>

					                                <td><?= htmlspecialchars($list->remarks,ENT_QUOTES,'UTF-8') ?></td>

					                                <td><?php if($list->is_active == 0){?>

					                                		<span class="btn btn-success btn-xs"><i class="fa fa-ban"></i> Returned</span>
					                         			<?php }else{?>

					                                    	<a href="<?php echo site_url("library/{$this->misc->_getClassName()}/guest_book_return/{$list->book_id}/{$list->guest_p_id}"); ?>"class="btn btn-primary btn-xs"><i class="fa fa-undo"></i> Return </a>
					                                    
					                                    <?php }  ?>
					                                   <!--  <a href="<?php echo site_url("library/{$this->misc->_getClassName()}/guest_book_edit/{$list->guest_p_id}"); ?>"class="btn btn-primary btn-xs"><i class="fa fa-undo"></i> Edit </a> -->
					                                </td>
												</tr>
											<?php }
											} ?>
										</tbody>
										<tfoot>
											<tr>
												<th>Serial No.</th>
												<th>Guest Name </th>
												<th>Book Title</th>
												<th>Acc. No.</th>
												<th>Call No.</th>
												<th>Issue Date</th>
												<th>Return Date</th>
												<th>Remarks</th>
												<th>Action</th>
											</tr>
										</tfoot>
									</table>
								</div>
				            </div>
					</div>
				</div>
			</div>
    	</div>
	</div>
</div>
