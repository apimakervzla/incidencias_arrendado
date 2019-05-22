@extends('layouts.admin')

@section('content')
@php
  use Carbon\Carbon;
@endphp
<div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
              <strong class="card-title">Lista de Novedades</strong>
              - Turno:
              <strong class="card-title">{{$turno[0]->descripcion_turno}}</strong>
            <a href="{{ route('create.novedades')}}" class="card-category">
            <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Agregar">
                <i class="fa fa-plus"></i>
            </button>
             Agregar Novedad</a>
             
                @include('flash::message')
                
            
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <input id="mostra_vista" value="usuarios" hidden disabled>
              <table class="table listas">
                <thead>
                  <tr>
                    <th>
                      Turno
                    </th>
                    <th>
                      Rol
                    </th>
                    <th>
                      Nombres
                    </th>
                    
                    <th>
                        Incidencia
                    </th>
                    <th>
                      Fecha Creacion
                    </th> 
                    {{-- <th>
                        Acciones
                    </th>                 --}}
                  </tr>
                </thead>
                <tbody>                  
                @foreach($novedades as $novedad)
                <tr>
                    <td>
                        {{ $novedad->descripcion_turno }}
                    </td>

                    <td>
                       <b>{{ $novedad->description }}:</b> {{$novedad->name}}
                    </td>

                    <td>
                      {{ $novedad->descripcion_novedad }}
                    </td>
                    
                    <td>
                        @if ($novedad->incluir_incidencia==0)
                            No
                        @else
                            Si
                        @endif                    
                      </td>
                    <td>       
                        {{ Carbon::parse($novedad->created_at)->format('d-m-Y') }}     
                        -
                        <b>
                        {{ Carbon::parse($novedad->created_at)->format('h:i:s') }}     
                        </b>
                    </td>
                    {{-- <td class="td-actions">
                      <!-- <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" onclick="location.href='{{ route('show.novedades',['novedad_id'=>$novedad->id])}}'" class="btn btn-white btn-link btn-sm" data-original-title="Ver">
                        <i class="fa fa-pencil"></i>
                      </button>                                                  -->
                    </td> --}}
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