<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration {

    public function up() {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('FirstName', 255);
            $table->string('LastName', 255);
            $table->string('Email', 255);
            $table->string('Mobile', 255);
            $table->string('Message', 255);
            $table->string('ContactBy');
            $table->dateTime('FirstDate');
            $table->dateTime('SecondDate')->nullable();
            $table->dateTime('ThirdDate')->nullable();
            $table->string('LettingId');
            $table->timestamps();
            $table->foreign('LettingId')->references('id')->on('lettings');
        });
    }

    public function down() {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['LettingId']);
        });
        Schema::dropIfExists("appointments");
    }

}
