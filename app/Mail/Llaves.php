<?php

namespace App\Mail;

use App\Llaves;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class LlavesMail extends Mailable
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
        $novedades=Llaves::join()->where()->get();

        $name    =$request['name'];
        $mail    =$request['mail'];
        $mensaje =$request['mensaje'];

        return $this->from('llaves@pagina.com')
                    ->view('Llaves.mail')
                    ->with([
                            'name' => $name,
                            'mail' => $mail,
                            'mensaje' => $mensaje,
                      ])
                    ->subject('Mensaje Web');
    }
}
