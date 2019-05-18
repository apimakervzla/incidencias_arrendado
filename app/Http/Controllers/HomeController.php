<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Authorization;
use App\Role;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);


        $roles=Role::get();

        foreach ($roles as $key => $rol) {
           if(Auth::user()->hasRole($rol->name))
           {
            $role_id=$rol->id;
           }
        }        
        $modulos=Authorization::select('module.icon_module','module.module_description')
                                        ->join('module_option', 'module_option.id',  'authorization.module_option_id')
                                        ->join('module', 'module.id',  'module_option.module_id')
                                        ->where("role_id",$role_id)
                                        ->get();
        $modulos_opciones=Authorization::select('module_option.icon_module_option','module_option.module_option_description','module_option.request')
                                    ->join('module_option', 'module_option.id',  'authorization.module_option_id')                                    
                                    ->where("role_id",$role_id)
                                    ->get();   
        // $modulos="";
        // $modulos_opciones="";
        return view('/',['modulos'=>$modulos,'modulos_opciones'=>$modulos_opciones]);
    }
}
