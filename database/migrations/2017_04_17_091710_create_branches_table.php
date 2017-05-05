<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('branches', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('Etag', 255);
            $table->string('Name', 255);
            $table->string('CompanyName', 255);
            $table->string('Address1', 255);
            $table->string('Address2', 255)->nullable();
            $table->string('Address3', 255)->nullable();
            $table->string('Address4', 255)->nullable();
            $table->string('PostCode', 10);
            $table->string('WebAddress', 50)->nullable();
            $table->string('EmailAddress', 50)->nullable();
            $table->string('LandPhone', 255);
            $table->string('FaxPhone', 255)->nullable();
            $table->string('County', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('branches');
    }

}
