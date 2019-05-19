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
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("js/demo.js")}}"></script>
<!-- jvectormap  -->
<script src="{{ asset("js/jquery-jvectormap-1.2.2.min.js")}}"></script>
<script src="{{ asset("js/jquery-jvectormap-world-mill-en.js")}}"></script>
</body>
</html>
<script>  
    $(document).ready(function() {
       //Initialize Select2 Elements
       $('.select2').select2();       

       $(".option").click(function(){   

          $(".incidenciasform").toggle("slide");         
       });
   
       //Datemask dd/mm/yyyy
       $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
       //Datemask2 mm/dd/yyyy
       $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
       //Money Euro
       $('[data-mask]').inputmask()
   
       //Date range picker
       $('#reservation').daterangepicker()
       //Date range picker with time picker
       $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
       //Date range as a button
       $('#daterange-btn').daterangepicker(
         {
           ranges   : {
             'Today'       : [moment(), moment()],
             'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
             'This Month'  : [moment().startOf('month'), moment().endOf('month')],
             'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
           },
           startDate: moment().subtract(29, 'days'),
           endDate  : moment()
         },
         function (start, end) {
           $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
         }
       )
   
       //Date picker
       $('#datepicker').datepicker({
         autoclose: true
       })
   
       //iCheck for checkbox and radio inputs
       $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
         checkboxClass: 'icheckbox_minimal-blue',
         radioClass   : 'iradio_minimal-blue'
       })
       //Red color scheme for iCheck
       $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
         checkboxClass: 'icheckbox_minimal-red',
         radioClass   : 'iradio_minimal-red'
       })
       //Flat red color scheme for iCheck
       $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
         checkboxClass: 'icheckbox_flat-green',
         radioClass   : 'iradio_flat-green'
       })
   
       //Colorpicker
       $('.my-colorpicker1').colorpicker()
       //color picker with addon
       $('.my-colorpicker2').colorpicker()
   
       //Timepicker
       $('.timepicker').timepicker({
         showInputs: false
       })
     })
   </script>