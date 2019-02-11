<section id="lawyer_signup_section">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1 class="title-header light_font">CASES</h1>
			<h2 class="second-title-header ">Manage your cases here</h2>
		</div>
	</div>
</section>

<section id="section_signup_tabs">
	<div class="row">
		<div class="col-md-12">

			<?php if($this->session->userdata('user_role')==2){?>
				<div class="btn-group" role="group" aria-label="...">
					<a href="<?php echo base_url('jobs/my_jobs/active'); ?>"  type="button" class="<?php echo active_link('jobs', 'my_jobs','active'); ?> btn btn-default">Active Jobs</a>
					<a href="<?php echo base_url('jobs/my_jobs/pending'); ?>" type="button" class="<?php echo active_link('jobs', 'my_jobs','pending'); ?> btn btn-default">Pending Jobs</a>
					<a href="<?php echo base_url('jobs/my_jobs/completed'); ?>" type="button" class="<?php echo active_link('jobs', 'my_jobs','completed'); ?> btn btn-default">Completed Jobs</a>
					<a href="<?php echo base_url('jobs/my_jobs/all'); ?>" type="button" class="<?php echo active_link('jobs', 'my_jobs', 'all'); ?> btn btn-default">View All</a>
				</div>
				<?php } else{?>
					<div id="tabs_container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="<?php echo active_link('jobs', 'my_jobs','requested'); ?> smaller-tabs"><a href="<?php echo base_url('jobs/my_jobs/requested'); ?>">Available Jobs</a></li>
							<li role="presentation" class="<?php echo active_link('jobs', 'my_jobs','active'); ?> smaller-tabs"><a href="<?php echo base_url('jobs/my_jobs/active'); ?>">Open Cases</a></li>
							<li role="presentation" class="<?php echo active_link('jobs', 'my_jobs','completed'); ?> smaller-tabs"><a href="<?php echo base_url('jobs/my_jobs/completed'); ?>">Closed Cases</a></li>
							<li role="presentation" class="<?php echo active_link('jobs', 'my_jobs','pending'); ?> smaller-tabs"><a href="<?php echo base_url('jobs/my_jobs/pending'); ?>">Sent Bids</a></li>
						</ul>
					</div>

					<?php } ?>

					<div class="row jobs_container">
						<div class="col-md-12">

							<?php if(isset($response)){?>
								<?php if($response==TRUE){?>
									<div class="alert alert-success alert-dismissable">
										Job has been created successfully!  
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									</div>
									<?php } else if($response==FALSE){?>		
										<div class="alert alert-danger alert-dismissable">
											Job could not be created! Please try again later!  
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										</div>
										<?php }else{?>
											<div class="alert alert-danger alert-dismissable">
												<?php echo $response; ?>
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											</div>
											<?php } }?>


									<div class="tab-content grey-label">
										<div role="tabpanel" class="tab-pane active" id="jobs">
											<div>
											<?php if($jobs && count($jobs)>0){ ?>
													<div class="row">
														<div class="col-xs-12 text-center">
															<span class="light-label">Recently posted jobs that you might be interested in.</span>
														</div>
													</div>
												<?php foreach ($jobs as $job) { ?>
													<!-- <div class="media">
														<div class="media-body">
															<a href="<?php echo site_url('jobs/view/'.$job->id); ?>"><h4 class="media-heading"><?php echo $job->title; ?></h4></a>
															<p> Created <?php echo $job->created?></p>
														</div>
													</div> -->
														<div class="col-xs-4 border-right">
															<div class="col-xs-3 text-right">
																<img src="<?php echo base_url('assets/design/images/circle_preview.png'); ?>" class="rounded-circle job-image" />
																&nbsp;
															</div>

															<div class="col-xs-6 text-left">
																<div>
																	<span><?php echo $job->title; ?></span>
																</div>
																<div>
																	<label >Area of law</label>
																</div>
																<div>
																	<i>Budget: $6000</i>
																</div>
															</div>

															<div class="col-xs-3">
																<a href="<?php echo site_url('jobs/view/'.$job->id); ?>"><img class="flip-image job-image" src="<?php echo base_url('assets/design/images/sm-magnifying.svg'); ?>" onerror="this.src='your.png'"></a>
															</div>
														</div>

														<?php } }else{ ?>
															<div class="row">
																<div class="col-xs-12 text-center"><br />
																	<span class="light-label">No Jobs Found</span>
																</div>
															</div>
															<!-- <div class="well">
																No jobs found!
															</div> -->
														<?php } ?>
														<?php echo $this->pagination->create_links(); ?>
													</div>

										</div>
									</div>


														</div>
													</div>
												</div>
											</div>
</section>