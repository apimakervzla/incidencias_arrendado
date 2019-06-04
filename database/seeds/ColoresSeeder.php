<?php

use App\Colores;
use Illuminate\Database\Seeder;

class ColoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $color = new Colores();
        $color->id=1;
        $color->nombre_color = "Azul Cielo";
        $color->hexadecimal = "#00acd6";        
        $color->save();

        $color = new Colores();
        $color->id=2;
        $color->nombre_color = "Rojo";
        $color->hexadecimal = "#d73925";        
        $color->save();

        $color = new Colores();
        $color->id=3;
        $color->nombre_color = "Amarillo";
        $color->hexadecimal = "#e08e0b";        
        $color->save();

        $color = new Colores();
        $color->id=4;
        $color->nombre_color = "Verde";
        $color->hexadecimal = "#008d4c";        
        $color->save();

        $color = new Colores();
        $color->id=5;
        $color->nombre_color = "Gris";
        $color->hexadecimal = "#9c9c9c";        
        $color->save();

        $color = new Colores();
        $color->id=6;
        $color->nombre_color = "Negro";
        $color->hexadecimal = "#000000";        
        $color->save();
    }
}
