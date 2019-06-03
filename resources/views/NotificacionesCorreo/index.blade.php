@extends('layouts.admin')

@section('content')
@php
  use Carbon\Carbon;
@endphp
<div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
              <strong class="card-title">Lista de Notificaciones Correo</strong>
              
              {{-- <a href="{{ route('create.notificacionescorreo')}}" class="card-category">
                  <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Agregar">
                      <i class="fa fa-plus"></i>
                  </button>
                   Agregar Notificación Correo</a>                 --}}
              


              
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
                          Módulo
                        </th>
                        <th>
                          Correo
                        </th>
                        
                        <th>
                            Acciones
                        </th>                
                      </tr>
                    </thead>
                    <tbody>
                      {{-- dd($incidencias) --}}
                    @foreach($notificaciones_correo as $puntero=>$valor)
                    <tr>
                        <td>
                            {{-- <i class="fa fa-circle" style="color: {{ $valor->hexadecimal }};"></i> --}}
                            {{ $valor->module_description }}
                        </td>
                        <td>
                          {{ $valor->correo_notificacion }} 
                        </td>
                       
    
                        <td class="td-actions">
                        {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info_{{$puntero}}">
                                Fotos
                            </button> --}}
                              
                            {{-- <a class="btn btn-app" data-toggle="modal" data-target="#modal-info_{{$puntero}}">
                                <i class="fa fa-photo"></i> Fotos
                            </a> --}}
    
    
                            <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" onclick="location.href='{{ route('edit.notificacionescorreo',['id'=>$valor->module_id])}}'" class="btn btn-white btn-link btn-sm" data-original-title="Ver">                             
                            <i class="fa fa-pencil"></i>
                          </button>                                                  
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