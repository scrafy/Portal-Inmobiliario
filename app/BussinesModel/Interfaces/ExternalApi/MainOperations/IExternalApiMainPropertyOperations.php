<?php

namespace App\BussinesModel\Interfaces\ExternalApi\MainOperations;

interface IExternalApiMainPropertyOperations {

    public function getProperties($offset = 0, $count = 100);

    public function getProperty($propertyid);

    public function getFacilities($propertyid, $offset = 0, $count = 100);

    public function getPhotos($propertyid, $offset = 0, $count = 100);

    public function getRooms($propertyid, $offset = 0, $count = 100);

    public function getEnergyEfficiencyReport($propertyid);

    public function getEnvironmentalReport($propertyid);
}
