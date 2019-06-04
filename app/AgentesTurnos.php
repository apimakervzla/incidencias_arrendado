<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentesTurnos extends Model
{
    protected $table = 'tbl_agentes_turnos';
    protected $fillable = ['id','role_user_id','role_user_id_agente','turno_id'];
    protected $guarded = ['id'];
}
