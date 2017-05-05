<?php

namespace App\BussinesModel\Services\ExternalApi\MainOperations;

use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainCountyOperations;
use App\BussinesModel\Services\ExternalApi\ExternalApiService;

class ExternalApiMainCountyOperations extends ExternalApiService implements IExternalApiMainCountyOperations {

    public function getCounties($offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.county.getcounties');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getCounty($countyid) {
        $path = config('externalservice.external_api_links.main_operations.county.getcounty');
        $path = sprintf($path, $this->tier, $this->shortname, $countyid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getCountyBranches($countyid, $offset = 0, $count = 100) {
        $path = config('externalservice.external_api_links.main_operations.county.getcountybranches');
        $path = sprintf($path, $this->tier, $this->shortname, $countyid);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

}
