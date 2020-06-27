<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Masuk | Zare</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin'); ?>/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin'); ?>/fonts/iconic/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/admin"); ?>/css/login.css">
	</head>
	<body>
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100 p-l-35 p-r-35 p-t-35 p-b-50">
					<form autocomplete="off" class="login100-form" action="<?php echo site_url('loginAdmin/checkLogin')?>" method="POST">
						<span class="login100-form-title p-b-35"><img src="<?php echo base_url('assets')?>/img/zare.png"/></span>
						<div class="wrap-input100 m-b-23" data-validate = "Email is required">
							<span class="label-input100">Email</span>
							<input class="input100" type="email" id="email" name="email" placeholder="Insert your email" value="<?php echo $this->session->flashdata('erroruser'); ?>">
							<span class="focus-input100" data-symbol="&#xf206;"></span>
						</div>
						<div class="wrap-input100 validate-input" data-validate="Password is required">
							<span class="label-input100">Password</span>
							<input class="input100" type="password" id="password" name="password" placeholder="Insert your password">
							<span class="focus-input100" data-symbol="&#xf190;"></span>
						</div>
						<div class="text-center text-error p-t-20 p-b-20">
							<a>
								<?php echo $this->session->flashdata('errorlog'); ?>
							</a>
						</div>
						<div class="container-login100-form-btn">
							<div class="wrap-login100-form-btn">
								<div class="login100-form-bgbtn"></div>
								<button type="submit" name="submit" class="enableOnInput login100-form-btn" disabled='disabled'>Sign In</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<script src="<?php echo base_url('assets/admin'); ?>/js/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/admin'); ?>/js/bootstrap.min.js"></script>
		<script>
		    $(function () {
		    $('#username').keyup(function () {
		        if ($(this).val() == ''  || $('#password').val()=='') {
		          $('.enableOnInput').prop('disabled', true);
		        } else {
		          $('.enableOnInput').prop('disabled', false);
		        }
		    });
		    $('#password').keyup(function () {
		      if ($(this).val() == '' ||  $('#username').val()=='' ) {
		        $('.enableOnInput').prop('disabled', true);
		      } else {
		        $('.enableOnInput').prop('disabled', false);
		      }
		    });
		  }); 
		</script>
	</body>
</html>