<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblIncidencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_incidencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_user_id');
            $table->unsignedBigInteger('tipo_incidencia_id');
            $table->unsignedBigInteger('role_user_id_actor')->nullable();
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->longText('url_imagen_1')->nullable();
            $table->longText('url_imagen_2')->nullable();
            $table->longText('url_imagen_3')->nullable();
            $table->longText('url_imagen_4')->nullable();
            $table->longText('url_imagen_5')->nullable();
            $table->longText('url_imagen_6')->nullable();
            $table->longText('detalle_incidencia');
            $table->timestamps();

            $table->foreign('role_user_id')->references('id')->on('role_user')->onDelete('restrict');
            $table->foreign('tipo_incidencia_id')->references('id')->on('tbl_tipos_incidencias')->onDelete('restrict');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_incidencias');
    }
}
