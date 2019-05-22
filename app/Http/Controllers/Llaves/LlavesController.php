<?php

namespace App\Http\Controllers\Llaves;

use App\Llaves;
use App\TiposLlaves;
use Illuminate\Http\Request;
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
        $llaves= Llaves::select('tbl_llaves.id', 'tbl_llaves.created_at','tbl_tipos_llaves.nombre_llave','tbl_colores.hexadecimal')        
        ->join('tbl_tipos_llaves','tbl_tipos_llaves.id','tbl_llaves.tipo_llave_id')
        ->join('tbl_colores','tbl_colores.id','tbl_tipos_llaves.color_id')
        ->get();

        // $tipos_incidencias= Tiposincidencias::all();
        // $tipos_actores= TiposActores::all();

        return view('Llaves.index',
        [
            'llaves'=>$llaves
            // 'tipos_incidencias'=>$tipos_incidencias,
            // 'tipos_actores'=>$tipos_actores
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
        $llaves= TiposLlaves::select('tbl_tipos_llaves.id','tbl_tipos_llaves.nombre_llave','tbl_colores.hexadecimal')
        ->join('tbl_colores','tbl_colores.id','tbl_tipos_llaves.color_id')
        ->get();

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
        //
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
