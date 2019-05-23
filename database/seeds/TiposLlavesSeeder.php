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
        $color->color_id = 1;
        $color->nombre_llave = "primera";        
        $color->tiempo_expira = "06:00:00";        
        $color->save();

        $color = new TiposLlaves();
        $color->color_id = 2;
        $color->nombre_llave = "segunda";    
        $color->tiempo_expira = "07:00:00";             
        $color->save();

        $color = new TiposLlaves();
        $color->color_id = 3;
        $color->nombre_llave = "tercera";    
        $color->tiempo_expira = "03:00:00";        
        $color->save();

        $color = new TiposLlaves();
        $color->color_id = 4;
        $color->nombre_llave = "cuarta";    
        $color->tiempo_expira = "08:00:00";               
        $color->save();
    }
}
