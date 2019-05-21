@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   Bienvenido
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>  
$(document).ready(function() {

    if($("#valores").val()==1){
        // alert("hola");
        $("#logout-form").submit();        
    }
} );
</script>
@endpush
