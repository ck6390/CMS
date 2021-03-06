<!-- page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-5">
		<h2><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?= base_url(); ?>">Home</a>
			</li>
			<li>
				<a href="<?= site_url("{$this->misc->_getClassName()}"); ?>"><span class="text-capitalize"><?= str_replace('_', ' ', $this->misc->_getClassName()) ; ?></span></a>
			</li>
			<li class="active">
				<strong>List</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-7">
		<div class="title-action">
			<a href="<?= site_url($this->misc->_getClassName().'/send_sms') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
					<?php 
                        $val = json_decode(check_sms(),true);
                        echo "<h3>Available SMS - [".@$val[0]['routeBalance']."]</h3>";
                    ?>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Serial No.</th>
									<th>Receiver Type</th>
									<th>Receiver Info</th>
									<th>General Number</th>
									<th>SMS</th>
									<th>Date & Time</th>
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
								foreach ($lists as $list) { $i++; 
									$branch_id = @$this->mdl_student->get($list->receiver_id)->fk_branch_id;
									?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
									<td><span class="badge badge-danger"><?= "{$i}." ?></span></td>
									
									<td><?= '<strong> '.htmlspecialchars(@$this->mdl_role->get($list->receiver_type)->role_name,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>									
									<td><?= $list->receiver_type==8 ? '<strong> '.htmlspecialchars(@$this->mdl_employee->get($list->receiver_id)->employee_id,ENT_QUOTES,'UTF-8').'</strong>':'<strong> '.htmlspecialchars(@$this->mdl_student->get($list->receiver_id)->student_unique_id,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= @$list->general_number ?></td>
									<!--td> <?= '<strong> '.htmlspecialchars($this->mdl_session->get($list->fk_session_id)->session_name,ENT_QUOTES,'UTF-8').'</strong>'; ?> </td>
									<td><?= '<strong> '.htmlspecialchars($this->mdl_course_year->get($list->fk_course_year_id)->course_year_name,ENT_QUOTES,'UTF-8').'</strong>'; ?> </td>
									<td> <?=  '<strong> '.htmlspecialchars($this->mdl_branch->get($branch_id)->branch_code,ENT_QUOTES,'UTF-8').'</strong>'; ?></td-->
									
									<td><?= '<strong> '.htmlspecialchars($list->message,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									<td><?= '<strong> '.htmlspecialchars($list->created_on,ENT_QUOTES,'UTF-8').'</strong>'; ?></td>
									
									<td>
										<button class="btn btn-xs btn-danger deleteRow" value="<?= $list->sms_p_id ?>">
											<i class="fa fa-trash"></i>
										</button>
										<?php if($this->auth->_isDeveloper()) { ?>
											<a href="<?php echo site_url("{$this->misc->_getClassName()}/force_delete/{$list->sms_p_id}"); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Serial No.</th>
									<th>Receiver Type</th>
									<th>Receiver Info</th>
									<th>General Number</th>
									<th>SMS</th>
									<th>Date & Time</th>
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