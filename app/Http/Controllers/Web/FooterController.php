<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\ExternalApi\SummaryLetting;
use App\Models\ExternalApi\Property;
use App\Models\ExternalApi\PostCodeArea;
use App\Models\InputModels\Web\Footer\ContactMessage;
use App\Models\OutputModels\JsonResponseModel;

class FooterController extends Controller {

    public function SendContactMessage(ContactMessage $message) {
        $resp = new JsonResponseModel();
        try {
            if ($message->Validate()) {
                $resp->content = "ok";
                return response()->json($resp);
            } else {
                $resp->error = "validation_errors";
                $resp->validation_errors = $message->getValidationErrors();
            }
        } catch (\Exception $ex) {
            $resp->error = $ex->getMessage();
            $resp->stack_trace = $ex->getTrace();
        }
        return response()->json($resp);
    }

}
