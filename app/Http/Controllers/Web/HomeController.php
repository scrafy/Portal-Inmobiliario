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
use App\Models\ExternalApi\Area;

class HomeController extends Controller {

    public function Home(Request $request) {
        $records_x_page = config("myparametersconfig.records_x_page");
        $data['lettings'] = SummaryLetting::orderBy("Price", "asc")->simplePaginate($records_x_page, ['*'], null, 1)->toArray()['data'];
        foreach ($data['lettings'] as &$letting) {
            $letting = (object) $letting;
        }
        $data['total_lettings'] = SummaryLetting::count();
        $data['pagination'] = $this->getPaginationData($records_x_page, $data['total_lettings'], 1);
        $data['type_properties'] = Property::orderBy("PropertyType", "asc")->get(['PropertyType'])->unique('PropertyType')->toArray();
        $data['areas'] = Area::orderBy("Name", "asc")->get()->toArray();
        $data['limitminprice'] = config("myparametersconfig.minprice");
        $data['limitmaxprice'] = config("myparametersconfig.maxprice");
        $data['minprice'] = config("myparametersconfig.minprice");
        $data['maxprice'] = config("myparametersconfig.maxprice");
        $data['queryfilter'] = "";
        return view('home.home')->with("data", $data);
    }

    public function Landlords() {
        $data['type_properties'] = Property::orderBy("PropertyType", "asc")->get(['PropertyType'])->unique('PropertyType')->toArray();
        $data['areas'] = Area::orderBy("Name", "asc")->get()->toArray();
        $data['limitminprice'] = config("myparametersconfig.minprice");
        $data['limitmaxprice'] = config("myparametersconfig.maxprice");
        $data['minprice'] = config("myparametersconfig.minprice");
        $data['maxprice'] = config("myparametersconfig.maxprice");
        $data['queryfilter'] = "";
        return view('home.landlords')->with("data", $data);
    }

    public function Information() {
        $data['type_properties'] = Property::orderBy("PropertyType", "asc")->get(['PropertyType'])->unique('PropertyType')->toArray();
        $data['areas'] = Area::orderBy("Name", "asc")->get()->toArray();
        $data['limitminprice'] = config("myparametersconfig.minprice");
        $data['limitmaxprice'] = config("myparametersconfig.maxprice");
        $data['minprice'] = config("myparametersconfig.minprice");
        $data['maxprice'] = config("myparametersconfig.maxprice");
        $data['queryfilter'] = "";
        return view('home.information')->with("data", $data);
    }

    public function Aboutus() {
        $data['type_properties'] = Property::orderBy("PropertyType", "asc")->get(['PropertyType'])->unique('PropertyType')->toArray();
        $data['areas'] = Area::orderBy("Name", "asc")->get()->toArray();
        $data['limitminprice'] = config("myparametersconfig.minprice");
        $data['limitmaxprice'] = config("myparametersconfig.maxprice");
        $data['minprice'] = config("myparametersconfig.minprice");
        $data['maxprice'] = config("myparametersconfig.maxprice");
        $data['queryfilter'] = "";
        return view('home.aboutus')->with("data", $data);
    }

    public function News() {
        $data['type_properties'] = Property::orderBy("PropertyType", "asc")->get(['PropertyType'])->unique('PropertyType')->toArray();
        $data['areas'] = Area::orderBy("Name", "asc")->get()->toArray();
        $data['limitminprice'] = config("myparametersconfig.minprice");
        $data['limitmaxprice'] = config("myparametersconfig.maxprice");
        $data['minprice'] = config("myparametersconfig.minprice");
        $data['maxprice'] = config("myparametersconfig.maxprice");
        $data['queryfilter'] = "";
        return view('home.news')->with("data", $data);
    }

}
