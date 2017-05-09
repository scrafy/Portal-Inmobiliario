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
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainPropertyOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainLettingOperations;
use App\Models\OutputModels\JsonResponseModel;
use App\Models\OutputModels\Web\Letting\GetEpcReportImageModel;
use App\Models\OutputModels\Web\Letting\GetBrochureModel;
use App\Models\ExternalApi\Area;
use App\Models\ExternalApi\PostCode;
use App\Models\InputModels\Web\Letting\Appointment;

class LettingController extends Controller {

    private $service_properties;
    private $service_lettings;

    public function __construct(IExternalApiMainPropertyOperations $_service_properties, IExternalApiMainLettingOperations $_service_lettings) {
        $this->service_properties = $_service_properties;
        $this->service_lettings = $_service_lettings;
    }

    public function View($id) {
        $data['type_properties'] = Property::orderBy("PropertyType", "asc")->get(['PropertyType'])->unique('PropertyType')->toArray();
        $data['areas'] = Area::orderBy("Name", "asc")->get()->toArray();
        $data['limitminprice'] = config("myparametersconfig.minprice");
        $data['limitmaxprice'] = config("myparametersconfig.maxprice");
        $data['minprice'] = config("myparametersconfig.minprice");
        $data['maxprice'] = config("myparametersconfig.maxprice");
        $data['queryfilter'] = "";
        $letting = SummaryLetting::where('PropertyId', '=', $id)->first();
        if ($letting != null) {
            $letting->Photos = $letting->getPhotos()->toArray();
            $data['letting'] = (object) $letting->toArray();
            return view('letting.letting')->with("data", $data);
        } else {
            $data['letting'] = null;
            return view('letting.letting')->with("data", $data);
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

    public function FilterLettings(Request $request) {
        $query = "";
        $records_x_page = config("myparametersconfig.records_x_page");
        $result = null;
        $data['limitminprice'] = config("myparametersconfig.minprice");
        $data['limitmaxprice'] = config("myparametersconfig.maxprice");
        $data['type_properties'] = Property::orderBy("PropertyType", "asc")->get(['PropertyType'])->unique('PropertyType')->toArray();
        $data['areas'] = Area::orderBy("Name", "asc")->get()->toArray();
        $page = 1;
        if ((count($request->query()) === 0) || ((count($request->query()) === 1) && (isset($request->query()['page'])))) {
            $page = isset($request->query()['page']) ? $request->query()['page'] : 1;
            $data['queryfilter'] = "";
            $data['minprice'] = config("myparametersconfig.minprice");
            $data['maxprice'] = config("myparametersconfig.maxprice");
            $result = SummaryLetting::orderBy("Price", "asc")->simplePaginate($records_x_page, ['*'], null, $page)->toArray()['data'];
            if (($result === null) || (count($result) === 0 )) {
                $data['lettings'] = null;
                $data['total_lettings'] = 0;
                $data['pagination'] = $this->getPaginationData($records_x_page, $data['total_lettings'], $page);
            } else {
                foreach ($result as &$letting) {
                    $letting = (object) $letting;
                }
                $data['lettings'] = $result;
                $data['total_lettings'] = SummaryLetting::count();
                $data['pagination'] = $this->getPaginationData($records_x_page, $data['total_lettings'], $page);
            }
        } else {
            $arr_query = $request->query();
            if (isset($arr_query['records_x_page'])) {
                $records_x_page = $arr_query['records_x_page'];
            }
            if (isset($arr_query['page'])) {
                $page = $arr_query['page'];
            }
            $arr_query['records_x_page'] = $records_x_page;
            $arr_query['page'] = $page;
            if (isset($arr_query['minprice'])) {
                $data['minprice'] = ($arr_query['minprice'] === "" || $arr_query['minprice'] === null) ? 0 : $arr_query['minprice'];
            } else {
                $data['minprice'] = config("myparametersconfig.minprice");
                $arr_query['minprice'] = config("myparametersconfig.minprice");
            }
            if (isset($request->query()['maxprice'])) {
                $data['maxprice'] = ($arr_query['maxprice'] === "" || $arr_query['maxprice'] === null) ? 0 : $arr_query['maxprice'];
            } else {
                $data['maxprice'] = config("myparametersconfig.maxprice");
                $arr_query['maxprice'] = config("myparametersconfig.maxprice");
            }
            foreach ($arr_query as $key => $value) {
                $query .= $key . "=" . $value . "&";
            }
            $query = substr($query, 0, strlen($query) - 1);
            $data['queryfilter'] = $query;
            $result = SummaryLetting::getPropertiesFiltered($arr_query);
            if (($result['data'] === null) || ($result['total_records'] === 0 )) {
                $data['lettings'] = null;
                $data['total_lettings'] = 0;
                $data['pagination'] = $this->getPaginationData($records_x_page, $data['total_lettings'], $page);
            } else {
                foreach ($result['data'] as &$letting) {
                    $letting = (object) $letting;
                }
                $data['lettings'] = $result['data'];
                $data['total_lettings'] = $result['total_records'];
                $data['pagination'] = $this->getPaginationData($records_x_page, $data['total_lettings'], $page);
            }
        }
        return view('home.home')->with("data", $data);
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

    public function GetMapInformation($postcode = null) {
        $data = [];
        $resp = new JsonResponseModel();
        try {
            if($postcode !== null){
                $result = \DB::select(sprintf("select * from lettingsbypostcode where PostCode = '%s'", $postcode));
            }else{
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

}
