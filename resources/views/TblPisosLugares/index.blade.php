@extends('layouts.admin')

@section('content')
@php
  use Carbon\Carbon;
@endphp
<div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
              <strong class="card-title">Lista de Pisos y Lugares</strong>
              
              <a href="{{ route('create.tblpisoslugares')}}" class="card-category">
                  <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Agregar">
                      <i class="fa fa-plus"></i>
                  </button>
                   Agregar Pisos y Lugares</a>                
              


              
             {{-- <div class="container"> --}}
                @include('flash::message')                
            {{-- </div> --}}
          </div>
          <div class="card-body">
            <div class="table-responsive">              
              <table class="table listas">                 
                  <thead>
                      <tr>
                        <th>
                          Piso
                        </th>
                        <th>
                          Lugar
                        </th>
                        <th>
                          Llave
                        </th>
                        
                        <th>
                            Acciones
                        </th>                
                      </tr>
                    </thead>
                    <tbody>
                      {{-- {{ dd($pisos_lugares)}} --}}
                    @foreach($pisos_lugares as $puntero=>$valor)
                    <tr>
                        <td>
                            {{-- <i class="fa fa-circle" style="color: {{ $valor->hexadecimal }};"></i> --}}
                            {{ $valor->nombre_piso }}
                        </td>
                        <td>
                          {{ $valor->nombre_lugar }} 
                        </td>

                        <td>
                          @if ($valor->hexadecimal != "")
                              <i class="fa fa-circle" style="color: {{ $valor->hexadecimal }};"></i>
                              {{ $valor->nombre_llave }}
                          @endif


                          
                      </td>
                       
    
                        <td class="td-actions">
                        {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info_{{$puntero}}">
                                Fotos
                            </button> --}}
                              
                            {{-- <a class="btn btn-app" data-toggle="modal" data-target="#modal-info_{{$puntero}}">
                                <i class="fa fa-photo"></i> Fotos
                            </a> --}}
    
    
                            <button style="font-size: 1.2rem" type="button" rel="tooltip" title="Actualizar" onclick="location.href='{{ route('edit.tblpisoslugares',['id'=>$valor->id])}}'" class="btn btn-white btn-link btn-sm" >                             
                            <i class="fa fa-pencil"></i>
                          </button>  
                          
                          {{-- <a class="btn btn-app" data-toggle="modal" data-target="#modal-info_{{$puntero}}">
                              <i class="fa fa-photo"></i> Fotos
                          </a> --}}
                          <button data-toggle="modal" data-target="#modal-info_{{$puntero}}" style="font-size: 1.2rem" type="button" rel="tooltip" title="Ver QR" class="btn btn-white btn-link btn-sm" >
                              <i class="fa fa-qrcode"></i>
                          </button>
  
                        <div class="modal modal-info fade" id="modal-info_{{$puntero}}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">QR</h4>
                                  </div>
                                  <div class="modal-body">
                                    {{-- <p>One fine body&hellip;</p> --}}
                                    <div class="row margin-bottom">       
                                        <div class="col-sm-12">
                                            <div class="row">
                                              <div class="col-sm-12" style="justify-content: center;">
                                                  <img class="img-responsive" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->errorCorrection('H')->generate($valor->id)) !!} ">
                                              </div>                                              
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                      

                                        {{-- <div class="col-sm-12">                                            
                                            <img class="img-responsive" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->errorCorrection('H')->generate($valor->id)) !!} ">
                                        </div> --}}
                                        <!-- /.col -->
                                        {{-- <div class="col-sm-6">
                                          <div class="row">
                                            <div class="col-sm-6">
                                              <img class="img-responsive" src="{{ asset("images/incidencias/$incidencia->url_imagen_1")}}" alt="{{$incidencia->url_imagen_1}}">
                                              <br>
                                              <img class="img-responsive" src="../../dist/img/photo3.jpg" alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                              <img class="img-responsive" src="../../dist/img/photo4.jpg" alt="Photo">
                                              <br>
                                              <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                          </div>
                                          <!-- /.row -->
                                        </div> --}}
                                        <!-- /.col -->
                                      </div>
  
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                                    {{-- <button type="button" class="btn btn-outline">Save changes</button> --}}
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>


                        </td>
                      </tr>
                    @endforeach                    
                    </tbody>
                    
                
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection
@push('scripts')
<script>  
$(document).ready(function() {
//   $('#fecha_ano').on('change', function(e){
//     $(this).closest('form').submit();
// });
// $("#apertura_cierre").click( function(){
//   $(this).closest('form').submit();
// });  
  $('table.listas').DataTable( {
      "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
  } );  
} );
</script>
@endpush