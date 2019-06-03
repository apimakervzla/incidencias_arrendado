<?php

use Illuminate\Database\Seeder;
use App\TblPisosLugaresTiposLlaves;

class PisosLugaresTiposLlavesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Obj_TblPisosLugaresTiposLLaves=new TblPisosLugaresTiposLlaves();
        $Obj_TblPisosLugaresTiposLLaves->id=1;
        $Obj_TblPisosLugaresTiposLLaves->piso_lugar_id=5;
        $Obj_TblPisosLugaresTiposLLaves->tipo_llave_id=1;
        $Obj_TblPisosLugaresTiposLLaves->save();

        $Obj_TblPisosLugaresTiposLLaves=new TblPisosLugaresTiposLlaves();
        $Obj_TblPisosLugaresTiposLLaves->id=2;
        $Obj_TblPisosLugaresTiposLLaves->piso_lugar_id=6;
        $Obj_TblPisosLugaresTiposLLaves->tipo_llave_id=2;
        $Obj_TblPisosLugaresTiposLLaves->save();

        $Obj_TblPisosLugaresTiposLLaves=new TblPisosLugaresTiposLlaves();
        $Obj_TblPisosLugaresTiposLLaves->id=3;
        $Obj_TblPisosLugaresTiposLLaves->piso_lugar_id=7;
        $Obj_TblPisosLugaresTiposLLaves->tipo_llave_id=3;
        $Obj_TblPisosLugaresTiposLLaves->save();

        $Obj_TblPisosLugaresTiposLLaves=new TblPisosLugaresTiposLlaves();
        $Obj_TblPisosLugaresTiposLLaves->id=4;
        $Obj_TblPisosLugaresTiposLLaves->piso_lugar_id=8;
        $Obj_TblPisosLugaresTiposLLaves->tipo_llave_id=4;
        $Obj_TblPisosLugaresTiposLLaves->save();

        $Obj_TblPisosLugaresTiposLLaves=new TblPisosLugaresTiposLlaves();
        $Obj_TblPisosLugaresTiposLLaves->id=5;
        $Obj_TblPisosLugaresTiposLLaves->piso_lugar_id=10;
        $Obj_TblPisosLugaresTiposLLaves->tipo_llave_id=5;
        $Obj_TblPisosLugaresTiposLLaves->save();

        $Obj_TblPisosLugaresTiposLLaves=new TblPisosLugaresTiposLlaves();
        $Obj_TblPisosLugaresTiposLLaves->id=6;
        $Obj_TblPisosLugaresTiposLLaves->piso_lugar_id=11;
        $Obj_TblPisosLugaresTiposLLaves->tipo_llave_id=6;
        $Obj_TblPisosLugaresTiposLLaves->save();
    }
}
