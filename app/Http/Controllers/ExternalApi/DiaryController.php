<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainDiaryOperations;
use App\Http\Controllers\ExternalApi\ExternalApiController;

class DiaryController extends ExternalApiController {

    private $service;

    public function __construct(Request $request, IExternalApiMainDiaryOperations $_service) {
        $this->setPaginationValues($request);
        $this->service = $_service;
    }

    public function getAllocations() {
        return response()->json($this->setResponseModel($this->service->getAllocations($this->offset, $this->count)));
    }

    public function getAllocationById($allocationid) {
        return response()->json($this->setResponseModel($this->service->getAllocation($allocationid)));
    }

    public function getAppointments() {
        return response()->json($this->setResponseModel($this->service->getAppointments($this->offset, $this->count)));
    }

    public function getAppointmentById($appointmentid) {
        return response()->json($this->setResponseModel($this->service->getAppointment($appointmentid)));
    }

    public function getAppointmentTypes() {
        return response()->json($this->setResponseModel($this->service->getAppointmentTypes($this->offset, $this->count)));
    }

    public function getAppointmentTypeById($appointmentid) {
        return response()->json($this->setResponseModel($this->service->getAppointmentType($appointmentid)));
    }

}
