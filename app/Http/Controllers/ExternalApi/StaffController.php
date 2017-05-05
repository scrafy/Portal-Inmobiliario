<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainStaffOperations;
use App\Http\Controllers\ExternalApi\ExternalApiController;

class StaffController extends ExternalApiController {

    private $service;

    public function __construct(Request $request, IExternalApiMainStaffOperations $_service) {
        $this->setPaginationValues($request);
        $this->service = $_service;
    }

    public function getStaffs() {
        return response()->json($this->setResponseModel($this->service->getStaffMembers($this->offset, $this->count)));
    }

    public function getStaffById($staffid) {
        return response()->json($this->setResponseModel($this->service->getStaffMember($staffid)));
    }

}
