<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposLlaves extends Model
{
    protected $table = 'tbl_tipos_llaves';
    protected $fillable = ['color_id','nombre_llave','tiempo_expira'];
    protected $guarded = ['id'];
}
