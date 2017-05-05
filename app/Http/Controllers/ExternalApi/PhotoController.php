<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainPhotoOperations;
use App\Http\Controllers\ExternalApi\ExternalApiController;

class PhotoController extends ExternalApiController {

    private $service;

    public function __construct(Request $request, IExternalApiMainPhotoOperations $_service) {
        $this->setPaginationValues($request);
        $this->service = $_service;
    }

    public function getPhotos() {
        return response()->json($this->setResponseModel($this->service->getPhotos($this->offset, $this->count)));
    }

    public function getPhotoById($photoid) {
        return response()->json($this->setResponseModel($this->service->getPhoto($photoid)));
    }

    public function DownLoad($photoid) {
        return response(($this->service->DownloadPhoto($photoid)))->withHeaders(['Content-type' => 'image/jpg']);
    }

}
