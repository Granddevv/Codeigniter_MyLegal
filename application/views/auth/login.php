
<div class="container">
	<section id="lawyer_signin_section">
		<div  id="login_box">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="light_font">Sign In</h1>
					<h2>Login with your credentials below</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php echo form_open('auth/login', array('class' => 'form-horizontal form')); ?>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="username" class="">Username</label>
									<input type="text" id="username" name="email" placeholder="e.g. name@domain.co.nz" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" id="password" name="password" placeholder="*******" class="form-control">
								</div>
							</div>
						</div>
						<div class=" text-center">
							<button class="btn" type="submit">Sign In</button><hr />
							<button type="button" class="btn btn-icon-only" id="facebook" onclick="javascript:_login();"><i class="fa fa-facebook" style="color:#4862A3;"></i> Login with Facebook</button>
						</div>
						<div class="row sub_nav">
							<div class="col-md-12">
								<a class="pull-left" href="<?php echo site_url('auth/lawyer_forget_password')?>">Forget your password?</a>
								<a class="pull-right" href="<?php echo site_url('lawyer/registration')?>">Don't have an account?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	(function(thisdocument, scriptelement, id){   //Load the SDK asynchronously

		var js, fjs = thisdocument.getElementsByTagName(scriptelement)[0];
		if(thisdocument.getElementById(id)) return;
		
		js = thisdocument.createElement(scriptelement); js.id = id;
		js.src = "https://connect.facebook.net/en_US/all.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	window.fbAsyncInit = function(){
		FB.init({
			appId   : '<?php echo $this->config->item("fb_app_id"); ?>',  	//APP ID
			status 	: true,
			cookie  : true,  //enable cookies to allow the server to access 
			xfbml   : true, 	//parse social plugins on this page
			version : 'v2.8',	//use version 2.8
			oauth   : true,
		})
	};

	function _login(){
		FB.login(function(response){
			if (response.status === 'connected') {
				_i();
			}
		}, {scope: 'public_profile,email'});
	}

	function _i(){
		FB.api('/me',{fields:'first_name,last_name,email'},function(response) {
			var oauth = FB.getAuthResponse();
			$.ajax({
				url:"<?php echo site_url('auth/social_login')?>",
				dataType:"JSON",
				type:"POST",
				data:{
					mode:   'facebook',
					fName:  response.first_name,
					lName:  response.last_name,
					email:  response.email,
					fb_id:  response.id,
					fb_token: oauth.accessToken
				},
				success:function(result){
					if(result.success) {
						location.href="<?php echo site_url('account/profile')?>";
					} else {
						$(".message").html("");
						$(".message").html(result.msg);
					}
				},
				error:function(xhr){
				}
			})
		});
	}
</script>