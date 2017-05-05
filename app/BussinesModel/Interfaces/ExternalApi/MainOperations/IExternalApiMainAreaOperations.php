<?php

namespace App\BussinesModel\Interfaces\ExternalApi\MainOperations;

interface IExternalApiMainAreaOperations {

    public function getAreas($offset = 0, $count = 100);

    public function getArea($areaid);
}
