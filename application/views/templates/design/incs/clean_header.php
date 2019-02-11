<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
	<title><?php if(isset($page_title)) echo $page_title; else echo 'Lawyer Signup'; ?></title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>vendor/twbs/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/design/css/css.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/fortawesome/font-awesome/css/font-awesome.min.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body class="no_padding_top">

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="col-md-5 col-sm-6 col-xs-6 nav_left">
				<div class="row">
					<div class="col-md-6 col-md-offset-4">
						<a href="<?php echo site_url('design/lawyers')?>">
							<img src="<?php echo site_url('assets/design/images/logo_blue.png')?>" id="logo" alt="mla logo">
						</a>

					</div>
				</div>
			</div>
			<div class="col-md-7 col-sm-6 col-xs-6 nav_right">
				<div id="menu" class="page_menu">
					<ul class="text-right pull-right">
						<li class="icon"><a class="blue_color" id="icon_for_menu" href="<?php echo site_url()?>" ><i class="fa fa-times"></i></a></li>
					</ul>
				</div>
			</div>
		</div>

	</nav>