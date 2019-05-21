<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turnos extends Model
{
    //
    protected $table = 'tbl_turnos';
    protected $fillable = ['id','role_user_id','tipo_turno_id','status_turno'];
    protected $guarded = ['id'];
}
