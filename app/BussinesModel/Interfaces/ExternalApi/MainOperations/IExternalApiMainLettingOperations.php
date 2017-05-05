<?php

namespace App\BussinesModel\Interfaces\ExternalApi\MainOperations;

use App\Models\InputModels\ExternalApi\MainOperations\AdvertModel;
use App\Models\InputModels\ExternalApi\MainOperations\AdvertBetweenDateModel;

interface IExternalApiMainLettingOperations {

    public function getLettings(AdvertModel $search, $offset = 0, $count = 100);

    public function getLettingsBetweenDates(AdvertBetweenDateModel $search, $offset = 0, $count = 100);

    public function getTenancies($offset = 0, $count = 100);

    public function getTenancyById($tenancyid);

    public function getBrochure($tenancyid);
}
