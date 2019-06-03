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
        $incidencias=Incidencias::select('tbl_incidencias.id','tbl_incidencias.role_user_id','tbl_incidencias.created_at',
                                'tbl_incidencias.tipo_incidencia_id','tbl_incidencias.role_user_id_actor',
                                'tbl_incidencias.actor_id','tbl_incidencias.url_imagen_1','tbl_incidencias.url_imagen_2',
                                'tbl_incidencias.url_imagen_3','tbl_incidencias.url_imagen_4','tbl_incidencias.url_imagen_5',
                                'tbl_incidencias.url_imagen_6','tbl_incidencias.detalle_incidencia','tbl_tipos_incidencias.descripcion_tipo_incidencia',
                                'users.name','roles.description','tbl_tipos_actores.descripcion_tipo_actor',
                                'tbl_actores.nombre_actor','tbl_actores.apellido_actor','tbl_actores.telefono_actor','tbl_actores.numero_habitacion',
                                'tbl_actores.identificacion_actor')
                        ->Join('tbl_tipos_incidencias','tbl_tipos_incidencias.id','tbl_incidencias.tipo_incidencia_id')                                    
                        ->leftJoin('role_user','role_user.id','tbl_incidencias.role_user_id_actor')                  
                        ->leftJoin('users','users.id','role_user.user_id')                  
                        ->leftJoin('roles','roles.id','role_user.role_id')                  
                        ->leftJoin('tbl_actores','tbl_actores.id','tbl_incidencias.actor_id')                  
                        ->leftJoin('tbl_tipos_actores','tbl_tipos_actores.id','tbl_actores.tipo_actor_id')                  

                        //->where('tbl_novedades.turno_id',$turno_id)
                        ->get();
        foreach ($incidencias as $key => $incidencia) {
            $inci.="Incidencia: ".$incidencia->detalle_incidencia.". Fecha:".$incidencia->created_at.", ";
        }
        
        $mensaje =$inci;

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
