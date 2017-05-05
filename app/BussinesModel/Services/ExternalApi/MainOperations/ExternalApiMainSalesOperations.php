<?php

namespace App\BussinesModel\Services\ExternalApi\MainOperations;

use App\BussinesModel\Interfaces\ExternalApi\MainOPerations\IExternalApiMainSalesOperations;
use App\BussinesModel\Services\ExternalApi\ExternalApiService;
use \App\Models\InputModels\ExternalApi\MainOperations\SaleAdvertisedModel;

class ExternalApiMainSalesOperations extends ExternalApiService implements IExternalApiMainSalesOperations {

    public function getAdvertisedSales(SaleAdvertisedModel $search, $offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.sales.getsales');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s&", $offset, $count, $this->api_key);
        foreach ($search as $property => &$value) {
            if ($value !== null) {
                $value = gettype($value) === "boolean" ? $value ? "true" : "false" : $value;
                $querystring .= "$property=$value&";
            }
        }
        $querystring = substr($querystring, 0, -1);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getEnergyReport($instructionid) {
        $path = config('externalservice.external_api_links.main_operations.sales.getenergyefficiencyreport');
        $path = sprintf($path, $this->tier, $this->shortname, $instructionid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link, null, true);
        return $result;
    }

    public function getEnvironmentalReport($instructionid) {
        $path = config('externalservice.external_api_links.main_operations.sales.getenvironmentalreport');
        $path = sprintf($path, $this->tier, $this->shortname, $instructionid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link, null, true);
        return $result;
    }

    public function getSalesFeatureType($sales_featureid) {
        $path = config('externalservice.external_api_links.main_operations.sales.getsalesfeaturetype');
        $path = sprintf($path, $this->tier, $this->shortname, $sales_featureid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getSalesFeatureTypes($offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.sales.getsalesfeaturetypes');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getSalesInstruction($sale_instructionid) {
        $path = config('externalservice.external_api_links.main_operations.sales.getsaleinstruction');
        $path = sprintf($path, $this->tier, $this->shortname, $sale_instructionid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getSalesInstructions($offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.sales.getsalesintructions');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getSalesInstructionsFeatures($sale_instructionid, $offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.sales.getsalesinstructionsfeatures');
        $path = sprintf($path, $this->tier, $this->shortname, $sale_instructionid);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getSalesInstructionsFloorPlans($sale_instructionid, $offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.sales.foorplans');
        $path = sprintf($path, $this->tier, $this->shortname, $sale_instructionid);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getSalesInstructionsPhotos($sale_instructionid, $offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.sales.photos');
        $path = sprintf($path, $this->tier, $this->shortname, $sale_instructionid);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getSalesInstructionsRooms($sale_instructionid, $offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.sales.rooms');
        $path = sprintf($path, $this->tier, $this->shortname, $sale_instructionid);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

}
