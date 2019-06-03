@extends('layouts.admin')

@section('content')
@php
  use Carbon\Carbon;
@endphp
<div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
              <strong class="card-title">Lista de Incidencias</strong>
              - Turno:
              <strong class="card-title">
              @if ($incidencias!=null)
              {{$turno->descripcion_turno}}
              
                @else              
                Sin Turno Abierto 
                @endif
              </strong>
              @if ($incidencias!=null)
              <a href="{{ route('create.incidencias')}}" class="card-category">
                  <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Agregar">
                      <i class="fa fa-plus"></i>
                  </button>
                   Agregar Incidencia</a>                
                @endif


              
             {{-- <div class="container"> --}}
                @include('flash::message')                
            {{-- </div> --}}
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <input id="mostra_vista" value="usuarios" hidden disabled>
              <table class="table listas">
                  @if ($incidencias!=null)
                  <thead>
                      <tr>
                        <th>
                          Detalle
                        </th>
                        <th>
                          Tipo
                        </th>
                        <th>
                          Agente
                        </th>
                        <th>
                          Actor
                        </th>
                        <th>
                          Teléfono
                        </th>
                        <th>
                          N° Habitación
                        </th>
                        <!-- <th>
                            Imagenes
                        </th> -->
                        <th>
                          Fecha Creacion
                        </th> 
                        <th>
                            Acciones
                        </th>                
                      </tr>
                    </thead>
                    <tbody>
                      {{-- dd($incidencias) --}}
                    @foreach($incidencias as $puntero=>$incidencia)
                    <tr>
                        <td>
                            {{ $incidencia->detalle_incidencia }}
                        </td>
                        <td>
                          {{ $incidencia->descripcion_tipo_incidencia }}
                        </td>
                        <td>
                         {{ $incidencia->name }}
                        </td>
                        <td>
                            {{ $incidencia->identificacion_actor }}    -     
                            {{ $incidencia->nombre_actor }}         
                            {{ $incidencia->apellido_actor }}         
                        </td>
                        <td>
                            {{ $incidencia->telefono_actor }}
                        </td>
                        <td>
                            {{ $incidencia->nombre_piso }} - {{ $incidencia->nombre_lugar }}
                        </td>
                        
                        <!-- <td>
                            Imagenmes                        
                        </td> -->
                        
                        <td>                       
                           {{ Carbon::parse($incidencia->created_at)->format('d-m-Y') }}    
                           -
                            <b>
                            {{ Carbon::parse($incidencia->created_at)->format('h:i:s') }}     
                            </b> 
                        </td>
    
    
                        <td class="td-actions">
                        {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info_{{$puntero}}">
                                Fotos
                            </button> --}}
                              
                            {{-- <a class="btn btn-app" data-toggle="modal" data-target="#modal-info_{{$puntero}}">
                                <i class="fa fa-photo"></i> Fotos
                            </a> --}}

                            
                            <i style="cursor:pointer;" class="fa fa-photo" data-toggle="modal" data-target="#modal-info_{{$puntero}}""></i>
                            
    
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
                                          @if ($incidencia->url_imagen_1!="")
                                          <div class="col-sm-6">
                                              <img class="img-responsive" src="{{ asset("images/incidencias/$incidencia->url_imagen_1")}}" alt="{{$incidencia->url_imagen_1}}">
                                          </div>
                                          @endif  
    
                                          @if ($incidencia->url_imagen_2!="")
                                          <div class="col-sm-6">
                                              <img class="img-responsive" src="{{ asset("images/incidencias/$incidencia->url_imagen_2")}}" alt="{{$incidencia->url_imagen_2}}">
                                          </div>
                                          @endif  
    
                                          @if ($incidencia->url_imagen_3!="")
                                          <div class="col-sm-6">
                                              <img class="img-responsive" src="{{ asset("images/incidencias/$incidencia->url_imagen_3")}}" alt="{{$incidencia->url_imagen_3}}">
                                          </div>
                                          @endif  
    
                                          @if ($incidencia->url_imagen_4!="")
                                          <div class="col-sm-6">
                                              <img class="img-responsive" src="{{ asset("images/incidencias/$incidencia->url_imagen_4")}}" alt="{{$incidencia->url_imagen_4}}">
                                          </div>
                                          @endif  
    
                                          @if ($incidencia->url_imagen_5!="")
                                          <div class="col-sm-6">
                                              <img class="img-responsive" src="{{ asset("images/incidencias/$incidencia->url_imagen_5")}}" alt="{{$incidencia->url_imagen_5}}">
                                          </div>
                                          @endif  
    
                                          @if ($incidencia->url_imagen_6!="")
                                          <div class="col-sm-6">
                                              <img class="img-responsive" src="{{ asset("images/incidencias/$incidencia->url_imagen_6")}}" alt="{{$incidencia->url_imagen_6}}">
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
    
                          <!-- <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" onclick="location.href='{{ route('show.novedades',['novedad_id'=>$incidencia->id])}}'" class="btn btn-white btn-link btn-sm" data-original-title="Ver">
                            <i class="fa fa-pencil"></i>
                          </button>                                                  -->
                        </td>
                      </tr>
                    @endforeach                    
                    </tbody>
                    @else
                    <thead>
                        <tr>
                          <th>
                            Sin Turno Abierto
                          </th>                          
                        </tr>
                      </thead>
                    @endif
                
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