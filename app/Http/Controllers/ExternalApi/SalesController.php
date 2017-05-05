<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainSalesOperations;
use App\Http\Controllers\ExternalApi\ExternalApiController;
use App\Models\InputModels\ExternalApi\MainOperations\SaleAdvertisedModel;

class SalesController extends ExternalApiController {

    private $service;

    public function __construct(Request $request, IExternalApiMainSalesOperations $_service) {
        $this->setPaginationValues($request);
        $this->service = $_service;
    }

    public function getAdvertisedSales(SaleAdvertisedModel $search) {
        if ($search->Validate()) {
            return response()->json($this->setResponseModel($this->service->getAdvertisedSales($search, $this->offset, $this->count)));
        } else {
            return response()->json($this->setResponseValidationErrors($search->getValidationErrors()));
        }
    }

    public function getEnergyReport($instructionid) {
        return response(($this->service->getEnergyReport($instructionid)))->withHeaders(['Content-type' => 'image/jpg']);
    }

    public function getEnvironmentalReport($instructionid) {
        return response(($this->service->getEnvironmentalReport($instructionid)))->withHeaders(['Content-type' => 'image/jpg']);
    }

    public function getSalesFeatureTypes() {
        return response()->json($this->setResponseModel($this->service->getSalesFeatureTypes($this->offset, $this->count)));
    }

    public function getSalesFeatureType($featureid) {
        return response()->json($this->setResponseModel($this->service->getSalesFeatureType($featureid)));
    }

    public function getSalesInstructions() {
        return response()->json($this->setResponseModel($this->service->getSalesInstructions($this->offset, $this->count)));
    }

    public function getSalesInstruction($instructionid) {
        return response()->json($this->setResponseModel($this->service->getSalesInstruction($instructionid)));
    }

    public function getSalesInstructionsFeatures($instructionid) {
        return response()->json($this->setResponseModel($this->service->getSalesInstructionsFeatures($instructionid, $this->offset, $this->count)));
    }

    public function getSalesInstructionsFloorPlans($instructionid) {
        return response()->json($this->setResponseModel($this->service->getSalesInstructionsFloorPlans($instructionid, $this->offset, $this->count)));
    }

    public function getSalesInstructionsPhotos($instructionid) {
        return response()->json($this->setResponseModel($this->service->getSalesInstructionsPhotos($instructionid, $this->offset, $this->count)));
    }

    public function getSalesInstructionsRooms($instructionid) {
        return response()->json($this->setResponseModel($this->service->getSalesInstructionsRooms($instructionid, $this->offset, $this->count)));
    }

}
