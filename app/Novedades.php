<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novedades extends Model
{
    //
    protected $table = 'tbl_novedades';
    protected $fillable = ['id','descripcion_novedad','incluir_incidencia','numero_incidencia','role_user_id'];
    protected $guarded = ['id'];
}
