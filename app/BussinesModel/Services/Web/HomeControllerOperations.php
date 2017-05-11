<?php

namespace App\BussinesModel\Services\Web;

use App\Models\ExternalApi\SummaryLetting;
use App\BussinesModel\Interfaces\Web\IHomeOperations;

class HomeControllerOperations extends WebControllersOperations implements IHomeOperations {

    public function __construct() {
        parent::__construct();
    }

    public function GetHomeData() {

        $this->data['lettings'] = SummaryLetting::orderBy("Price", "asc")->simplePaginate($this->records_x_page, ['*'], null, 1)->toArray()['data'];
        foreach ($this->data['lettings'] as &$letting) {
            $letting = (object) $letting;
        }
        $this->data['total_lettings'] = SummaryLetting::count();
        $this->data['pagination'] = $this->getPaginationData($this->records_x_page, $this->data['total_lettings'], 1);
        return $this->data;
    }

    public function GetAboutusData() {
        return $this->data;
    }

    public function GetInformationData() {
        return $this->data;
    }

    public function GetLandlordsData() {
        return $this->data;
    }

    public function GetNewsData() {
        return $this->data;
    }

}
