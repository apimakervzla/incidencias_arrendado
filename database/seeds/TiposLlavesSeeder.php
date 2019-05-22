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
        $color->tiempo_expira = 6;        
        $color->save();

        $color = new TiposLlaves();
        $color->color_id = 2;
        $color->nombre_llave = "segunda";    
        $color->tiempo_expira = 7;        
        $color->save();

        $color = new TiposLlaves();
        $color->color_id = 3;
        $color->nombre_llave = "tercera";    
        $color->tiempo_expira = 3;        
        $color->save();

        $color = new TiposLlaves();
        $color->color_id = 4;
        $color->nombre_llave = "cuarta";    
        $color->tiempo_expira = 8;        
        $color->save();
    }
}
