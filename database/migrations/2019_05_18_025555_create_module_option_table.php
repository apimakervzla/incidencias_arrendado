<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_option', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('role_user_id')->unsigned();
            $table->bigInteger('module_id')->unsigned();            
            $table->bigInteger('correlative_module_option');            
            $table->mediumText('module_option_description');
            $table->mediumText('request');
            $table->longText('route');
            $table->mediumText('icon_module_option');
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
        Schema::dropIfExists('module_option');
    }
}
