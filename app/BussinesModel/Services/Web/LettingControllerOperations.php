<?php

namespace App\BussinesModel\Services\Web;

use App\Models\ExternalApi\SummaryLetting;
use App\BussinesModel\Interfaces\Web\ILettingOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainPropertyOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainLettingOperations;
use App\Models\OutputModels\JsonResponseModel;
use App\Models\OutputModels\Web\Letting\GetEpcReportImageModel;
use App\Models\InputModels\Web\Letting\Appointment;
use App\Models\ExternalApi\PostCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LettingControllerOperations extends WebControllersOperations implements ILettingOperations {

    private $service_properties;
    private $service_lettings;

    public function __construct(IExternalApiMainPropertyOperations $_service_properties, IExternalApiMainLettingOperations $_service_lettings) {
        parent::__construct();
        $this->service_properties = $_service_properties;
        $this->service_lettings = $_service_lettings;
    }

    public function CreateAppointment(Appointment $appointment) {
        $resp = new JsonResponseModel();
        try {
            if ($appointment->Validate()) {
                $appointment->SetAttributes()->save();
                $resp->content = "ok";
                return response()->json($resp);
            } else {
                $resp->error = "validation_errors";
                $resp->validation_errors = $appointment->getValidationErrors();
            }
        } catch (\Exception $ex) {
            $resp->error = $ex->getMessage();
            $resp->stack_trace = $ex->getTrace();
        }
        return response()->json($resp);
    }

    public function GetBrochure($id) {
        try {
            $letting = SummaryLetting::where('PropertyId', '=', $id)->first();
            if ($letting != null) {
                if (!file_exists(config("myparametersconfig.pathimgbrochures") . $id . "pdf")) {
                    $link = $this->service_lettings->getBrochure($letting->LettingId);
                    $data = file_get_contents($link);
                    $f = fopen(sprintf(config('myparametersconfig.pathimgbrochures') . "%s.pdf", $id), "w");
                    fwrite($f, $data);
                    fclose($f);
                }
                return response(file_get_contents(config("myparametersconfig.pathimgbrochures") . $id . ".pdf"))->withHeaders(['Content-type' => 'application/pdf', 'Content-Disposition' => 'inline; filename=brochure.pdf']);
            }
            //set error
        } catch (\Exception $ex) {
            //set error
        }
    }

    public function GetEpcReport($id) {
        try {
            $letting = SummaryLetting::where('PropertyId', '=', $id)->first();
            $resp = new JsonResponseModel();
            $content = new GetEpcReportImageModel();
            if ($letting != null) {
                if (!file_exists(config("myparametersconfig.pathimgepc") . $id . "jpg")) {
                    $data = $this->service_properties->getEnergyEfficiencyReport($id);
                    $f = fopen(sprintf(config('myparametersconfig.pathimgepc') . "%s.jpg", $id), "w");
                    $img = imagecreatefromstring($data);
                    imagejpeg($img, $f, 100);
                    fclose($f);
                }
                $content->file = $id . ".jpg";
                $resp->content = $content;
                $resp->pagination = null;
            } else {
                $resp->error = "There is any Property with the id: $id";
                $resp->pagination = null;
            }
        } catch (\Exception $ex) {
            $resp->error = $ex->getMessage();
            $resp->pagination = null;
        }
        return response()->json($resp);
    }

    public function GetLatLongFromPostCode($postcode) {
        $resp = new JsonResponseModel();
        $data = [];
        try {
            $result = PostCode::where('PostCode', "=", $postcode)->first();
            if ($result === null) {
                return response()->json($resp);
            }
            $data["lat"] = floatval($result->Latitude);
            $data["lng"] = floatval($result->Longitude);
            $resp->content = (object) $data;
        } catch (\Exception $ex) {
            $resp->error = $ex->getMessage();
        }
        return response()->json($resp);
    }

    public function CleanFilters() {
        $page = 1;
        $result = SummaryLetting::orderBy("Price", "asc")->simplePaginate($this->records_x_page, ['*'], null, $page)->toArray()['data'];
        if (($result === null) || (count($result) === 0 )) {
            $this->data['lettings'] = null;
            $this->data['total_lettings'] = 0;
            $this->data['pagination'] = $this->getPaginationData($this->records_x_page, $this->data['total_lettings'], $page);
        } else {
            foreach ($result as &$letting) {
                $letting = (object) $letting;
            }
            $this->data['lettings'] = $result;
            $this->data['total_lettings'] = SummaryLetting::count();
            $this->data['pagination'] = $this->getPaginationData($this->records_x_page, $this->data['total_lettings'], $page);
        }
        $this->data['queryfilterstring'] = "";
        if (Session::has('queryfilter')) {
            Session::remove('queryfilter');
        }
        return $this->data;
    }

    public function GetLettingsFilteredData($request_input) {
        $query = "";
        $result = null;
        $page = 1;
        if ((count($request_input) === 0) || ((count($request_input) === 1) && (isset($request_input['page'])))) {
            $page = isset($request_input['page']) ? $request_input['page'] : 1;
            $result = SummaryLetting::orderBy("Price", "asc")->simplePaginate($this->records_x_page, ['*'], null, $page)->toArray()['data'];
            if (($result === null) || (count($result) === 0 )) {
                $this->data['lettings'] = null;
                $this->data['total_lettings'] = 0;
                $this->data['pagination'] = $this->getPaginationData($this->records_x_page, $this->data['total_lettings'], $page);
            } else {
                foreach ($result as &$letting) {
                    $letting = (object) $letting;
                }
                $this->data['lettings'] = $result;
                $this->data['total_lettings'] = SummaryLetting::count();
                $this->data['pagination'] = $this->getPaginationData($this->records_x_page, $this->data['total_lettings'], $page);
            }
            $this->data['queryfilterstring'] = "";
            if (Session::has('queryfilter')) {
                Session::remove('queryfilter');
            }
        } else {
            if (isset($request_input['records_x_page'])) {
                $this->records_x_page = $request_input['records_x_page'];
            } else {
                $request_input['records_x_page'] = $this->records_x_page;
            }
            if (isset($request_input['page'])) {
                $page = $request_input['page'];
            } else {
                $request_input['page'] = $page;
            }
            if (isset($request_input['minprice'])) {
                $this->data['minprice'] = ($request_input['minprice'] === "" || $request_input['minprice'] === null) ? 0 : $request_input['minprice'];
            } else {
                $request_input['minprice'] = $this->data['minprice'];
            }
            if (isset($request_input['maxprice'])) {
                $this->data['maxprice'] = ($request_input['maxprice'] === "" || $request_input['maxprice'] === null) ? 0 : $request_input['maxprice'];
            } else {
                $request_input['maxprice'] = $this->data['maxprice'];
            }
            $query = $this->getQueryStringFromArray($request_input);
            $this->data['queryfilterstring'] = $query;
            Session::put('queryfilter', $request_input);
            $result = SummaryLetting::getPropertiesFiltered($request_input);
            if (($result['data'] === null) || ($result['total_records'] === 0 )) {
                $this->data['lettings'] = null;
                $this->data['total_lettings'] = 0;
                $this->data['pagination'] = $this->getPaginationData($this->records_x_page, $this->data['total_lettings'], $page);
            } else {
                foreach ($result['data'] as &$letting) {
                    $letting = (object) $letting;
                }
                $this->data['lettings'] = $result['data'];
                $this->data['total_lettings'] = $result['total_records'];
                $this->data['pagination'] = $this->getPaginationData($this->records_x_page, $this->data['total_lettings'], $page);
            }
        }
        return $this->data;
    }

    public function GetMapInformation($postcode = null) {
        $data = [];
        $resp = new JsonResponseModel();
        try {
            if ($postcode !== null) {
                $result = \DB::select(sprintf("select * from lettingsbypostcode where PostCode = '%s'", $postcode));
            } else {
                $result = \DB::select("select * from lettingsbypostcode");
            }

            foreach ($result as &$postcode) {
                $data[$postcode->PostCode] = [];
                $data[$postcode->PostCode]['latitude'] = $postcode->Latitude;
                $data[$postcode->PostCode]['longitude'] = $postcode->Longitude;
                $string_lettings = explode("*", $postcode->data);
                $cont = 0;
                foreach ($string_lettings as &$string_letting) {
                    $values = explode(",", $string_letting);
                    foreach ($values as &$val) {
                        if (explode("=", $val)[0] === "")
                            $data[$postcode->PostCode][$cont][explode("=", $val)[0]] = null;
                        else
                            $data[$postcode->PostCode][$cont][explode("=", $val)[0]] = explode("=", $val)[1];
                    }
                    $cont++;
                }
            }
            $aux = [];
            $data = (object) $data;

            foreach ($data as $name => $value) {
                $aux = $data->$name;
                $data->$name = new \stdClass();
                $data->$name->html = null;
                $data->$name->mob_html = null;

                $data->$name->latitude = floatval($aux['latitude']);
                $data->$name->longitude = floatval($aux['longitude']);
                unset($aux['latitude']);
                unset($aux['longitude']);
                $data->$name->lettings = $aux;
            }
            foreach ($data as $name => $value) {
                $aux = [];
                foreach ($data->$name->lettings as $_name => $_value) {
                    $aux[] = (object) $_value;
                }
                $data->$name->html = view("partials.letting.adverts")->with("lettings", $aux)->__toString();
            }
            $resp->content = $data;
        } catch (\Exception $ex) {
            $resp->error = $ex->getMessage();
            $resp->stack_trace = $ex->getTrace();
        }
        if (count($data) > 1)
            $resp->content = $data;

        return response()->json($resp);
    }

    public function GetViewData($id) {
        $letting = SummaryLetting::where('PropertyId', '=', $id)->first();
        if ($letting != null) {
            $letting->Photos = $letting->getPhotos()->toArray();
            $this->data['letting'] = (object) $letting->toArray();
        } else {
            $this->data['letting'] = null;
        }
        return $this->data;
    }

}
