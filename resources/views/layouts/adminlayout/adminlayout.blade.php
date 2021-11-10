<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/admincss/css/main.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/adminplugins/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('adminlte/adminplugins/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('adminlte/adminplugins/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/adminplugins/plugins/select2/css/select2.min.css')}}">
//

  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('adminlte/adminplugins/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('adminlte/adminplugins/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('adminlte/adminplugins/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('adminlte/adminplugins/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('adminlte/adminplugins/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
  <body class="hold-transition sidebar-mini layout-fixed" style="background-color: peru">
    <div class="wrapper" >

  <!-- Navbar -->
 @include('layouts.adminlayout.adminpartials.adminheader')
  <!-- /.navbar -->

 @include('layouts.adminlayout.adminpartials.adminsidebar')

@yield('content')
 @include('layouts.adminlayout.adminpartials.adminfooter')

  <aside class="control-sidebar control-sidebar-open">
  </aside>
</div>

<!-- jQuery -->
<script src="{{asset('adminlte/adminplugins/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adminlte/adminplugins/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/adminplugins/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('adminlte/adminplugins/plugins/select2/js/select2.full.min.js')}}"></script>

  <script>
        $('.select2').select2()
  </script>
<!-- DataTables -->
 <script src="{{asset('adminlte/adminplugins/plugins/datatables/jquery.dataTables.js')}}"></script>
 <script src="{{asset('adminlte/adminplugins/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
  $(function () {
    $("#sections").DataTable();
    jQuery("#userstablee").DataTable();
    $("#categories").DataTable();
    $("#products").DataTable();
    $("#attributes").DataTable();
    $("#brands").DataTable();
    $("#cmspages").DataTable();
    $("#adminstablee").DataTable();
  });
</script>
<!-- ChartJS -->
<script src="{{asset('adminlte/adminplugins/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('adminlte/adminplugins/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('adminlte/adminplugins/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('adminlte/adminplugins/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('adminlte/adminplugins/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('adminlte/adminplugins/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('adminlte/adminplugins/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>

<script src="{{asset('adminlte/adminplugins/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('adminlte/adminplugins/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('adminlte/adminplugins/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('adminlte/adminplugins/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('adminlte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
<script src="{{asset('adminlte/adminjs/adminscript.js')}}"></script>
<!--sweet alert2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('adminlte/sweetalert2.min.js')}}"></script>

</body>
</html>
