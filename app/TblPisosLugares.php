<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblPisosLugares extends Model
{
    //
    protected $table = 'tbl_pisos_lugares';
    protected $fillable = ['id','piso_id','lugar_id'];
    protected $guarded = ['id'];
}
