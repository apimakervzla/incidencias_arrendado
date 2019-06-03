<?php

use App\TiposLlaves;
use Illuminate\Database\Seeder;

class TiposLlavesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $color = new TiposLlaves();
        $color->id=1;
        $color->color_id = 1;
        $color->nombre_llave = "00001";        
        $color->tiempo_expira = "06:00:00";        
        $color->save();

        $color = new TiposLlaves();
        $color->id=2;
        $color->color_id = 1;
        $color->nombre_llave = "00002";    
        $color->tiempo_expira = "07:00:00";             
        $color->save();

        $color = new TiposLlaves();
        $color->id=3;
        $color->color_id = 2;
        $color->nombre_llave = "00003";    
        $color->tiempo_expira = "03:00:00";        
        $color->save();

        $color = new TiposLlaves();
        $color->id=4;
        $color->color_id = 2;
        $color->nombre_llave = "00004";    
        $color->tiempo_expira = "08:00:00";               
        $color->save();

        $color = new TiposLlaves();
        $color->id=5;
        $color->color_id = 3;
        $color->nombre_llave = "00005";    
        $color->tiempo_expira = "08:00:00";               
        $color->save();

        $color = new TiposLlaves();
        $color->id=6;
        $color->color_id = 3;
        $color->nombre_llave = "00006";    
        $color->tiempo_expira = "08:00:00";               
        $color->save();

        $color = new TiposLlaves();
        $color->id=7;
        $color->color_id = 4;
        $color->nombre_llave = "00007";    
        $color->tiempo_expira = "08:00:00";               
        $color->save();

        $color = new TiposLlaves();
        $color->id=8;
        $color->color_id = 4;
        $color->nombre_llave = "00008";    
        $color->tiempo_expira = "08:00:00";               
        $color->save();

        $color = new TiposLlaves();
        $color->id=9;
        $color->color_id = 5;
        $color->nombre_llave = "00009";    
        $color->tiempo_expira = "08:00:00";               
        $color->save();

        $color = new TiposLlaves();
        $color->id=10;
        $color->color_id = 5;
        $color->nombre_llave = "000010";    
        $color->tiempo_expira = "08:00:00";               
        $color->save();

        $color = new TiposLlaves();
        $color->id=11;
        $color->color_id = 6;
        $color->nombre_llave = "000011";    
        $color->tiempo_expira = "08:00:00";               
        $color->save();

        $color = new TiposLlaves();
        $color->id=12;
        $color->color_id = 6;
        $color->nombre_llave = "000012";    
        $color->tiempo_expira = "08:00:00";               
        $color->save();
    }
}
