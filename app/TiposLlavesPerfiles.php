<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposLlavesPerfiles extends Model
{
    protected $table = 'tbl_tipos_llaves_perfiles';
    protected $fillable = ['role_user_id','tipo_llave_id','role_id','status_tipo_llave_perfil'];
    protected $guarded = ['id'];
}
