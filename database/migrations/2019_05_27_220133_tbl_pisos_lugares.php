<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPisosLugares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pisos_lugares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('piso_id');
            $table->unsignedBigInteger('lugar_id');
            $table->timestamps();

            //$table->foreign('piso_id')->references('id')->on('tbl_pisos')->onDelete('restrict');
            $table->foreign('lugar_id')->references('id')->on('tbl_lugares')->onDelete('restrict');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pisos_lugares');
    }
}
