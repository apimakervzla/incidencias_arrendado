@extends('layouts.admin')
@section('link_back', url('novedadessall'))
@section('content')

<section class="content-header">
        <h1>
          Configuración de Pisos Lugares LLaves
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
                        
                        <!-- /.box-header -->
                        <div class="box-body" >                        
                        <form method="POST" role="form" action="{{ route("update.tblpisoslugarestiposllaves",['id'=>$pisos_lugares_tipos_llaves[0]->id])}}" enctype="multipart/form-data" >
                          @csrf
                            <!-- textarea -->
                            

                            <!-- radio -->
                              
                            <div class="incidenciasform" >
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Pisos Lugares Llaves</h3>
                            
                                      <div class="box-tools pull-right">                                        
                                        {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> --}}
                                      </div>
                                    </div>          
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                            {{-- <div class="form-group">
                                                <label for="nombreinput">Código</label>
                                                <input name="nombre_llave" class="form-control" id="nombre_llave" placeholder="Ingrese Código" type="text">
                                            </div> --}}

                                            <div class="form-group">
                                              <label>Piso Lugar</label>                                        
                                                <select name="piso_lugar_id" id="piso_lugar_id" class="form-control select2" style="width: 100%;" data-placeholder="Seleccione">                                        
                                                  @foreach ($pisos_lugares as $index=>$valor)
                                                    @if ($valor->id == $pisos_lugares_tipos_llaves[0]->piso_lugar_id)
                                                    <option selected value="{{$valor->id}}">{{$valor->nombre_piso}} - {{$valor->nombre_lugar}}</option>    
                                                    @else
                                                    <option value="{{$valor->id}}">{{$valor->nombre_piso}} - {{$valor->nombre_lugar}}</option>    
                                                    @endif
                                                  
                                                  @endforeach                    
                                                </select>
                                            </div>

                                            {{-- <div class="form-group">
                                                <label for="nombreinput">Horas Expiración</label>
                                                <input name="tiempo_expira" class="form-control" id="tiempo_expira" placeholder="Ingrese Hora" type="text">
                                            </div> --}}

                                            <div class="form-group">
                                                <label>Llave</label>
                                                  <select name="tipo_llave_id" class="form-control select2"  data-placeholder="Seleccione uno" style="width: 100%;" tabindex="-1" aria-hidden="true">                                                
                                                    @foreach ($tipos_llaves as $usuario)
                                                    @if ($usuario->id == $pisos_lugares_tipos_llaves[0]->tipo_llave_id)
                                                    <option selected value="{{$usuario->id}}">{{$usuario->nombre_llave}}</option>    
                                                    @else
                                                    <option value="{{$usuario->id}}">{{$usuario->nombre_llave}}</option>    
                                                    @endif
                                                      
                                                    @endforeach                   
                                                  </select>
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