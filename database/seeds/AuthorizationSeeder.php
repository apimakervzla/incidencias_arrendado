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
        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 1;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();

        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 2;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();

        $authorization = new Authorization();
        $authorization->role_user_id = 1;
        $authorization->role_id = 1;
        $authorization->module_option_id = 3;
        $authorization->authorized = true;
        $authorization->create = true;        
        $authorization->update = true;        
        $authorization->read = true;        
        $authorization->save();        
    }
}
