<?php

use Illuminate\Database\Seeder;
use App\TblLugares;

class LugaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=1;
        $Obj_TblLugares->nombre_lugar="SALA ESTACIONAMIENTO A";
        $Obj_TblLugares->save();

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=2;
        $Obj_TblLugares->nombre_lugar="SALA ESTACIONAMIENTO B";
        $Obj_TblLugares->save();

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=3;
        $Obj_TblLugares->nombre_lugar="LOBBY";
        $Obj_TblLugares->save();

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=4;
        $Obj_TblLugares->nombre_lugar="PASILLO PRINCIPAL PB";
        $Obj_TblLugares->save();

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=5;
        $Obj_TblLugares->nombre_lugar="SALON REUNIONES MZ";
        $Obj_TblLugares->save();

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=6;
        $Obj_TblLugares->nombre_lugar="PASILLO MZ";
        $Obj_TblLugares->save();

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=7;
        $Obj_TblLugares->nombre_lugar="A1";
        $Obj_TblLugares->save();

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=8;
        $Obj_TblLugares->nombre_lugar="B1";
        $Obj_TblLugares->save();

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=9;
        $Obj_TblLugares->nombre_lugar="PASILLO CENTRAL P1";
        $Obj_TblLugares->save();

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=10;
        $Obj_TblLugares->nombre_lugar="A2";
        $Obj_TblLugares->save();

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=11;
        $Obj_TblLugares->nombre_lugar="B2";
        $Obj_TblLugares->save();

        $Obj_TblLugares=new TblLugares();
        $Obj_TblLugares->id=12;
        $Obj_TblLugares->nombre_lugar="PASILLO CENTRAL P2";
        $Obj_TblLugares->save();
    }
}
