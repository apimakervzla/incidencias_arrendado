<?php

use App\TiposLlavesPerfiles;
use Illuminate\Database\Seeder;

class TiposLlavesPerfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $color = new TiposLlavesPerfiles();
        $color->role_user_id = 1;
        $color->tipo_llave_id = 1;    
        $color->role_id = 3;        
        $color->status_tipo_llave_perfil = 1;        
        $color->save();

        $color = new TiposLlavesPerfiles();
        $color->role_user_id = 1;
        $color->tipo_llave_id = 2;    
        $color->role_id = 2;        
        $color->status_tipo_llave_perfil = 1;        
        $color->save();

        $color = new TiposLlavesPerfiles();
        $color->role_user_id = 1;
        $color->tipo_llave_id = 1;    
        $color->role_id = 4;        
        $color->status_tipo_llave_perfil = 1;        
        $color->save();

        $color = new TiposLlavesPerfiles();
        $color->role_user_id = 1;
        $color->tipo_llave_id = 3;    
        $color->role_id = 4;        
        $color->status_tipo_llave_perfil = 1;        
        $color->save();

    }
}
