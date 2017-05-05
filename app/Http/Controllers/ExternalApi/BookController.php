<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainBookOperations;
use App\Http\Controllers\ExternalApi\ExternalApiController;
use App\Models\InputModels\ExternalApi\MainOperations\BookModel;
use App\Models\InputModels\ExternalApi\MainOperations\ViewBookModel;

class BookController extends ExternalApiController {

    private $service;

    public function __construct(Request $request, IExternalApiMainBookOperations $_service) {
        $this->setPaginationValues($request);
        $this->service = $_service;
    }

    public function getBooks(ViewBookModel $search) {
        if ($search->Validate()) {
            return response()->json($this->setResponseModel($this->service->getBooks($search)));
        } else {
            return response()->json($this->setResponseValidationErrors($search->getValidationErrors()));
        }
    }

    public function getBook(BookModel $search) {
        if ($search->Validate()) {
            return response()->json($this->setResponseModel($this->service->getBook($search)));
        } else {
            return response()->json($this->setResponseValidationErrors($search->getValidationErrors()));
        }
    }

}
