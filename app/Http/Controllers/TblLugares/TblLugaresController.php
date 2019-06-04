<?php

namespace App\Http\Controllers\TblLugares;

use App\TblLugares;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TblLugaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $resultado= TblLugares::orderBy('nombre_lugar','ASC')->get();        
        //$resultado= TblLugares::all();        
        return view('TblLugares.index',
        [
            'lugares'=>$resultado            
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
        //$resultado= TblLugares::all();

        return view('TblLugares.create',
            [
                //'lugares'=>$resultado                
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
        //busco si el lugar ya esta creado
        $resultado= TblLugares::where(
            [
                ['nombre_lugar',$request->nombre_lugar],                
                ['id','<>',$request->id]
            ]
        )->orderBy('nombre_lugar','desc')->get();   
        //dd($resultado);
        if($resultado->count()>0)
        {
            flash("El Nombre del Lugar ".$request->nombre_lugar." ya Se Encuentra Creado")->warning();    
            return view('TblLugares.create',
            [
                //'lugares'=>$resultado                
            ]
        );   
        }  

        $Obj_TblLugares=new TblLugares($request->all());            
        $Obj_TblLugares->save();
        flash("Se ha Registrado el Lugar de forma Exitosa")->success();    
        return redirect()->route('index.tbllugares'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TblLugares  $tblLugares
     * @return \Illuminate\Http\Response
     */
    public function show(TblLugares $tblLugares)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TblLugares  $tblLugares
     * @return \Illuminate\Http\Response
     */
    //public function edit(TblLugares $tblLugares)
    public function edit($id)
    {
        //dd('jajaj');        
        $Obj_TblLugares=new TblLugares();
        $resultado=$Obj_TblLugares->find($id); 
        return view('TblLugares.edit',
        [            
            'lugares'=>$resultado
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TblLugares  $tblLugares
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, TblLugares $tblLugares)
    public function update(Request $request, $id)
    {        
        //busco si el lugar ya esta creado
        $resultado= TblLugares::where(
            [
                ['nombre_lugar',$request->nombre_lugar],                
                ['id','<>',$request->id]
            ]
        )->orderBy('nombre_lugar','desc')->get();   
        //dd($resultado);
        if($resultado->count()>0)
        {
            $Obj_TblLugares=new TblLugares();
            $resultado=$Obj_TblLugares->find($id);
            flash("El Nombre del Lugar ".$request->nombre_lugar." ya Se Encuentra Creado")->warning();    
            return view('TblLugares.edit',
            [            
                'lugares'=>$resultado
            ]
            );
        }  


        $Obj_TblLugares=new TblLugares();
        $resultado=$Obj_TblLugares->find($id);        
        $resultado->fill($request->all());//reemplaza los valores
        $resultado->save();
        flash("Se ha Actualizado el Lugar de forma Exitosa")->success();    
        return redirect()->route('index.tbllugares'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TblLugares  $tblLugares
     * @return \Illuminate\Http\Response
     */
    public function destroy(TblLugares $tblLugares)
    {
        //
    }
}
