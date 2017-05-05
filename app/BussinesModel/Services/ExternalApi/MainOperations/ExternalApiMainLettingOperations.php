<?php

namespace App\BussinesModel\Services\ExternalApi\MainOperations;

use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainLettingOperations;
use App\BussinesModel\Services\ExternalApi\ExternalApiService;
use App\Models\InputModels\ExternalApi\MainOperations\AdvertModel;
use \App\Models\InputModels\ExternalApi\MainOperations\AdvertBetweenDateModel;

class ExternalApiMainLettingOperations extends ExternalApiService implements IExternalApiMainLettingOperations {

    public function getLettings(AdvertModel $search, $offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.letting.getlettings');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s&", $offset, $count, $this->api_key);
        foreach ($search as $property => &$value) {
            if ($value !== null) {
                $value = gettype($value) === "boolean" ? $value ? "true" : "false" : $value;
                $querystring .= "$property=$value&";
            }
        }
        $querystring = substr($querystring, 0, -1);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getLettingsBetweenDates(AdvertBetweenDateModel $search, $offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.letting.getlettingsdates');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s&", $offset, $count, $this->api_key);
        foreach ($search as $property => &$value) {
            if ($value !== null) {
                $value = gettype($value) === "boolean" ? $value ? "true" : "false" : $value;
                $querystring .= "$property=$value&";
            }
        }
        $querystring = substr($querystring, 0, -1);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getBrochure($tenancyid) {
        $path = config('externalservice.external_api_links.main_operations.letting.getbrochure');
        $path = sprintf($path, $this->tier, $this->shortname, $tenancyid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        return $final_link;
    }

    public function getTenancies($offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.letting.gettenancies');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getTenancyById($tenancyid) {
        $path = config('externalservice.external_api_links.main_operations.letting.gettenancy');
        $path = sprintf($path, $this->tier, $this->shortname, $tenancyid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

}
