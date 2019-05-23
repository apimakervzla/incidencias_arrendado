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
        $user->name = 'Ruben Betancourt';
        $user->email = 'rubentorres26@gmail.com';
        $user->password = Hash::make('123456');
        $user->email_verified_at = Carbon::now();
        $user->status = true;
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Edgar Silva';
        $user->email = 'edgarsilvalovera@gmail.com';
        $user->password = Hash::make('123456');
        $user->email_verified_at = Carbon::now();
        $user->status = true;
        $user->save();
        $user->roles()->attach($role_admin);
        
    }
}
