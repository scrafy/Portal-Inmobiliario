<?php

namespace App\BussinesModel\Interfaces\ExternalApi\MainOperations;

interface IExternalApiMainPhotoOperations {

    public function getPhotos($offset = 0, $count = 100);

    public function getPhoto($photoid);

    public function DownloadPhoto($photoid);
}
