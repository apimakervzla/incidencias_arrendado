<?php

namespace App;

use App\Turnos;
use Illuminate\Database\Eloquent\Model;

class Llaves extends Model
{
    protected $table = 'tbl_llaves';
    protected $fillable = ['role_user_id','tipo_llave_perfil_id','tiempo_llave','status_llave','turno_id'];
    protected $guarded = ['id'];
}
