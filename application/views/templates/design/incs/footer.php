<div id="footer" class="section">
	<div class="container-fluid">
		<div class="row hidden-xs">
			<div class="col-md-8 col-md-offset-2 text-center">
				<img src="<?php echo site_url('assets/design/images/logo_blue.png')?>" alt="logo" class="pull-left" />
				<a href="<?php echo site_url('design/lawyer_register_your_interest')?>" class="btn pull-right background_white blue_color border_blue blue_border">Register Interest</a>
			</div>
		</div>

		<div class="row hidden-xs">
			<div class="col-md-6 col-md-offset-3">
				<div class="row">
					<ul id="footer_menu">
						<li><a href="<?php echo site_url('design/support')?>">Support</a></li>
						<li><a href="<?php echo site_url('design/signin')?>">Login</a></li>
						<li><a href="">Contract</a></li>
					</ul>
				</div>

			</div>
		</div>

		<div class="row hidden-xs">
			<div class="col-md-8 col-md-offset-2 text-center">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat
				</p>
			</div>
		</div>

		<div class="row hidden-sm hidden-lg hidden-md">
			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				</p>
			</div>
		</div>
	</div>
</div>

<!-- <a href="#" class="scroll_up"><img src="<?php echo site_url('assets/design/images/scroll_up_icon.png')?>" alt="scroll up"></a> -->

</div>


<div id="backdrop" style="display: none"></div>

<div id="side_nav" style="display:none">
	<div id="nav_header">
		<a href="#" id="close"><i class="fa fa-times"></i></a>
		<img src="<?php echo site_url('assets/design/images/logo_icon_blue.png'); ?>" alt="">
	</div>
	<ul>
		<li><a href="<?php echo site_url('design/lawyers'); ?>" <?php if($this->uri->segment(2)=='lawyers') echo ' class="active"' ?>>
			<img src="<?php if($this->uri->segment(2)=='lawyers') echo base_url('assets/design/images/icons/active_home.png'); else echo base_url('assets/design/images/icons/home.png'); ?>" alt="Home">
			<span>Home</span>
		</a></li>
		<li><a href="<?php echo site_url('design/support'); ?>" <?php if($this->uri->segment(2)=='support') echo ' class="active"' ?>>
			<img src="<?php if($this->uri->segment(2)=='support') echo base_url('assets/design/images/icons/active_support.png'); else echo base_url('assets/design/images/icons/support.png'); ?>" alt="Support">
			<span>Support</span>
		</a></li>
		<li><a href="<?php echo site_url('design/contact'); ?>" <?php if($this->uri->segment(2)=='contact') echo ' class="active"' ?>>
			<img src="<?php if($this->uri->segment(2)=='contact') echo base_url('assets/design/images/icons/active_contact.png'); else echo base_url('assets/design/images/icons/contact.png'); ?>" alt="Contact">
			<span>Contact</span>
		</a></li>
		<li><a href="<?php echo site_url('design/signin'); ?>" <?php if($this->uri->segment(2)=='signin' || $this->uri->segment(2)=='lawyer_signin') echo ' class="active"' ?>>
			<img src="<?php if($this->uri->segment(2)=='signin' || $this->uri->segment(2)=='lawyer_signin') echo base_url('assets/design/images/icons/active_login.png'); else echo base_url('assets/design/images/icons/login.png'); ?>" alt="Login">
			<span>Login</span>
		</a></li>
		<li><a href="<?php echo site_url('design'); ?>" <?php if($this->uri->segment(2)=='') echo ' class="active"' ?>>
		<img src="<?php if($this->uri->segment(2)=='') echo base_url('assets/design/images/icons/active_find_lawyer.png'); else echo base_url('assets/design/images/icons/find_lawyer.png'); ?>" alt="Find a Lawyer">
			<span>Find a Lawyer</span>
		</a></li>
	</ul>
</div>

<script src="<?php echo base_url('assets/design/js/js.js'); ?>" type="text/javascript"></script>
</body>
</html>