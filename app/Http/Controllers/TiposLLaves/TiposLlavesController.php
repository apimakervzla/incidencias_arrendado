<?php

namespace App\Http\Controllers\TiposLLaves;

use App\TiposLlaves;
use App\Colores;
use App\User;
use App\TiposLlavesPerfiles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TiposLlavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $resultado= TiposLlaves::select('tbl_tipos_llaves.id','tbl_tipos_llaves.color_id','tbl_tipos_llaves.nombre_llave','tbl_tipos_llaves.tiempo_expira',
        'tbl_tipos_llaves.created_at','tbl_colores.nombre_color','tbl_colores.hexadecimal')
                  ->Join('tbl_colores','tbl_colores.id','tbl_tipos_llaves.color_id')
                  //->where('tbl_novedades.turno_id',$turno_id)
                  ->orderBy('tbl_colores.id','desc')
                  ->orderBy('tbl_tipos_llaves.nombre_llave','asc')
                  ->get();
        
        //dd($resultado);
        return view('TiposLlaves.index',
        [
            'tipos_llaves'=>$resultado            
        ]
        );        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $colores= Colores::all();     
        
        $usuarios= User::select('users.name','role_user.id')
                  ->join('role_user','role_user.user_id','users.id')
                  ->join('roles','roles.id','role_user.role_id')
                  //->whereIn('roles.id',array(2,3,4))
                  ->get();

        return view('TiposLlaves.create',
            [
                'colores'=>$colores,
                'usuarios'=>$usuarios     
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
        $Obj_TiposLlaves=new TiposLlaves($request->all());            
        $Obj_TiposLlaves->save();


        foreach($request["role_user_id_permisado"] as $index=>$valor)
        {
            $Obj_TiposLlavesPerfiles=new TiposLlavesPerfiles();
            $Obj_TiposLlavesPerfiles->role_user_id=Auth::id();
            $Obj_TiposLlavesPerfiles->tipo_llave_id=$Obj_TiposLlaves->id;
            $Obj_TiposLlavesPerfiles->role_user_id_permisado=$valor;
            $Obj_TiposLlavesPerfiles->status_tipo_llave_perfil=1;
            $Obj_TiposLlavesPerfiles->save();

            
        }
        flash("Se ha Registrado La Llave de forma Exitosa")->success();    
            return redirect()->route('index.tiposllaves'); 
        




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TiposLlaves  $tiposLlaves
     * @return \Illuminate\Http\Response
     */
    //public function show(TiposLlaves $tiposLlaves)
    public function show($id)
    {
        //dd('jajddddddedaj');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TiposLlaves  $tiposLlaves
     * @return \Illuminate\Http\Response
     */
    //public function edit(TiposLlaves $tiposLlaves)
    public function edit($id)
    {
        //dd('jajaj');
        $Obj_TiposLlaves=new TiposLlaves();
        //$resultado=$Obj_TiposLlaves->find($id); 
        
        $resultado= TiposLlaves::select('tbl_tipos_llaves.id','tbl_tipos_llaves.color_id','tbl_tipos_llaves.nombre_llave','tbl_tipos_llaves.tiempo_expira',
        'tbl_tipos_llaves.created_at','tbl_colores.nombre_color','tbl_colores.hexadecimal','users.name','role_user.user_id')
                  ->Join('tbl_colores','tbl_colores.id','tbl_tipos_llaves.color_id')
                  ->leftJoin('tbl_tipos_llaves_perfiles','tbl_tipos_llaves_perfiles.tipo_llave_id','tbl_tipos_llaves.id')
                  ->leftJoin('role_user','role_user.id','tbl_tipos_llaves_perfiles.role_user_id_permisado')
                  ->leftJoin('users','users.id','role_user.user_id')
                  ->where('tbl_tipos_llaves.id',$id)
                  ->orderBy('tbl_colores.id','desc')
                  ->get();


        
        $colores= Colores::all();   
        
        $usuarios= User::select('users.name','role_user.id')
                  ->join('role_user','role_user.user_id','users.id')
                  ->join('roles','roles.id','role_user.role_id')
                  //->whereIn('roles.id',array(2,3,4))
                  ->get();
        //dd($resultado);
        return view('TiposLlaves.edit',
        [
            'tiposllaves'=>$resultado,
            'colores' =>$colores,
            'usuarios'=>$usuarios
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TiposLlaves  $tiposLlaves
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, TiposLlaves $tiposLlaves)
    public function update(Request $request, $id)
    {
        //
        //dd($request);
        $Obj_TiposLlaves=new TiposLlaves();
        $resultado=$Obj_TiposLlaves->find($id);
        //dd($resultado);        
        $resultado->fill($request->all());//reemplaza los valores
        $resultado->save();


        //dd($request["role_user_id_permisado"]);
        //elimino los usuarios permisados
        $Obj_TiposLlavesPerfiles=new TiposLlavesPerfiles();        
        //$resultado=$Obj_TiposLlavesPerfiles->find($id);
        $Obj_TiposLlavesPerfiles->where("tipo_llave_id",$resultado->id)->delete();

        foreach($request["role_user_id_permisado"] as $index=>$valor)
        {
            $Obj_TiposLlavesPerfiles=new TiposLlavesPerfiles();
            $Obj_TiposLlavesPerfiles->role_user_id=Auth::id();
            $Obj_TiposLlavesPerfiles->tipo_llave_id=$resultado->id;
            $Obj_TiposLlavesPerfiles->role_user_id_permisado=$valor;
            $Obj_TiposLlavesPerfiles->status_tipo_llave_perfil=1;
            $Obj_TiposLlavesPerfiles->save();
        }
        flash("Se ha Actualizado La Llave de forma Exitosa")->success();    
        return redirect()->route('index.tiposllaves'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TiposLlaves  $tiposLlaves
     * @return \Illuminate\Http\Response
     */
    public function destroy(TiposLlaves $tiposLlaves)
    {
        //
    }
}
