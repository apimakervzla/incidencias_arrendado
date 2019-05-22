<?php

namespace App\Http\Controllers\Novedades;

use App\Novedades;
use App\User;
use App\Audit;
use App\Incidencias;
use App\Actores;
use App\Turnos;
use App\Tiposincidencias;
use App\TiposActores;
use App\AgentesTurnos;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NovedadesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class NovedadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd("hola");
        // $Obj_Novedades=new Novedades();
        // $resultado=$Obj_Novedades->orderBy("id","DESC")->paginate(5);
        // dd($resultado);

        //Consulto el turno_id
        $turno=$this->consultar_turno();

        $resultado=array();
        if( $turno->count() > 0)
        {
            //consulto las novedades  
            $Obj_Novedades=new Novedades();
            $resultado= $Obj_Novedades//->select('tbl_novedades.descripcion_novedad')
                    ->Join('tbl_turnos','tbl_turnos.id','tbl_novedades.turno_id')                  
                    ->Join('tbl_tipos_turnos','tbl_tipos_turnos.id','tbl_turnos.tipo_turno_id')                  
                    ->Join('role_user','role_user.id','tbl_novedades.role_user_id')                  
                    ->Join('roles','roles.id','role_user.role_id')                  
                    ->Join('users','users.id','role_user.user_id')                  
                    ->where('tbl_novedades.turno_id',$turno[0]->id)
                    ->get();
        }

        //dd($resultado);
        //flash('BIENVENIDOS AL SISTEMA');
        return view('ControlNovedades.index',
        [
            'novedades'=>$resultado,
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

        $turno=$this->consultar_turno();                  

        $agentes_turnos= AgentesTurnos::select('users.name','role_user.id')
        ->join('role_user','role_user.id','tbl_agentes_turnos.role_user_id_agente')
        ->join('users','users.id','role_user.user_id')
        ->join('roles','roles.id','role_user.role_id')
        ->where('tbl_agentes_turnos.turno_id',$turno[0]->id)
        ->get();                  

        $tipos_incidencias= Tiposincidencias::all();
        $tipos_actores= TiposActores::all();
        
        return view('ControlNovedades.create',
            [
                'agentes'=>$agentes,
                'agentes_turnos'=>$agentes_turnos,
                'tipos_incidencias'=>$tipos_incidencias,
                'tipos_actores'=>$tipos_actores,
                'turno'=>$turno
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
    //public function store(NovedadesRequest $request)
    {  
        //$this->validateNovedades($request);
        //dd($request->telefono_actor);
        //Consulto el turno_id
        $turno=$this->consultar_turno();            
        if($turno->count() <= "0" )
        {            
            flash("El Supervisor No Posee Turno Activo. Ingrese Nuevamente al Sistema")->error();    
            return redirect()->route('index.novedades');                
        }
        
        //Creo el Obj auditoria para registrar las auditorias de los insert
        $auditoria = new Audit();     
        
        //Creo el objeto novedades
        $Obj_Novedades=new Novedades($request->all()); 
        
        //Valido si la notificación genera incidencia        
        if ($request["incidencia_id"]==true) 
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

            foreach ($file as $key => $value) 
            {            
                if(true)//($request->hasFile($key))//if($request->hasFile('url_imagen1'))
                {
                    $nombreArchivo  =   "img_incidencias";
                    $archivo_img    =   $aux_archivo_img[]=$nombreArchivo."_".time().'.'.$value->getClientOriginalExtension();
                    $path           =   public_path().'/images/incidencias/';                
                    $value->move($path, $archivo_img);                
                } 
            }
            
            //Seteo el role_user_id y las url_imag para registro de la Incidencia                        
            $Obj_Incidencias->role_user_id=Auth::id();     
            $Obj_Incidencias->role_user_id_actor=($request["role_user_id_actor"])?$request["role_user_id_actor"]:"";                 
            $Obj_Incidencias->url_imagen_1=(isset($aux_archivo_img[0]) && $aux_archivo_img[0]!="")?$aux_archivo_img[0]:"";
            $Obj_Incidencias->url_imagen_2=(isset($aux_archivo_img[1]) && $aux_archivo_img[1]!="")?$aux_archivo_img[0]:"";
            $Obj_Incidencias->url_imagen_3=(isset($aux_archivo_img[2]) && $aux_archivo_img[2]!="")?$aux_archivo_img[0]:"";
            $Obj_Incidencias->url_imagen_4=(isset($aux_archivo_img[3]) && $aux_archivo_img[3]!="")?$aux_archivo_img[0]:"";
            $Obj_Incidencias->url_imagen_5=(isset($aux_archivo_img[4]) && $aux_archivo_img[4]!="")?$aux_archivo_img[0]:"";
            $Obj_Incidencias->url_imagen_6=(isset($aux_archivo_img[5]) && $aux_archivo_img[5]!="")?$aux_archivo_img[0]:"";
            $Obj_Incidencias->save();

            //Seteo el campo incidencia_id de la tbl_novedades
            $Obj_Novedades->incidencia_id=$Obj_Incidencias->id;      
            
            //Seteo el role_user_id para el registro de la auditoria de creacion de incidencia
            $auditoria->role_user_id = Auth::id();
            $auditoria->action = "Se creó la Incidencia:".substr($request["detalle_incidencia"],0,10)."...., por: ".Auth::user()->name;
            $auditoria->save();
        }    
        
        //Seteo role_user_id para cargar la novedad
        $Obj_Novedades->role_user_id=Auth::id();      
        $Obj_Novedades->turno_id=$turno[0]->id;
        $Obj_Novedades->incluir_incidencia=($request["incidencia_id"])?"1":"0";        
        $Obj_Novedades->save();        

        //Seteo el role_user_id para el registro de la auditoria de creacion de incidencia
        $auditoria->role_user_id = Auth::id();        
        $auditoria->action = "Se creó La Novedad:".$request["descripcion_novedad"].", por: ".Auth::user()->name;        
        $auditoria->save();
       
        //Retorno Msj de Exito                
        flash("Se ha Registrado La Novedad de forma Exitosa")->success();    
        return redirect()->route('index.novedades');                
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Novedades  $novedades
     * @return \Illuminate\Http\Response
     */
    public function show(Novedades $novedades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Novedades  $novedades
     * @return \Illuminate\Http\Response
     */
    public function edit(Novedades $novedades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Novedades  $novedades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Novedades $novedades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Novedades  $novedades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Novedades $novedades)
    {
        //
    }

    public function consultar_turno()
    {
        //Consulto el Role User del usurio logeado
        //$role_user=Auth::user()->whatRoleUser(Auth::user()->id);
        //dd($role_user);

        $Obj_Turnos= new Turnos()   ;
        $turno= $Obj_Turnos->select('tbl_turnos.id','tbl_turnos.role_user_id','tbl_turnos.tipo_turno_id','tbl_tipos_turnos.descripcion_turno')                  
                ->Join('tbl_tipos_turnos','tbl_tipos_turnos.id','tbl_turnos.tipo_turno_id')                  
                ->Join('role_user','role_user.id','tbl_turnos.role_user_id')                  
                ->Join('roles','roles.id','role_user.role_id')                  
                ->Join('users','users.id','role_user.user_id')                  
                ->where(
                    [
                        ['tbl_turnos.role_user_id',Auth::user()->id],
                        ['tbl_turnos.status_turno',"1"]
                    ]
                )
                ->orderby('tbl_turnos.id','DESC')->take(1)
                ->get(); 
        //dd($turno);
        return $turno;
    }

    protected function validateNovedades(Request $request)
    {
        $request->validate([
            'descripcion_novedad' => 'required|string',
            'telefono_actor' => 'integer',
        ]);
    }

    
}
