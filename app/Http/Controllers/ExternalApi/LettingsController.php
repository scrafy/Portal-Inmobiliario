<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainLettingOperations;
use App\Http\Controllers\ExternalApi\ExternalApiController;
use App\Models\InputModels\ExternalApi\MainOperations\AdvertModel;
use App\Models\InputModels\ExternalApi\MainOperations\AdvertBetweenDateModel;

class LettingsController extends ExternalApiController {

    private $service;

    public function __construct(Request $request, IExternalApiMainLettingOperations $_service) {
        $this->setPaginationValues($request);
        $this->service = $_service;
    }

    public function getLettings(AdvertModel $search) {
        if ($search->Validate()) {
            return response()->json($this->setResponseModel($this->service->getLettings($search, $this->offset, $this->count)));
        } else {
            return response()->json($this->setResponseValidationErrors($search->getValidationErrors()));
        }
    }

    public function getLettingsBetweenDates(AdvertBetweenDateModel $search) {
        if ($search->Validate()) {
            return response()->json($this->setResponseModel($this->service->getLettingsBetweenDates($search, $this->offset, $this->count)));
        } else {
            return response()->json($this->setResponseValidationErrors($search->getValidationErrors()));
        }
    }

    public function getTenancies() {
        return response()->json($this->setResponseModel($this->service->getTenancies($this->offset, $this->count)));
    }

    public function getTenancyById($tenancyid) {
        return response()->json($this->setResponseModel($this->service->getTenancyById($tenancyid)));
    }

    public function getBrochure($tenancyid) {
        return response(file_get_contents($this->service->getBrochure($tenancyid)))->withHeaders(['Content-type' => 'application/pdf', 'Content-Disposition' => 'inline; filename=brochure.pdf']);
    }

}
