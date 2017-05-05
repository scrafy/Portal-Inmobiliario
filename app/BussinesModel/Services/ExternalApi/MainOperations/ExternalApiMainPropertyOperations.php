<?php

namespace App\BussinesModel\Services\ExternalApi\MainOperations;

use App\BussinesModel\Interfaces\ExternalApi\MainOPerations\IExternalApiMainPropertyOperations;
use App\BussinesModel\Services\ExternalApi\ExternalApiService;

class ExternalApiMainPropertyOperations extends ExternalApiService implements IExternalApiMainPropertyOperations {

    public function getEnergyEfficiencyReport($propertyid) {
        $path = config('externalservice.external_api_links.main_operations.property.getenergyefficiencyreport');
        $path = sprintf($path, $this->tier, $this->shortname, $propertyid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link, null, true);
        return $result;
    }

    public function getEnvironmentalReport($propertyid) {
        $path = config('externalservice.external_api_links.main_operations.property.getenvironmentalreport');
        $path = sprintf($path, $this->tier, $this->shortname, $propertyid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link, null, true);
        return $result;
    }

    public function getFacilities($propertyid, $offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.property.getfacilities');
        $path = sprintf($path, $this->tier, $this->shortname, $propertyid);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getPhotos($propertyid, $offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.property.getphotos');
        $path = sprintf($path, $this->tier, $this->shortname, $propertyid);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getProperties($offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.property.getproperties');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getProperty($propertyid) {
        $path = config('externalservice.external_api_links.main_operations.property.getproperty');
        $path = sprintf($path, $this->tier, $this->shortname, $propertyid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getRooms($propertyid, $offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.property.getrooms');
        $path = sprintf($path, $this->tier, $this->shortname, $propertyid);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

}
