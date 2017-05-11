<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BussinesModel\Interfaces\Web\IHomeOperations;

class HomeController extends Controller {

    private $service = null;

    public function __construct(IHomeOperations $service) {
        $this->service = $service;
    }

    public function Home(Request $request) {

        return view('home.home')->with("data", $this->service->GetHomeData());
    }

    public function Landlords() {

        return view('home.landlords')->with("data", $this->service->GetLandlordsData());
    }

    public function Information() {

        return view('home.information')->with("data", $this->service->GetInformationData());
    }

    public function Aboutus() {

        return view('home.aboutus')->with("data", $this->service->GetAboutusData());
    }

    public function News() {

        return view('home.news')->with("data", $this->service->GetNewsData());
    }

}
