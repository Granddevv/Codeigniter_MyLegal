<div class="row">
	<div class="col-md-12">
		<!-- <div class="page-header">
			<h1><?php if($this->session->userdata('user_role')!=3 && $this->session->userdata('user_role')!=4)echo 'Dashboard'; else echo 'My Jobs';?> <small></small></h1>
		</div> -->
		<section id="lawyer_signup_section">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="title-header light_font">CASES</h1>
					<h2 class="second-title-header ">Manage your cases here</h2>
				</div>
			</div>
		</section>
		<?php if($this->session->userdata('user_role')!=3 && $this->session->userdata('user_role')!=4) { ?>
			<div class="row text-center">
				<div class="col-md-12">
					<a class="btn" href="<?php echo site_url('jobs/find')?>">FIND A LAWYER</a>
				</div>
			</div>
		<?php } ?>

		<div class="content">
			<?php if($this->session->userdata('user_role')!=3 && $this->session->userdata('user_role')!=4){ ?>
				<section id="section_signup_tabs">
					<!-- <div class="col-md-3 text-center">
						<br>
						<a href="<?php echo site_url('jobs/find')?>">
							<i class="fa fa-search fa-3x"></i><br>
							<h3>Find a Lawyer</h3>
						</a>
					</div> -->
					<div id="tabs_container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="<?php echo active_link('jobs', 'my_jobs','requested'); ?> md-tabs"><a href="<?php echo base_url('jobs/my_jobs/requested'); ?>">Proposals</a></li>
							<li role="presentation" class="<?php echo active_link('jobs', 'my_jobs','active'); ?> md-tabs"><a href="<?php echo base_url('jobs/my_jobs/active'); ?>">Open Cases</a></li>
							<li role="presentation" class="<?php echo active_link('jobs', 'my_jobs','completed'); ?> md-tabs"><a href="<?php echo base_url('jobs/my_jobs/completed'); ?>">Closed Cases</a></li>
						</ul>
					</div>
				</section>
				<?php } else{ redirect(site_url('jobs/my_jobs')); } ?>
				</div>
			</div>
		</div>