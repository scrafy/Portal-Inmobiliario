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
                        `a`.`PostCode` AS `PostCode`,
                        `a`.`data` AS `data`,
                        `b`.`Latitude` AS `Latitude`,
                        `b`.`Longitude` AS `Longitude`
                    FROM
                        (((SELECT 
                            `pfp`.`summarylettings`.`PostCode` AS `PostCode`,
                                GROUP_CONCAT('PropertyId=', `pfp`.`summarylettings`.`PropertyId`, ',', 'AreaName=', `pfp`.`summarylettings`.`AreaName`, ',', 'ShortAddress=', `pfp`.`summarylettings`.`ShortAddress`, ',', 'PostCode=', `pfp`.`summarylettings`.`PostCode`, ',', 'Price=', `pfp`.`summarylettings`.`Price`, ',', 'TypeProperty=', `pfp`.`summarylettings`.`TypeProperty`, ',', 'Furnished=', `pfp`.`summarylettings`.`Furnished`, ',', 'TotalBathrooms=', `pfp`.`summarylettings`.`TotalBathrooms`, ',', 'TotalBedrooms=', `pfp`.`summarylettings`.`TotalBedrooms`, ',', 'TotalGarages=', `pfp`.`summarylettings`.`TotalGarages`, ',', 'TotalKitchens=', `pfp`.`summarylettings`.`TotalKitchens`, ',', 'TotalRooms=', `pfp`.`summarylettings`.`TotalRooms`, ',', 'MainPhoto=', (CASE
                                    WHEN ISNULL(`pfp`.`summarylettings`.`MainPhoto`) THEN ''
                                    ELSE `pfp`.`summarylettings`.`MainPhoto`
                                END)
                                    SEPARATOR '*') AS `data`
                        FROM
                            `pfp`.`summarylettings`
                        GROUP BY `pfp`.`summarylettings`.`PostCode`)) `a`
                        JOIN `pfp`.`postcodes` `b` ON ((`a`.`PostCode` = `b`.`PostCode`)))";
        
        DB::connection()->getPdo()->exec($sql);
    }

    public function down() {
        $sql = "DROP VIEW IF EXISTS lettingsbypostcode";
        DB::connection()->getPdo()->exec($sql);
    }

}
