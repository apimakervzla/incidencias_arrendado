@extends('layouts.admin')

@section('content')
@php
  use Carbon\Carbon;
@endphp
<div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
              <strong class="card-title">Lista de Lost&Found</strong>
            <a href="{{ route('create.lostfound')}}" class="card-category">
            <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Agregar">
                <i class="fa fa-plus"></i>
            </button>
             Agregar Lost Found</a>
             {{-- <div class="container"> --}}
                @include('flash::message')                
            {{-- </div> --}}
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <input id="mostra_vista" value="usuarios" hidden disabled>
              <table class="table listas">
                <thead>
                  <tr>
                    <th>
                      Descripción
                    </th>
                    
                    <th>
                      Agente
                    </th>

                    <th>
                      Actor
                    </th>
                    <!-- <th>
                        Imagenes
                    </th> -->
                    <th>
                      Fecha Creacion
                    </th> 
                    <th>
                      Fecha Vencimiento
                    </th> 
                    <th>
                        Acciones
                    </th>                
                  </tr>
                </thead>
                <tbody>
                  {{-- {{ dd($lostfound) }}  --}}
                @foreach($lostfound as $puntero=>$valor)
                <tr>
                    <td>
                        {{ $valor->descripcion_lostfound }}
                    </td>
                    
                    <td>
                     {{ $valor->name }}
                    </td>
                    <td>
                        <b>{{ $valor->tipo_actor }}</b>
                        <br>
                        <i title="Actor" class="fa fa-user"></i>
                        {{ $valor->identificacion_actor }} - {{ $valor->nombre_actor }} {{ $valor->apellido_actor }}  
                        <br>
                        <i title="N° Habitación" class="fa fa-bed"></i>{{ $valor->nombre_piso }} - {{ $valor->nombre_lugar }}
                        <br>
                        <i title="Teléfono" class="fa fa-phone"></i>{{ $valor->telefono_actor }}
                        <br>
                        <i title="Correo Electrónico" class="fa fa-envelope"></i>{{ $valor->correo_electronico_actor }}
                    </td>
                    
                    
                    <!-- <td>
                        Imagenmes                        
                    </td> -->
                    
                    <td>                       
                       {{ Carbon::parse($valor->created_at)->format('d-m-Y') }}    
                       -
                        <b>
                        {{ Carbon::parse($valor->created_at)->format('h:i:s') }}     
                        </b> 
                    </td>

                    <td>                       
                      {{ Carbon::parse($valor->fecha_vencimiento_lost_found)->format('d-m-Y') }}    
                      -
                       <b>
                       {{ Carbon::parse($valor->fecha_vencimiento_lost_found)->format('h:i:s') }}     
                       </b> 
                   </td>


                    <td class="td-actions">
                      <!-- <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" onclick="location.href='{{ route('show.novedades',['novedad_id'=>$valor->id])}}'" class="btn btn-white btn-link btn-sm" data-original-title="Ver">
                        <i class="fa fa-pencil"></i>
                      </button>                                                  -->


                      {{-- <a class="btn btn-app" data-toggle="modal" data-target="#modal-info_{{$puntero}}">
                          <i class="fa fa-photo"></i> Fotos
                      </a> --}}
                      <i style="cursor:pointer" class="fa fa-photo" data-toggle="modal" data-target="#modal-info_{{$puntero}}">
                      </i> 

                    <div class="modal modal-info fade" id="modal-info_{{$puntero}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Fotos</h4>
                              </div>
                              <div class="modal-body">
                                {{-- <p>One fine body&hellip;</p> --}}
                                <div class="row margin-bottom">
                                    @if ($valor->url_foto_1!="")
                                    <div class="col-sm-6">
                                        <img class="img-responsive" src="{{ asset("images/lostfound/$valor->url_foto_1")}}" alt="{{$valor->url_foto_1}}">
                                    </div>
                                    @endif  

                                    @if ($valor->url_foto_2!="")
                                    <div class="col-sm-6">
                                        <img class="img-responsive" src="{{ asset("images/lostfound/$valor->url_foto_2")}}" alt="{{$valor->url_foto_2}}">
                                    </div>
                                    @endif  

                                    @if ($valor->url_foto_3!="")
                                    <div class="col-sm-6">
                                        <img class="img-responsive" src="{{ asset("images/lostfound/$valor->url_foto_3")}}" alt="{{$valor->url_foto_3}}">
                                    </div>
                                    @endif  

                                    @if ($valor->url_foto_4!="")
                                    <div class="col-sm-6">
                                        <img class="img-responsive" src="{{ asset("images/lostfound/$valor->url_foto_4")}}" alt="{{$valor->url_foto_4}}">
                                    </div>
                                    @endif  

                                  


                                    
                                    
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