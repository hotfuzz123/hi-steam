<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="description" content="Responsive Admin Template" />
	<meta name="author" content="RedstarHospital" />
	<title>Smart University | Bootstrap Responsive Admin Template</title>
	<!-- google font -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
	<!-- icons -->
	<link href="{{ asset('backend/admin/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('backend/admin/plugins/iconic/css/material-design-iconic-font.min.css') }}">
	<!-- Font Awesome 5 -->
    <script src="https://kit.fontawesome.com/91f55319c9.js" crossorigin="anonymous"></script>
	{{-- PHPFlasher --}}
	@flasher_render
    <!-- Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <!-- bootstrap -->
	<link href="{{ asset('backend/admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- style -->
	<link rel="stylesheet" href="{{ asset('backend/admin/css/pages/extra_pages.css') }}">
	<!-- favicon -->
	<link rel="shortcut icon" href="{{ asset('backend/admin/img/favicon.ico') }}" />
</head>

<body>
	<div class="limiter">
		<div class="container-login100 page-background">
			<div class="wrap-login100">
				<form action="{{ route('admin.login') }}" method="post" class="login100-form validate-form">
					<span class="login100-form-logo">
						<img alt="" src="{{ asset('backend/admin/img/logo-2.png') }}">
					</span>
					<span class="login100-form-title p-b-34 p-t-27">Đăng nhập Admin</span>
					@csrf
                    <div class="wrap-input100 validate-input" data-validate="Nhập Email">
						<input class="input100" type="text" name="email" placeholder="Nhập Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Nhập Mật Khẩu">
						<input class="input100" type="password" name="password" placeholder="Nhập Mật Khẩu">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">Ghi nhớ đăng nhập</label>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">Đăng nhập</button>
					</div>
					<div class="text-center p-t-30">
						<a class="txt1" href="forgot_password.html">Quên mật khẩu?</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- start js include path -->
	<script src="{{ asset('backend/admin/plugins/jquery/jquery.min.js') }}"></script>
	<!-- bootstrap -->
	<script src="{{ asset('backend/admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('backend/admin/js/pages/extra-pages/pages.js') }}"></script>
	{{-- SweetAlert --}}
	@include('sweetalert::alert')
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- end js include path -->
</body>

</html>
