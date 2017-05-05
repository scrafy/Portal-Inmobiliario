<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummarylettingsProcedure extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $sql = "
            CREATE PROCEDURE `sp_load_summary_lettings`()
            BEGIN

                SET SQL_SAFE_UPDATES = 0;
                truncate table summarylettings;

                insert into summarylettings
                select 
                    a.id AS PropertyId,
                    b.id AS LettingId,
                    a.RoomName AS ShortAddress,
                    a.FullAddress AS FullAddress,
                    a.PostCode AS PostCode,
                    a.PostCodeArea AS PostCodeArea,
                    a.Areaid as AreaId,
                    d.Name as AreaName,
                    b.TermStart as Start,
                    a.Description AS Description,
                    case when mainphoto.id is null then (select id from photos where PropertyId = c.PropertyId limit 1) else mainphoto.id end as MainPhoto,
                    a.PropertyType AS TypeProperty,
                    b.RentAdvertised AS Price,
                    b.BondRequired AS BondRequired,
                    b.Furnished AS Furnished,
                    case when c.total_kitchens is null then 0 else c.total_kitchens end AS TotalKitchens,
                    case when c.total_bedrooms is null then 0 else c.total_bedrooms end AS TotalBedrooms,
		    case when c.total_rooms is null then 0 else c.total_rooms end AS TotalRooms,
                    case when c.total_bathrooms is null then 0 else c.total_bathrooms end AS TotalBathrooms,
                    case when c.total_garages is null then 0 else c.total_garages end AS TotalGarages
                    from properties a
                    inner join areas d on d.id = a.AreaId
                    inner join lettings b on a.id = b.PropertyId
                    left join photos mainphoto on mainphoto.id = a.MainPhoto
                    left join
                    (
                            select 
                            a.PropertyId,
                            sum(a.total_kitchens) as total_kitchens,
                            sum(a.total_bedrooms) as total_bedrooms,
                            sum(a.total_rooms) as total_rooms,
                            sum(a.total_bathrooms) as total_bathrooms,
                            sum(a.total_garages) as total_garages
                            from
                            (
                                    select 
                                    a.PropertyId,
                                    if((LOWER(RoomName) REGEXP '(kitchen)'=1),1,0) as total_kitchens,
                                    if((LOWER(RoomName) REGEXP '(bedroom)'=1),1,0) as total_bedrooms,
                                    if((LOWER(RoomName) REGEXP '^.* room$'=1),1,0) as total_rooms,
                                    if((LOWER(RoomName) REGEXP '(bathroom|wc|shower|sauna|toilet)'=1),1,0) as total_bathrooms,
                                    if((LOWER(RoomName) REGEXP '(garage)'=1),1,0) as total_garages
                                    from rooms a

                            ) a group by a.PropertyId

                    ) c on c.PropertyId = a.id;

                SET SQL_SAFE_UPDATES = 1;

            END";


        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        $sql = "DROP PROCEDURE IF EXISTS sp_load_summary_lettings";
        DB::connection()->getPdo()->exec($sql);
    }

}
