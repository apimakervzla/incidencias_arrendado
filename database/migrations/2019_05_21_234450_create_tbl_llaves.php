<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblLlaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_llaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_user_id');
            $table->unsignedBigInteger('tipo_llave_perfil_id');
            $table->unsignedBigInteger('turno_id');
            $table->boolean('status_llave')->default('0');
            $table->timestamps();

            $table->foreign('role_user_id')->references('id')->on('role_user')->onDelete('restrict');
            $table->foreign('tipo_llave_perfil_id')->references('id')->on('tbl_tipos_llaves_perfiles')->onDelete('restrict');
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
        Schema::dropIfExists('tbl_llaves');
    }
}
