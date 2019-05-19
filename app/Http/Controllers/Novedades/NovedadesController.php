<?php

namespace App\Http\Controllers\Novedades;

use App\Novedades;
use App\User;
use App\Audit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NovedadesRequest;
use Illuminate\Support\Facades\Auth;

class NovedadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // dd("hola");
        $Obj_Novedades=new Novedades();
        $resultado=$Obj_Novedades->orderBy("id","DESC")->paginate(5);
        // dd($resultado);
        //flash('BIENVENIDOS AL SISTEMA');
        return view('ControlNovedades.index')->with('novedades',$resultado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agentes= User::select('users.id','users.name')
                  ->join('role_user','role_user.user_id','users.id')
                  ->join('roles','roles.id','role_user.role_id')
                  ->where('roles.name','agent')
                  ->get();

        return view('ControlNovedades.create',['agentes'=>$agentes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(NovedadesRequest $request)
    {
        // dd($request);
        if ($request["incluir_incidencia"]==true) {
            // $Obj_Incidencias=new Incidencias($request->all());                    
            // $Obj_Incidencias->save(); 

            $auditoria = new Audit();
            $auditoria->role_user_id = Auth::id();
            
            foreach ($variable as $key => $value) {
                # code...
            }
            if($request->hasFile('url_imagen1')){
                $nombreArchivo = "img_incidencias";
                $archivo_img = $nombreArchivo."_".time().'.'.$request["url_imagen1"]->getClientOriginalExtension();
                        $path = public_path().'/images/incidencias/';
                        $request["url_imagen1"]->move($path, $archivo_img);
                $auditoria->url_imagen1 = $archivo_img;
              }     
            $auditoria->action = "Se creó La Incidencia:".$user->name.", con el Rol:".$rolename->description;
            
            $auditoria->save();
        }       
        //dd($request->all());        
        $Obj_Novedades=new Novedades($request->all()); 
        // $Obj_Novedades->incidencia_id=$Obj_Incidencias->id;      
        $Obj_Novedades->role_user_id=Auth::id();      
        $Obj_Novedades->save();        

        $auditoria = new Audit();
        $auditoria->role_user_id = Auth::id();        
        $auditoria->action = "Se creó La Novedad:".$request["descripcion_novedad"].", por: ".Auth::id();
        
        $auditoria->save();
       
       
        //flash("Se ha Registrado ".$Obj_Novedades->descripcion_novedad." de forma Exitosa")->success();    
        flash("Se ha Registrado La Novedad de forma Exitosa")->success();    
        return redirect()->route('index.novedades');                
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
