<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacionesCorreo extends Model
{
    protected $table = 'tbl_notificaciones_correo';
    protected $fillable = ['id','correo_notificacion','module_id'];
    protected $guarded = ['id'];
}
