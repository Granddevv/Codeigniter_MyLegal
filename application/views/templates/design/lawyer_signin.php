<div class="container-fluid">
	<div id="lawyer_signin_section" class="section">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-12 col-xs-12 col-sm-12 col-xs-12">
				<div class="row">
					<div class="col-md-11 .col-md-offset-1 col-sm-12 col-xs-12 col-sm-12 col-xs-12">
						<div  id="login_box">
							<div class="row">
								<div class="col-md-12 text-center">
									<h1 class="light_font">Sign In</h1>
									<h2>Login with your credentials below</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form action="" class="form">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="username" class="">Username</label>
													<input type="text" id="username" name="username" placeholder="e.g. name@domain.co.nz" class="form-control">
												</div>

											</div>
										</div>

										<div class="row">
											<div class="col-md-12">

												<div class="form-group">
													<label for="user_type">Password</label>
													<input type="password" placeholder="*******" class="form-control">
												</div>
											</div>
										</div>

									</form>
									<div class=" text-center">
										<button class="btn" onclick="window.location='<?php echo base_url('design/dashboard'); ?>'">Sign In</button>
									</div>
									<div class="row sub_nav text-center">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<a href="<?php echo site_url('design/lawyer_forget_password')?>">Forget your password?</a>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<a href="<?php echo site_url('design/lawyer_signup')?>">Don't have an account?</a>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>