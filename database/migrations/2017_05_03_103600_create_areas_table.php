<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration {

    public function up() {
        Schema::create('areas', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('Name', 255);
            $table->boolean('ShowInWeb');
            $table->string('BranchId', 50);
            $table->timestamps();
            $table->foreign('BranchId')->references('id')->on('branches');
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->foreign('AreaId')->references('id')->on('areas');
        });
    }

    public function down() {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['AreaId']);
        });
        Schema::table('areas', function (Blueprint $table) {
            $table->dropForeign(['BranchId']);
        });
        Schema::dropIfExists("areas");
    }

}
