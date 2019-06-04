<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblLugares extends Model
{
    protected $table = 'tbl_lugares';
    protected $fillable = ['id','nombre_lugar'];
    protected $guarded = ['id'];
}
