<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLettingsbypostcodeView extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $sql = "CREATE 
                ALGORITHM = UNDEFINED 
                DEFINER = `root`@`%` 
                SQL SECURITY DEFINER
                VIEW `lettingsbypostcode` AS
                    SELECT 
                        `summarylettings`.`PostCode` AS `PostCode`,
                        GROUP_CONCAT('PropertyId=',
                            `summarylettings`.`PropertyId`,
                            ',',
                            'AreaName=',
                            `summarylettings`.`AreaName`,
                            ',',
                            'ShortAddress=',
                            `summarylettings`.`ShortAddress`,
                            ',',
                            'PostCode=',
                            `summarylettings`.`PostCode`,
                            ',',
                            'PostCodeArea=',
                            `postcodeareas`.`area`,
                            ',',
                            'Price=',
                            `summarylettings`.`Price`,
                            ',',
                            'TypeProperty=',
                            `summarylettings`.`TypeProperty`,
                            ',',
                            'Furnished=',
                            `summarylettings`.`Furnished`,
                            ',',
                            'TotalBathrooms=',
                            `summarylettings`.`TotalBathrooms`,
                            ',',
                            'TotalBedrooms=',
                            `summarylettings`.`TotalBedrooms`,
                            ',',
                            'TotalGarages=',
                            `summarylettings`.`TotalGarages`,
                            ',',
                            'TotalKitchens=',
                            `summarylettings`.`TotalKitchens`,
                            ',',
                            'TotalRooms=',
                            `summarylettings`.`TotalRooms`,
                            ',',
                            'MainPhoto=',
                            (CASE
                                WHEN ISNULL(`summarylettings`.`MainPhoto`) THEN ''
                                ELSE `summarylettings`.`MainPhoto`
                            END)
                            SEPARATOR '*') AS `data`
                    FROM
                        (`summarylettings`
                        JOIN `postcode_areas` `postcodeareas` ON ((`summarylettings`.`PostCodeArea` = `postcodeareas`.`postcode_area`)))
                    GROUP BY `summarylettings`.`PostCode`";
        DB::connection()->getPdo()->exec($sql);
    }

    public function down() {
        $sql = "DROP VIEW IF EXISTS lettingsbypostcode";
        DB::connection()->getPdo()->exec($sql);
    }

}
