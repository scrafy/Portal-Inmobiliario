<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('properties', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('Etag', 255);
            $table->string('GlobalReference', 255);
            $table->string('RoomName', 50);
            $table->string('FullAddress', 255);
            $table->string('PostCode', 255);
            $table->char('PostCodeArea', 2);
            $table->string('AreaId', 255);
            $table->Text('Description');
            $table->string('PropertySource', 255);
            $table->string('MainPhoto', 255);
            $table->string('PropertyType', 255);
            $table->string('BranchId', 255);
            $table->timestamps();

            /* foreign keys */
            $table->foreign('BranchId')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('properties', function($table) {
            $table->dropForeign(['BranchId']);
        });
        Schema::dropIfExists('properties');
    }

}
