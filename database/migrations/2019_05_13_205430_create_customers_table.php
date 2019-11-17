<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ci');
            $table->string('firstName');
            $table->string('secondName');
            $table->string('fatherName');
            $table->string('motherName');
            $table->string('phoneNumber');
            $table->char('gender');
            $table->date('birthDate');
            $table->tinyInteger('enabled');
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idHotel');
            $table->integer('idRoomType');
            $table->string('name');
            $table->string('prize');
            $table->string('comment');
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
        Schema::dropIfExists('customers');
    }
}
