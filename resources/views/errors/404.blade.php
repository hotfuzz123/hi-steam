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
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet"
		type="text/css" />
	<!-- icons -->
	<link href="{{ asset('backend/admin/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('backend/admin/plugins/iconic/css/material-design-iconic-font.min.css') }}">
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
				<form class="form-404">
					<span class="login100-form-logo">
						<img alt="" src="{{ asset('backend/admin/img/logo-2.png') }}">
					</span>
					<span class="form404-title p-b-34 p-t-27">
						Error 404
					</span>
					<p class="content-404">The page you are looking for does't exist or an other error occurred.</p>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Go to home page
						</button>
					</div>
					<div class="text-center p-t-27">
						<a class="txt1" href="#">
							Need Help?
						</a>
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
	<!-- end js include path -->
</body>
</html>