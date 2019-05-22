<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Llaves extends Model
{
    protected $table = 'tbl_llaves';
    protected $fillable = ['role_user_id','tipo_llave_id','tiempo_llave','status_llave'];
    protected $guarded = ['id'];
}
