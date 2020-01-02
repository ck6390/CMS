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
			<a href="<?= site_url($this->misc->_getClassName())."/add" ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
					<!-- PAGE CONTENT BEGINS -->					
					<div id="alert_msg"></div>
					
						<script type="text/javascript">
							<?php if($this->session->flashdata('success')) { ?>
								toastr.success("<?php echo $this->session->flashdata('success'); ?>");
							<?php } else if($this->session->flashdata('error')) { ?>
								toastr.error("<?php echo $this->session->flashdata('error'); ?>");
							<?php } else if($this->session->flashdata('warning')) { ?>
								toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
							<?php } else if($this->session->flashdata('info')) { ?>
								toastr.info("<?php echo $this->session->flashdata('info'); ?>");
							<?php } ?>
						</script>
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTablesView">
							<thead>
								<tr>
									<th>Student Id</th>
									<th>Student Info</th>
									<th>Branch</th>
									<th>Session</th>
									<th>Status</th>
									<th>Admission Status</th>
									<th>Hostel Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($lists) == 0) { ?>
								<tr class="text-center text-uppercase">
									<td colspan="8"><strong>NO RECORD AVAILABLE</strong></td>
								</tr>
							<?php
							} else {
								foreach ($lists as $list) { ?>
								<tr>
									<input type="hidden" name="cntrlName" id="cntrlName" value="<?= $this->misc->_getClassName(); ?>">
									<td>
										<strong><?= htmlspecialchars($list->student_unique_id,ENT_QUOTES,'UTF-8') ?></strong>
									</td>
									<td><?= htmlspecialchars($list->student_full_name,ENT_QUOTES,'UTF-8') ?><br><?= '<span class="badge badge-primary">'.htmlspecialchars($list->admission_no,ENT_QUOTES,'UTF-8').'</span>'?><br><?= '<span class="badge badge-warning">'.htmlspecialchars($list->student_roll ? "Roll: ".$list->student_roll : "" ,ENT_QUOTES,'UTF-8').'</span>'?></td>

									<td><?= htmlspecialchars($list->branch_code,ENT_QUOTES,'UTF-8') ?></td>

									<td><?= htmlspecialchars($list->session_name,ENT_QUOTES,'UTF-8') ?></td>

									<td><?php echo ($list->is_active) ? anchor("{$this->misc->_getClassName()}/deactivate/{$list->student_p_id}", '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i> Active</span>') : anchor("{$this->misc->_getClassName()}/activate/{$list->student_p_id}", '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Inactive</span>'); ?>
									</td>

									<td>
										<?php  if($list->admission_status == "provisional"){
											 echo '<span class="btn btn-info btn-xs"> Provisional</span>';
										}elseif($list->admission_status == "pending"){
											echo '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Pending</span>';
										}elseif($list->admission_status == "passout"){
											echo '<span class="btn btn-xs btn-danger"><i class="fa fa-ban"></i> Passout</span>';
										}elseif($list->admission_status == "junk"){
											echo '<span class="btn btn-xs btn-danger"><i class="fa fa-ban"></i> Junk</span>';
										}else{
											echo '<span class="btn btn-xs btn-primary"><i class="fa fa-check"></i> Final</span>';
										} ?>
										
									</td>

									<td><?php echo ($list->hostel_status) ? '<span class="btn btn-xs btn-warning"><i class="fa fa-ban"></i> Alloted</span>' :  '<span class="btn btn-info btn-xs"><i class="fa fa-check"></i>Allot</span>'; ?>
									</td>

									

									<td>
										<span class="dropdown">
	                            				<button class="btn btn-xs btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-navicon"></i> Action <span class="caret"></span></button>
												<ul class="dropdown-menu dropdown-menu-right">
	                                				<li>
	                                					<a href="<?php echo site_url("{$this->misc->_getClassName()}/profile/{$list->student_p_id}"); ?>" >View
														</a>
													</li>
													<li>
	                                					<a href="<?php echo site_url("{$this->misc->_getClassName()}/print_profile/{$list->student_p_id}"); ?>" >Print Profile
														</a>
													</li>
													<?php
														if($list->final_submit != "1" || $this->session->userdata['roleID'] == '7'){
													 ?>
					                                <li>
					                                	<a href="<?php echo site_url("{$this->misc->_getClassName()}/edit/{$list->student_p_id}"); ?>" >
													Edit
													</a>
													</li>
													<?php } ?>
													<li>
					                                	<a href="<?php echo site_url("{$this->misc->_getClassName()}/roll/{$list->student_p_id}"); ?>" >
													Create Roll
													</a>
													</li>
													<li>
					                                	<a href="#" id="<?=$list->student_p_id?>" class="get_student_id" student_id="<?= $list->student_unique_id?>">
													Set Restrication
													</a>
													</li>
	                            				</ul>
	                        				</span>

				                        <button class="btn btn-xs btn-danger deleteRow" value="<?= $list->student_p_id ?>">
											<i class="fa fa-trash"></i>
										</button>
										<?php
										
										 if($this->auth->_isDeveloper()) { ?>
											<a href="<?php echo site_url("{$this->misc->_getClassName()}/force_delete/{$list->student_p_id}"); ?>" class="btn btn-default btn-xs">DEL</a>
										<?php } ?>
									</td>
								</tr>
								<?php }
							} ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Student Id</th>
									<th>Student Name</th>
									<th>Branch</th>
									<th>Session</th>
									<th>Status</th>
									<th>Admission Status</th>
									<th>Hostel Status</th>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Set Restrication  - <span id="s_id" class="btn-danger btn"></span></h4>
      </div>
      <div class="modal-body">
      	<div class="demo"></div>
      	<?php if(!empty(get_restrication())){?>
      	<form action="<?php echo site_url("{$this->misc->_getClassName()}/set_restrication/"); ?>" method="post">
      		<input type="hidden" name="student_id" id="student_id">     		
      		<?php 
      			foreach (get_restrication() as $value) {
      		?><div class="">
 				<label class="checkbox-inline text-capitalize">
 					<input type="checkbox" value="<?= $value->restriction_p_id?>" name="restrication[]" id="<?= $value->restriction_p_id?>"><?= $value->restriction?></label>			 
			</div><?php } ?><br/><br/>	
			<button class="btn-danger btn btn-xs">Set Restrication</button>			
      	</form>
        <?php } else{?>
        	<p class="text-center">Data not found.</p>
        <?php } ?>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
function updateAdmissionStatus(id) {
	
	var status = $('#status'+id).val();
	var formData = {'status':status};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/students/update_admission_status/" + id,
		success: function(data)
		{
			$("#alert_msg").html(data);
			$("#alert_msg").fadeIn(200);
			 window.setTimeout(function () {
                        $("#alert_msg").fadeOut(500);
                    }, 6000);
		},
		error: function(xhr,status,strErr)
		{
			//alert(status);
		}	
	});
}
$('.get_student_id').on('click', function(e){
    e.preventDefault();
    var student_unique_id = $(this).attr('student_id');
    var s_id = this.id;
    $.ajax({
	    url: "<?= site_url();?>/students/get_student_restrication",
	    datatype:'json',
	    data:{s_id:s_id},				
	    type:"POST",
	    success: function(data){
	    	var res = data.split(",");	
	    	$('#student_id').val(s_id);
		    $('#s_id').html(student_unique_id);
		    if(data.length > 0){
			    $.each(res,function(i){
			    	$('#'+res[i]).prop('checked',true);
			    });
			}
		    $("#myModal").modal('show');
	    },
	    error:function(data){
	       alert("error");
	    }          
	});    
});
</script>
