<?php

namespace App\Models\ExternalApi;

use App\Models\BaseModel;
use App\Models\ExternalApi\Photo;
use App\Models\ExternalApi\Room;

class SummaryLetting extends BaseModel {

    protected $table = 'summarylettings';
    protected $primarykey = 'PropertyId';
    public $incrementing = false;
    protected $fillable = [
        'PropertyId', 'LettingId', 'ShortAddress', 'FullAddress', 'PostCode', 'PostCodeArea', 'AreaId', 'AreaName',
        'Start', 'Description', 'MainPhoto', 'TypeProperty', 'Price', 'BondRequired', 'Furnished', 'TotalKitchens',
        'TotalBedrooms', 'TotalBathrooms', 'TotalGarages'
    ];

    public function getPhotos() {
        return Photo::where('PropertyId', $this->PropertyId)->get();
    }

    public function getPhoto($id) {
        return Photo::where('id', $id)->first();
    }

    public function getRooms() {
        return Room::where('PropertyId', $this->PropertyId)->get();
    }

    public function getRoom($id) {
        return Room::where('id', $id)->first();
    }

    public static function getPropertiesFiltered($parameters = []) {
        $result = null;
        $sort = false;
        $page = 1;
        $records_x_page = config("myparametersconfig.records_x_page");
        $resp = [];
        foreach ($parameters as $key => &$value) {
            switch ($key) {
                case "type_property":
                    $result = $result === null ? SummaryLetting::orWhereIn("TypeProperty", $value) : $result->orWhereIn("TypeProperty", $value);
                    break;
                case "sortby":
                    $sort = true;
                    break;
                case "minprice":
                    $result = $result === null ? SummaryLetting::where("Price", ">=", $value) : $result->where("Price", ">=", $value);
                    break;
                case "maxprice":
                    $result = $result === null ? SummaryLetting::where("Price", "<=", $value) : $result->where("Price", "<=", $value);
                    break;
                case "numbeds":
                    $result = $result === null ? SummaryLetting::where("TotalBedrooms", ">=", $value) : $result->where("TotalBedrooms", ">=", $value);
                    break;
                case "furnished":
                    $result = $result === null ? SummaryLetting::where("Furnished","=", [$value]) : $result->where("Furnished","=", [$value]);
                    break;
                case "page":
                    $page = $value;
                    break;
                case "records_x_page":
                    $records_x_page = $value;
                    break;
                case "area":
                    $result = $result === null ? SummaryLetting::where("AreaId", "=", $value) : $result->where("AreaId", "=", $value);
                    break;
            }
        }
        if ($result !== null) {
            $resp['total_records'] = $result->count("*");
            if ($sort) {
                switch ($parameters['sortby']) {
                    case "pricelowtohigh":
                        $result = $result->orderBy("Price", "asc");
                        break;
                    case "pricehightolow":
                        $result = $result->orderBy("Price", "desc");
                        break;
                }
            }
            //echo $result->toSql();
            //exit;
            $result = $result->simplePaginate($records_x_page, ['*'], null, $page);
            $resp['data'] = $result->toArray()['data'];
        } else {
            $resp['total_records'] = 0;
            $resp['data'] = null;
        }
        return $resp;
    }

}
