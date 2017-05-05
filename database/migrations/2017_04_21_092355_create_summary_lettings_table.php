<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummaryLettingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('summarylettings', function (Blueprint $table) {
            $table->string('PropertyId', 50);
            $table->string('LettingId', 50);
            $table->string('ShortAddress', 255);
            $table->string('FullAddress', 255);
            $table->string('PostCode', 255);
            $table->char('PostCodeArea', 2);
            $table->string('AreaId', 255);
            $table->string('AreaName', 255);
            $table->dateTime('Start');
            $table->text('Description');
            $table->string('MainPhoto', 255)->nullable();
            $table->string('TypeProperty', 255);
            $table->decimal('Price', 11, 2);
            $table->decimal('BondRequired', 11, 2);
            $table->string('Furnished', 255);
            $table->tinyInteger('TotalKitchens')->unsigned();
            $table->tinyInteger('TotalBedrooms')->unsigned();
            $table->tinyInteger('TotalRooms')->unsigned();
            $table->tinyInteger('TotalBathrooms')->unsigned();
            $table->tinyInteger('TotalGarages')->unsigned();


            /* primary key */
            $table->primary('PropertyId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('summarylettings');
    }

}
