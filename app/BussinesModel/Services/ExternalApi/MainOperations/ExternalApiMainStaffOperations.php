<?php

namespace App\BussinesModel\Services\ExternalApi\MainOperations;

use App\BussinesModel\Interfaces\ExternalApi\MainOPerations\IExternalApiMainStaffOperations;
use App\BussinesModel\Services\ExternalApi\ExternalApiService;

class ExternalApiMainStaffOperations extends ExternalApiService implements IExternalApiMainStaffOperations {

    public function getStaffMember($staffid) {
        $path = config('externalservice.external_api_links.main_operations.staff.getstaffmember');
        $path = sprintf($path, $this->tier, $this->shortname, $staffid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getStaffMembers($offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.staff.getstaffmembers');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

}
