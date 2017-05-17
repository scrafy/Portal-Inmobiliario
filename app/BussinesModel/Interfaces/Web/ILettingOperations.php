<?php

namespace App\BussinesModel\Interfaces\Web;
use App\Models\InputModels\Web\Letting\Appointment;
use Illuminate\Http\Request;

interface ILettingOperations {

    public function GetViewData($id);

    public function GetEpcReport($id);

    public function GetBrochure($id);

    public function GetLettingsFilteredData($request_input);

    public function CreateAppointment(Appointment $appointment);
    
    public function GetMapInformation($postcode = null);
    
    public function GetLatLongFromPostCode($postcode);
}
