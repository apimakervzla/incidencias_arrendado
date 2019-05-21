@extends('layouts.admin')
@section('link_back', url('usersall'))
@section('content')
<div class="col-md-12">
<div class="card">
    <div class="card-header">
        <strong>{{ __('Nuevo Usuario') }}</strong> - Complete todos los campos
    </div>
    <div class="card-body card-block">
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
        <div class="row form-group">
                <div class="col col-md-3"><label for="email-input" class=" form-control-label">{{ __('Nombre') }}</label></div>
                <div class="col-12 col-md-9"><input placeholder="Nombre del Usuario" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <small class="help-block form-text">Porfavor ingresa el nombre del usuario</small></div>
                

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
        </div>
        <div class="row form-group">
                <div class="col col-md-3"><label for="email-input" class=" form-control-label">{{ __('Correo Electrónico') }}</label></div>
                <div class="col-12 col-md-9">
                    <input placeholder="Correo Electrónico" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    
                    @error('email')
                    <small class="help-block invalid-feedback form-text" role="alert">{{ $message }}</small>
                    @enderror
                </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3"><label for="select" class=" form-control-label">{{ __('Rol de Usuario') }}</label></div>
            <div class="col-12 col-md-9">
            <select id="role_id_select" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required>
                <option value="">Seleccione</option>
                @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->description}}</option>
                @endforeach                        
            </select>                                

            @error('role_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror           
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3"><label for="password-input" class=" form-control-label">{{ __('Clave') }}</label></div>
            <div class="col-12 col-md-9">
                <input placeholder="Clave"  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')                 
                    <small class="help-block invalid-feedback form-text" role="alert">{{ $message }}</small>
                
                @enderror                               
            </div>            
        </div>
        <div class="row form-group">
            <div class="col col-md-3"><label for="password-input" class=" form-control-label">{{ __('Confirmación Clave') }}</label></div>
            <div class="col-12 col-md-9">
                    <input placeholder="Confirmación Clave" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">               
                <small class="help-block form-text">Porfavor repita la contraseña</small></div>
        </div>
    </div>
        <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> {{ __('Registrar') }}
                </button>
                <button type="reset" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Borrar
                </button>
            </div>
        </form>
</div>
</div>
@endsection
