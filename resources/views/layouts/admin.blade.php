<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset("css/bootstrap/bootstrap.min.css")}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("css/bootstrap/font-awesome.min.css")}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset("css/bootstrap/ionicons.min.css")}}">
  <link rel="stylesheet" href="{{ asset("dist/css/daterangepicker.css")}}">
  <link rel="stylesheet" href="{{ asset("dist/css/bootstrap-datepicker.min.css")}}">
  <link rel="stylesheet" href="{{ asset("css/bootstrap/all.css")}}">
  <link rel="stylesheet" href="{{ asset("css/bootstrap/bootstrap-colorpicker.min.css")}}">
  <link rel="stylesheet" href="{{ asset("css/bootstrap/bootstrap-timepicker.min.css")}}">
  <link rel="stylesheet" href="{{ asset("css/dataTables.bootstrap.min.css")}}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("dist/css/AdminLTE.min.css")}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset("css/all-skins.min.css")}}">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>I</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>Incidencias</span>
    </a>

    @include('layouts.navbar_top')
    
  </header>
  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      @yield('content')

  </div>
  <!-- /.content-wrapper -->

  @include('layouts.footer')


  @include('layouts.sidebar_control')

  <!-- Control Sidebar -->
  
<!-- ./wrapper -->

 <!-- jQuery 3 -->
 <script src="{{ asset("js/jquery.min.js")}}"></script>
 <!-- Bootstrap 3.3.7 -->
 <script src="{{ asset("js/bootstrap.min.js")}}"></script>
 {{-- <script src="{{ asset("js/fastclick.js")}}"></script> --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
 <script src="{{ asset("js/jquery.inputmask.js")}}"></script>
<script src="{{ asset("js/jquery.inputmask.date.extensions.js")}}"></script>
<script src="{{ asset("js/jquery.inputmask.extensions.js")}}"></script>
<script src="{{ asset("js/moment.min.js")}}"></script>
<script src="{{ asset("js/daterangepicker.js")}}"></script>
<script src="{{ asset("js/bootstrap-datepicker.min.js")}}"></script>
<script src="{{ asset("js/bootstrap-colorpicker.min.js")}}"></script>
<script src="{{ asset("js/bootstrap-timepicker.min.js")}}"></script>
<script src="{{ asset("js/jquery.slimscroll.min.js")}}"></script>
<script src="{{ asset("js/icheck.min.js")}}"></script>
<!-- FastClick -->
<script src="{{ asset("js/fastclick.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("js/adminlte.min.js")}}"></script>
<script src="{{ asset("js/jquery.dataTables.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("js/demo.js")}}"></script>
<!-- jvectormap  -->
<script src="{{ asset("js/jquery-jvectormap-1.2.2.min.js")}}"></script>
<script src="{{ asset("js/jquery-jvectormap-world-mill-en.js")}}"></script>


@stack('scripts')
</body>
</html>
