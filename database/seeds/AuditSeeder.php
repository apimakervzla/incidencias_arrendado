<?php

use App\Audit;
use Illuminate\Database\Seeder;

class AuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $audit = new Audit();
        $audit->role_user_id = 1;
        $audit->action = "Se creó el Usuario: Edgar Silva, con el Rol: Administrador";        
        $audit->save();

        $audit = new Audit();
        $audit->role_user_id = 1;
        $audit->action = "Se creó la Opción: Crear, en el Modulo: Usuarios";        
        $audit->save();

        $audit = new Audit();
        $audit->role_user_id = 1;
        $audit->action = "Se creó la Opción: Perfil, en el Modulo: Usuarios";        
        $audit->save();

        $audit = new Audit();
        $audit->role_user_id = 1;
        $audit->action = "Se creó la Opción: Auditoría, en el Modulo: Usuarios";        
        $audit->save();

        $audit = new Audit();
        $audit->role_user_id = 1;
        $audit->action = "Se Editó el Rol Administrador para: Crear, Editar y Consultar, en la Opción: Crear, en el Modulo: Usuarios";        
        $audit->save();

        $audit = new Audit();
        $audit->role_user_id = 1;
        $audit->action = "Se Editó el Rol Administrador para: Crear, Editar y Consultar, en la Opción: Perfil, en el Modulo: Usuarios";        
        $audit->save();

        $audit = new Audit();
        $audit->role_user_id = 1;
        $audit->action = "Se Editó el Rol Administrador para: Crear, Editar y Consultar, en la Opción: Auditoría, en el Modulo: Usuarios";        
        $audit->save();
       
    }
}
