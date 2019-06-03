@extends('layouts.admin')

@section('content')
@php
  use Carbon\Carbon;
@endphp
<div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
              <strong class="card-title">Lista de Pisod Lugares Llaves</strong>
              
              <a href="{{ route('create.tblpisoslugarestiposllaves')}}" class="card-category">
                  <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Agregar">
                      <i class="fa fa-plus"></i>
                  </button>
                   Agregar Piso Lugar Llave</a>                
              


              
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
                      {{-- {{dd($pisos_lugares_tipos_llaves)}} --}}
                    @foreach($pisos_lugares_tipos_llaves as $puntero=>$valor)
                    <tr>
                        <td>                            
                            {{ $valor->nombre_piso }}
                        </td>
                        <td>
                          {{ $valor->nombre_lugar }}
                        </td>

                        <td>
                          <i class="fa fa-circle" style="color: {{ $valor->hexadecimal }};"></i>
                          {{ $valor->nombre_llave }}
                      </td>
                       
    
                        <td class="td-actions">
                        {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info_{{$puntero}}">
                                Fotos
                            </button> --}}
                              
                            {{-- <a class="btn btn-app" data-toggle="modal" data-target="#modal-info_{{$puntero}}">
                                <i class="fa fa-photo"></i> Fotos
                            </a> --}}
    
    
                            <button style="font-size: 1.2rem" type="button" rel="tooltip" title="Actualizar" onclick="location.href='{{ route('edit.tblpisoslugarestiposllaves',['id'=>$valor->id,'tipo_llave_id'=>$valor->tipo_llave_id])}}'" class="btn btn-white btn-link btn-sm" >                             
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