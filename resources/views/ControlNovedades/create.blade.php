@extends('layouts.admin')
@section('link_back', url('novedadessall'))
@section('content')

<section class="content-header">
        <h1>
          Control de Novedades
          <!-- <small>Preview</small> -->
        </h1>
        <!-- <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Forms</a></li>
          <li class="active">Advanced Elements</li>
        </ol> -->
</section>
<section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Agentes de Turno</h3>
            
                @include('flash::message')
                
            
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> --}}
            </div>
          </div>          
          <!-- /.box-header -->
          <form method="POST" role="form" action="{{ route("store.agentes_turnos")}}">
              @csrf
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                {{-- @if ($agentes_turnos=="") --}}
                <div class="form-group">
                    <label>Agentes</label>
                    <select name="role_user_id_agente[]" class="form-control select2" multiple="" data-placeholder="Seleccione uno o mas" style="width: 100%;" tabindex="-1" aria-hidden="true" required >
                  @foreach ($agentes as $agente)
                  <option value="{{$agente->id}}">{{$agente->name}}</option>    
                      @endforeach                   
                    </select>
                  </div>
                {{-- @endif                 --}}
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <div class="box-footer">
              <button type="submit" class="btn btn-primary">Asignar</button>
            </div> 
          </form>
          <!-- /.box-body -->
          <div class="box-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div>
        </div>
        <!-- /.box -->              
        <div class="row">
            
          <div class="col-md-12">
                <div class="box box-warning">
                        <div class="box-header with-border">
                          <h3 class="box-title">Novedad</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" >                        
                        <form method="POST" role="form" action="{{ route("store.novedades")}}" enctype="multipart/form-data" >
                          @csrf
                            <!-- textarea -->
                            <div class="form-group">
                              <label>Detalle la Novedad</label>
                              <textarea name="descripcion_novedad" class="form-control" rows="3" placeholder="Escriba aquí ..." required></textarea>
                              @error('descripcion_novedad')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>

                            <!-- radio -->
                            <div class="form-group">
                            <div class="radio">
                                {{ __('Causa Incidencia:') }}                                
                                <label>
                                <input name="incidencia_id" id="optionsRadios1" class="option" value="1" type="radio">
                                Si
                                </label>
                                <label>
                                <input name="incidencia_id" id="optionsRadios2" class="option" value="0" checked="" type="radio">
                                No
                                </label>
                            </div>                                                       
                            </div>    
                            <div class="incidenciasform" style="display:none">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Incidencias</h3>
                            
                                      <div class="box-tools pull-right">                                        
                                        {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> --}}
                                      </div>
                                    </div>          
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Tipo incidencia</label>                                        
                                        <select name="tipo_incidencia_id" id="tipo_incidencia_id" class="incidencias form-control select2" style="width: 100%;" data-placeholder="Seleccione">                                        
                                        @foreach ($tipos_incidencias as $tipo_incidencia)
                                        <option value="{{$tipo_incidencia->id}}">{{$tipo_incidencia->descripcion_tipo_incidencia}}</option>    
                                        @endforeach                    
                                        </select>
                                        </div>
                                        <div class="form-group">
                                                <label>Detalle la Incidencia</label>
                                                <textarea name="detalle_incidencia" class="incidencias form-control" rows="3" placeholder="Escriba aquí ..."></textarea>
                                        </div>                                        
                                        <div class="form-group">
                                          <label>Agentes</label>
                                          <select name="role_user_id_actor[]" class="agentes incidencias form-control select2" multiple="" data-placeholder="Seleccione uno o mas" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        @foreach ($agentes as $agente)
                                        <option value="{{$agente->id}}">{{$agente->name}}</option>    
                                            @endforeach                   
                                          </select>
                                        </div>
                                        <div class="actoresform">
                                        <div class="form-group">
                                            <label>Tipos Actores</label>
                                            <select name="tipo_actor_id" id="tipo_actor_id" class="actores incidencias form-control select2" data-placeholder="Seleccione" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option value="">Seleccione...</option>
                                            @foreach ($tipos_actores as $tipo_actor)
                                        <option value="{{$tipo_actor->id}}">{{$tipo_actor->descripcion_tipo_actor}}</option>    
                                            @endforeach                    
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombreinput">Nombre</label>
                                            <input name="nombre_actor" class="nombre actores incidencias form-control" id="nombreinput" placeholder="Ingrese Nombre" type="text">
                                          </div>
                                          <div class="form-group">
                                              <label for="apellidoinput">Apellido</label>
                                              <input name="apellido_actor" class="actores incidencias form-control" id="apellidoinput" placeholder="Ingrese Apellid" type="text">
                                            </div>
                                        <div class="form-group">
                                            <label for="documentoid">Documento de Identidad</label>
                                            <input name="identificacion_actor" class="actores incidencias form-control" id="documentoid" placeholder="Ingrese Doc" type="text">
                                          </div>
                                        <div class="form-group">
                                            <label for="telefono">Teléfono de Contacto</label>
                                            <input name="telefono_actor" class="actores incidencias form-control" id="telefono" placeholder="Ingrese tel" type="tel">
                                            @error('telefono_actor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>                                       
                                        <div class="form-group">
                                            <label for="telefono">N° Habitación</label>
                                            <input name="numero_habitacion" class="numero_habitacion incidencias form-control" id="numero_habitacion" placeholder="Ingrese Número Hab." type="text">
                                        </div>                                       
                                        </div>
                                        <div class="form-group">
                                        <label for="exampleInputFile">Evidencias</label>
                                        <input name="url_imagen[]" class="incidencias" id="exampleInputFile" type="file" multiple>
                        
                                        <p class="help-block">Ingrese max 6 fotografías.</p>
                                        </div>
                                          <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                      </div>
                                      <!-- /.row -->
                                    </div> 
                                </div>  
                                <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Enviar</button>
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