<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\Module;
use App\ModuleOption;
use App\Authorization;
use App\Audit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        
        return view('roles.index',['roles'=>$roles]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modulos = Module::get();
        
        $opciones = ModuleOption::get();
        
        // dd($modulos_opciones);
        return view('roles.create',['modulos'=>$modulos,'opciones'=>$opciones]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $role = new Role();
        $role->name = $request["description"];
        $role->description = $request["description"];             
        $role->save();

            foreach ($request["autorizado"] as $key => $value) {

                if ($value["autorizacion"]!= 0 || $value["agregar"]!= 0 || $value["editar"]!= 0 || $value["consultar"]!= 0) {
                    $autorizacion = new Authorization();  
                    $autorizacion->role_user_id = Auth::id();                 
                    $autorizacion->role_id = $role->id;
                    $autorizacion->module_option_id = $value["id"];
                    $autorizacion->authorized = $value["autorizacion"];
                    $autorizacion->create = $value["agregar"];
                    $autorizacion->update = $value["editar"];
                    $autorizacion->read = $value["consultar"];       
                    $autorizacion->save();

                    if ($value["agregar"]) {
                        $crear="Crear";
                    }

                    if ($value["editar"]) {
                        $editar="Editar";
                    }

                    if ($value["consultar"]) {
                        $consultar="Consultar";
                    }
                    

                    $auditoria = new Audit();
                    $auditoria->role_user_id = Auth::id(); 
                         
                    $moduloopciones = ModuleOption::join('module', 'module.id', 'module_option.module_id')
                                            ->where('module_option.id', $value["id"])->first();

                    if($value["agregar"]!=0 && $value["editar"]!=0 && $value["consultar"]!=0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $crear, $editar y $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    }                     
                    if($value["agregar"]!=0 && $value["editar"]!=0 && $value["consultar"]==0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $crear y $editar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    if($value["agregar"]!=0 && $value["editar"]==0 && $value["consultar"]==0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $crear, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    if($value["agregar"]==0 && $value["editar"]!=0 && $value["consultar"]!=0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $editar y $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    if($value["agregar"]==0 && $value["editar"]==0 && $value["consultar"]!=0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    if($value["agregar"]!=0 && $value["editar"]==0 && $value["consultar"]!=0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $crear y $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    if($value["agregar"]==0 && $value["editar"]!=0 && $value["consultar"]==0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $editar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    $auditoria->save();

                    // $modulos_afectados[$key]=$value["id"];
                } 
               
            }        
        
        
    
        return redirect()->route("index.roles");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {        
        $role = Role::where('id',$role->id)
                    ->first();
        $modulos = Module::get();        
        $opciones = Option::get();        
        $modulo_autorizaciones= Authorization::where('role_id',$role->id)
                                ->get();   

        return view('roles.edit',['modulos'=>$modulos,'opciones'=>$opciones,'role'=>$role,'modulo_autorizaciones'=>$modulo_autorizaciones]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        
        $autorizaciones_roles = Authorization::where('role_id',$role->id)
        ->get();

        // dd($request);
        $role = Role::find($role->id);
        $role->name = $request["description"];
        $role->description = $request["description"];             
        $role->update();        

        foreach ($request["autorizado"] as $key => $value) {

            if ($value["autorizacion"]!= 0 || $value["agregar"]!= 0 || $value["editar"]!= 0 || $value["consultar"]!= 0) {

                if ($value["agregar"]) {
                    $crear="Crear";
                }
                if ($value["editar"]) {
                    $editar="Editar";
                }
                if ($value["consultar"]) {
                    $consultar="Consultar";
                }
                
                if (isset($autorizaciones_roles[0])==true) {
                    foreach ($autorizaciones_roles as $keys => $auth_rol) {

                        if ($auth_rol->id_opcion==$key) {
                            $autorizacion = Authorization::find($auth_rol->id);
                            $autorizacion->role_user_id = Auth::id();
                            $autorizacion->role_id = $role->id;
                            $autorizacion->module_option_id = $value["id"];
                            $autorizacion->authorized = $value["autorizacion"];
                            $autorizacion->create = $value["agregar"];
                            $autorizacion->update = $value["editar"];
                            $autorizacion->read = $value["consultar"];                             
                            $autorizacion->update();

                            $auditoria = new Audit();
                            $auditoria->role_user_id = Auth::id();                                
                            $moduloopciones = ModuleOption::join('module', 'module.id', 'module_option.module_id')
                                                    ->where('module_option.id', $value["id"])->first();
                            if($value["agregar"]!=0 && $value["editar"]!=0 && $value["consultar"]!=0){
                                $auditoria->action = "Se editó el Rol:".$request["description"]."para: $crear, $editar y $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                            }                     
                            if($value["agregar"]!=0 && $value["editar"]!=0 && $value["consultar"]==0){
                                $auditoria->action = "Se editó el Rol:".$request["description"]."para: $crear y $editar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                            } 
                            if($value["agregar"]!=0 && $value["editar"]==0 && $value["consultar"]==0){
                                $auditoria->action = "Se editó el Rol:".$request["description"]."para: $crear, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                            } 
                            if($value["agregar"]==0 && $value["editar"]!=0 && $value["consultar"]!=0){
                                $auditoria->action = "Se editó el Rol:".$request["description"]."para: $editar y $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                            } 
                            if($value["agregar"]==0 && $value["editar"]==0 && $value["consultar"]!=0){
                                $auditoria->action = "Se editó el Rol:".$request["description"]."para: $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                            } 
                            if($value["agregar"]!=0 && $value["editar"]==0 && $value["consultar"]!=0){
                                $auditoria->action = "Se editó el Rol:".$request["description"]."para: $crear y $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                            } 
                            if($value["agregar"]==0 && $value["editar"]!=0 && $value["consultar"]==0){
                                $auditoria->action = "Se editó el Rol:".$request["description"]."para: $editar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                            } 
                            $auditoria->save();

                        }
                       
                    }                   
                } else {
                    $autorizacion = new Autorizaciones();
                    $autorizacion->id_rol = $role->id;
                    $autorizacion->id_opcion = $value["id"];
                    $autorizacion->autorizacion = $value["autorizacion"];
                    $autorizacion->agregar = $value["agregar"];
                    $autorizacion->editar = $value["editar"];
                    $autorizacion->consultar = $value["consultar"];
                    $autorizacion->id_usuario = Auth::id();        
                    $autorizacion->save();

                    $auditoria = new Audit();
                    $auditoria->role_user_id = Auth::id();                          
                    $moduloopciones = ModuleOption::join('module', 'module.id', 'module_option.module_id')
                                            ->where('module_option.id', $value["id"])->first();
                    if($value["agregar"]!=0 && $value["editar"]!=0 && $value["consultar"]!=0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $crear, $editar y $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    }                     
                    if($value["agregar"]!=0 && $value["editar"]!=0 && $value["consultar"]==0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $crear y $editar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    if($value["agregar"]!=0 && $value["editar"]==0 && $value["consultar"]==0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $crear, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    if($value["agregar"]==0 && $value["editar"]!=0 && $value["consultar"]!=0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $editar y $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    if($value["agregar"]==0 && $value["editar"]==0 && $value["consultar"]!=0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    if($value["agregar"]!=0 && $value["editar"]==0 && $value["consultar"]!=0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $crear y $consultar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    if($value["agregar"]==0 && $value["editar"]!=0 && $value["consultar"]==0){
                        $auditoria->action = "Se creó el Rol:".$request["description"]."para: $editar, en la Opción: $moduloopciones->module_option_description, en el Modulo: $moduloopciones->module_description";
                    } 
                    $auditoria->save();
                }
            } 
            $modulos_afectados[$key]=$value["id"];
        }
        
        return redirect()->route("index.roles");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
