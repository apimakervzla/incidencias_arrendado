<?php

namespace App\Http\Controllers\TblTiposTurnos;

use App\TiposTurnos;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TblTiposTurnosController extends Controller
{
    //

    public function index()
    {
        //
        $tiposturnos = TiposTurnos::all();
        //dd($tiposturnos);

        return view('TblTiposTurnos.index',
        [
            'tiposturnos'=>$tiposturnos            
        ]
        );  
    }

    public function edit($id)
    {
        //dd('jajaj');        
        $Obj_TiposTurnos=new TiposTurnos();
        $resultado=$Obj_TiposTurnos->find($id);         
        //dd($resultado);
        return view('TblTiposTurnos.edit',
        [            
            'tiposturnos'=>$resultado
        ]
        );
    }

    public function update(Request $request, $id)
    {
        $tiempo_desde=explode(" ",$request->tiempo_desde);        
        if($tiempo_desde[1]=="PM")
        {
            $tiempo_desde=explode(":",$tiempo_desde[0]);
            $hora=($tiempo_desde[0]==12)?12:($tiempo_desde[0]+12);            
            $request->tiempo_desde=$request["tiempo_desde"]=$hora.":".$tiempo_desde[1];            
        }
        if($tiempo_desde[1]=="AM")
        {
            $tiempo_desde=explode(":",$tiempo_desde[0]);
            $hora=($tiempo_desde[0]==12)?"00":($tiempo_desde[0]);            
            $request->tiempo_desde=$request["tiempo_desde"]=$hora.":".$tiempo_desde[1];            
        }

        $tiempo_hasta=explode(" ",$request->tiempo_hasta);                
        if($tiempo_hasta[1]=="PM")
        {
            $tiempo_hasta=explode(":",$tiempo_hasta[0]);
            $hora=($tiempo_hasta[0]==12)?12:($tiempo_hasta[0]+12);            
            $request->tiempo_hasta=$request["tiempo_hasta"]=$hora.":".$tiempo_hasta[1];            
        }
        if($tiempo_hasta[1]=="AM")
        {
            $tiempo_hasta=explode(":",$tiempo_hasta[0]);            
            $hora=($tiempo_hasta[0]==12)?"00":($tiempo_hasta[0]);            
            $request->tiempo_hasta=$request["tiempo_hasta"]=$hora.":".$tiempo_hasta[1];            
            //dd($request->tiempo_hasta);
        }
        
        /*dd($request->tiempo_desde);
        $request->tiempo_desde=$request["tiempo_desde"]=str_replace(" AM","",$request->tiempo_desde);
        $request->tiempo_desde=$request["tiempo_desde"]=str_replace(" PM","",$request->tiempo_desde);
        $request->tiempo_hasta=$request["tiempo_hasta"]=str_replace(" AM","",$request->tiempo_hasta);
        $request->tiempo_hasta=$request["tiempo_hasta"]=str_replace(" PM","",$request->tiempo_hasta);
        //dd($request->tiempo_desde);*/

        $Obj_TiposTurnos=new TiposTurnos();
        $resultado=$Obj_TiposTurnos->find($id);        
        $resultado->fill($request->all());//reemplaza los valores
        $resultado->save();
        flash("Se ha Actualizado el Tipo Turno de forma Exitosa")->success();    
        return redirect()->route('index.tbltiposturnos'); 

    }
}
