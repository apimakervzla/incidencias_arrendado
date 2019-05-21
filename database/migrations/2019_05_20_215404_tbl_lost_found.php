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
            $table->unsignedBigInteger('role_user_id_agente');
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->text('descripcion_lostfound');
            $table->timestamp('fecha_vencimiento_lost_found')->nullable();
            
            $table->foreign('role_user_id_agente')->references('id')->on('role_user')->onDelete('restrict');
            $table->foreign('actor_id')->references('id')->on('tbl_actores')->onDelete('restrict');

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
