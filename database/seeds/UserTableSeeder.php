<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $role_admin = Role::where('name', 'admin')->first();       

        $user = new User();
        $user->id=1;
        $user->name = 'Ruben Betancourt';
        $user->email = 'rubentorres26@gmail.com';
        $user->foto_usuario = 'img_usuario_default.jpg';
        $user->password = Hash::make('123456');
        $user->email_verified_at = Carbon::now();
        $user->status = true;
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->id=2;
        $user->name = 'Edgar Silva';
        $user->email = 'edgarsilvalovera@gmail.com';
        $user->foto_usuario = 'img_usuario_default.jpg';
        $user->password = Hash::make('123456');
        $user->email_verified_at = Carbon::now();
        $user->status = true;
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->id=3;
        $user->name = 'Mchael Sosa';
        $user->email = 'msosa@methacortex.com ';
        $user->foto_usuario = 'img_usuario_default.jpg';
        $user->password = Hash::make('123456');
        $user->email_verified_at = Carbon::now();
        $user->status = true;
        $user->save();
        $user->roles()->attach($role_admin);
        
    }
}
