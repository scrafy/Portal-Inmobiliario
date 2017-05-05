<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('photos', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('Etag', 255);
            $table->string('Name', 255)->nullable();
            $table->string('FileName', 255);
            $table->boolean("Downloaded")->default(false);
            $table->string('InspectionItem', 255);
            $table->string('InterimInspection', 255);
            $table->string('InventoryItem', 255);
            $table->string('Room', 255);
            $table->tinyInteger('PhotoNumber')->unsigned();
            $table->string('PhotoType', 255);
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
        Schema::table('photos', function($table) {
            $table->dropForeign(['PropertyId']);
        });
        Schema::dropIfExists('photos');
    }

}
