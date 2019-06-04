<?php

namespace App\Http\Controllers\NotificacionesCorreo;

use App\NotificacionesCorreo;
use Illuminate\Http\Request;
use App\Module;

use App\Http\Controllers\Controller;

class NotificacionesCorreoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultado= NotificacionesCorreo::select('tbl_notificaciones_correo.id','tbl_notificaciones_correo.correo_notificacion',
        'tbl_notificaciones_correo.module_id','module.module_description')
                  ->Join('module','module.id','tbl_notificaciones_correo.module_id')
                  //->where('tbl_novedades.turno_id',$turno_id)
                  ->orderBy('tbl_notificaciones_correo.module_id','desc')
                  ->get();
        
        //dd($resultado);
        return view('NotificacionesCorreo.index',
        [
            'notificaciones_correo'=>$resultado            
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotificacionesCorreo  $notificacionesCorreo
     * @return \Illuminate\Http\Response
     */
    public function show(NotificacionesCorreo $notificacionesCorreo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotificacionesCorreo  $notificacionesCorreo
     * @return \Illuminate\Http\Response
     */
    //public function edit(NotificacionesCorreo $notificacionesCorreo)
    public function edit($module_id)
    {
        //dd($module_id);
        $resultado= NotificacionesCorreo::select('tbl_notificaciones_correo.id','tbl_notificaciones_correo.correo_notificacion',
        'tbl_notificaciones_correo.module_id','module.module_description')
                  ->Join('module','module.id','tbl_notificaciones_correo.module_id')
                  ->where('tbl_notificaciones_correo.module_id',$module_id)
                  ->orderBy('tbl_notificaciones_correo.module_id','desc')
                  ->get();


        
        $module= Module::all();   
        
       
        return view('NotificacionesCorreo.edit',
        [
            'module'=>$module,
            'notificaciones_correo' =>$resultado            
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotificacionesCorreo  $notificacionesCorreo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificacionesCorreo $notificacionesCorreo)
    {
        $Obj_NotificacionesCorreo=new NotificacionesCorreo();        
        //$resultado=$Obj_TiposLlavesPerfiles->find($id);
        $Obj_NotificacionesCorreo->where("module_id",$request["module_id"])->delete();

        foreach($request["correo_notificacion"] as $index=>$valor)
        {
            // echo $valor."-->".$request["module_id"];
            // echo "<br>";
            // continue;
            if($valor!="")
            {
                $Obj_NotificacionesCorreo=new NotificacionesCorreo();
                $Obj_NotificacionesCorreo->correo_notificacion=$valor;
                $Obj_NotificacionesCorreo->module_id=$request["module_id"];            
                $Obj_NotificacionesCorreo->save();
            }
            
        }
        flash("Se ha Actualizado Los Correos de Notificaciones de forma Exitosa")->success();    
        return redirect()->route('index.notificacionescorreo'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotificacionesCorreo  $notificacionesCorreo
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificacionesCorreo $notificacionesCorreo)
    {
        //
    }
}
