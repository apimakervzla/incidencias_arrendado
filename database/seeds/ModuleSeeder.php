<?php

use App\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = new Module();
        $module->module_description = 'Usuarios';
        $module->request = '';
        $module->icon_module = 'fa fa-fw fa-user';
        $module->save();
    }
}
