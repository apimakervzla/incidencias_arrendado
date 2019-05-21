<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class Novedades extends Mailable
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
        $name    =$request['name'];
        $mail    =$request['mail'];
        $mensaje =$request['mensaje'];

        return $this->from('novedades@pagina.com')
                    ->view('Frontend.Mail.contacto')
                    ->with([
                            'name' => $name,
                            'mail' => $mail,
                            'mensaje' => $mensaje,
                      ])
                    ->subject('Mensaje Web');
    }
}
