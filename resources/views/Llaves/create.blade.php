@extends('layouts.admin')
@section('link_back', url('llavessall'))
@section('content')

<section class="content-header">
        <h1>
          Control de Llaves
          <!-- <small>Preview</small> -->
        </h1>
        <!-- <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Forms</a></li>
          <li class="active">Advanced Elements</li>
        </ol> -->
</section>
<section class="content">           
        <div class="row">
            
          <div class="col-md-12">
                <div class="box box-warning">
                        <div class="box-header with-border">
                          <h3 class="box-title">Llaves</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" >                        
                        <form method="POST" role="form" action="{{ route("store.llaves")}}" enctype="multipart/form-data" >
                          @csrf
                          <div class="form-group">
                            <label>Llaves</label>                                        
                            <select name="tipo_llave_id" id="tipo_llave_id" class="incidencias form-control select2" style="width: 100%;" data-placeholder="Seleccione">                                        
                            @foreach ($llaves as $llave)
                            <option value="{{$llave->id}}">                                
                                {{ $llave->nombre_llave}}  
                            </option>    
                            @endforeach                    
                            </select>
                        </div>
                          <div class="form-group">
                            <label>Usuarios Permitidos</label>                                        
                            <select name="role_user_id_permisado" id="role_user_id_permisado" class="incidencias form-control select2" style="width: 100%;" data-placeholder="Seleccione">                                        
                                                
                            </select>
                        </div>
                                <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Entregar</button>
                                      </div>                                                        
                          </form>
                        </div>
                        <!-- /.box-body -->
                      </div>
            
              </div>
  </div></section>
@endsection
@push('scripts')
<script>  
    $(document).ready(function() {
     

      var $company2 = $('#tipo_llave_id');
      var $location2 = $("#role_user_id_permisado");

      $company2.select2().on('change', function() {
          $.ajax({
              url:"llaves/tl" + $company2.val(), // if you say $(this) here it will refer to the ajax call not $('.company2')
              type:'GET',
              success:function(data) {
                  $location2.empty();
                  $.each(data, function(value, key) {
                      $location2.append($("<option></option>").attr("value", value).text(key)); // name refers to the objects value when you do you ->lists('name', 'id') in laravel
                  });
                  $location2.select2(); //reload the list and select the first option
              }
          });
      }).trigger('change');

      // $("#role_user_id").select2({
      //     dropdownParent: $("#tipo_llave_id")
      //   });
//  $("#tipo_llave_id").change(function (event) {
//     $.get("llaves/tl"+event.target.value+"",function(response,tipo_llave_id)
//     {
//       console.log();
//       $("#role_user_id").empty();
//       for (let index = 0; index < response.length; index++) {
       
//       $("#role_user_id").append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
      
//     }
//     });

    
//   });

     
       //Initialize Select2 Elements
       $('.select2').select2();              
       $(".option").click(function(){
          $(".incidenciasform").toggle("slide");         
        if ($(this).val()!=1) {
          
          $(".incidencias").prop('required',false);
        } else {
          
          $(".incidencias").prop('required',true);
        }
       });

       $(".agentes").change(function() {
          if ($(this).val()!="") {
            $(".actores").prop('required',false);            
          }
          else{
            $(".actores").prop('required',true);
            $(".agentes").prop('required',false);            
          }                
        });

       $("#tipo_actor_id").change
       (
          function() 
          {
            //pongo a false a todos
            $("#nombreinput,#apellidoinput,#documentoid,#numero_habitacion").prop('required',false); 
            switch($(this).val())
            {
                case "1"://huesped                  
                    //Pongo requerido a nombre apellido cedula y # hab sea obligatorio
                    $("#nombreinput,#apellidoinput,#documentoid,#numero_habitacion").prop('required',true);
                break;

                default:                
                    //Valido que nom ape y ci sea obligatorio
                    $("#nombreinput,#apellidoinput,#documentoid").prop('required',true);
                break;
            }            
          }
        );

      //  $(".nombre").blur(function() {
      //     if ($(this).val()!="") {
      //       $(".agentes").prop('required',false);            
      //     }
      //     else{
      //       $(".agentes").prop('required',true);          
      //     }                
      //   });

   
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
   @endpush