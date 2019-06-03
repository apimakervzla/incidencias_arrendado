@extends('layouts.admin')

@section('content')
@php
  use Carbon\Carbon;
@endphp
<div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
              <strong class="card-title">Lista de Llaves</strong>       
              - Turno:       
              <strong class="card-title">
                @if ($llaves!=null)
                {{$turno->descripcion_turno}}
                @else
                Sin Turno Abierto
                @endif
                </strong>
                @if ($llaves!=null)
                <a href="{{ route('create.llaves')}}" class="card-category">
                    <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Agregar">
                        <i class="fa fa-plus"></i>
                    </button>
                     Agregar Prestamo</a>
                @else
                
                @endif
            
             
                @include('flash::message')
                
            
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <input id="mostra_vista" value="usuarios" hidden disabled>
              <table class="table listas">
                  @if ($llaves!=null)
                  <thead>
                      <tr>                   
                        <th>
                          Nombres de Llaves
                        </th>
                        <th>
                          Prestamo a
                        </th>                    
                        <th>
                            Estatus
                        </th>
                        <th>
                          Fecha Prestamo
                        </th>                     
                        <th>
                            Acciones
                        </th>                
                      </tr>
                    </thead>
                    <tbody>                  
                    @foreach($llaves as $llave)                
                    <tr>
                        <td>
                          <i class="fa fa-circle" style="color: {{ $llave->hexadecimal }};"></i>
                            {{ $llave->nombre_llave }}
                        </td>
                        <td>         
                          @if ($llave->status_llave==1)
                          {{ $llave->usuario_prestamo }}                          
                          @endif                                       
                        </td>
                        <td>   
                          
                          @switch($llave->status_llave)
                            @case(0)
                            <i class="fa fa-circle" style="color: #00a65a;"></i> Disponible  
                                @break
                            @case(1)
                              @if ($llave->tiempo_maximo<Carbon::now())
                              <i class="fa fa-circle" style="color: #d73925;"></i> Venció Tiempo Entrega     
                              @else
                              <i class="fa fa-circle" style="color: #f39c12;"></i> Entregado    
                              @endif                            
                                @break                            
                            @default
                          @endswitch     
                          
                              
                          </td>
                        <td>       
                          @if ($llave->status_llave==1)
                            {{ Carbon::parse($llave->fecha_prestamo)->format('d-m-Y') }}     
                            -
                            <b>
                            {{ Carbon::parse($llave->fecha_prestamo)->format('h:i:s') }}     
                            </b>
                          @endif                        
                        </td>
                        <td class="td-actions">
                            @if ($llave->status_llave)
                            <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" onclick="location.href='{{ route('status.llaves',['tipo_llave_id'=>$llave->id])}}'" class="btn btn-white btn-link btn-sm" data-original-title="Recibido">
                                <i class="fa fa-key"></i>
                            </button>
                          @endif 
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