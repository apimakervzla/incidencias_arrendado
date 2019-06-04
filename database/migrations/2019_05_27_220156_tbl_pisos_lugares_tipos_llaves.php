<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPisosLugaresTiposLlaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pisos_lugares_tipos_llaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('piso_lugar_id');
            $table->unsignedBigInteger('tipo_llave_id');
            $table->timestamps();

            $table->foreign('piso_lugar_id')->references('id')->on('tbl_pisos_lugares')->onDelete('restrict');
            $table->foreign('tipo_llave_id')->references('id')->on('tbl_tipos_llaves')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pisos_lugares_tipos_llaves');
    }
}
