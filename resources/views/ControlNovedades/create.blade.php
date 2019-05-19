@extends('layouts.admin')
@section('link_back', url('novedadessall'))
@section('content')
<section class="content-header">
        <h1>
          Advanced Form Elements
          <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Forms</a></li>
          <li class="active">Advanced Elements</li>
        </ol>
</section>
<section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Agentes de Turno</h3>
  
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> --}}
            </div>
          </div>          
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Agentes</label>
                  <select name="role_user_id_agente" class="form-control select2" multiple="" data-placeholder="Seleccione uno o mas" style="width: 100%;" tabindex="-1" aria-hidden="true">
                {{-- @foreach ($agentes as $agente)
                <option value="{{$agente->id}}">{{$agente->name}}</option>    
                    @endforeach                    --}}
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
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
                        <div class="box-body">
                          <form role="form">
                            <!-- textarea -->
                            <div class="form-group">
                              <label>Detalle la Novedad</label>
                              <textarea name="descripcion_novedad" class="form-control" rows="3" placeholder="Escriba aquí ..."></textarea>
                            </div>

                            <!-- radio -->
                            <div class="form-group">
                            <div class="radio">
                                Causa Incidencia:
                                <label>
                                <input name="inculir_incidencia[]" id="optionsRadios1" class="option" value="1" type="radio">
                                Si
                                </label>
                                <label>
                                <input name="inculir_incidencia[]" id="optionsRadios2" class="option" value="0" checked="" type="radio">
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
                                        <select name="tipo_incidencia_id" class="form-control select2" style="width: 100%;">
                                        {{-- @foreach ($tipos_incidencias as $tipo_incidencia)
                                        <option value="{{$tipo_incidencia->id}}">{{$tipo_incidencia->descripcion_incidencia}}</option>    
                                            @endforeach                    --}}
                                        </select>
                                        </div>
                                        <div class="form-group">
                                                <label>Detalle la Incidencia</label>
                                                <textarea name="detalle_incidencia" class="form-control" rows="3" placeholder="Escriba aquí ..."></textarea>
                                              </div>
                                        <div class="form-group">
                                        <label for="exampleInputFile">Evidencias</label>
                                        <input name="url_imagen[]" id="exampleInputFile" type="file" multiple>
                        
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
   @endpush