<?php

namespace App\Http\Controllers\TblPisosLugares;

use App\TblPisosLugares;
use App\TblPisos;
use App\TblPisosLugaresTiposLlaves;
use App\TiposLlaves;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\TblLugares;

class TblPisosLugaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $resultado= TblPisosLugares::select('tbl_pisos_lugares.id','tbl_pisos_lugares.piso_id','tbl_pisos_lugares.lugar_id',
        'tbl_pisos.nombre_piso','tbl_pisos.orden_piso','tbl_lugares.nombre_lugar','tbl_tipos_llaves.nombre_llave','tbl_colores.hexadecimal')
        ->Join('tbl_pisos','tbl_pisos.id','tbl_pisos_lugares.piso_id')
        ->Join('tbl_lugares','tbl_lugares.id','tbl_pisos_lugares.lugar_id')
        ->leftJoin('tbl_pisos_lugares_tipos_llaves','tbl_pisos_lugares_tipos_llaves.piso_lugar_id','tbl_pisos_lugares.id')
        ->leftJoin('tbl_tipos_llaves','tbl_tipos_llaves.id','tbl_pisos_lugares_tipos_llaves.tipo_llave_id')
        ->leftJoin('tbl_colores','tbl_colores.id','tbl_tipos_llaves.color_id')
        ->orderBy('tbl_pisos.orden_piso','ASC')->get();        
        //$resultado= TblPisosLugares::all();      
        
        //dd($resultado);
        return view('TblPisosLugares.index',
        [
            'pisos_lugares'=>$resultado            
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
        $pisos= TblPisos::all()->sortBy("orden_piso");//asc sortByDesc->desc
        $lugares= TblLugares::all()->sortBy("nombre_lugar");

        return view('TblPisosLugares.create',
            [
                'lugares'=>$lugares    ,            
                'pisos'=>$pisos                
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
        //busco si el piso lugar ya esta creado
        foreach($request["lugar_id"] as $index=>$valor)
        {
            $resultado= TblPisosLugares::where(
                [
                    ['piso_id',$request->piso_id],                
                    ['lugar_id','<>',$valor]
                ]
            )->get();   
            //dd($resultado);
            if($resultado->count()>0)
            {
                $lugar= TblLugares::where('id',$valor)->get();                
                $piso= TblPisos::where('id',$request->piso_id)->get();                
                $pisos= TblPisos::all()->sortBy("orden_piso");//asc sortByDesc->desc
                $lugares= TblLugares::all()->sortBy("nombre_lugar");
        
                flash("El Piso <b>'".$piso[0]->nombre_piso."'</b> ya Posee Asociado el Lugar <b>'".$lugar[0]->nombre_lugar."'</b>")->warning();
                return view('TblPisosLugares.create',
                    [
                        'lugares'=>$lugares    ,            
                        'pisos'=>$pisos                
                    ]
                );
            } 
        }
         

        //echo "jajaj";exit;
        //dd($request["lugar_id"]);
        foreach($request["lugar_id"] as $index=>$valor)
        {
            $Obj_TblPisosLugares=new TblPisosLugares();
            $Obj_TblPisosLugares->piso_id=$request["piso_id"];
            $Obj_TblPisosLugares->lugar_id=$valor;
            $Obj_TblPisosLugares->save();
        }


        
        flash("Se ha Registrado el Piso-Lugar de forma Exitosa")->success();    
        return redirect()->route('index.tblpisoslugares'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TblPisosLugares  $TblPisosLugares
     * @return \Illuminate\Http\Response
     */
    public function show(TblPisosLugares $TblPisosLugares)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TblPisosLugares  $TblPisosLugares
     * @return \Illuminate\Http\Response
     */
    //public function edit(TblPisosLugares $TblPisosLugares)
    public function edit($id)
    {
        //dd('jajaj');        
        //$Obj_TblPisosLugares=new TblPisosLugares();
        //$resultado=$Obj_TblPisosLugares->find($id); 

        $resultado= TblPisosLugares::select('tbl_pisos_lugares.id','tbl_pisos_lugares.piso_id','tbl_pisos_lugares.lugar_id',
        'tbl_pisos.nombre_piso','tbl_pisos.orden_piso','tbl_lugares.nombre_lugar','tbl_tipos_llaves.nombre_llave','tbl_colores.hexadecimal',
        'tbl_pisos_lugares_tipos_llaves.tipo_llave_id')
        ->Join('tbl_pisos','tbl_pisos.id','tbl_pisos_lugares.piso_id')
        ->Join('tbl_lugares','tbl_lugares.id','tbl_pisos_lugares.lugar_id')
        ->leftJoin('tbl_pisos_lugares_tipos_llaves','tbl_pisos_lugares_tipos_llaves.piso_lugar_id','tbl_pisos_lugares.id')
        ->leftJoin('tbl_tipos_llaves','tbl_tipos_llaves.id','tbl_pisos_lugares_tipos_llaves.tipo_llave_id')
        ->leftJoin('tbl_colores','tbl_colores.id','tbl_tipos_llaves.color_id')
        ->where('tbl_pisos_lugares.id',$id)
        ->orderBy('tbl_pisos.orden_piso','desc')->get();      
        //dd($resultado);



        $pisos= TblPisos::all();
        $lugares= TblLugares::all();
        $tiposllaves= TiposLlaves::all();

        //dd($resultado);
        
        return view('TblPisosLugares.edit',
        [            
            'pisos_lugares'=>$resultado,
            'lugares'=>$lugares    ,            
            'pisos'=>$pisos    ,
            'tiposllaves'=>$tiposllaves
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TblPisosLugares  $TblPisosLugares
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, TblPisosLugares $TblPisosLugares)
    public function update(Request $request, $id)
    {        
        /*$Obj_TblPisosLugares=new TblPisosLugares();
        $resultado=$Obj_TblPisosLugares->find($id);        
        $resultado->fill($request->all());//reemplaza los valores
        $resultado->save();*/
        
        if($request["tiposllaves"]!="")
        {
            $obj=new TblPisosLugaresTiposLlaves();
            $obj->where("piso_lugar_id",$id)->delete();
        }


        $Obj_TblPisosLugares=new TblPisosLugares();                
        $Obj_TblPisosLugares->where("piso_id",$request["piso_id"])->delete();



        foreach($request["lugar_id"] as $index=>$valor)
        {
            $Obj_TblPisosLugares=new TblPisosLugares();
            $Obj_TblPisosLugares->piso_id=$request["piso_id"];
            $Obj_TblPisosLugares->lugar_id=$valor;
            $Obj_TblPisosLugares->save();
        }

        if($request["tiposllaves"]!="")
        {
            //$obj=new TblPisosLugaresTiposLlaves();
            //$obj->where("piso_lugar_id",$id)->delete();

            $obj=new TblPisosLugaresTiposLlaves();
            $obj->tipo_llave_id=$request["tiposllaves"];
            $obj->piso_lugar_id=$Obj_TblPisosLugares->id;
            $obj->save();
        }



        flash("Se ha Actualizado el Piso-Lugar-Llave de forma Exitosa")->success();    
        return redirect()->route('index.tblpisoslugares'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TblPisosLugares  $TblPisosLugares
     * @return \Illuminate\Http\Response
     */
    public function destroy(TblPisosLugares $TblPisosLugares)
    {
        //
    }
}
