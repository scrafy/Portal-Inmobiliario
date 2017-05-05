<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainAreaOperations;
use App\Http\Controllers\ExternalApi\ExternalApiController;

class AreaController extends ExternalApiController {

    private $service;

    public function __construct(Request $request, IExternalApiMainAreaOperations $_service) {
        $this->setPaginationValues($request);
        $this->service = $_service;
    }

    public function getAreas() {
        return response()->json($this->setResponseModel($this->service->getAreas($this->offset, $this->count)));
    }

    public function getAreaById($areaid) {
        return response()->json($this->setResponseModel($this->service->getArea($areaid)));
    }

}
