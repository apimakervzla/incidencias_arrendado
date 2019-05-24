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
        $turno=$this->consultar_turno();

        $resultado=array();
        if( $turno->count() > 0)
        {
            //consulto las novedades  
            $Obj_Novedades=new Novedades();
            $resultado= $Obj_Novedades->select('tbl_novedades.id as novedad_id','descripcion_novedad','tbl_novedades.created_at','roles.description','users.name','incluir_incidencia','descripcion_turno')
                    ->Join('tbl_turnos','tbl_turnos.id','tbl_novedades.turno_id')                  
                    ->Join('tbl_tipos_turnos','tbl_tipos_turnos.id','tbl_turnos.tipo_turno_id')                  
                    ->Join('role_user','role_user.id','tbl_novedades.role_user_id')                  
                    ->Join('roles','roles.id','role_user.role_id')                  
                    ->Join('users','users.id','role_user.user_id')                  
                    ->where('tbl_novedades.turno_id',$turno->id)
                    ->orderBy('tbl_novedades.created_at','desc')
                    ->get();
        }
        
        $name    =$request['name']="hola";
        $mail    =$request['mail'];
        foreach ($resultado as $key => $result) {
            $novedades.="Novedad: ".$result->descripcion_novedad.". Fecha:".$result->created_at."<br>";
        }
        
        $mensaje =$novedades;

        return $this->from('novedades@pagina.com')
                    ->view('ControlNovedades.mail')
                    ->with([
                            'name' => $name,
                            'mail' => $mail,
                            'mensaje' => $mensaje,
                      ])
                    ->subject('Informe Novedades');
    }
}
