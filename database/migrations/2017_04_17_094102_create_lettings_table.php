<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLettingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('lettings', function (Blueprint $table) {
            $table->string('id', 255)->primary();
            $table->string('Etag', 255);
            $table->string('GlobalReference', 50);
            $table->boolean("IsTenancyAdvertised");
            $table->boolean("IsTenancyProposed");
            $table->dateTime("TermStart");
            $table->string('Area', 255);
            $table->integer('RentAdvertised')->unsigned();
            $table->string('RentSchedule', 255);
            $table->integer('RentRecurrence')->unsigned();
            $table->dateTime("AdvertiseFrom")->nullable();
            $table->integer('BondRequired')->unsigned();
            $table->string('Furnished', 255);
            $table->boolean("IsShareProperty");
            $table->boolean("IsStudentProperty");
            $table->tinyInteger('MinimumTenants')->unsigned();
            $table->tinyInteger('MaximumTenants')->unsigned();
            $table->tinyInteger('TermMinimum')->unsigned();
            $table->tinyInteger('TermMaximum')->unsigned();
            $table->string('PropertyId', 255)->unique();
            $table->string('BranchId', 255);
            $table->timestamps();

            /* foreign keys */
            $table->foreign('BranchId')->references('id')->on('branches');
            $table->foreign('PropertyId')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('lettings', function($table) {
            $table->dropForeign(['BranchId']);
            $table->dropForeign(['PropertyId']);
        });
        Schema::dropIfExists('lettings');
    }

}
