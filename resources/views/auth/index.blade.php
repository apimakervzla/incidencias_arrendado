@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
          <strong class="card-title">Lista de Usuarios</strong>
        <a href="{{ route('create.users')}}" class="card-category">
        <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Agregar">
            <i class="fa fa-plus"></i>
        </button>
         Agregar usuario</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <input id="mostra_vista" value="usuarios" hidden disabled>
          <table class="table listas">
            <thead>
              <tr>
                <th>
                  Usuario
                </th>
                <th>
                  Correo Electrónico
                </th>
                <th>
                  Rol
                </th>
                <th>
                  Fecha Creacion/Modificación
                </th>
                            <th>
                                Acciones
                            </th>
              </tr>
            </thead>
            <tbody>
              @foreach($usuarios as $usuario)
              <tr>
                <td>
                    {{ $usuario->name }}
                </td>
                <td>
                  {{ $usuario->email }}
                </td>
                <td>
                   {{ $usuario->description }}
                </td>
                <td>
                  {{ $usuario->created_at}}
                </td>
                <td class="td-actions">
                  <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" onclick="location.href='{{ route('edit.users',['user_id'=>$usuario->id])}}'" class="btn btn-white btn-link btn-sm" data-original-title="Editar">
                    <i<i class="fa fa-pencil"></i>
                  </button>                  
                  @switch($usuario->id_estado)
                      @case(1)
                      <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" onclick="location.href='{{ route('status.users',['user_id'=>$usuario->id,'id_estado'=>$usuario->id_estado])}}'" class="btn btn-white btn-link btn-sm" data-original-title="Remover">
                        <i class="fa fa-unlock"></i>
                    </button>
                          @break
                      @case(0)
                      <button style="font-size: 1.2rem" type="button" rel="tooltip" title="" onclick="location.href='{{ route('status.users',['user_id'=>$usuario->id,'id_estado'=>$usuario->id_estado])}}'" class="btn btn-white btn-link btn-sm" data-original-title="Remover">
                        <i class="fa fa-lock"></i>
                    </button>
                          @break
                      @default                          
                  @endswitch                
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