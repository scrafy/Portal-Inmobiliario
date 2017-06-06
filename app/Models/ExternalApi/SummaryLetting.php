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
    
    public function getLettings($options) {
        $lettings = null;
        $key = $this->getKeyFromOptions($options);
        if ($this->cache_service->hasKey($key)) {
            $lettings = $this->cache_service->getValue($key);
        } else {
            $lettings = SummaryLetting::orderBy($options['orderby'], $options['direction'])->simplePaginate($options['records_x_page'], ['*'], null, $options['page'])->toArray()['data'];
            $this->cache_service->setValue($key, $lettings);
        }
        return $lettings;
    }

    public function getLettingsFiltered($parameters = [], $cache_key = null) {
        
        if ($cache_key != null) {
            if ($this->cache_service->hasKey($cache_key)) {
                return $this->cache_service->getValue($cache_key);
            }
        }
        $result = null;
        $sort = false;
        $page = 1;
        $records_x_page = config("myparametersconfig.records_x_page");
        $resp = [];
        foreach ($parameters as $key => &$value) {
            switch ($key) {
                case "type_property":
                    $result = $result === null ? SummaryLetting::WhereIn("TypeProperty", $value) : $result->WhereIn("TypeProperty", $value);
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
                    $result = $result === null ? SummaryLetting::WhereIn("AreaId", $value) : $result->WhereIn("AreaId", $value);
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
            }else{
                $result = $result->orderBy("Price", "asc");
            }
            $result = $result->simplePaginate($records_x_page, ['*'], null, $page);
            $resp['data'] = $result->toArray()['data'];
        } else {
            $resp['total_records'] = 0;
            $resp['data'] = null;
        }
        if ($cache_key != null) {
            $this->cache_service->setValue($cache_key, $resp);
        }
        return $resp;
    }

}
