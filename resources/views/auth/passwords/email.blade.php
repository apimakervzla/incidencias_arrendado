
@extends('layouts.app')

@section('content')


  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Enlace de Recuperación de Clave</p>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('password.email') }}" method="POST">
            @csrf
      <div class="form-group has-feedback">
        <input placeholder="Correo Electrónico" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Enviar') }}</button>
        </div>
        <!-- /.col -->
      </div>
</form>
    
{{-- <a href="{{ route("create.users")}}" class="text-center">Register a new membership</a> --}}

  </div>
  <!-- /.login-box-body -->

  @endsection
