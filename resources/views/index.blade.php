@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>  
$(document).ready(function() {

    // if($("#valores").val()==1){
    //     $("#logout-form-nosesion").submit();  
    // }
    switch ($("#valores").val()) {
        case "1": //NO TIENE SESIÓN      
        $("#logout-form-nosesion").submit();  
            break;
    
        case "3": //ES EL MISMO SUPERVISOR ANTERIOR PERO EN UN TURNO DISTINTO 'Se ha cerrado el ultimo turno que dejaron abierto, si desea tomar el turno actual vuelva a iniciar'        
        $("#logout-form-sigturnoigusuper").submit(); 
            break;
    
        case "4": //ES EL MISMO TURNO ABIERTO PERO DIFERENTE SUPERVISOR 'Ya existe un supervisor encargado del turno actual, espere a que termine el turno y vuelva a iniciar'        
        $("#logout-form-turnodifsuper").submit(); 
            break;

        case "5": //ES EL MISMO TURNO CERRADO 'El turno actual fue cerrado, debe esperar el proximo turno para iniciar'
        $("#logout-form-turnocerrado").submit(); 
            break;
    
        default:        
            break;
    }
    
} );
</script>
@endpush
