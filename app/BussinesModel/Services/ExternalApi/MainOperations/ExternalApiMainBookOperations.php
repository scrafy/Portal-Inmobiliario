<?php

namespace App\BussinesModel\Services\ExternalApi\MainOperations;

use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainBookOperations;
use App\BussinesModel\Services\ExternalApi\ExternalApiService;
use App\Models\InputModels\ExternalApi\MainOperations\BookModel;
use App\Models\InputModels\ExternalApi\MainOperations\ViewBookModel;

class ExternalApiMainBookOperations extends ExternalApiService implements IExternalApiMainBookOperations {

    public function getBook(BookModel $search) {
        $path = config('externalservice.external_api_links.main_operations.book.getbooking');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?api_key=%s&", $this->api_key);
        $body = null;
        foreach ($search as $property => &$value) {
            if ($value !== null) {

                if (is_array($value)) {
                    foreach ($value as &$property) {
                        $querystring .= "$property=$property&";
                    }
                } else if (is_object($value)) {
                    $body = $value;
                } else {

                    $value = gettype($value) === "boolean" ? $value ? "true" : "false" : $value;
                    $querystring .= "$property=$value&";
                }
            }
        }
        $querystring = substr($querystring, 0, -1);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link, $body);
        return $result;
    }

    public function getBooks(ViewBookModel $search) {
        $path = config('externalservice.external_api_links.main_operations.book.getbookings');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?api_key=%s&", $this->api_key);
        foreach ($search as $property => &$value) {
            if ($value !== null) {

                if (is_array($value)) {
                    foreach ($value as &$propertyid) {
                        $querystring .= "$property=$propertyid&";
                    }
                } else {
                    $querystring .= "$property=$value&";
                }
            }
        }
        $querystring = substr($querystring, 0, -1);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

}
