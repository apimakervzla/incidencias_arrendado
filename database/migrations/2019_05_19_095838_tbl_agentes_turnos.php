<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblAgentesTurnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_agentes_turnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_user_id');
            $table->unsignedBigInteger('role_user_id_agente');
            $table->unsignedBigInteger('turno_id');
            $table->timestamps();

            $table->foreign('role_user_id')->references('id')->on('role_user')->onDelete('restrict');
            $table->foreign('role_user_id_agente')->references('id')->on('role_user')->onDelete('restrict');
            $table->foreign('turno_id')->references('id')->on('tbl_turnos')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_agentes_turnos');
    }
}
