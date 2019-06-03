<?php

namespace App\Http\Controllers\TblPisosLugaresTiposLlaves;

use App\TblPisosLugaresTiposLlaves;
use App\TblPisos;
use App\TblPisosLugares;
use App\TiposLlaves;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\TblLugares;

class TblPisosLugaresTiposLlavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $resultado= TblPisosLugaresTiposLlaves::select('tbl_pisos_lugares_tipos_llaves.id',
        'tbl_pisos_lugares_tipos_llaves.piso_lugar_id',
        'tbl_pisos_lugares_tipos_llaves.tipo_llave_id',
        'tbl_pisos_lugares.piso_id',
        'tbl_pisos_lugares.lugar_id',
        'tbl_pisos.nombre_piso',
        'tbl_pisos.orden_piso',
        'tbl_lugares.nombre_lugar',
        'tbl_tipos_llaves.nombre_llave',
        'tbl_colores.hexadecimal'
        )        
        ->Join('tbl_tipos_llaves','tbl_tipos_llaves.id','tbl_pisos_lugares_tipos_llaves.tipo_llave_id')
        ->Join('tbl_colores','tbl_colores.id','tbl_tipos_llaves.color_id')
        ->Join('tbl_pisos_lugares','tbl_pisos_lugares.id','tbl_pisos_lugares_tipos_llaves.piso_lugar_id')
        ->Join('tbl_pisos','tbl_pisos.id','tbl_pisos_lugares.piso_id')
        ->Join('tbl_lugares','tbl_lugares.id','tbl_pisos_lugares.lugar_id')
        ->orderBy('tbl_pisos.orden_piso','asc')
        ->orderBy('tbl_lugares.nombre_lugar','asc')
        ->get();
        //$resultado= TblPisosLugaresTiposLlaves::all();        
        return view('TblPisosLugaresTiposLlaves.index',
        [
            'pisos_lugares_tipos_llaves'=>$resultado            
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
        $pisos_lugares= TblPisosLugares::select('tbl_pisos_lugares.id','tbl_pisos_lugares.piso_id','tbl_pisos_lugares.lugar_id',
        'tbl_pisos.nombre_piso','tbl_pisos.orden_piso','tbl_lugares.nombre_lugar')        
        ->Join('tbl_pisos','tbl_pisos.id','tbl_pisos_lugares.piso_id')
        ->Join('tbl_lugares','tbl_lugares.id','tbl_pisos_lugares.lugar_id')
        ->orderBy('tbl_pisos.orden_piso','asc')
        ->orderBy('tbl_lugares.nombre_lugar','asc')
        ->get();
        //dd($pisos_lugares);
        $tipos_llaves= TiposLlaves::whereNotIn(
            'tbl_tipos_llaves.id',
            function($query)
            {
                $query->select('tbl_pisos_lugares_tipos_llaves.tipo_llave_id')
                ->from('tbl_pisos_lugares_tipos_llaves')
                ->get();
            }
        )
        //->all()->sortBy('nombre_llave');//asc sortByDesc->desc
        ->orderBy("nombre_llave","asc")
        ->get();
        //dd($tipos_llaves);

        return view('TblPisosLugaresTiposLlaves.create',
            [
                'tipos_llaves'=>$tipos_llaves    ,                            
                'pisos_lugares'=>$pisos_lugares
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
        //echo "jajaj";exit;
        //dd($request["lugar_id"]);
        $Obj_TblPisosLugaresTiposLlaves=new TblPisosLugaresTiposLlaves();
        $Obj_TblPisosLugaresTiposLlaves->piso_lugar_id=$request["piso_lugar_id"];
        $Obj_TblPisosLugaresTiposLlaves->tipo_llave_id=$request->tipo_llave_id;
        $Obj_TblPisosLugaresTiposLlaves->save();

        flash("Se ha Registrado el Piso-Lugar-Llave de forma Exitosa")->success();    
        return redirect()->route('index.tblpisoslugarestiposllaves'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TblPisosLugaresTiposLlaves  $TblPisosLugaresTiposLlaves
     * @return \Illuminate\Http\Response
     */
    public function show(TblPisosLugaresTiposLlaves $TblPisosLugaresTiposLlaves)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TblPisosLugaresTiposLlaves  $TblPisosLugaresTiposLlaves
     * @return \Illuminate\Http\Response
     */
    //public function edit(TblPisosLugaresTiposLlaves $TblPisosLugaresTiposLlaves)
    public function edit($id,$tipo_llave_id)
    {   
        $pisos_lugares= TblPisosLugares::select('tbl_pisos_lugares.id','tbl_pisos_lugares.piso_id','tbl_pisos_lugares.lugar_id',
        'tbl_pisos.nombre_piso','tbl_pisos.orden_piso','tbl_lugares.nombre_lugar')        
        ->Join('tbl_pisos','tbl_pisos.id','tbl_pisos_lugares.piso_id')
        ->Join('tbl_lugares','tbl_lugares.id','tbl_pisos_lugares.lugar_id')
        ->orderBy('tbl_pisos.orden_piso','asc')
        ->orderBy('tbl_lugares.nombre_lugar','asc')
        ->get();
        //dd($pisos_lugares);

        //busco los tipos llave q no esten asociados + el tipo llave que se esta actualizando
        $tipos_llaves= TiposLlaves::whereNotIn(
            'tbl_tipos_llaves.id',
            function($query)
            {
                $query->select('tbl_pisos_lugares_tipos_llaves.tipo_llave_id')
                ->from('tbl_pisos_lugares_tipos_llaves')
                ->get();
            }
        )
        ->orWhere('tbl_tipos_llaves.id',$tipo_llave_id)
        ->orderBy("nombre_llave","asc")
        ->get();
        //dd($tipos_llaves);

        $pisos_lugares_tipos_llaves= TblPisosLugaresTiposLlaves::select('tbl_pisos_lugares_tipos_llaves.id',
        'tbl_pisos_lugares_tipos_llaves.piso_lugar_id',
        'tbl_pisos_lugares_tipos_llaves.tipo_llave_id',
        'tbl_pisos_lugares.piso_id',
        'tbl_pisos_lugares.lugar_id',
        'tbl_pisos.nombre_piso',
        'tbl_pisos.orden_piso',
        'tbl_lugares.nombre_lugar',
        'tbl_tipos_llaves.nombre_llave',
        'tbl_colores.hexadecimal'
        )        
        ->Join('tbl_tipos_llaves','tbl_tipos_llaves.id','tbl_pisos_lugares_tipos_llaves.tipo_llave_id')
        ->Join('tbl_colores','tbl_colores.id','tbl_tipos_llaves.color_id')
        ->Join('tbl_pisos_lugares','tbl_pisos_lugares.id','tbl_pisos_lugares_tipos_llaves.piso_lugar_id')
        ->Join('tbl_pisos','tbl_pisos.id','tbl_pisos_lugares.piso_id')
        ->Join('tbl_lugares','tbl_lugares.id','tbl_pisos_lugares.lugar_id')
        ->where('tbl_pisos_lugares_tipos_llaves.id',$id)
        ->orderBy('tbl_pisos.orden_piso','asc')
        ->orderBy('tbl_lugares.nombre_lugar','asc')
        ->get();
        //dd($pisos_lugares_tipos_llaves);

        return view('TblPisosLugaresTiposLlaves.edit',
            [
                'tipos_llaves'=>$tipos_llaves    ,                            
                'pisos_lugares'=>$pisos_lugares,
                'pisos_lugares_tipos_llaves'=>$pisos_lugares_tipos_llaves
            ]
        ); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TblPisosLugaresTiposLlaves  $TblPisosLugaresTiposLlaves
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, TblPisosLugaresTiposLlaves $TblPisosLugaresTiposLlaves)
    public function update(Request $request, $id)
    {        
        $resultado=TblPisosLugaresTiposLlaves::where("piso_lugar_id",$request->piso_lugar_id)
        ->where('tipo_llave_id',$request->tipo_llave_id)
        ->where('tbl_pisos_lugares_tipos_llaves.id','<>',$id);
        if($resultado->count()>0)
        {
            flash("El Piso Lugar ya se Encuentra Asociado a una Llave")->success();    
            return redirect()->route('index.tblpisoslugarestiposllaves'); 
        }
        
        
        $Obj_TblPisosLugaresTiposLlaves=new TblPisosLugaresTiposLlaves();
        $resultado=$Obj_TblPisosLugaresTiposLlaves->find($id);        
        //$resultado->fill($request->all());//reemplaza los valores
        $resultado->piso_lugar_id=$request["piso_lugar_id"];
        $resultado->tipo_llave_id=$request->tipo_llave_id;
        $resultado->save();
      



        flash("Se ha Actualizado el Piso Lugar Llave de forma Exitosa")->success();    
        return redirect()->route('index.tblpisoslugarestiposllaves'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TblPisosLugaresTiposLlaves  $TblPisosLugaresTiposLlaves
     * @return \Illuminate\Http\Response
     */
    public function destroy(TblPisosLugaresTiposLlaves $TblPisosLugaresTiposLlaves)
    {
        //
    }
}
