@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div> --}}
       
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('Un nuevo enlace ha sido enviado a su correo electrónico.') }}
            </div>
            @endif

            {{ __('Antes de continuar, por favor verifica tu correo electrónico.') }}
            {{ __('Si no recibiste el correo') }}, <a href="{{ route('verification.resend') }}">{{ __('haga click aqui para recibirlo de nuevo') }}</a>.
        <div class="text-center">          
        </div>

        
        <div class="lockscreen-footer text-center">
          Copyright © 2019 <b><a href="https://apimaker.com.ve" class="text-black">Apimaker Group</a></b><br>
          Todos los Derechos Reservados.
        </div>
        @endsection
