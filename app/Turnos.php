<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Turnos extends Model
{
    //
    protected $table = 'tbl_turnos';
    protected $fillable = ['id','role_user_id','tipo_turno_id','status_turno'];
    protected $guarded = ['id'];

    public function consultar_turno()
    {
        //Consulto el Role User del usurio logeado
        //$role_user=Auth::user()->whatRoleUser(Auth::user()->id);
        //dd($role_user);

        //$Obj_Turnos= new Turnos()   ;
        $turno= $this->select('tbl_turnos.id','tbl_turnos.role_user_id','tbl_turnos.tipo_turno_id')                  
                ->Join('role_user','role_user.id','tbl_turnos.role_user_id')                  
                ->Join('roles','roles.id','role_user.role_id')                  
                ->Join('users','users.id','role_user.user_id')                  
                ->where(
                    [
                        ['tbl_turnos.role_user_id',Auth::user()->id],
                        ['tbl_turnos.status_turno',"1"]
                    ]
                )
                ->orderby('tbl_turnos.id','DESC')->take(1)
                ->get(); 
        //dd($turno);
        return $turno;
    }
}
