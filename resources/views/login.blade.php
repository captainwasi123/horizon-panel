<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Horizon I Login</title>
		<meta name="description" content="" />
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- Toggles CSS -->
		<link href="/vendors4/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
		<link href="/vendors4/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
		
		<!-- Custom CSS -->
		<link href="{{URL::to('/')}}/dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		
		<!-- HK Wrapper -->
		<div class="hk-wrapper">
			
			<!-- Main Content -->
			<div class="hk-pg-wrapper hk-auth-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12 pa-0">
							<div class="auth-form-wrap pt-xl-0 pt-70">
								<div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
									<a class="auth-brand text-center d-block mb-20" href="#">
										<img src="{{URL::to('/')}}/dist/img/logo.png" class="dash-logo">
									</a>
									<form method="post" action="{{ URL::to('/login') }}">
										{{ csrf_field() }}
										@if (session()->has('error'))
											<div class="alert alert-danger" role="alert">
		                                        <strong>Alert.! </strong> &nbsp;{{session()->get('error')}}
		                                    </div>
										@endif
										
										<h3 class="display-5 text-center mb-10"><strong>LOGIN</strong></h3>
										<div class="form-group">
											<input class="form-control" placeholder="Email" type="email" name="email" required>
										</div>
										<div class="form-group">
											<div class="input-group">
												<input class="form-control" placeholder="Password" type="password" name="password" required>
												<div class="input-group-append">
													<span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
												</div>
											</div>
										</div>
										<button class="btn btn-primary btn-block" type="submit">Login</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /HK Wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="/vendors4/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="/vendors4/popper.js/dist/umd/popper.min.js"></script>
		<script src="/vendors4/bootstrap/dist/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="{{URL::to('/')}}/dist/js/jquery.slimscroll.js"></script>
	
		<!-- Fancy Dropdown JS -->
		<script src="{{URL::to('/')}}/dist/js/dropdown-bootstrap-extended.js"></script>
		
		<!-- FeatherIcons JavaScript -->
		<script src="{{URL::to('/')}}/dist/js/feather.min.js"></script>
		
		<!-- Init JavaScript -->
		<script src="{{URL::to('/')}}/dist/js/init.js"></script>
	</body>
</html>