<?php

namespace App\Http\Controllers\Turnos;

use App\Turnos;
use App\Novedades;
use App\Role;
use App\Audit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
//use App\Mail\Novedades;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TurnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    { 
        $Obj_Novedades=new Novedades();
        $turno=$Obj_Novedades->consultar_turno();        
        $novedades=array();
        $novedades= $Obj_Novedades->select('tbl_novedades.id as novedad_id','descripcion_novedad','tbl_novedades.created_at','roles.description','users.name','incluir_incidencia','descripcion_turno')
                        ->Join('tbl_turnos','tbl_turnos.id','tbl_novedades.turno_id')                  
                        ->Join('tbl_tipos_turnos','tbl_tipos_turnos.id','tbl_turnos.tipo_turno_id')                  
                        ->Join('role_user','role_user.id','tbl_novedades.role_user_id')                  
                        ->Join('roles','roles.id','role_user.role_id')                  
                        ->Join('users','users.id','role_user.user_id')        
                        ->where('tbl_novedades.turno_id',$turno->id)
                        ->orderBy('tbl_novedades.created_at','desc')
                        ->get();  

        if(Auth::id()){
            $turno_actual=Role::select('tbl_turnos.role_user_id','tipo_turno_id','status_turno')
            ->join('role_user','role_user.role_id','roles.id')                        
            ->join('tbl_turnos','tbl_turnos.role_user_id','role_user.id')                                            
            ->orderBy('tbl_turnos.created_at','desc')                                           
            ->orderBy('tbl_turnos.tipo_turno_id','desc')                                           
            ->first(); 

            $fecha_actual=Carbon::now();
            $hora_actual=$fecha_actual->format('H:i:s');

            $tipo_turno_id=DB::table('tbl_tipos_turnos')
                            ->select(DB::raw(" ( SELECT id
                            from tbl_tipos_turnos
                            where 
                            CAST('$hora_actual' AS time) BETWEEN tiempo_desde AND tiempo_hasta
                            OR (NOT CAST('$hora_actual' AS time) BETWEEN tiempo_hasta AND tiempo_desde AND tiempo_desde > tiempo_hasta)) as tipo_turno_id"))                        
                            ->first();
            
            if($turno_actual){
                    if($turno_actual->status_turno!=1)
                {
                    Auth::logout();
                    return redirect('/login');
                }
                else{

                    if ($turno_actual->role_user_id!=Auth::id()) {

                        Auth::logout();
                        return redirect('/login');
                    }
                    else{
                        if($turno_actual->tipo_turno_id!=$tipo_turno_id->tipo_turno_id){
                            $turno= new Turnos();
                            $turno->role_user_id=Auth::id();
                            $turno->tipo_turno_id=$tipo_turno_id->tipo_turno_id;
                            $turno->status_turno=0;            
                            $turno->save();                           

                            $destinatarios = "rubentorres26@gmail.com";
                            $destinatarios = "edgarsilvalovera@gmail.com";

                            $datos["tipo_turno_id"]=$tipo_turno_id->tipo_turno_id;
                            $datos["user_id"]=Auth::id();

                            
                            // foreach ($destinatarios as $key => $destinatario) 
                            // {
                            //     switch ($destinatario->modulo_destinatario) {
                            //         case 'novedades':
                            //         Mail::to($destinatario->mail)->send(new Novedades($datos));
                            //             break;
                            //         case 'incidencias':
                            //         Mail::to($destinatario->email)->send(new Incidencias($datos));
                            //             break;
                            //         case 'llaves':
                            //         Mail::to($destinatario->email)->send(new Llaves($datos));
                            //             break;
                            //         case 'lostfound':
                            //         Mail::to($destinatario->email)->send(new LostFound($datos));
                            //             break;
                                    
                            //         default:
                            //             # code...
                            //             break;
                            //     }
                            // }


                                  
                            Mail::send(
                                'Mail.novedades',
                                ["novedades"=>$novedades],
                                function($message)
                                {
                                    $message->from('mercadointerno2019@gmail.com','Sistema de Incidencias');
                                    $message->to('edgarsilvalovera@gmail.com')->subject("Novedades");
                                    //$message->to('yadilo64@hotmail.com')->subject("Novedades");
                                }
                            );
                        }
                        else{
                            $turno= new Turnos();
                            $turno->role_user_id=Auth::id();
                            $turno->tipo_turno_id=$tipo_turno_id->tipo_turno_id;
                            $turno->status_turno=0;            
                            $turno->save();

                            $destinatarios = "rubentorres26@gmail.com";

                            $datos["tipo_turno_id"]=$tipo_turno_id->tipo_turno_id;
                            $datos["user_id"]=Auth::id();

                            
                            // foreach ($destinatarios as $key => $destinatario) {
                            //     switch ($destinatario->modulo_destinatario) {
                            //         case 'novedades':
                            //         Mail::to($destinatario->mail)->send(new Novedades($datos));
                            //             break;
                            //         case 'incidencias':
                            //         Mail::to($destinatario->email)->send(new Incidencias($datos));
                            //             break;
                            //         case 'llaves':
                            //         Mail::to($destinatario->email)->send(new Llaves($datos));
                            //             break;
                            //         case 'lostfound':
                            //         Mail::to($destinatario->email)->send(new LostFound($datos));
                            //             break;
                                    
                            //         default:
                            //             # code...
                            //             break;
                            //     }
                            // }
                            Mail::send(
                                'Mail.novedades',
                                ["novedades"=>$novedades],
                                function($message)
                                {
                                    $message->from('mercadointerno2019@gmail.com','Sistema de Incidencias');
                                    $message->to('edgarsilvalovera@gmail.com')->subject("Novedades");
                                    //$message->to('yadilo64@hotmail.com')->subject("Novedades");
                                }
                            );
                        }
                    }
                          
                       
                    }
                   
               
                
                }
                else{
                    $turno= new Turnos();
                    $turno->role_user_id=Auth::id();
                    $turno->tipo_turno_id=$tipo_turno_id->tipo_turno_id;
                    $turno->status_turno=0;            
                    $turno->save();

                    $destinatarios = "rubentorres26@gmail.com";

                    $datos["tipo_turno_id"]=$tipo_turno_id->tipo_turno_id;
                    $datos["user_id"]=Auth::id();

                    
                    // foreach ($destinatarios as $key => $destinatario) {
                    //     switch ($destinatario->modulo_destinatario) {
                    //         case 'novedades':
                    //         Mail::to($destinatario->mail)->send(new Novedades($datos));
                    //             break;
                    //         case 'incidencias':
                    //         Mail::to($destinatario->email)->send(new Incidencias($datos));
                    //             break;
                    //         case 'llaves':
                    //         Mail::to($destinatario->email)->send(new Llaves($datos));
                    //             break;
                    //         case 'lostfound':
                    //         Mail::to($destinatario->email)->send(new LostFound($datos));
                    //             break;
                            
                    //         default:
                    //             # code...
                    //             break;
                    //     }
                    // }
                    Mail::send(
                        'Mail.novedades',
                        ["novedades"=>$novedades],
                        function($message)
                        {
                            $message->from('mercadointerno2019@gmail.com','Sistema de Incidencias');
                            $message->to('edgarsilvalovera@gmail.com')->subject("Novedades");
                            //$message->to('yadilo64@hotmail.com')->subject("Novedades");
                        }
                    );

                }

            
            }
        else{
            Auth::logout();
            return redirect('/login');
            // return view('Auth.login');  
        }

        Auth::logout();
            return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Turnos  $turnos
     * @return \Illuminate\Http\Response
     */
    public function show(Turnos $turnos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Turnos  $turnos
     * @return \Illuminate\Http\Response
     */
    public function edit(Turnos $turnos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Turnos  $turnos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turnos $turnos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Turnos  $turnos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turnos $turnos)
    {
        //
    }
}
