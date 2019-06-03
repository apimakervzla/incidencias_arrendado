<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorization', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->bigInteger('role_user_id')->unsigned();
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('module_option_id')->unsigned();
            $table->boolean('authorized');
            $table->boolean('create');
            $table->boolean('update');
            $table->boolean('read');                        
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
        Schema::dropIfExists('authorization');
    }
}
