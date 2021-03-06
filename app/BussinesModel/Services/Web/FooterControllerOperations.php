<?php

namespace App\BussinesModel\Services\Web;

use App\BussinesModel\Interfaces\Web\IFooterOperations;
use \App\Models\InputModels\Web\Footer\ContactMessage;
use App\Models\OutputModels\JsonResponseModel;


class FooterControllerOperations extends WebControllersOperations implements IFooterOperations {

    public function __construct() {
        parent::__construct();
    }

    public function SendContactMessage(ContactMessage $message) {
        $resp = new JsonResponseModel();
        try {
            if ($message->Validate()) {
                \Mail::send('mailtemplates.contact-form', ['data' => $message], function ($_message) use($message){
                    $_message->subject($message->Subject);
                    $_message->to(config("mail.from.address"), config("mail.from.address.name"));
                    $_message->from(config("mail.from.address"), config("mail.from.address.name"));
                });
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
