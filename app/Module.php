<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'module';
    protected $fillable = ['module_description','request','icon_module','role_userid'];
    protected $guarded = ['id'];
}
