<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V19</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{!! asset('public/images/icons/favicon.ico') !!}"/>
	<link rel="stylesheet" type="text/css" href="{!! asset('public/fonts/font-awesome-4.7.0/css/font-awesome.min.css') !!}">
	<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/vendor/animate/animate.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/vendor/css-hamburgers/hamburgers.min.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/vendor/animsition/css/animsition.min.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/vendor/select2/select2.min.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/vendor/daterangepicker/daterangepicker.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/css/util.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/css/main.css') !!}">
</head>
<body>
<div class="modal fade" id="errorLoginModal" tabindex="-1" role="dialog" aria-labelledby="errorLoginModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalCenterTitle">Đăng nhập không thành công</h4>
			</div>
			<div class="modal-body">
				{!! $notify !!}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Đã hiểu</button>
			</div>
		</div>
	</div>
</div>	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form method="get" action="{!! route('process-login') !!}" class="login100-form validate-form">
					<span class="login100-form-title p-b-33">
						Đăng nhập tài khoản
					</span>
					<input type="hidden" name="_token" value="{!! csrf_token(); !!}">
					<div class="wrap-input100 validate-input" data-validate = "Tên đăng nhập là bắt buộc">
						<input class="input100" type="text" name="username" placeholder="Tên đăng nhập">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Mật khẩu là bắt buộc">
						<input class="input100" type="password" name="password" placeholder="Mật khẩu">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn" type="submit">
							Đăng nhập
						</button>
					</div>

					<div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							Quên
						</span>

						<a href="#" class="txt2 hov1">
							Tên đăng nhập / Mật khẩu?
						</a>
					</div>

					<div class="text-center">
						<span class="txt1">
							Tạo tài khoản mới?
						</span>

						<a href="#" class="txt2 hov1">
							Đăng ký
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!-- 	<script src="vendor/jquery/jquery-3.2.1.min.js"></script> -->
	<script src="{!! asset('plugins/bower_components/jquery/dist/jquery.min.js') !!}"></script>
	
	<script src="{!! asset('public/vendor/animsition/js/animsition.min.js') !!}"></script>
	<script src="{!! asset('public/vendor/bootstrap/js/popper.js') !!}"></script>
	<!-- <script src="vendor/bootstrap/js/bootstrap.min.js"></script> -->
	<script src="{!! asset('public/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
	<script src="{!! asset('public/vendor/select2/select2.min.js') !!}"></script>
	<script src="{!! asset('public/vendor/daterangepicker/moment.min.js') !!}"></script>
	<script src="{!! asset('public/vendor/daterangepicker/daterangepicker.js') !!}"></script>
	<script src="{!! asset('public/vendor/countdowntime/countdowntime.js') !!}"></script>
	
	<script src="{!! asset('public/js/main.js') !!}"></script>
	@if ( $notify != "" )
		<script type="text/javascript">
			$(window).load(function() {
				$("#errorLoginModal").modal('show');
			});
		</script>
	@endif 
</body>
</html>