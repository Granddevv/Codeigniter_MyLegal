<div class="container-fluid">
	<div id="lawyer_signup_section" class="section">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 text-center">
				<h1 class="light_font">Lawyer Sign Up</h1>
				<h2>Sign up for an account</h2>
			</div>
		</div>
	</div>


	<div id="section_signup_tabs" class="section">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div id="tabs_container">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#about_you" aria-controls="about_you" role="tab" data-toggle="tab">1. About You</a></li>
						<li role="presentation"><a href="#address" aria-controls="address" role="tab" data-toggle="tab">2. Address</a></li>
						<li role="presentation"><a href="#qualifications" aria-controls="qualifications" role="tab" data-toggle="tab">3. Qualifications</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="about_you">
							<div>
								<form action="" class="form">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="name" class="">What's your name?</label>
												<input type="text" id="name" name="name" placeholder="Full Legal Name" class="form-control">
											</div>
											
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="ethnicity">What's your ethnicity?</label>
												<input type="text" class="form-control">
											</div>
											
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											
											<div class="form-group">
												<label for="user_type">What kind of user are you?</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="gender">What's your gender?</label>
												<input type="text" class="form-control">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="user_type">What languages do you speak?</label>
												<input type="text" class="form-control">
											</div>	
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="gender">Upload a profile photo</label>
												<input type="text" class="form-control">
											</div>
										</div>
									</div>
								</form>
							</div>
							<div>
								<button class="btn inverted pull-right">Next</button>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="address">
							<div>
								<form action="" class="form">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="address" class="">What's your practicing address?</label>
												<input type="text" id="address" name="address" placeholder="Address line 1" class="form-control">
											</div>
											
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="ethnicity">&nbsp;</label>
												<input type="text" class="form-control" placeholder="Address line 2">
											</div>
											
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<!-- <label for="user_type">&nbsp;</label> -->
												<input type="text" class="form-control" placeholder="Suberb">
											</div>
										</div>
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<!-- <label for="user_type">&nbsp;</label> -->
														<input type="text" class="form-control" placeholder="City">
													</div>
													
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<!-- <label for="gender">&nbsp;</label> -->
														<input type="text" class="form-control" placeholder="Post Code">
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div>
								<button class="btn inverted pull-right">Next</button>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="qualifications">
							<div>
								<form action="" class="form">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="about" class="">Tell us about you as a lawyer?</label>
												<textarea type="text" id="about" name="about" class="form-control"></textarea>
											</div>
											
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="certificates">List of Certificates</label>
												<textarea type="text" class="form-control"></textarea>
											</div>
											
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="user_type">Proof of Qualification</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-6">

											<a href="<?php echo site_url('design/lawyer_register_your_interest')?>" class="btn black">Register Interest</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>