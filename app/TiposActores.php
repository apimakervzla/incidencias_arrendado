<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposActores extends Model
{
    protected $table = 'tbl_tipos_actores';
    protected $fillable = ['id','descripcion_tipo_actor'];
    protected $guarded = ['id'];
}
