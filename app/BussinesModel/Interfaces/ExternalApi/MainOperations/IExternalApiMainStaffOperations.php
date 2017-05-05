<?php

namespace App\BussinesModel\Interfaces\ExternalApi\MainOperations;

interface IExternalApiMainStaffOperations {

    public function getStaffMembers($offset = 0, $count = 100);

    public function getStaffMember($staffid);
}
