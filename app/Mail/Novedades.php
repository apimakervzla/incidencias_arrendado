<?php

namespace App\Mail;

use App\Novedades;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class NovedadesMail extends Mailable
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
        $novedades=Novedades::join()->where()->get();

        $name    =$request['name'];
        $mail    =$request['mail'];
        $mensaje =$request['mensaje'];

        return $this->from('novedades@pagina.com')
                    ->view('Novedades.mail')
                    ->with([
                            'name' => $name,
                            'mail' => $mail,
                            'mensaje' => $mensaje,
                      ])
                    ->subject('Mensaje Web');
    }
}
