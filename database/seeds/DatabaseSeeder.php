<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(ModuleOptionSeeder::class);
        $this->call(AuthorizationSeeder::class);
        $this->call(AuditSeeder::class);
        $this->call(TiposTurnosSeeder::class);
        $this->call(TurnosSeeder::class);
        $this->call(TiposActoresSeeder::class);
    }
}
