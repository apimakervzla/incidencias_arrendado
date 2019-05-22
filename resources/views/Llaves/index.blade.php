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
              {{-- <strong class="card-title">{{$turno[0]->descripcion_turno}}</strong> --}}
            <a href="{{ route('create.llaves')}}" class="card-category">
            <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Agregar">
                <i class="fa fa-plus"></i>
            </button>
             Agregar Prestamo</a>
             
                @include('flash::message')
                
            
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <input id="mostra_vista" value="usuarios" hidden disabled>
              <table class="table listas">
                <thead>
                  <tr>                   
                    <th>
                      Nombres
                    </th>
                    
                    <th>
                        Estatus
                    </th>
                    <th>
                      Fecha Creacion
                    </th> 
                    <th>
                        Acciones
                    </th>                
                  </tr>
                </thead>
                <tbody>                  
                @foreach($llaves as $llave)
                <div class="modal modal-info fade" id="modal-novedades{{$llave->id}}" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Llave</h4>
                      </div>
                      <div class="modal-body">
                        <p>{{ $llave->nombre_llave }}</p>
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
                <tr>
                    <td style="color: {{ $llave->hexadecimal }};">
                        {{ $llave->nombre_llave }}
                    </td>
                    
                    <td>   
                        @switch($llave->status_llave)
                            @case(0)
                            <i class="fa fa-circle text-success"></i> Disponible  
                                @break
                            @case(1)
                            <i class="fa fa-circle text-warning"></i> Entregado  
                                @break
                            @case(3)
                            <i class="fa fa-circle text-error"></i> Venció Tiempo Entrega 
                                @break
                            @default
                                
                        @endswitch                    
                                          
                      </td>
                    <td>       
                        {{ Carbon::parse($llave->created_at)->format('d-m-Y') }}     
                        -
                        <b>
                        {{ Carbon::parse($llave->created_at)->format('h:i:s') }}     
                        </b>
                    </td>
                    <td class="td-actions">
                    <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" data-toggle="modal" data-target="#modal-novedades{{$llave->id}}" class="btn btn-white btn-link btn-sm" data-original-title="Ver">
                        <i class="fa fa-eye"></i>
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