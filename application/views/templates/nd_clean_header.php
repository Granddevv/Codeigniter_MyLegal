<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php if(isset($page_title)) echo $page_title; else echo 'Lawyer Signup'; ?></title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/twbs/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/fortawesome/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>components/select2/dist/css/select2.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/design/css/css.css"> <!-- Change the path once design is completed -->

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  	<script type="text/javascript" src="<?php echo base_url(); ?>components/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  	<script type="text/javascript" src="<?php echo base_url(); ?>components/select2/dist/js/select2.js"></script>
  	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-repeater.min.js"></script>
</head>
<body class="no_padding_top">

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="col-md-5 nav_left">
				<div class="row">
					<div class="col-md-6 col-md-offset-4">
						<a href="<?php echo site_url('design/lawyers')?>">
							<img src="<?php echo site_url('assets/design/images/logo_blue.png')?>" alt="mla logo">
						</a>

					</div>
				</div>
			</div>
			<div class="col-md-7 nav_right">
				<div id="menu" class="page_menu pull-right">
					<ul>
						<li class="icon"><a class="extra_margin blue_color" id="icon_for_menu" href="<?php echo site_url('design/lawyers')?>" ><i class="fa fa-times"></i></a></li>
					</ul>
				</div>
			</div>
		</div>

	</nav>