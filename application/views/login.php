<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() . 'filemanager/files/' . $settings[0]->Favicon ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() . 'filemanager/files/' . $settings[0]->Favicon ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/linearicons/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/main2.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/sweet-alert/sweetalert.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form id="frmLogin" class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-55">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" placeholder="Email" required autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>

					<div class="contact100-form-checkbox m-l-4">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>
					
					<div class="container-login100-form-btn p-t-25">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/scripts/main.js"></script>
	<script src="<?php echo base_url()?>assets/vendor/sweet-alert/sweetalert.min.js"></script>


	<script type="text/javascript">
		$("#frmLogin").submit(function(e){
            e.preventDefault()
            
            form = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>' + 'user/do_login/',
                data: form,
                dataType: 'json',
                crossDomain: true,
                error: function(res){
                	console.log('error')
                    console.log(res)
                },
                success: function(res){
                    if(res.message == 'success'){
                        swal({
                            title: 'Welcome Back!', 
                            text: '', 
                            type: "success",
                            timer: 800,
                  			showConfirmButton: false,
                        },function(){
                        	window.location.href='<?php echo base_url()?>' + 'my/dashboard/';
                        })

                    }
                    else{
                        swal({
                        	title: 'Oops',
                        	text: 'Invalid Email / Password!', 
                        	type: 'error',
                            timer: 800,
                  			showConfirmButton: false,
                       	})
                    }
                }
            })
        })
	</script>

</body>
</html>