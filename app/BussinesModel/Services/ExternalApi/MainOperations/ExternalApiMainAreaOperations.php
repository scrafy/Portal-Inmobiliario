<?php

namespace App\BussinesModel\Services\ExternalApi\MainOperations;

use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainAreaOperations;
use App\BussinesModel\Services\ExternalApi\ExternalApiService;

class ExternalApiMainAreaOperations extends ExternalApiService implements IExternalApiMainAreaOperations {

    public function getArea($areaid) {
        $path = config('externalservice.external_api_links.main_operations.area.getarea');
        $path = sprintf($path, $this->tier, $this->shortname, $areaid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getAreas($offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.area.getareas');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

}
