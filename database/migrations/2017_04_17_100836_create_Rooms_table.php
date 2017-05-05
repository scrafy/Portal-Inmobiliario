<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('rooms', function (Blueprint $table) {
            $table->string('id', 255)->primary();
            $table->string('Etag', 255);
            $table->string('GlobalReference', 255);
            $table->string('RoomName', 255);
            $table->text('Description');
            $table->string('MainPhoto', 255);
            $table->string('RoomFloor', 255);
            $table->tinyInteger('HeightCentimeters')->unsigned()->nullable();
            $table->tinyInteger('HeightMeters')->unsigned()->nullable();
            $table->tinyInteger('LengthCentimeters')->unsigned()->nullable();
            $table->tinyInteger('LengthMeters')->unsigned()->nullable();
            $table->tinyInteger('WidthCentiMeters')->unsigned()->nullable();
            $table->tinyInteger('WidthMeters')->unsigned()->nullable();
            $table->string('PropertyId', 255);
            $table->timestamps();

            /* foreign keys */
            $table->foreign('PropertyId')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('rooms', function($table) {
            $table->dropForeign(['PropertyId']);
        });
        Schema::dropIfExists('rooms');
    }

}
