<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblPisos extends Model
{
    //
    protected $table = 'tbl_pisos';
    protected $fillable = ['id','nombre_piso','orden_piso'];
    protected $guarded = ['id'];
}
