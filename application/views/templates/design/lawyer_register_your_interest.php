<div class="container-fluid">
	<div id="lawyer_signin_section" class="section">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 col-xs-12">
				<div class="row">
					<div class="col-md-11 col-md-offset-1 col-sm-12 col-xs-12 col-sm-12 col-xs-12">
						<div  id="login_box">
							<?php if(!$this->session->flashdata('message')){?>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12 text-center">
										<h1 class="light_font">Register your interest</h1>
										<h2>and be the first to know when My Legal Advice goes live</h2>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<form action="" class="form" method="post">
											<?php echo validation_errors(); ?>
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="name" class="">Name*</label>
														<input type="text" id="name" name="name" required="required" placeholder="First and Last Name" class="form-control">
													</div>

												</div>
											</div>

											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12">

													<div class="form-group">
														<label for="email">Email*</label>
														<input type="text" required="required" placeholder="email@domain.co.nz" name="email" id="email" class="form-control">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12  col-sm-12 col-xs-12">

													<div class="form-group">
														<label for="user_type">Mobile</label>
														<input type="text" placeholder="12345678" name="mobile" id="mobile" class="form-control">
													</div>
												</div>
											</div>
											<div class=" text-center">
												<button class="btn" type="submit" id="submit" name="submit">Register</button>
											</div>
										</form>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<?php } else{?>
				<div class="row">
					<div class="col-md-12  col-sm-12 col-xs-12 text-center">
						<h1 class="light_font">Your interest request</h1>
						<h2><?php echo $this->session->message; ?></h2>
						<p><a href="<?php echo site_url('design/lawyer_register_your_interest'); ?>">&laquo; Go Back</a></p>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>