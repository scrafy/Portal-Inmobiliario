<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLettingsTenantSystemTypesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('letting_tenantsystemtype', function (Blueprint $table) {
            $table->integer('tenantsystemtype_id')->unsigned();
            $table->string('letting_id', 50);

            /* primary key */
            $table->primary(['tenantsystemtype_id', 'letting_id']);

            /* foreign keys */
            $table->foreign('letting_id')->references('id')->on('lettings');
            $table->foreign('tenantsystemtype_id')->references('id')->on('tenantsystemtypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('letting_tenantsystemtype', function($table) {
            $table->dropForeign(['letting_id']);
            $table->dropForeign(['tenantsystemtype_id']);
        });
        Schema::dropIfExists('letting_tenantsystemtype');
    }

}
