<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta name="description" content="Responsive Admin Template" />
<meta name="author" content="SmartUniversity" />
<title>Smart University | Bootstrap Responsive Admin Template</title>
<!-- google font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
<!-- icons -->
<link href="{{ asset('backend/admin/fonts/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/admin/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/admin/fonts/material-design-icons/material-icon.css') }}" rel="stylesheet" type="text/css" />
<!--token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--bootstrap -->
<link href="{{ asset('backend/admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/admin/plugins/summernote/summernote.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('backend/admin/plugins/flatpicker/css/flatpickr.min.css') }}" />
<!-- data tables -->
<link href="{{ asset('backend/admin/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Material Design Lite CSS -->
<link rel="stylesheet" href="{{ asset('backend/admin/plugins/material/material.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/admin/css/material_style.css') }}">
<!-- inbox style -->
<link href="{{ asset('backend/admin/css/pages/inbox.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Theme Styles -->
<link href="{{ asset('backend/admin/css/theme/light/theme_style.css') }}" rel="stylesheet" id="rt_style_components" type="text/css" />
<link href="{{ asset('backend/admin/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/admin/css/pages/formlayout.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/admin/css/theme/light/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/admin/css/responsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/admin/css/theme/light/theme-color.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/admin/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet">
{{-- bootstrap4-toggle --}}
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
{{-- TinyMCE --}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
{{-- PHPFlasher --}}
@flasher_render
<!-- favicon -->
<link rel="shortcut icon" href="{{ asset('backend/admin/img/favicon.ico') }}" />