<?php

use Illuminate\Database\Seeder;
use App\Tiposincidencias;

class TiposIncidenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Tiposincidencias=new Tiposincidencias();;
        $Tiposincidencias->id=1;
        $Tiposincidencias->descripcion_tipo_incidencia='Tipo Incidencia 1';
        $Tiposincidencias->save();

        $Tiposincidencias=new Tiposincidencias();
        $Tiposincidencias->id=2;
        $Tiposincidencias->descripcion_tipo_incidencia='Tipo Incidencia 2';
        $Tiposincidencias->save();

        $Tiposincidencias=new Tiposincidencias();
        $Tiposincidencias->id=3;
        $Tiposincidencias->descripcion_tipo_incidencia='Tipo Incidencia 3';
        $Tiposincidencias->save();

    }
}
