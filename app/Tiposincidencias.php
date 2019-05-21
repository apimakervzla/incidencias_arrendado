<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiposincidencias extends Model
{
    protected $table = 'tbl_tipos_incidencias';
    protected $fillable = ['id','descripcion_tipo_incidencia'];
    protected $guarded = ['id'];
}
