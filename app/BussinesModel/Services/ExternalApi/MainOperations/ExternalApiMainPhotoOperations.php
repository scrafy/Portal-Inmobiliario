<?php

namespace App\BussinesModel\Services\ExternalApi\MainOperations;

use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainPhotoOperations;
use App\BussinesModel\Services\ExternalApi\ExternalApiService;

class ExternalApiMainPhotoOperations extends ExternalApiService implements IExternalApiMainPhotoOperations {

    public function DownloadPhoto($photoid) {
        $path = config('externalservice.external_api_links.main_operations.photo.download');
        $path = sprintf($path, $this->tier, $this->shortname, $photoid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link, null, true);
        return $result;
    }

    public function getPhoto($photoid) {
        $path = config('externalservice.external_api_links.main_operations.photo.getphoto');
        $path = sprintf($path, $this->tier, $this->shortname, $photoid);
        $querystring = sprintf("?api_key=%s", $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

    public function getPhotos($offset = 0, $count = 100) {
        if ($count <= 0) {
            $count = 100;
        }
        $path = config('externalservice.external_api_links.main_operations.photo.getphotos');
        $path = sprintf($path, $this->tier, $this->shortname);
        $querystring = sprintf("?offset=%d&count=%d&api_key=%s", $offset, $count, $this->api_key);
        $final_link = $this->endpoint . $path . $querystring;
        $result = $this->makeCall($final_link);
        return $result;
    }

}
