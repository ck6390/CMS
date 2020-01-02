<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?= $title ?></title>
		<meta name="description" content="">
		<!-- tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		
		<!-- jQuery -->
		<script src="<?= base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
		<!-- bootstrap -->
		<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
		<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
		<!-- style css -->
		<link href="<?= base_url() ?>assets/css/animate.css" rel="stylesheet">
		<link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
		<style type="text/css">
			.logo-head{
				font-size: 26px;
				line-height: 55px;
			}
		</style>
	</head>

	<body class="login_banner">

		<div class="middle-box text-center loginscreen animated fadeInDown py-5">
			<div>
				<div>
					<!--h1 class="logo-name">GANGA MEMORIAL</h1-->
				</div>
				<h3 class="logo-head text-white no-gutter"> Ganga Memorial College Of Polytechnic</h3>
				<!--p>Login in. To see it in action.</p-->				
				<?= isset($failed) && !empty($failed) ? "<div class='alert alert-danger'>{$failed}</div>" : ""; ?>	
							
				<form class="m-t" role="form" action="<?= site_url('main/login') ?>" method="POST">
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username/Email Id" required="true">
						<?= form_error('username') ?>
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required="true">
						<?= form_error('password') ?>
					</div>
					<input type="hidden" value="<?php echo $roll_id; ?>" name="role" required="true">
					<!-- <div class="form-group">
						<input type="hidden" value="<?php echo $roll_id; ?>" name="role" required="true">

						<select class="form-control m-b select2_one" name="role">
                            <option>Please Select</option>
                            <option value="9">Principal</option>
                            <option value="7">Super Admin</option>
                            <option value="2">Admin</option>
                            <option value="5">Account</option>
                            <option value="3">Hostel</option>
                            <option value="4">Library</option>
                            <option value="8">Employee</option>
                            <option value="1">Developer</option>
                        </select>
                    </div> -->
					<button type="submit" class="btn btn-primary block full-width m-b">Login</button>

					<a href="#" class="hidden"><small><b>Forgot password?</b></small></a>
					<a href="<?= base_url() ?>" class="btn btn-sm btn-danger">Back to login panel</a>
				</form>
				<p class="m-t text-white"> <small><b>Maintained by Fillip Technologies &copy; <?php echo date('Y')?><b></small> </p>
			</div>
		</div>
	<?php if(!empty($this->session->flashdata('error'))){?>
		<div class="container-fluid licence-msg">
			<div class="container">
				<?php 
					if($this->session->flashdata('error')){
						echo "<div class='alert alert-danger'>{$this->session->flashdata('error')}</div>";
					}
				?>
			</div>
		</div>	
		<style>
			.licence-msg{
				width:100% !important;
				height:100vh !important;
				background: rgba(51, 51, 51, 0.53)!important;
				position: absolute;
				top:0;
				right: 0;
				left: 0;
				padding:50px;
			}			
		</style>
	<?php } ?>
	<script language="javascript">
		document.onmousedown=disableclick;
		status="Right Click Disabled";
		Function disableclick(e)
		{
		  if(event.button==1)
		   {
		     alert(status);
		     return false;  
		   }
		}
	</script>
	</body>
</html>