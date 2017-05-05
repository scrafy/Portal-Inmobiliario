<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainCountyOperations;
use App\Http\Controllers\ExternalApi\ExternalApiController;

class CountyController extends ExternalApiController {

    private $service;

    public function __construct(Request $request, IExternalApiMainCountyOperations $_service) {
        $this->setPaginationValues($request);
        $this->service = $_service;
    }

    public function getCounties() {
        return response()->json($this->setResponseModel($this->service->getCounties($this->offset, $this->count)));
    }

    public function getCountyBranches($countyid) {
        return response()->json($this->setResponseModel($this->service->getCountyBranches($countyid, $this->offset, $this->count)));
    }

    public function getCountyById($countyid) {
        return response()->json($this->setResponseModel($this->service->getCounty($countyid)));
    }

}
