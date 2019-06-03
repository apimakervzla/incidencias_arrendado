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
        //MODULO CONTROL NOVEDADES
            //SUB MODULO VER NOVEDADES
        $module_option = new ModuleOption();
        $module_option->id = 1;
        $module_option->role_user_id = 1;
        $module_option->module_id = 1;
        $module_option->correlative_module_option = 1;
        $module_option->module_option_description = 'Ver Novedades';
        $module_option->request = '';
        $module_option->route = 'index.novedades';   
        $module_option->icon_module_option = 'fa fa-fw fa-bell-o';
        $module_option->save();

        //MODULO CONTROL INCIDENCIAS
            //SUB MODULO VER INCIDENCIAS
        $module_option = new ModuleOption();
        $module_option->id = 2;
        $module_option->role_user_id = 1;
        $module_option->module_id = 2;
        $module_option->correlative_module_option = 1;
        $module_option->module_option_description = 'Ver Incidencias';
        $module_option->request = '';
        $module_option->route = 'index.incidencias';    
        $module_option->icon_module_option = 'fa fa-fw fa-commenting';    
        $module_option->save();

        //MODULO CONTROL LLAVES
            //SUB MODULO VER LLAVES
        $module_option = new ModuleOption();
        $module_option->id = 3;
        $module_option->role_user_id = 1;
        $module_option->module_id = 3;
        $module_option->correlative_module_option = 1;
        $module_option->module_option_description = 'Ver Llaves';
        $module_option->request = '';
        $module_option->route = 'index.llaves';    
        $module_option->icon_module_option = 'fa fa-fw fa-building';    
        $module_option->save();

        //MODULO CONTROL LOST&FOUND
            //SUB MODULO VER LOS&FOUND
        $module_option = new ModuleOption();
        $module_option->id = 4;
        $module_option->role_user_id = 1;
        $module_option->module_id = 4;
        $module_option->correlative_module_option = 1;
        $module_option->module_option_description = 'Ver Lost&Found';
        $module_option->request = '';
        $module_option->route = 'index.lostfound';    
        $module_option->icon_module_option = 'fa fa-fw fa-search-plus';    
        $module_option->save();

        //MODULO CONFIGURACION
            //SUB MODULO VER USUARIOS
        $module_option = new ModuleOption();
        $module_option->id = 5;
        $module_option->role_user_id = 1;
        $module_option->module_id = 5;
        $module_option->correlative_module_option = 1;
        $module_option->module_option_description = 'Ver Usuarios';
        $module_option->request = '';
        $module_option->route = 'index.users';  
        $module_option->icon_module_option = 'fa fa-fw fa-user';      
        $module_option->save();

            //SUB MODULO VER LLAVES
        $module_option = new ModuleOption();
        $module_option->id = 6;
        $module_option->role_user_id = 1;
        $module_option->module_id = 5;
        $module_option->correlative_module_option = 2;
        $module_option->module_option_description = 'Ver Llaves';
        $module_option->request = '';
        $module_option->route = 'index.tiposllaves';  
        $module_option->icon_module_option = 'fa fa-key';      
        $module_option->save();

            //SUB MODULO VER PISOS
        $module_option = new ModuleOption();
        $module_option->id = 7;
        $module_option->role_user_id = 1;
        $module_option->module_id = 5;
        $module_option->correlative_module_option = 3;
        $module_option->module_option_description = 'Ver Pisos';
        $module_option->request = '';
        $module_option->route = 'index.tblpisos';  
        $module_option->icon_module_option = 'fa fa-fw fa-bed';      
        $module_option->save();

            //SUB MODULO VER LUGARES
        $module_option = new ModuleOption();
        $module_option->id = 8;
        $module_option->role_user_id = 1;
        $module_option->module_id = 5;
        $module_option->correlative_module_option = 4;
        $module_option->module_option_description = 'Ver Lugares';
        $module_option->request = '';
        $module_option->route = 'index.tbllugares';  
        $module_option->icon_module_option = 'fa fa-fw fa-bed';      
        $module_option->save();

            //SUB MODULO VER PISOS Y LUGARES
        $module_option = new ModuleOption();
        $module_option->id = 9;
        $module_option->role_user_id = 1;
        $module_option->module_id = 5;
        $module_option->correlative_module_option = 5;
        $module_option->module_option_description = 'Ver Pisos y Lugares';
        $module_option->request = '';
        $module_option->route = 'index.tblpisoslugares';  
        $module_option->icon_module_option = 'fa fa-fw fa-bed';      
        $module_option->save();

            //SUB MODULO VER PISOS LUGARES LLAVES
        $module_option = new ModuleOption();
        $module_option->id = 10;
        $module_option->role_user_id = 1;
        $module_option->module_id = 5;
        $module_option->correlative_module_option = 6;
        $module_option->module_option_description = 'Ver Pisos Lugares Llaves';
        $module_option->request = '';
        $module_option->route = 'index.tblpisoslugarestiposllaves';
        $module_option->icon_module_option = 'fa fa-key';
        $module_option->save();

            //SUB MODULO VER NOTIFICACIONES CORREO
        $module_option = new ModuleOption();
        $module_option->id = 11;
        $module_option->role_user_id = 1;
        $module_option->module_id = 5;
        $module_option->correlative_module_option = 7;
        $module_option->module_option_description = 'Ver Notificaciones Correo';
        $module_option->request = '';
        $module_option->route = 'index.notificacionescorreo';  
        $module_option->icon_module_option = 'fa fa-envelope';      
        $module_option->save();

            //SUB MODULO VER TURNOS
        $module_option = new ModuleOption();
        $module_option->id = 12;
        $module_option->role_user_id = 1;
        $module_option->module_id = 5;
        $module_option->correlative_module_option = 8;
        $module_option->module_option_description = 'Ver Tipos Turnos';
        $module_option->request = '';
        $module_option->route = 'index.tbltiposturnos';  
        $module_option->icon_module_option = 'fa fa-clock-o';      
        $module_option->save();

        
    }
}
