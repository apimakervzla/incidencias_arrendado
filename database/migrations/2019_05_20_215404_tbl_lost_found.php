<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblLostFound extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_lost_found', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_user_id');
            $table->unsignedBigInteger('role_user_id_agente')->nullable();
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->unsignedBigInteger('turno_id');
            $table->text('descripcion_lostfound');
            $table->text('url_foto_1');
            $table->text('url_foto_2');
            $table->text('url_foto_3');
            $table->text('url_foto_4');
            $table->timestamp('fecha_vencimiento_lost_found')->nullable();
            
            $table->foreign('role_user_id_agente')->references('id')->on('role_user')->onDelete('restrict');
            $table->foreign('actor_id')->references('id')->on('tbl_actores')->onDelete('restrict');
            $table->foreign('turno_id')->references('id')->on('tbl_turnos')->onDelete('restrict');

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
        Schema::dropIfExists('tbl_lost_found');
    }
}
