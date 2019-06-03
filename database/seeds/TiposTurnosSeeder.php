<?php

use App\TiposTurnos;
use Illuminate\Database\Seeder;

class TiposTurnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos_turnos = new TiposTurnos();
        $tipos_turnos->descripcion_turno = "Matutino";
        $tipos_turnos->tiempo_desde = "06:15:00";
        $tipos_turnos->tiempo_hasta = "12:15:00";
        $tipos_turnos->save();

        $tipos_turnos = new TiposTurnos();
        $tipos_turnos->descripcion_turno = "Vespertino";
        $tipos_turnos->tiempo_desde = "12:30:00";
        $tipos_turnos->tiempo_hasta = "18:00:00";
        $tipos_turnos->save();

        $tipos_turnos = new TiposTurnos();
        $tipos_turnos->descripcion_turno = "Nocturno";
        $tipos_turnos->tiempo_desde = "18:15:00";
        $tipos_turnos->tiempo_hasta = "06:00:00";
        $tipos_turnos->save();
    }
}
