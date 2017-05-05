<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\OutputModels\JsonResponseModel;

class ExternalApiController extends Controller {

    protected $count;
    protected $offset;

    protected function setPaginationValues($request) {
        $num_records = config('externalservice.num_max_records');
        $this->count = $request->get("count") ? $request->get("count") : $num_records;
        $this->offset = $request->get("offset") ? $request->get("offset") : 0;
        $this->count = is_numeric($this->count) ? $this->count : $num_records;
        $this->offset = is_numeric($this->offset) ? $this->offset : 0;
    }

    protected function setResponseModel($resp) {
        $json_response = new JsonResponseModel();
        $pagination = new \stdClass();
        if (property_exists($resp, "Count")) {
            if ($resp->Count > 0) {
                $json_response->content = $resp->Data;
                $pagination->total_records = $resp->Count;
                $pagination->records_x_page = $this->count;
                $pagination->num_pages = $resp->Count % $this->count == 0 ? $resp->Count / $this->count : intval(($resp->Count / $this->count)) + 1;
                $json_response->pagination = $pagination;
            } else {
                $pagination->total_records = 0;
                $pagination->records_x_page = $this->count;
                $pagination->num_pages = 0;
                $json_response->content = $resp->Data;
                $json_response->pagination = $pagination;
            }
        } else {
            $json_response->content = $resp;
            $json_response->pagination = null;
        }
        return $json_response;
    }

    protected function setResponseValidationErrors($validation_errors) {
        $json_response = new JsonResponseModel();
        $json_response->pagination = null;
        $json_response->validation_errors = $validation_errors;
        return $json_response;
    }

}
