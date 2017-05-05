<?php

namespace App\BussinesModel\Interfaces\ExternalApi\MainOperations;

interface IExternalApiMainBranchOperations {

    public function getBranches($offset = 0, $count = 100);

    public function getBranch($branchid);
}
