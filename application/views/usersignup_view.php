<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Sign Up</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/login.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components-md.css" rel="stylesheet" type="text/css">
</head>
<body class="page-md login">
	<div class="logo">
		<a href="">
			<img src="" alt=""/>
		</a>
	</div>
	<div class="content">
		<form class="login-form" action="<?php echo site_url('welcome')?>" method="post">
			<div id="status"></div>
			<h3>Sign Up</h3>
			<?php echo validation_errors(); ?>
			<?php echo ((!empty($message)) ? $message : ''); ?>
			<p class="hint">
				Enter your personal details below;
				<a href="<?php echo site_url('auth/login')?>">Login</a>
			</p>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">First Name</label>
				<input class="form-control placeholder-no-fix" type="text" placeholder="First Name" id="firstname" name="first_name"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Last Name</label>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Last Name" id="lastname" name="last_name"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Email</label>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Email" id="email" name="email"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Phone</label>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Phone" name="phone"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" id="password_confirm" name="password_confirm"/>
			</div>
			<div class="form-group">
				<select id="userrole" name="userrole">
					<option value="1">ADMIN</option>
					<option value="2">USER</option>
					<option value="3">LAWYER</option>
				</select>
			</div>
			<div class="form-actions">
				<button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
				<button type="button" class="btn btn-icon-only red" id="facebook" onclick="javascript:_login();">F</button>
				<a href="<?php echo site_url('login');?>" class="btn btn-primary ">Login</a>
			</div>
			<input type="hidden" id="oauthtoken" name="oauthtoken">
		</form>	
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


	<script>
	  // window.fbAsyncInit = function() {
	  //   FB.init({
	  //     appId      : '{your-app-id}',
	  //     cookie     : true,
	  //     xfbml      : true,
	  //     version    : '{latest-api-version}'
	  //   });
	  //   FB.AppEvents.logPageView();   
	  // };

	  // (function(d, s, id){
	  //    var js, fjs = d.getElementsByTagName(s)[0];
	  //    if (d.getElementById(id)) {return;}
	  //    js = d.createElement(s); js.id = id;
	  //    js.src = "//connect.facebook.net/en_US/sdk.js";
	  //    fjs.parentNode.insertBefore(js, fjs);
	  //  }(document, 'script', 'facebook-jssdk'));

	  // function statusChangeCallback(response) {
			//     if (response.status === 'connected') {
			//       	connectAPI();
			// 	    $("#loginWithFbText").html("");
			// 	    $("#loginWithFbText").html("Logged in");
			//     } else {
			//       	$("#loginWithFbText").html("");
			// 		$("#loginWithFbText").html("Login with facebook");
			//     }
			// }

			// window.fbAsyncInit = function() {
			//     FB.init({
			//     	appId            : '262078784256119',
			//     	autoLogAppEvents : true,
			//     	xfbml            : true,
			//     	version          : 'v2.9'
			//     });
			// };

		 //  	(function(d, s, id){
		 //     var js, fjs = d.getElementsByTagName(s)[0];
		 //     if (d.getElementById(id)) {return;}
		 //     js = d.createElement(s); js.id = id;
		 //     js.src = "//connect.facebook.net/en_US/sdk.js";
		 //     fjs.parentNode.insertBefore(js, fjs);
		 //   	}(document, 'script', 'facebook-jssdk'));

		 //   	function connectAPI() {
			//     FB.api('/me?fields=id,email,first_name,last_name,picture.width(400).height(400)', function(response) {
			//     	$.ajax({
			//     		url: "<?php echo base_url('/user/login/facebook'); ?>",
			//     		data: response,
			//     		type: "post",
			//     		dataType: "json",
			//     		success: function(resp) {
			//     			if(resp.status == "success") {
			//     				swal("Success", resp.msg, "success");
			//     				location.reload();
			//     			} else {
			//     				swal("Error", resp.msg, "error");
			//     			}
			//     		}, beforeSend: function() {
			// 	    		$("#loginWithFbText").html("");
			// 	    		$("#loginWithFbText").html("Refreshing page <i class='fa fa-spinner fa-spin'></i>");
			// 	    	}
			//     	});
			//     });
			// }

			// function loginWithFB(elmnt) {
			// 	FB.login(function(response) {
			// 	  	if (response.status === 'connected') {
			// 		    connectAPI();
			// 		    elmnt.html("");
			// 		    elmnt.html("Logged in");
			// 		} else {
			// 			elmnt.html("");
			// 		    elmnt.html("Login with facebook");
			// 		}
			// 	}, {scope: 'email'});
			// }
	</script>

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
					url:"<?php echo site_url('welcome/social_signup')?>",
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
						location.href="<?php echo site_url('account/profile')?>";
					},
					error:function(xhr){
					}
				})
			});
		}
	</script>
	<script>
	$(document).ready(function(){
		$("#userrole").change(function() {
			if($("#userrole").val()=='2')
				$('#facebook').show();
			else
				$('#facebook').hide();
		})
		if($("#userrole").val()!='2') {
			$('#facebook').hide();
		}
	})
	
	</script>
</body>
</html>