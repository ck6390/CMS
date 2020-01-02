<!-- page-footer -->
				<div class="footer hiddens">
					<!-- <div class="pull-right"> 10GB of <strong>250GB</strong> Free. </div> -->
					<div> <strong>Copyright</strong> Fillip Technologies &copy; 2014-2019 </div>
				</div>
				<!-- /.footer -->
			</div>
			<!-- /page-wrapper -->
		</div>
		<!-- /wrapper -->
		<!-- mainly scripts -->
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<!-- custom and plugin javascript -->
		<script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>
		<!-- jQuery UI -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
		<!-- data picker -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
		<!-- Clock picker -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/clockpicker/clockpicker.js"></script>
		<!-- dataTables -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/dataTables/datatables.min.js"></script>		
		<!-- summernote -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/summernote/summernote.min.js"></script>
		<!-- printArea -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.printArea.js"></script>
		<!-- Jasny -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>
		<!-- password-strength -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/pwstrength/pwstrength-bootstrap.min.js"></script>
		<!-- sweet-alert -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>
		<!-- select 2 -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/select2/select2.full.min.js"></script>
		<!-- dropify -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/dropify/js/dropify.min.js"></script>
		<!-- DROPZONE -->
    	<script src="<?php echo base_url(); ?>assets/js/plugins/dropzone/dropzone.js"></script>
		<!-- js init -->
		<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
		<!-- toastr -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/toastr/toastr.min.js"></script>
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
		
		<script type="text/javascript">
			function printDiv(divID) {
		        //Get the HTML of div
		        var divElements = document.getElementById(divID).innerHTML;
		        //Get the HTML of whole page
		        var oldPage = document.body.innerHTML;

		        //Reset the page's HTML with div's HTML only
		        document.body.innerHTML = "<html><head><title></title></head><body><style> body{font-size:10px;padding-left:70px;} .table > tbody > tr > td{padding:3px;}.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{border-top: 1px solid #000 !important;}.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{border: 1px solid #555 !important;}</style>" + 
		          divElements + "</body>";


		        //Print Page
		        window.print();

		        //Restore orignal HTML
		        document.body.innerHTML = oldPage;
		    }
		</script>
	</body>
</html>