<?php

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
        $turnos->role_user_id = 'admin';
        $turnos->description = 'Administrador';
        $turnos->save();
    }
}
