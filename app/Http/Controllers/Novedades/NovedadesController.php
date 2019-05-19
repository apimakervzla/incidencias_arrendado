<?php

namespace App\Http\Controllers\Novedades;

use App\Novedades;
use Illuminate\Http\Request;

use App\Http\Requests\NovedadesRequest;

class NovedadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Obj_Novedades=new Novedades();
        $resultado=$Obj_Novedades->orderBy("id","DESC")->paginate(5);
        //dd($resultado);
        //flash('BIENVENIDOS AL SISTEMA');
        return view('novedades.index')->with('novedades',$resultado);
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
    //public function store(Request $request)
    public function store(NovedadesRequest $request)
    {
        //dd($request->all());        
        $Obj_Novedades=new Novedades($request->all());        
        $Obj_Novedades->save();        
        //flash("Se ha Registrado ".$Obj_Novedades->descripcion_novedad." de forma Exitosa")->success();
        flash("Se ha Registrado La Novedad de forma Exitosa")->success();
        return redirect()->route('novedades.index');                
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
}
