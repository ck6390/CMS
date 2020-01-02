<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-5">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="#">Hostel</a>
			</li>
			<li>
				<a href="<?= site_url("hostel/{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-7">
		<div class="title-action">
			<a href="<?= site_url("hostel/".$this->misc->_getClassName().'/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span> List <small>(Please use the table below to navigate or filter the results.)</small></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Student Id</th>
									<th>Session</th>
									<th>Year</th>
									<th>Branch</th>
									<th>Fee Type</th>
									<th>Month</th>
									<th>Due Amount</th>
									<th>Payment status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="10"><strong>NO RECORDS AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								$i = 0;
								foreach ($lists as $list) { 
									$month = date("F", strtotime($list->hostel_charge_month));
                                    $year = date("Y", strtotime($list->hostel_charge_month));
									$i++; ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="hostel/<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>

									<td><?= '<strong> '.htmlspecialchars($list->student_unique_id,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->session_name,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->course_year_name,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->branch_code,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->fee_type_name ,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									
									<td><?= '<strong> '.htmlspecialchars($month."-".$year,ENT_QUOTES,'UTF-8').'</strong>'; ?>
										

									</td>
									<td>
										<?php 

										if($list->paid_status=="partial"){
											// echo $list->fee_amount;

											// echo $list->late_fine;

											// echo $list->due_amount;
											echo '<strong> '.htmlspecialchars($list->fee_amount+$list->late_fine-$list->due_amount,ENT_QUOTES,'UTF-8').'</strong>';
										}else{
											
											echo '<strong> '.htmlspecialchars($list->fee_amount+$this->misc->hostelFine($list->hostel_charge_month),ENT_QUOTES,'UTF-8').'</strong>';
											//echo $this->misc->hostelFine($list->hostel_charge_month);
											//print_r($this->misc->hostelFine($list->hostel_charge_month));
											//echo $list->fee_amount;
										}
										
									?>
										
									</td>
									<td><?= '<strong> '.htmlspecialchars($list->paid_status,ENT_QUOTES,'UTF-8').'</strong>'; ?>
										
									</td>

									<td>
									 <!--  <a href="<?php echo site_url("hostel/{$this->misc->_getClassName()}/edit/{$list->hostel_fee_p_id}"); ?>" class="btn btn-xs btn-danger btn-xs">edit</a> --> 
										<a href="<?php echo site_url("hostel/{$this->misc->_getClassName()}/delete/{$list->hostel_fee_p_id}"); ?>" class="btn btn-xs btn-danger btn-xs">DEL</a>
										<?php if($this->auth->_isDeveloper()) { ?>
											<a href="<?php echo site_url("hostel/{$this->misc->_getClassName()}/force_delete/{$list->hostel_fee_p_id}"); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Student Id</th>
									<th>Session</th>
									<th>Year</th>
									<th>Branch</th>
									<th>Fee Type</th>
									<th>Month</th>
									<th>Due Amount</th>
									<th>Payment status</th>
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