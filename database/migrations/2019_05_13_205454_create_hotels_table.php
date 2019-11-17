<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {     
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idCity');
            $table->string('name');
            $table->string('phoneNumber');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idCity');
            $table->string('name');
            $table->string('phoneNumber');
            $table->string('address');
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
        Schema::dropIfExists('hotels');
    }
}
