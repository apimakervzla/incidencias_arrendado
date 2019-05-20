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
            $table->unsignedBigInteger('tipo_actor_id');
            $table->mediumText('nombre_actor');
            $table->mediumText('apellido_actor');
            $table->mediumText('identificacion_actor');
            $table->bigInteger('telefono_actor');
            $table->timestamps();

            $table->foreign('tipo_actor_id')->references('id')->on('tbl_tipos_actores')->onDelete('restrict');
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
