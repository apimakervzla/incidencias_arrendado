<?php

namespace App\Http\Controllers\AgentesTurnos;

use App\AgentesTurnos;
use App\Novedades;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AgentesTurnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //Consulto el turno_id
        $Obj_Novedades=new Novedades();        
        $turno=$Obj_Novedades->consultar_turno2();            
        if($turno->count() <= "0" )
        {            
            flash("El Supervisor No Posee Turno Activo. Ingrese Nuevamente al Sistema")->error();    
            return redirect()->route('index.novedades');                
        }

        
        foreach($request["role_user_id_agente"] as $index=>$valor)
        {
            $Obj_AgentesTurnos=new AgentesTurnos()     ;
            $Obj_AgentesTurnos->role_user_id=Auth::id();
            $Obj_AgentesTurnos->turno_id=$turno[0]->id;
            $Obj_AgentesTurnos->role_user_id_agente=$valor;
            $Obj_AgentesTurnos->save();
        }

        $agentes_turnos=$Obj_AgentesTurnos->select('users.name','role_user.id')
        ->join('role_user','role_user.id','tbl_agentes_turnos.role_user_id_agente')
        ->join('users','users.id','role_user.user_id')
        ->where('tbl_agentes_turnos.turno_id',$turno[0]->id)
        ->get();

        //dd($agentes_turnos);

        flash("Los Agentes Fueron Agregados al Turno")->success();    
        return redirect()->route('create.novedades')->with('agentes_turnos',$agentes_turnos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AgentesTurnos  $agentesTurnos
     * @return \Illuminate\Http\Response
     */
    public function show(AgentesTurnos $agentesTurnos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AgentesTurnos  $agentesTurnos
     * @return \Illuminate\Http\Response
     */
    public function edit(AgentesTurnos $agentesTurnos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AgentesTurnos  $agentesTurnos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgentesTurnos $agentesTurnos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AgentesTurnos  $agentesTurnos
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgentesTurnos $agentesTurnos)
    {
        //
    }
}
