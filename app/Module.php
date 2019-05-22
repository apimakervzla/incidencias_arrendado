<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'module';
    protected $fillable = ['module_description','request','icon_module','correlative_module'];
    protected $guarded = ['id'];
}
