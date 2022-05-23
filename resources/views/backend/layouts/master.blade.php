<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
    @include('backend.layouts.head')
</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
	<div class="loader"></div>
	<div class="page-wrapper">
		<!-- start header -->
        @include('backend.layouts.header')
		<!-- end header -->
		<!-- start color quick setting -->
        @include('backend.layouts.setting')
		<!-- end color quick setting -->
		<!-- start page container -->
		<div class="page-container">
			<!-- start sidebar menu -->
            @include('backend.layouts.sidebar')
			<!-- end sidebar menu -->
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
                    @yield('content')
				</div>
			</div>
			<!-- end page content -->
			<!-- start chat sidebar -->
            @include('backend.layouts.chat')
			<!-- end chat sidebar -->
		</div>
		<!-- end page container -->
		<!-- start footer -->
        @include('backend.layouts.footer')
		<!-- end footer -->
	</div>
    @include('backend.layouts.scripts')
</body>

</html>
