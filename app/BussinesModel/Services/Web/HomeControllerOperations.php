<?php

namespace App\BussinesModel\Services\Web;

use App\Models\ExternalApi\SummaryLetting;
use App\BussinesModel\Interfaces\Web\IHomeOperations;
use App\BussinesModel\Interfaces\Web\ILettingOperations;

class HomeControllerOperations extends WebControllersOperations implements IHomeOperations {

    private $letting_operations = null;

    public function __construct(ILettingOperations $_lettings_operations) {
        parent::__construct();
        $this->letting_operations = $_lettings_operations;
    }

    public function GetHomeData() {

        if (count($this->data['queryfilter']) > 0) {
            return $this->letting_operations->GetLettingsFilteredData($this->data['queryfilter']);
        }
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
