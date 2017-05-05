<?php

namespace App\BussinesModel\Services\ExternalApi\MainOperations;

use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainBranchOperations;
use App\BussinesModel\Services\ExternalApi\ExternalApiService;

class ExternalApiMainBranchOperations extends ExternalApiService implements IExternalApiMainBranchOperations {

    public function getBranch($branchid) {
        $path = config('externalservice.external_api_links.main_operations.branch.getbranch');
        $path = sprintf($path, $this->tier, $this->shortname, $branchid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getBranches($offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.branch.getbranches');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

}
