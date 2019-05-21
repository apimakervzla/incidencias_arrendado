<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actores extends Model
{
    //
    protected $table = 'tbl_actores';
    protected $fillable = ['id','nombre_actor','apellido_actor','identificacion_actor','telefono_actor'];
    protected $guarded = ['id'];
}
