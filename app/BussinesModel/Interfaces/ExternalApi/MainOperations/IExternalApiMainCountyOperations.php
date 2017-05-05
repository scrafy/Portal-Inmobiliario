<?php

namespace App\BussinesModel\Interfaces\ExternalApi\MainOperations;

interface IExternalApiMainCountyOperations {

    public function getCounties($offset = 0, $count = 100);

    public function getCounty($countyid);

    public function getCountyBranches($countyid, $offset = 0, $count = 100);
}
