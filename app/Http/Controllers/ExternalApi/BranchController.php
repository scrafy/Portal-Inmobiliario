<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainBranchOperations;
use App\Http\Controllers\ExternalApi\ExternalApiController;

class BranchController extends ExternalApiController {

    private $service;

    public function __construct(Request $request, IExternalApiMainBranchOperations $_service) {
        $this->setPaginationValues($request);
        $this->service = $_service;
    }

    public function getBranches() {
        return response()->json($this->setResponseModel($this->service->getBranches($this->offset, $this->count)));
    }

    public function getBranchById($branchid) {
        return response()->json($this->setResponseModel($this->service->getBranch($branchid)));
    }

}
