<?php

namespace App\Mail;

use App\Incidencias;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class IncidenciasMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $novedades=Incidencias::join()->where()->get();

        $name    =$request['name'];
        $mail    =$request['mail'];
        $mensaje =$request['mensaje'];

        return $this->from('incidencias@pagina.com')
                    ->view('Incidencias.mail')
                    ->with([
                            'name' => $name,
                            'mail' => $mail,
                            'mensaje' => $mensaje,
                      ])
                    ->subject('Mensaje Web');
    }
}
