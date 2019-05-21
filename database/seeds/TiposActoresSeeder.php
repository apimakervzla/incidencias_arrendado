<?php

use Illuminate\Database\Seeder;
use App\TiposActores;
class TiposActoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $TiposActores = new TiposActores();
        $TiposActores->id = 1;        
        $TiposActores->descripcion_tipo_actor = 'Huesped';        
        $TiposActores->save();

        $TiposActores = new TiposActores();
        $TiposActores->id = 2;        
        $TiposActores->descripcion_tipo_actor = 'Cliente';        
        $TiposActores->save();

        $TiposActores = new TiposActores();
        $TiposActores->id = 3;        
        $TiposActores->descripcion_tipo_actor = 'Asociado';        
        $TiposActores->save();

        $TiposActores = new TiposActores();
        $TiposActores->id = 4;        
        $TiposActores->descripcion_tipo_actor = 'Proveedores';        
        $TiposActores->save();

        $TiposActores = new TiposActores();
        $TiposActores->id = 5;        
        $TiposActores->descripcion_tipo_actor = 'Contratista';        
        $TiposActores->save();
    }
}
