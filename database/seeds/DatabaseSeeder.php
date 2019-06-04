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
        $this->call(ColoresSeeder::class);
        $this->call(TiposLlavesSeeder::class);
        $this->call(TiposLlavesPerfilesSeeder::class);
        $this->call(LugaresSeeder::class);
        $this->call(PisosSeeder::class);
        $this->call(PisosLugaresSeeder::class);
        $this->call(PisosLugaresTiposLlavesSeeder::class);
        $this->call(TblNotificacionesCorreoSeeder::class);
        $this->call(TiposIncidenciasSeeder::class);        
        
    }
}
