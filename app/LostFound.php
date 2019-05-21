<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LostFound extends Model
{
    protected $table = 'tbl_lost_found';
    protected $fillable = ['role_user_id','role_user_id_agente','actor_id','created_at','descripcion_lostfound'];
    protected $guarded = ['id'];
}
