<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblTiposLlavesPerfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tipos_llaves_perfiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_user_id');
            $table->unsignedBigInteger('tipo_llave_id');
            $table->unsignedBigInteger('role_id');
            $table->boolean('status_tipo_llave_perfil')->default('0');
            $table->timestamps();

            $table->foreign('role_user_id')->references('id')->on('role_user')->onDelete('restrict');      
            $table->foreign('tipo_llave_id')->references('id')->on('tbl_tipos_llaves')->onDelete('restrict');      
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_tipos_llaves_perfiles');
    }
}
