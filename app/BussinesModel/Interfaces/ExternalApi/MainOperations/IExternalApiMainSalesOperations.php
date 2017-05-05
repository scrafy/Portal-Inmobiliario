<?php

namespace App\BussinesModel\Interfaces\ExternalApi\MainOperations;

use \App\Models\InputModels\ExternalApi\MainOperations\SaleAdvertisedModel;

interface IExternalApiMainSalesOperations {

    public function getAdvertisedSales(SaleAdvertisedModel $search, $offset = 0, $count = 100);

    public function getEnergyReport($instructionid);

    public function getEnvironmentalReport($instructionid);

    public function getSalesFeatureTypes($offset = 0, $count = 100);

    public function getSalesFeatureType($sales_featureid);

    public function getSalesInstructions($offset = 0, $count = 100);

    public function getSalesInstruction($sale_instructionid);

    public function getSalesInstructionsFeatures($sale_instructionid, $offset = 0, $count = 100);

    public function getSalesInstructionsFloorPlans($sale_instructionid, $offset = 0, $count = 100);

    public function getSalesInstructionsPhotos($sale_instructionid, $offset = 0, $count = 100);

    public function getSalesInstructionsRooms($sale_instructionid, $offset = 0, $count = 100);
}
