<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colores extends Model
{
    protected $table = 'tbl_colores';
    protected $fillable = ['nombre_color','hexadecimal'];
    protected $guarded = ['id'];
}
