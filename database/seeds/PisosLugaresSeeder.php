<?php

use Illuminate\Database\Seeder;
use App\TblPisosLugares;

class PisosLugaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=1;
        $Obj_TblPisosLugares->piso_id=1;
        $Obj_TblPisosLugares->lugar_id=1;
        $Obj_TblPisosLugares->save();

        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=2;
        $Obj_TblPisosLugares->piso_id=1;
        $Obj_TblPisosLugares->lugar_id=2;
        $Obj_TblPisosLugares->save();

        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=3;
        $Obj_TblPisosLugares->piso_id=2;
        $Obj_TblPisosLugares->lugar_id=3;
        $Obj_TblPisosLugares->save();

        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=4;
        $Obj_TblPisosLugares->piso_id=2;
        $Obj_TblPisosLugares->lugar_id=4;
        $Obj_TblPisosLugares->save();

        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=5;
        $Obj_TblPisosLugares->piso_id=3;
        $Obj_TblPisosLugares->lugar_id=5;
        $Obj_TblPisosLugares->save();

        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=6;
        $Obj_TblPisosLugares->piso_id=3;
        $Obj_TblPisosLugares->lugar_id=6;
        $Obj_TblPisosLugares->save();

        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=7;
        $Obj_TblPisosLugares->piso_id=4;
        $Obj_TblPisosLugares->lugar_id=7;
        $Obj_TblPisosLugares->save();

        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=8;
        $Obj_TblPisosLugares->piso_id=4;
        $Obj_TblPisosLugares->lugar_id=8;
        $Obj_TblPisosLugares->save();

        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=9;
        $Obj_TblPisosLugares->piso_id=4;
        $Obj_TblPisosLugares->lugar_id=9;
        $Obj_TblPisosLugares->save();

        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=10;
        $Obj_TblPisosLugares->piso_id=5;
        $Obj_TblPisosLugares->lugar_id=10;
        $Obj_TblPisosLugares->save();

        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=11;
        $Obj_TblPisosLugares->piso_id=5;
        $Obj_TblPisosLugares->lugar_id=11;
        $Obj_TblPisosLugares->save();

        $Obj_TblPisosLugares=new TblPisosLugares();
        $Obj_TblPisosLugares->id=12;
        $Obj_TblPisosLugares->piso_id=5;
        $Obj_TblPisosLugares->lugar_id=12;
        $Obj_TblPisosLugares->save();


    }
}
