@extends('layouts.admin')
@section('link_back', url('usersall'))
@section('content')
<div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>{{ __('Modificar Usuario') }}</strong> - Complete todos los campos
            </div>
            <div class="card-body card-block">
                <form action="{{ route('update.users',['user_id'=>$user->id]) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">{{ __('Correo Electrónico') }}</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="form-control-static">{{$user->email}}</p>
                    </div>
                </div>
                <div class="row form-group">
                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">{{ __('Nombre') }}</label></div>
                        <div class="col-12 col-md-9"><input value="{{$user->name}}" placeholder="Nombre del Usuario" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <small class="help-block form-text">Porfavor ingresa el nombre del usuario</small></div>
                        
        
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                </div>                
                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">{{ __('Rol de Usuario') }}</label></div>
                    <div class="col-12 col-md-9">
                    <select id="role_id_select" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required>
                        <option value="">Seleccione</option>
                        @foreach($roles as $role)
                        @if ($user->role_id==$role->id)
                        <option value="{{$role->id}}" selected="selected">{{$role->description}}</option>
                        @else
                        <option value="{{$role->id}}">{{$role->description}}</option> 
                        @endif                        
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
                            <input placeholder="Clave"  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                            @error('password')                 
                                <small class="help-block invalid-feedback form-text" role="alert">{{ $message }}</small>
                            
                            @enderror                               
                        </div>            
                    </div>
                    {{-- <div class="row form-group">
                        <div class="col col-md-3"><label for="password-input" class=" form-control-label">{{ __('Confirmación Clave') }}</label></div>
                        <div class="col-12 col-md-9">
                                <input placeholder="Confirmación Clave" id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">               
                            <small class="help-block form-text">Porfavor repita la contraseña</small></div>
                    </div>
             --}}
                    <div class="row form-group">
                            <div class="col col-md-3"><label for="password-input" class=" form-control-label">Foto</label></div>
                            <div class="col-12 col-md-9">
                                    <input type="file" class="form-control" name="file_foto_usuario[]" >
                                {{-- <small class="help-block form-text">Porfavor repita la contraseña</small> --}}
                            </div>
                        </div>




            </div>
                <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-sm">
                        <i class="fa fa-refresh"></i> {{ __('Modificar') }}
                        </button>
                        <button type="reset" class="btn btn-warning btn-sm">
                            <i class="fa fa-undo"></i> {{__('Restaurar')}}
                        </button>
                    </div>
                </form>
        </div>
        </div>
@endsection
