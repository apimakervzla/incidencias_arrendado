<?php

namespace App;

use App\Role;
use App\Turnos;
use App\TiposTurnos;
use App\Mail\Novedades;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use App\Notifications\VerificandoEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                 return true; 
            }   
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function whatRole($user_id)
    {
        $rolename= Role::select('description')
                        ->join('role_user','role_user.role_id','roles.id')                        
                        ->where('role_user.user_id',$user_id)
                        ->first();        
        return $rolename->description;
    }

    public function whatRoleUser($user_id)
    {
        $Obj_Role= new Role();
        $rolename= $Obj_Role//->select('description')
                        ->join('role_user','role_user.role_id','roles.id')                        
                        ->where('role_user.user_id',$user_id)
                        ->first();        
        return $rolename;
    }

    public function whatModule($user_id)
    {
        $moduleauth= Role::select('module.id as module_id','module_option.id as module_option_id','module_description','icon_module','module_option_description','icon_module_option','route','correlative_module')
                        ->join('role_user','role_user.role_id','roles.id')                        
                        ->join('authorization','authorization.role_id','role_user.role_id')                        
                        ->join('module_option','module_option.id','authorization.module_option_id')
                        ->join('module','module.id','module_option.module_id')                        
                        ->where('role_user.user_id',$user_id)                        
                        ->orderBy('correlative_module','asc')
                        ->orderBy('correlative_module_option','asc')
                        ->get();        

        return $moduleauth;
    }
    public function turno($user_id)
    {
        if(Auth::id()){

            $turno_actual=Role::select('tbl_turnos.role_user_id','tipo_turno_id','status_turno')
            ->join('role_user','role_user.role_id','roles.id')                        
            ->join('tbl_turnos','tbl_turnos.role_user_id','role_user.id')                                            
            ->orderBy('tbl_turnos.created_at','desc')                                           
            ->orderBy('tbl_turnos.tipo_turno_id','desc')                                           
            ->first(); 

            $mirol=Role::select('role_user.role_id','role_user.id as role_user_id')
                        ->join('role_user','role_user.role_id','roles.id')
                        ->join('users','users.id','role_user.user_id')
                        ->where('user_id',Auth::id())
                        ->first();
// dd($mirol);
            $fecha_actual=Carbon::now();
            $hora_actual=$fecha_actual->format('H:i:s');

            $tipo_turno_id=DB::table('tbl_tipos_turnos')
                            ->select(DB::raw(" ( SELECT id
                            from tbl_tipos_turnos
                            where 
                            CAST('$hora_actual' AS time) BETWEEN tiempo_desde AND tiempo_hasta
                            OR (NOT CAST('$hora_actual' AS time) BETWEEN tiempo_hasta AND tiempo_desde AND tiempo_desde > tiempo_hasta)) as tipo_turno_id"))                        
                            ->first();
        
          if ($mirol->role_id==2) {
             
          
            if($turno_actual){
                    if($turno_actual->status_turno!=1)
                {
                    if ($turno_actual->role_user_id!=$mirol->role_user_id) {

                        if($turno_actual->tipo_turno_id!=$tipo_turno_id->tipo_turno_id){
                            $turno= new Turnos();
                            $turno->role_user_id=$mirol->role_user_id;
                            $turno->tipo_turno_id=$tipo_turno_id->tipo_turno_id;
                            $turno->status_turno=1;            
                            $turno->save();
                        }
                        else{

                            $valores=1;                    
                            return $valores;
                        }
                    }
                    else{
                        if($turno_actual->tipo_turno_id!=$tipo_turno_id->tipo_turno_id){
                            $turno= new Turnos();
                            $turno->role_user_id=$mirol->role_user_id;
                            $turno->tipo_turno_id=$tipo_turno_id->tipo_turno_id;
                            $turno->status_turno=1;            
                            $turno->save();
                        }
                        else{

                            $valores=1;                    
                            return $valores;
                        }
                    }
                }
                else{
                    if($turno_actual->role_user_id!=$mirol->role_user_id){

                        if($turno_actual->tipo_turno_id!=$tipo_turno_id->tipo_turno_id){

                            $turno= new Turnos();
                            $turno->role_user_id=$mirol->role_user_id;
                            $turno->tipo_turno_id=$turno_actual->tipo_turno_id;
                            $turno->status_turno=0;            
                            $turno->save();

                            $destinatarios = "rubentorres26@gmail.com";

                            $datos["tipo_turno_id"]=$tipo_turno_id->tipo_turno_id;
                            $datos["user_id"]=Auth::id();

                            
                            // foreach ($destinatarios as $key => $destinatario) {
                            //     switch ($destinatario->modulo_destinatario) {
                            //         case 'novedades':
                            //         Mail::to($destinatario->mail)->send(new Novedades($datos));
                            //             break;
                            //         case 'incidencias':
                            //         Mail::to($destinatario->email)->send(new Incidencias($datos));
                            //             break;
                            //         case 'llaves':
                            //         Mail::to($destinatario->email)->send(new Llaves($datos));
                            //             break;
                            //         case 'lostfound':
                            //         Mail::to($destinatario->email)->send(new LostFound($datos));
                            //             break;
                                    
                            //         default:
                            //             # code...
                            //             break;
                            //     }
                            // }

                        

                            $turno= new Turnos();
                            $turno->role_user_id=$mirol->role_user_id;
                            $turno->tipo_turno_id=$tipo_turno_id->tipo_turno_id;
                            $turno->status_turno=1;            
                            $turno->save();
                        }
                        else {
                            $valores=1;                    
                            return $valores;
                        }
                    }
                    else{
                        if($turno_actual->tipo_turno_id!=$tipo_turno_id->tipo_turno_id){

                            $turno= new Turnos();
                            $turno->role_user_id=$mirol->role_user_id;
                            $turno->tipo_turno_id=$turno_actual->tipo_turno_id;
                            $turno->status_turno=0;            
                            $turno->save();

                            // Mail::to($destinatario->email)->send(new NovedadesMail($datos));

                            $turno=1;                                            
                        }
                    }
                }

                $turno=Role::select('tbl_turnos.role_user_id','tipo_turno_id','status_turno','descripcion_turno')
                            ->join('role_user','role_user.role_id','roles.id')                        
                            ->join('tbl_turnos','tbl_turnos.role_user_id','role_user.id')                                            
                            ->join('tbl_tipos_turnos','tbl_tipos_turnos.id','tbl_turnos.tipo_turno_id')                                            
                            ->orderBy('tbl_turnos.created_at','desc')                                           
                            ->first();
                }
                else{
                    $turno= new Turnos();
                    $turno->role_user_id=$mirol->role_user_id;
                    $turno->tipo_turno_id=$tipo_turno_id->tipo_turno_id;
                    $turno->status_turno=1;            
                    $turno->save();
                }
            }
            else {
                $turno=2;
            }
            
            }
        else{
            $turno=1;
        }

        return $turno;
    }

    public function sinceUser($user_id)
    {
        $since= Role::select('role_user.created_at')
                        ->join('role_user','role_user.role_id','roles.id')                        
                        ->where('role_user.user_id',$user_id)
                        ->first();        
        return $since->created_at;
    }
    
    public function sendEmailVerificacion($verify)
    {
        
        $this->notify(new VerificandoEmail($verify));
    }
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
