<?php

use Illuminate\Database\Seeder;
use App\TblPisos;
class PisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Obj_TblPisos = new TblPisos();
        $Obj_TblPisos->id=1;
        $Obj_TblPisos->nombre_piso = 'SS';        
        $Obj_TblPisos->orden_piso = 1;        
        $Obj_TblPisos->save();

        $Obj_TblPisos = new TblPisos();
        $Obj_TblPisos->id=2;
        $Obj_TblPisos->nombre_piso = 'MZ';        
        $Obj_TblPisos->orden_piso = 2;        
        $Obj_TblPisos->save();

        $Obj_TblPisos = new TblPisos();
        $Obj_TblPisos->id=3;
        $Obj_TblPisos->nombre_piso = 'PB';        
        $Obj_TblPisos->orden_piso = 3;        
        $Obj_TblPisos->save();

        $Obj_TblPisos = new TblPisos();
        $Obj_TblPisos->id=4;
        $Obj_TblPisos->nombre_piso = 'P1';        
        $Obj_TblPisos->orden_piso = 4;        
        $Obj_TblPisos->save();

        $Obj_TblPisos = new TblPisos();
        $Obj_TblPisos->id=5;
        $Obj_TblPisos->nombre_piso = 'P2';        
        $Obj_TblPisos->orden_piso = 5;        
        $Obj_TblPisos->save();
    }
}
