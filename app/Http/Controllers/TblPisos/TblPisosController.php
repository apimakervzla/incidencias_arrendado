<?php

namespace App\Http\Controllers\TblPisos;

use App\TblPisos;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TblPisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $resultado= TblPisos::orderBy('orden_piso','desc')->get();        
        //$resultado= TblPisos::all();        
        return view('TblPisos.index',
        [
            'pisos'=>$resultado            
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
        //$resultado= TblPisos::all();

        return view('TblPisos.create',
            [
                //'pisos'=>$resultado                
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
        //busco si el piso ya esta creado
        $resultado= TblPisos::where(
            [
                ['nombre_piso',$request->nombre_piso],
                ['orden_piso',$request->orden_piso]
            ]
        )->orderBy('orden_piso','ASC')->get();   
        if($resultado->count()>0)
        {
            flash("El Nombre del Piso ".$request->nombre_piso." ya Se Encuentra Creado")->warning();    
            return redirect()->route('create.tblpisos'); 
        }        
        
        $Obj_TblPisos=new TblPisos($request->all());  
        $Obj_TblPisos->save();
        //echo "vamos bien ";exit;
        flash("Se ha Registrado el Lugar de forma Exitosa")->success();    
        return redirect()->route('index.tblpisos'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TblPisos  $TblPisos
     * @return \Illuminate\Http\Response
     */
    public function show(TblPisos $TblPisos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TblPisos  $TblPisos
     * @return \Illuminate\Http\Response
     */
    //public function edit(TblPisos $TblPisos)
    public function edit($id)
    {
        //dd('jajaj');        
        $Obj_TblPisos=new TblPisos();
        $resultado=$Obj_TblPisos->find($id);         
        return view('TblPisos.edit',
        [            
            'pisos'=>$resultado
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TblPisos  $TblPisos
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, TblPisos $TblPisos)
    public function update(Request $request, $id)
    {        
        //busco si el piso ya esta creado
        $resultado= TblPisos::where(
            [
                ['nombre_piso',$request->nombre_piso],
                //['orden_piso',$request->orden_piso],
                ['id','<>',$request->id]
            ]
        )->orderBy('orden_piso','desc')->get();   
        //dd($resultado);
        if($resultado->count()>0)
        {
            $Obj_TblPisos=new TblPisos();
            $resultado=$Obj_TblPisos->find($id);
            flash("El Nombre del Piso ".$request->nombre_piso." ya Se Encuentra Creado")->warning();    
            //return redirect()->route('create.tblpisos'); 
            return view('TblPisos.edit',
            [            
                'pisos'=>$resultado
            ]
            );
        }  

        $Obj_TblPisos=new TblPisos();
        $resultado=$Obj_TblPisos->find($id);        
        $resultado->fill($request->all());//reemplaza los valores
        $resultado->save();
        flash("Se ha Actualizado el Lugar de forma Exitosa")->success();    
        return redirect()->route('index.tblpisos'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TblPisos  $TblPisos
     * @return \Illuminate\Http\Response
     */
    public function destroy(TblPisos $TblPisos)
    {
        //
    }
}
