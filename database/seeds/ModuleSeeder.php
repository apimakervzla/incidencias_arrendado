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
        $module->module_description = 'Control Novedades';
        $module->correlative_module = 1;
        $module->request = '';
        $module->icon_module = 'fa fa-fw fa-bell';
        $module->save();

        $module = new Module();
        $module->module_description = 'Control Incidencias';
        $module->correlative_module = 2;
        $module->request = '';
        $module->icon_module = 'fa fa-fw fa-bullhorn';
        $module->save();

        $module = new Module();
        $module->module_description = 'Control Llaves';
        $module->correlative_module = 3;
        $module->request = '';
        $module->icon_module = 'fa fa-fw fa-key';
        $module->save();

        $module = new Module();
        $module->module_description = 'Control_Lost&Found';
        $module->correlative_module = 4;
        $module->request = '';
        $module->icon_module = 'fa fa-fw fa-search';
        $module->save();

        $module = new Module();
        $module->module_description = 'Configuración';
        $module->correlative_module = 5;
        $module->request = '';
        $module->icon_module = 'fa fa-fw fa-cog';
        $module->save();
    }
}
