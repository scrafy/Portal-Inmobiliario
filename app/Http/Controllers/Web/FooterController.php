<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\InputModels\Web\Footer\ContactMessage;
use App\Models\OutputModels\JsonResponseModel;
use App\BussinesModel\Interfaces\Web\IFooterOperations;

class FooterController extends Controller {

    private $service = null;

    public function __construct(IFooterOperations $service) {
        $this->service = $service;
    }

    public function SendContactMessage(ContactMessage $message) {
        return $this->service->SendContactMessage($message);
    }

}
