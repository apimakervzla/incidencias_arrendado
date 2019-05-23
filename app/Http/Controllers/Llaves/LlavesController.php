<?php

namespace App\Http\Controllers\Llaves;

use App\Llaves;
use App\Role;
use App\TiposLlaves;
use App\TiposLlavesPerfiles;
use App\Audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LlavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turno=$this->consultar_turno();
        $llaves=null;
        if ($turno!=null) {
            
            if( $turno->count() > 0 && $turno->status_turno!=0)
            {
                $llaves=DB::table('tbl_tipos_llaves AS tl')
                                    ->select(DB::raw(" tl.id
                                    ,nombre_llave
                                    ,hexadecimal
                                    ,tl.created_at
                                    ,(SELECT name FROM tbl_tipos_llaves_perfiles tlp
                                    JOIN tbl_llaves 
                                    ON tbl_llaves.tipo_llave_perfil_id=tlp.id
                                    JOIN role_user
                                    ON tlp.role_user_id_permisado=role_user.id
                                    JOIN users
                                    ON role_user.user_id=users.id WHERE tlp.tipo_llave_id=tl.id ORDER BY tbl_llaves.id DESC LIMIT 1) AS usuario_prestamo
                                    ,(SELECT status_llave FROM tbl_tipos_llaves_perfiles tlp
                                    JOIN tbl_llaves
                                    ON tlp.id=tbl_llaves.tipo_llave_perfil_id
                                    WHERE tlp.tipo_llave_id=tl.id ORDER BY tbl_llaves.id DESC LIMIT 1) AS status_llave
                                    ,(SELECT tbl_llaves.created_at FROM tbl_tipos_llaves_perfiles tlp
                                    JOIN tbl_llaves
                                    ON tbl_llaves.tipo_llave_perfil_id=tlp.id
                                     WHERE tipo_llave_id=tl.id ORDER BY tbl_llaves.id DESC LIMIT 1) AS fecha_prestamo
                                     ,(SELECT tipo_llave_perfil_id FROM tbl_tipos_llaves_perfiles tlp
                                     JOIN tbl_llaves
                                     ON tbl_llaves.tipo_llave_perfil_id=tlp.id
                                      WHERE tipo_llave_id=tl.id ORDER BY tbl_llaves.id DESC LIMIT 1) AS tipo_llave_perfil_id"))
                                    ->join('tbl_colores','tbl_colores.id','tl.color_id')          
                                    ->get();
            }
            }
        // $llaves= Llaves::select('tbl_llaves.id', 'tbl_llaves.created_at','tbl_tipos_llaves.nombre_llave','tbl_colores.hexadecimal')        
        // ->join('tbl_tipos_llaves','tbl_tipos_llaves.id','tbl_llaves.tipo_llave_id')
        // ->join('tbl_colores','tbl_colores.id','tbl_tipos_llaves.color_id')
        // ->get();

        // $tipos_incidencias= Tiposincidencias::all();
        // $tipos_actores= TiposActores::all();
        
        return view('Llaves.index',
        [
            'llaves'=>$llaves,
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
        
        
        $llaves= TiposLlaves::get();
        // dd($llaves);
        // $tipos_incidencias= Tiposincidencias::all();
        // $tipos_actores= TiposActores::all();

        return view('Llaves.create',
        [
            'llaves'=>$llaves
            // 'tipos_incidencias'=>$tipos_incidencias,
            // 'tipos_actores'=>$tipos_actores
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
        $turno=$this->consultar_turno();

        $tipo_llave_perfil_id=TiposLlavesPerfiles::select('id')
                                ->where('role_user_id_permisado',$request["role_user_id_permisado"])
                                ->where('tipo_llave_id',$request["tipo_llave_id"])
                                ->first();

        $Obj_Actores= new Llaves();
                $Obj_Actores->role_user_id=Auth::id();
                $Obj_Actores->tipo_llave_perfil_id=$tipo_llave_perfil_id->id;
                $Obj_Actores->turno_id=$turno->id;
                $Obj_Actores->status_llave=1;                
                $Obj_Actores->save();
        
        return redirect()->route("index.llaves");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Llaves  $llaves
     * @return \Illuminate\Http\Response
     */
    public function show(Llaves $llaves)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Llaves  $llaves
     * @return \Illuminate\Http\Response
     */
    public function edit(Llaves $llaves)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Llaves  $llaves
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Llaves $llaves)
    {
        //
    }

    public function combo(Request $request,$tipo_llave_id)
    {
        // dd("hola");
        $usuarios_permitidos=TiposLlavesPerfiles::join('tbl_tipos_llaves','tbl_tipos_llaves.id','tbl_tipos_llaves_perfiles.tipo_llave_id')
                            ->join('role_user','role_user.id','tbl_tipos_llaves_perfiles.role_user_id_permisado')
                            ->join('users','users.id','role_user.user_id')
                            ->where('tipo_llave_id', $tipo_llave_id)
                            ->orderBy('tbl_tipos_llaves.id')
                            ->pluck('name','role_user_id_permisado');  
                
        // dd($usuarios_permitidos);
        return $usuarios_permitidos;
    }

    public function status($tipo_llave_perfil_id)
    {        
        $turno=$this->consultar_turno();

        
        $ultima_llave=Llaves::where('tipo_llave_perfil_id',$tipo_llave_perfil_id)
                            ->where('status_llave',1)
                            ->orderBy('id','desc')
                            ->first();
        // dd($ultima_llave);

        $llavename=TiposLlaves::join('tbl_tipos_llaves_perfiles','tbl_tipos_llaves_perfiles.tipo_llave_id','tbl_tipos_llaves.id')
                            ->where('tbl_tipos_llaves_perfiles.id',$tipo_llave_perfil_id)->first();
        
        $llave = new Llaves();
        $llave->role_user_id = Auth::id();        
        $llave->tipo_llave_perfil_id = $tipo_llave_perfil_id;        
        $llave->status_llave = 0;        
        $llave->turno_id = $turno->id;        
        $llave->save();      

        $auditoria = new Audit();
        $auditoria->role_user_id = Auth::id();        
        $auditoria->action = "Se cambió el estatus de la llave:".$llavename->nombre_llave.", con el Estatus: Disponible";
        $auditoria->save();

        return redirect()->route("index.llaves");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Llaves  $llaves
     * @return \Illuminate\Http\Response
     */
    public function destroy(Llaves $llaves)
    {
        //
    }
}
