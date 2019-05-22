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
        $module_option->module_option_description = 'Crear';
        $module_option->request = '';
        $module_option->route = '';   
        $module_option->icon_module_option = 'fa fa-fw fa-user-plus';
        $module_option->save();

        $module_option = new ModuleOption();
        $module_option->role_user_id = 1;
        $module_option->module_id = 1;
        $module_option->correlative_module_option = 2;
        $module_option->module_option_description = 'Perfil';
        $module_option->request = '';
        $module_option->route = '';    
        $module_option->icon_module_option = 'fa fa-fw fa-users';    
        $module_option->save();

        $module_option = new ModuleOption();
        $module_option->role_user_id = 1;
        $module_option->module_id = 1;
        $module_option->correlative_module_option = 3;
        $module_option->module_option_description = 'Auditoría';
        $module_option->request = '';
        $module_option->route = '';  
        $module_option->icon_module_option = 'fa fa-fw fa-user-secret';      
        $module_option->save();
    }
}
