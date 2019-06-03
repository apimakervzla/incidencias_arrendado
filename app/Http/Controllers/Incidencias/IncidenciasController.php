<?php

namespace App\Http\Controllers\Incidencias;

use App\Incidencias;


use App\User;
use App\Audit;
use App\Actores;
use App\Turnos;
use App\Role;
use App\Tiposincidencias;
use App\TiposActores;
use App\TblPisosLugares;


use Illuminate\Http\Request;



use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IncidenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $turno=$this->consultar_turno();

        $resultado=null;
        if ($turno!=null) {
        //echo "jajjaa";exit;
        $resultado= Incidencias::select('tbl_incidencias.id','tbl_incidencias.role_user_id','tbl_incidencias.created_at',
                            'tbl_incidencias.tipo_incidencia_id','tbl_incidencias.role_user_id_actor',
                            'tbl_incidencias.actor_id','tbl_incidencias.url_imagen_1','tbl_incidencias.url_imagen_2',
                            'tbl_incidencias.url_imagen_3','tbl_incidencias.url_imagen_4','tbl_incidencias.url_imagen_5',
                            'tbl_incidencias.url_imagen_6','tbl_incidencias.detalle_incidencia','tbl_tipos_incidencias.descripcion_tipo_incidencia',
                            'users.name','roles.description','tbl_tipos_actores.descripcion_tipo_actor',
                            'tbl_actores.nombre_actor','tbl_actores.apellido_actor','tbl_actores.telefono_actor','tbl_actores.numero_habitacion',
                            'tbl_actores.identificacion_actor','tbl_pisos.nombre_piso','tbl_lugares.nombre_lugar')
                  ->Join('tbl_tipos_incidencias','tbl_tipos_incidencias.id','tbl_incidencias.tipo_incidencia_id')                                    

                  

                  ->leftJoin('role_user','role_user.id','tbl_incidencias.role_user_id_actor')                  
                  ->leftJoin('users','users.id','role_user.user_id')                  
                  ->leftJoin('roles','roles.id','role_user.role_id')                  
                  ->leftJoin('tbl_actores','tbl_actores.id','tbl_incidencias.actor_id')                  

                  ->leftJoin('tbl_pisos_lugares','tbl_pisos_lugares.id','tbl_actores.numero_habitacion')                  
                  ->leftJoin('tbl_pisos','tbl_pisos.id','tbl_pisos_lugares.piso_id')
                  ->leftJoin('tbl_lugares','tbl_lugares.id','tbl_pisos_lugares.lugar_id')

                  ->leftJoin('tbl_tipos_actores','tbl_tipos_actores.id','tbl_actores.tipo_actor_id')                  
                  
                  //->where('tbl_novedades.turno_id',$turno_id)
                  ->get();
        }
        //dd($resultado);
        return view('Incidencias.index',
        [
            'incidencias'=>$resultado,
            'turno'=>$turno
            // 'tipos_actores'=>$tipos_actores
        ]
        );        
    }

    public function consultar_turno()
    {
        //Consulto el Role User del usurio logeado
        //$role_user=Auth::user()->whatRoleUser(Auth::user()->id);
        //dd($role_user);

        $turno=Role::select('tbl_turnos.id','tbl_turnos.role_user_id','tipo_turno_id','status_turno','descripcion_turno')
            ->join('role_user','role_user.role_id','roles.id')                        
            ->join('tbl_turnos','tbl_turnos.role_user_id','role_user.id')                                            
            ->join('tbl_tipos_turnos','tbl_tipos_turnos.id','tbl_turnos.tipo_turno_id')                                                        
            ->orderBy('tbl_turnos.created_at','desc')                                           
            ->orderBy('tbl_turnos.tipo_turno_id','desc')                                           
            ->first();
        // dd($turno);

        
        return $turno;
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

        $tipos_incidencias= Tiposincidencias::all();
        $tipos_actores= TiposActores::all();

        $pisoslugares=TblPisosLugares::select('tbl_pisos_lugares.id','tbl_pisos_lugares.piso_id','tbl_pisos_lugares.lugar_id',
            'tbl_pisos.nombre_piso','tbl_lugares.nombre_lugar'
        )
            ->join('tbl_pisos','tbl_pisos.id','tbl_pisos_lugares.piso_id')
            ->join('tbl_lugares','tbl_lugares.id','tbl_pisos_lugares.lugar_id')
            ->orderBy('orden_piso','asc')
            ->orderBy('nombre_lugar','asc')
            ->get();

        return view('Incidencias.create',
            [
                'agentes'=>$agentes,
                'tipos_incidencias'=>$tipos_incidencias,
                'tipos_actores'=>$tipos_actores,
                "pisoslugares"=>$pisoslugares
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
        //Consulto el turno_id
        // $turno=$this->consultar_turno();            
        // if($turno->count() <= "0" )
        // {            
        //     flash("El Supervisor No Posee Turno Activo. Ingrese Nuevamente al Sistema")->error();    
        //     return redirect()->route('index.novedades');                
        // }
        
        //Creo el Obj auditoria para registrar las auditorias de los insert
        $auditoria = new Audit();     
        
        
        if (true)//($request["incidencia_id"]==true) 
        {            
            //Como genera incidencia, creo el objeto de incidencia
            $Obj_Incidencias=new Incidencias($request->all());    

            //Valido si existe actor en la incidencia   
            $msj="";
            if($request["tipo_actor_id"]=!"")
            {         
                //Valido los datos    
                switch($request["tipo_actor_id"])
                {
                    case "1"://huesped
                        //Valido que nombre apellido cedula y # hab sea obligatorio                        
                        if($request["numero_habitacion"]=="")$msj="El N° Habitación del Actor es Obligatorio";                            
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
                $Obj_Actores->save();

                //Registro la auditoria de creacion de actor
                $auditoria->role_user_id = Auth::id();
                $auditoria->action = "Se creó el Actor:".$request["nombre_actor"]." ".$request["apellido_actor"].", por: ".Auth::user()->name;
                $auditoria->save();

                //Seteo el role_user_id_actor por el registrado en la tbl_actores
                $Obj_Incidencias->actor_id=$Obj_Actores->id;
            }
            
            
            //Obtengo el campo file definido en el formulario
            $file = $request->file('url_imagen');
            if(count($file)>6)
            {
                $msj="Sólo se aceptan 6 Fotos Máx";
            }
            $time=time();
            foreach ($file as $key => $value) 
            {            
                if(true)//($request->hasFile($key))//if($request->hasFile('url_imagen1'))
                {
                    $time++;
                    $nombreArchivo  =   "img_incidencias";
                    $archivo_img    =   $aux_archivo_img[]=$nombreArchivo."_".$time.'.'.$value->getClientOriginalExtension();
                    $path           =   public_path().'/images/incidencias/';                
                    $value->move($path, $archivo_img);                
                } 
            }
            
            //Seteo el role_user_id y las url_imag para registro de la Incidencia                        
            $Obj_Incidencias->role_user_id=Auth::id();     
            $Obj_Incidencias->role_user_id_actor=($request["role_user_id_actor"])?$request["role_user_id_actor"]:"";                 
            $Obj_Incidencias->url_imagen_1=(isset($aux_archivo_img[0]) && $aux_archivo_img[0]!="")?$aux_archivo_img[0]:"";
            $Obj_Incidencias->url_imagen_2=(isset($aux_archivo_img[1]) && $aux_archivo_img[1]!="")?$aux_archivo_img[1]:"";
            $Obj_Incidencias->url_imagen_3=(isset($aux_archivo_img[2]) && $aux_archivo_img[2]!="")?$aux_archivo_img[2]:"";
            $Obj_Incidencias->url_imagen_4=(isset($aux_archivo_img[3]) && $aux_archivo_img[3]!="")?$aux_archivo_img[3]:"";
            $Obj_Incidencias->url_imagen_5=(isset($aux_archivo_img[4]) && $aux_archivo_img[4]!="")?$aux_archivo_img[4]:"";
            $Obj_Incidencias->url_imagen_6=(isset($aux_archivo_img[5]) && $aux_archivo_img[5]!="")?$aux_archivo_img[5]:"";
            $Obj_Incidencias->save();

               
            
            //Seteo el role_user_id para el registro de la auditoria de creacion de incidencia
            $auditoria->role_user_id = Auth::id();
            $auditoria->action = "Se creó la Incidencia:".substr($request["detalle_incidencia"],0,10)."...., por: ".Auth::user()->name;
            $auditoria->save();
        }    
        
        
       
        //Retorno Msj de Exito                
        flash("Se ha Registrado La Incidencia de forma Exitosa")->success();    
        return redirect()->route('index.incidencias'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TblIncidencias  $tblIncidencias
     * @return \Illuminate\Http\Response
     */
    public function show(TblIncidencias $tblIncidencias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TblIncidencias  $tblIncidencias
     * @return \Illuminate\Http\Response
     */
    public function edit(TblIncidencias $tblIncidencias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TblIncidencias  $tblIncidencias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TblIncidencias $tblIncidencias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TblIncidencias  $tblIncidencias
     * @return \Illuminate\Http\Response
     */
    public function destroy(TblIncidencias $tblIncidencias)
    {
        //
    }
}
