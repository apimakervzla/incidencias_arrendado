<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblPisosLugaresTiposLlaves extends Model
{
    //
    protected $table = 'tbl_pisos_lugares_tipos_llaves';
    protected $fillable = ['id','piso_lugar_id','tipo_llave_id'];
    protected $guarded = ['id'];
}
