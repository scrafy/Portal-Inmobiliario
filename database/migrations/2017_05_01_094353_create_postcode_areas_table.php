<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostcodeAreasTable extends Migration {

    public function up() {
        Schema::create('postcode_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('area', 255);
            $table->char('postcode_area', 2)->unique();
            $table->timestamps();
        });
        Schema::table('properties', function($table) {
            $table->foreign('PostCodeArea')->references('postcode_area')->on('postcode_areas');
        });
    }

    public function down() {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['PostCodeArea']);
        });
        Schema::dropIfExists("postcode_areas");
    }

}
