<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotificacionesCorreo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_notificaciones_correo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('correo_notificacion');
            $table->unsignedBigInteger('module_id');

            $table->foreign('module_id')->references('id')->on('module_option')->onDelete('restrict');

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
        Schema::dropIfExists('tbl_notificaciones_correo');
    }
}
