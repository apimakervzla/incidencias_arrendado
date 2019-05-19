<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblActores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_actores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('nombre_actor');
            $table->mediumText('apellido_actor');
            $table->mediumText('identificacion_actor');
            $table->bigInteger('telefono_actor');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_actores');
    }
}
