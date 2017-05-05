<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostcodesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('postcodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('PostCode', 255)->unique();
            $table->string('Latitude', 255);
            $table->string('Longitude', 255);
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->foreign('PostCode')->references('PostCode')->on('postcodes');
        });
        $sql = 'LOAD DATA INFILE "' . resource_path() . "/files/postcodes.csv" . '"
                INTO TABLE postcodes
                COLUMNS TERMINATED BY ","
                OPTIONALLY ENCLOSED BY "\""
                ESCAPED BY "\""
                LINES TERMINATED BY "\n"
                IGNORE 1 LINES;';

        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['PostCode']);
        });
        Schema::dropIfExists('postcodes');
    }

}
