<?php

use App\Authorization;
use Illuminate\Database\Seeder;

class AuthorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Administrador
            //Novedades
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 1;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();

            //Incidencias
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 2;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();

            //Llaves
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 3;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();     
        
            //Lost&Found
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 4;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();     

            //Usuarios
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 5;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();    
        
            //Llaves
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 6;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();   

            //Pisos
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 7;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();

            //Lugares
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 8;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();   

            //Pisos Lugares
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 9;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();   

            //Pisos Lugares Llaves
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 10;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();   

            //Notificaciones Correo
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 11;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save(); 

            //Tipos Turnos
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 12;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save(); 

        


        //SUPERVISOR
            //Novedades
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 2;
        $authorization->module_option_id = 1;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();     

            //Incidencias
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 2;
        $authorization->module_option_id = 2;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();

            //Lost&Found
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 2;
        $authorization->module_option_id = 4;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();
        

        //RECEPTOR AMA LLAVES
            //Llaves
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 4;
        $authorization->module_option_id = 3;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();
    }
}
