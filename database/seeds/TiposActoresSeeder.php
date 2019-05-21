<?php

use App\TiposActores;
use Illuminate\Database\Seeder;

class TiposActoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos_actores = new TiposActores();
        $tipos_actores->descripcion_tipo_actor = "Huesped";        
        $tipos_actores->save();
        
        $tipos_actores = new TiposActores();
        $tipos_actores->descripcion_tipo_actor = "Cliente";        
        $tipos_actores->save();

        $tipos_actores = new TiposActores();
        $tipos_actores->descripcion_tipo_actor = "Asociado";        
        $tipos_actores->save();

        $tipos_actores = new TiposActores();
        $tipos_actores->descripcion_tipo_actor = "Proveedor";        
        $tipos_actores->save();

        $tipos_actores = new TiposActores();
        $tipos_actores->descripcion_tipo_actor = "Contratista";        
        $tipos_actores->save();       

    }
}
