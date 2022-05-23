<!-- start js include path -->
<script src="{{ asset('backend/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/admin/plugins/popper/popper.js') }}"></script>
<script src="{{ asset('backend/admin/plugins/jquery-blockui/jquery.blockui.min.js') }}"></script>
<script src="{{ asset('backend/admin/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('backend/admin/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('backend/admin/plugins/jquery-validation/js/additional-methods.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('backend/admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('backend/admin/plugins/sparkline/jquery.sparkline.js') }}"></script>
<script src="{{ asset('backend/admin/js/pages/sparkline/sparkline-data.js') }}"></script>
<!-- data tables -->
<script src="{{ asset('backend/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/admin/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/admin/js/pages/table/table_data.js') }}"></script>
<!-- Common js-->
<script src="{{ asset('backend/admin/js/app.js') }}"></script>
<script src="{{ asset('backend/admin/js/pages/validation/form-validation.js') }}"></script>
<script src="{{ asset('backend/admin/js/layout.js') }}"></script>
<script src="{{ asset('backend/admin/js/theme-color.js') }}"></script>
<!-- material -->
<script src="{{ asset('backend/admin/plugins/material/material.min.js') }}"></script>
<script src="{{ asset('backend/admin/plugins/flatpicker/js/flatpicker.min.js') }}"></script>
<script src="{{ asset('backend/admin/js/pages/date-time/date-time.init.js') }}"></script>
<!--apex chart-->
<script src="{{ asset('backend/admin/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/admin/js/pages/chart/chartjs/home-data.js') }}"></script>
<!-- Ckeditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
<!-- Validator -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="{{ asset('backend/admin/plugins/validator/jquery.form-validator.min.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('backend/admin/js/custom.js')}}"></script>
<script src="{{ asset('backend/admin/js/editor.js')}}"></script>
<!-- summernote -->
<script src="{{ asset('backend/admin/plugins/summernote/summernote.js') }}"></script>
<script src="{{ asset('backend/admin/js/pages/summernote/summernote-data.js') }}"></script>
{{-- bootstrap4-toggle --}}
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
{{-- SweetAlert --}}
@include('sweetalert::alert')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- Scripts From Layout --}}
@yield('scripts')
<!-- end js include path -->
