<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblTiposTurnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tipos_turnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('descripcion_turno');
            $table->timestamp('fecha_desde')->nullable();
            $table->timestamp('fecha_hasta')->nullable();
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
        Schema::dropIfExists('tbl_tipos_turnos');
    }
}
