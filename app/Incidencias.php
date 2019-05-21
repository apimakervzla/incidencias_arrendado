<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidencias extends Model
{
    //
    protected $table = 'tbl_incidencias';
    protected $fillable = ['id','role_user_id','tipo_incidencia_id','role_user_id_actor','actor_id','url_imagen_1','url_imagen_2','url_imagen_3','url_imagen_4','url_imagen_5','url_imagen_6','detalle_incidencia'];
    protected $guarded = ['id'];
}
