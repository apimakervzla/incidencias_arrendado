<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleOption extends Model
{
    protected $table = 'module_option';
    protected $fillable = ['module_id','correlative','module_option_description','request','route','icon_module_option'];
    protected $guarded = ['id'];
}
