<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblNovedades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_novedades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('descripcion_novedad');
            $table->boolean('incluir_incidencia')->default('0');
            $table->BigInteger('incidencia_id')->nullable();
            $table->BigInteger('turno_id')->nullable();
            $table->unsignedBigInteger('role_user_id');
            $table->timestamps();
            
            $table->foreign('role_user_id')->references('id')->on('role_user')->onDelete('restrict');
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
        Schema::dropIfExists('tbl_novedades');
    }
}
