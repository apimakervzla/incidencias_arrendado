<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrador';
        $role->save();

        $role = new Role();
        $role->name = 'super';
        $role->description = 'Supervisor';
        $role->save();

        $role = new Role();
        $role->name = 'vigilant';
        $role->description = 'Vigilante';
        $role->save();

        $role = new Role();
        $role->name = 'receptor';
        $role->description = 'Receptor de Ama de Llaves';
        $role->save();
       
    }
}
