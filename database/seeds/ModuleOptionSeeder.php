<?php

use App\ModuleOption;
use Illuminate\Database\Seeder;

class ModuleOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module_option = new ModuleOption();
        $module_option->role_user_id = 1;
        $module_option->module_id = 1;
        $module_option->correlative_module_option = 1;
        $module_option->module_option_description = 'Ver Novedades';
        $module_option->request = '';
        $module_option->route = 'index.novedades';   
        $module_option->icon_module_option = 'fa fa-fw fa-bell-o';
        $module_option->save();

        $module_option = new ModuleOption();
        $module_option->role_user_id = 1;
        $module_option->module_id = 2;
        $module_option->correlative_module_option = 1;
        $module_option->module_option_description = 'Ver Incidencias';
        $module_option->request = '';
        $module_option->route = 'index.incidencias';    
        $module_option->icon_module_option = 'fa fa-fw fa-commenting';    
        $module_option->save();

        $module_option = new ModuleOption();
        $module_option->role_user_id = 1;
        $module_option->module_id = 3;
        $module_option->correlative_module_option = 1;
        $module_option->module_option_description = 'Ver Llaves';
        $module_option->request = '';
        $module_option->route = 'index.llaves';    
        $module_option->icon_module_option = 'fa fa-fw fa-building';    
        $module_option->save();

        $module_option = new ModuleOption();
        $module_option->role_user_id = 1;
        $module_option->module_id = 4;
        $module_option->correlative_module_option = 1;
        $module_option->module_option_description = 'Ver Lost&Found';
        $module_option->request = '';
        $module_option->route = 'index.lostfound';    
        $module_option->icon_module_option = 'fa fa-fw fa-search-plus';    
        $module_option->save();

        $module_option = new ModuleOption();
        $module_option->role_user_id = 1;
        $module_option->module_id = 5;
        $module_option->correlative_module_option = 1;
        $module_option->module_option_description = 'Ver Usuarios';
        $module_option->request = '';
        $module_option->route = 'index.users';  
        $module_option->icon_module_option = 'fa fa-fw fa-user';      
        $module_option->save();

        $module_option = new ModuleOption();
        $module_option->role_user_id = 1;
        $module_option->module_id = 5;
        $module_option->correlative_module_option = 2;
        $module_option->module_option_description = 'Ver Llaves Asociadas';
        $module_option->request = '';
        $module_option->route = '';  
        $module_option->icon_module_option = 'fa fa-fw fa-users';      
        $module_option->save();

        $module_option = new ModuleOption();
        $module_option->role_user_id = 1;
        $module_option->module_id = 5;
        $module_option->correlative_module_option = 3;
        $module_option->module_option_description = 'Ver Pisos y Lugares';
        $module_option->request = '';
        $module_option->route = '';  
        $module_option->icon_module_option = 'fa fa-fw fa-bed';      
        $module_option->save();
    }
}
