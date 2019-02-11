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

	<nav class="navbar navbar-default page_navbar">
		<div class="container-fluid">
			<div class="col-md-5 col-sm-6 col-xs-6 nav_left">
				<div class="row">
					<div class="col-md-6 col-md-offset-4">
						<a href="<?php echo site_url()?>">
							<img src="<?php echo site_url('assets/design/images/logo_blue.png')?>" id="logo" alt="mla logo">
						</a>

					</div>
				</div>
			</div>
			<div class="col-md-7 col-sm-6 col-xs-6 nav_right">
				<div id="menu" class="page_menu pull-right">
					<ul>
						<li><a class="extra_margin <?php if($this->uri->segment(2)=='support') echo 'active'; ?>" href="<?php echo site_url('design/support')?>">Support</a></li>
						<li><a class="extra_margin <?php if($this->uri->segment(2)=='contact') echo 'active'; ?>" href="<?php echo site_url('design/contact')?>">Contact</a></li>
						<li><a class="extra_margin <?php if($this->uri->segment(2)=='lawyer_signin' || $this->uri->segment(2)=='signin') echo 'active'; ?>" href="<?php echo site_url('design/lawyer_signin')?>">Login</a></li>
						<!-- <li><a class="btn color_white border_blue last" href="">Signup</a></li> -->
						<li class="icon"><a class="extra_margin blue_color" id="icon_for_menu" href="" ><i class="fa fa-bars"></i></a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container-fluid page_header">
			<!-- <div class="col-md-5"> -->
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="row">
								<div class="col-md-6 col-sm-8 col-xs-12">
									<h1 class="page_heading"><?php if(isset($page_title)) echo $page_title; else echo 'Support'; ?></h1>
									<h2 class="page_sub_heading"><?php if(isset($sub_heading)) echo $sub_heading; else echo 'Frequently Asked Questions'; ?></h2>
								</div>
								<!-- </div> -->
								<div class="col-md-6 col-sm-4 col-xs-12 text-right hidden-xs">
									<a href="<?php echo site_url('design/contact')?>" class="btn inverted transparent_background">
										Get in touch
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>