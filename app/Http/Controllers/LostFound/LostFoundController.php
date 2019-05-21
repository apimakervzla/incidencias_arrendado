<?php

namespace App\Http\Controllers\LostFound;

use App\LostFound;
use App\Turnos;
use App\User;
use App\TiposActores;
use App\Actores;
use App\Audit;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class LostFoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Obj_Turnos=new Turnos();
        $turno=$Obj_Turnos->consultar_turno();

        $resultado=array();
        if( $turno->count() > 0)
        {
            //consulto los lostfound  
            $Obj_LostFounds=new LostFound()                ;
            $resultado= $Obj_LostFounds//->select('tbl_novedades.descripcion_novedad')
                    ->Join('role_user','role_user.id','tbl_lost_found.role_user_id_agente')                                      
                    ->Join('users','users.id','role_user.user_id')                                      
                    ->Join('tbl_turnos','tbl_turnos.id','tbl_lost_found.turno_id')                                      
                    ->Join('tbl_actores','tbl_actores.id','tbl_lost_found.actor_id')                                      
                    ->Join('tbl_tipos_actores','tbl_tipos_actores.id','tbl_actores.tipo_actor_id')                                      
                    ->where('tbl_lost_found.turno_id',$turno[0]->id)
                    ->get();
        }

        return view('LostFound.index',
        [
            'lostfound'=>$resultado,
            'turno'=>$turno
        ]
        );//->with('novedades',$resultado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agentes= User::select('users.name','role_user.id')
                  ->join('role_user','role_user.user_id','users.id')
                  ->join('roles','roles.id','role_user.role_id')
                  ->where('roles.name','agent')
                  ->get();

        //$tipos_incidencias= Tiposincidencias::all();
        $tipos_actores= TiposActores::all();
        
        return view('LostFound.create',
            [
                'agentes'=>$agentes,
                //'tipos_incidencias'=>$tipos_incidencias,
                'tipos_actores'=>$tipos_actores
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //echo $request["descripcion_lostfound"];exit;
        $Obj_Turnos=new Turnos();
        $turno=$Obj_Turnos->consultar_turno();
        if($turno->count() <= "0" )
        {            
            flash("El Supervisor No Posee Turno Activo. Ingrese Nuevamente al Sistema")->error();    
            return redirect()->route('index.lostfound');                
        }

        $auditoria=new Audit();

        $Obj_LostFounds=new LostFound($request->all());
        $Obj_LostFounds->role_user_id=Auth::id();
        $Obj_LostFounds->turno_id=$turno[0]->id;

        if($request["tipo_actor_id"]!="")
        {
            //Registro en la tbl acotres
            //Valido los datos    
            switch($request["tipo_actor_id"])
            {
                case "1"://huesped
                    //Valido que nombre apellido cedula y # hab sea obligatorio    
                    if($request["nombre_actor"]=="")$msj="El Nombre del Actor es Obligatorio";
                    if($request["apellido_actor"]=="")$msj="El Apellido del Actor es Obligatorio";
                    if($request["identificacion_actor"]=="")$msj="El Identificador del Actor es Obligatorio";                    
                    if($request["numero_habitacion"]=="")$msj="El N° Habitación del Actor es Obligatorio";                            
                    if($request["correo_electronico_actor"]=="")$msj="El Correo Electronico del Actor es Obligatorio";                            
                break;

                default:
                    //Valido que nom ape y ci sea obligatorio
                    if($request["nombre_actor"]=="")$msj="El Nombre del Actor es Obligatorio";
                    if($request["apellido_actor"]=="")$msj="El Apellido del Actor es Obligatorio";
                    if($request["identificacion_actor"]=="")$msj="El Identificador del Actor es Obligatorio";
                break;
            }

            //Como es si, creo el objeto de actores y registro el actor
            $Obj_Actores= new Actores();
            $Obj_Actores->tipo_actor_id=$request["tipo_actor_id"];
            $Obj_Actores->nombre_actor=$request["nombre_actor"];
            $Obj_Actores->apellido_actor=$request["apellido_actor"];
            $Obj_Actores->identificacion_actor=$request["identificacion_actor"];
            $Obj_Actores->numero_habitacion=$request["numero_habitacion"];
            $Obj_Actores->telefono_actor=$request["telefono_actor"];
            $Obj_Actores->correo_electronico_actor=$request["correo_electronico_actor"];
            $Obj_Actores->save();

            //Registro la auditoria de creacion de actor
            $auditoria->role_user_id = Auth::id();
            $auditoria->action = "Se creó el Actor:".$request["nombre_actor"]." ".$request["apellido_actor"].", por: ".Auth::user()->name;
            $auditoria->save();

            //Seteo el role_user_id_actor por el registrado en la tbl_actores
            $Obj_LostFounds->actor_id=$Obj_Actores->id;
        }

        //echo "jajaj";exit;
        //Obtengo el campo file definido en el formulario
        $file = $request->file('url_foto');
        if(count($file)>4)
        {
            $msj="Sólo se aceptan 4 Fotos Máx";
        }

        foreach ($file as $key => $value) 
        {            
            if(true)//($request->hasFile($key))//if($request->hasFile('url_imagen1'))
            {
                $nombreArchivo  =   "img_incidencias";
                $archivo_img    =   $aux_archivo_img[]=$nombreArchivo."_".time().'.'.$value->getClientOriginalExtension();
                $path           =   public_path().'/images/lostfound/';                
                $value->move($path, $archivo_img);                
            } 
        }

        $Obj_LostFounds->url_foto_1=$aux_archivo_img[0];
        $Obj_LostFounds->url_foto_2=$aux_archivo_img[1];
        $Obj_LostFounds->url_foto_3=$aux_archivo_img[2];
        $Obj_LostFounds->url_foto_4=$aux_archivo_img[3];
        $Obj_LostFounds->fecha_vencimiento_lost_found=Carbon::parse($request["fecha_vencimiento_lost_found"])->format('Y-m-d');
        $Obj_LostFounds->save();
        
        
        //Seteo el role_user_id para el registro de la auditoria de creacion de incidencia
        $auditoria->role_user_id = Auth::id();        
        $auditoria->action = "Se creó Un Lost&Found:".$Obj_LostFounds->descripcion_lostfound.", por: ".Auth::user()->name;                
        $auditoria->save();
       
        //Retorno Msj de Exito                
        flash("Se ha Registrado el Lost&Found de forma Exitosa")->success();    
        return redirect()->route('index.lostfound');   


        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LostFound  $lostFound
     * @return \Illuminate\Http\Response
     */
    public function show(LostFound $lostFound)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LostFound  $lostFound
     * @return \Illuminate\Http\Response
     */
    public function edit(LostFound $lostFound)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LostFound  $lostFound
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LostFound $lostFound)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LostFound  $lostFound
     * @return \Illuminate\Http\Response
     */
    public function destroy(LostFound $lostFound)
    {
        //
    }
}
