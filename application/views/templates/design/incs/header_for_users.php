<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($page_title)) echo $page_title; else echo 'Lawyer Signup'; ?></title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/twbs/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/design/css/css.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/fortawesome/font-awesome/css/font-awesome.min.css">

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body  id="for_users">

	<nav class="navbar navbar-default navbar-static-top">
		<div class="container-fluid">
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-6 col-md-offset-4">
						<a href="<?php echo site_url('design')?>">
							<img src="<?php echo site_url('assets/design/images/logo.png')?>" alt="mla logo" id="blue_logo">
						</a>

					</div>
				</div>
			</div>
			<div class="col-md-7 nav_right">
				<div id="menu" class="pull-right page_menu">
					<ul>
						<li><a class="extra_margin" href="<?php echo site_url('design/support')?>">Support</a></li>
						<li><a class="extra_margin" href="<?php echo site_url('design/contact')?>">Contact</a></li>
						<li><a class="extra_margin" href="<?php echo site_url('design/signin')?>">Login</a></li>
						<li class="icon"><a class="extra_margin blue_color" id="icon_for_menu" href="" ><i class="fa fa-bars"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>