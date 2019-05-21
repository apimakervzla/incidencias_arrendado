<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposTurnos extends Model
{
    protected $table = 'tbl_tipos_turnos';
    protected $fillable = ['descripcion_turno','tiempo_desde','tiempo_hasta'];
    protected $guarded = ['id'];
}
