<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainPropertyOperations;
use App\Http\Controllers\ExternalApi\ExternalApiController;

class PropertyController extends ExternalApiController {

    private $service;

    public function __construct(Request $request, IExternalApiMainPropertyOperations $_service) {
        $this->setPaginationValues($request);
        $this->service = $_service;
    }

    public function getProperties() {
        return response()->json($this->setResponseModel($this->service->getProperties($this->offset, $this->count)));
    }

    public function getPropertyById($propertyid) {
        return response()->json($this->setResponseModel($this->service->getProperty($propertyid)));
    }

    public function getFacilities($propertyid) {
        return response()->json($this->setResponseModel($this->service->getFacilities($propertyid, $this->offset, $this->count)));
    }

    public function getPhotos($propertyid) {
        return response()->json($this->setResponseModel($this->service->getPhotos($propertyid, $this->offset, $this->count)));
    }

    public function getRooms($propertyid) {
        return response()->json($this->setResponseModel($this->service->getRooms($propertyid, $this->offset, $this->count)));
    }

    public function getEnergyReport($propertyid) {
        return response(($this->service->getEnergyEfficiencyReport($propertyid)))->withHeaders(['Content-type' => 'image/jpg']);
    }

    public function getEnvironmentalReport($propertyid) {
        return response(($this->service->getEnvironmentalReport($propertyid)))->withHeaders(['Content-type' => 'image/jpg']);
    }

}
