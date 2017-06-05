<?php

namespace App\BussinesModel\Services\Web;

use App\Models\ExternalApi\SummaryLetting;
use App\BussinesModel\Interfaces\Web\IHomeOperations;
use App\BussinesModel\Interfaces\Web\ILettingOperations;


class HomeControllerOperations extends WebControllersOperations implements IHomeOperations {

    private $letting_operations = null;
    private $summary_lettings = null;

    public function __construct(ILettingOperations $_lettings_operations, SummaryLetting $summary_lettings) {
        parent::__construct();
        $this->letting_operations = $_lettings_operations;
        $this->summary_lettings = $summary_lettings;
    }

    public function GetHomeData() {

        if (count($this->data['queryfilter']) > 0) {
            $value = $this->letting_operations->GetLettingsFilteredData($this->data['queryfilter']);
            return $value;
        }
        $this->data['lettings'] = $this->summary_lettings->getLettings(['orderby' => 'Price', 'direction' => 'asc', 'records_x_page' => $this->records_x_page, 'page' => 1]);
        foreach ($this->data['lettings'] as &$letting) {
            $letting = (object) $letting;
        }
        $this->data['total_lettings'] = $this->summary_lettings->count();
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
