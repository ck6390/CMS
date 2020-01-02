<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?= $title ?> | Ganga Memorial CMS</title>
		<meta name="description" content="">
		<!-- tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- jQuery -->
		<script src="<?= base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
		<!-- Toastr -->
    	<link href="<?= base_url(); ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<!-- bootstrap -->
		<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
		<!-- font-awesome -->
		<link href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- date picker -->
		<link href="<?= base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
		<!-- clock-picker -->
		<link href="<?= base_url(); ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
		<!-- datatables -->
		<link href="<?= base_url(); ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">		
		<!-- check-box -->
		<link href="<?= base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
		<link href="<?= base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
		<link href="<?= base_url(); ?>assets/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
		<!-- dropify -->
		<link href="<?= base_url(); ?>assets/js/plugins/dropify/css/dropify.min.css" rel="stylesheet">
		<!-- dropzone -->
		<link href="<?= base_url(); ?>assets/css/plugins/dropzone/basic.css" rel="stylesheet">
    	<link href="<?= base_url(); ?>assets/css/plugins/dropzone/dropzone.css" rel="stylesheet">
		<!-- summernote -->
		<link href="<?= base_url(); ?>assets/css/plugins/summernote/summernote.css" rel="stylesheet">
    	<link href="<?= base_url(); ?>assets/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    	<!-- sweet alert -->
    	<link href="<?= base_url(); ?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    	<!-- select-2 -->
    	<link href="<?= base_url(); ?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">
		<!-- mainly css -->
		<link href="<?= base_url(); ?>assets/css/animate.css" rel="stylesheet">
		<link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
		<script>var base_url = "<?= base_url() ?>";</script>
	</head>

	<body>
		<div id="wrapper">
			<!-- navigation page -->
			<?php require 'page_navbar.php' ?>
			<!-- top-header page -->
			<?php require 'page_top_header.php' ?>