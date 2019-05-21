<?php

use App\Turnos;
use Illuminate\Database\Seeder;

class TurnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $turnos = new Turnos();
        $turnos->role_user_id = 1;
        $turnos->tipo_turno_id = 1;
        $turnos->status_turno = 1;
        $turnos->save();
    }
}
