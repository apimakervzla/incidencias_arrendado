<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    protected $table = 'authorization';
    protected $fillable = ['role_user_id','role_id','module_option_id','authorized','create','update','read'];
    protected $guarded = ['id'];
}
