<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BussinesModel\Interfaces\Web\ILettingOperations;
use App\Models\InputModels\Web\Letting\Appointment;

class LettingController extends Controller {

    private $service;

    public function __construct(ILettingOperations $service) {

        $this->service = $service;
    }

    public function View($id) {

        return view('letting.letting')->with("data", $this->service->GetViewData($id));
    }

    public function GetEpcReport($id) {
        return $this->service->GetEpcReport($id);
    }

    public function GetBrochure($id) {
        return $this->service->GetBrochure($id);
    }

    public function FilterLettings(Request $request) {
        return view('home.home')->with("data", $this->service->GetLettingsFilteredData($request));
    }

    public function CreateAppointment(Appointment $appointment) {
        return $this->service->CreateAppointment($appointment);
    }

    public function GetMapInformation($postcode = null) {
        return $this->service->GetMapInformation($postcode);
    }

    public function GetLatLongFromPostCode($postcode) {
        return $this->service->GetLatLongFromPostCode($postcode);
    }

}
