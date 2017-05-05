<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Schema;
use Illuminate\Http\Response;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainPropertyOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainPhotoOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainBranchOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainLettingOperations;
use App\BussinesModel\Interfaces\ExternalApi\MainOperations\IExternalApiMainAreaOperations;
use App\Http\Controllers\ExternalApi\ExternalApiController;
use App\Models\ExternalApi\Property;
use App\Models\ExternalApi\Branch;
use App\Models\ExternalApi\Photo;
use App\Models\ExternalApi\Room;
use App\Models\ExternalApi\Letting;
use App\Models\ExternalApi\Tenantsystemtype;
use App\Models\ExternalApi\PostCodeArea;
use App\Models\ExternalApi\PostCode;
use App\Models\ExternalApi\Area;
use App\Models\InputModels\ExternalApi\MainOperations\AdvertModel;

class UpdateDBController extends ExternalApiController {

    private $properties_service;
    private $branches_service;
    private $photos_service;
    private $lettings_service;
    private $areas_service;

    public function __construct
    (
    IExternalApiMainPropertyOperations $properties_service, IExternalApiMainBranchOperations $branches_service, IExternalApiMainPhotoOperations $photos_service, IExternalApiMainLettingOperations $lettings_service, IExternalApiMainAreaOperations $areas_service
    ) {
        $this->properties_service = $properties_service;
        $this->branches_service = $branches_service;
        $this->photos_service = $photos_service;
        $this->lettings_service = $lettings_service;
        $this->areas_service = $areas_service;
    }

    public function UpdateDB() {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        try {
            \DB::transaction(function () {

                $this->getPostCodeAreasFromFile();
                $this->getBranches();
                $this->getAreas();
                $this->getProperties();
                $this->getPhotos();
                $this->getRooms();
                $this->getLettings();
            });
            \DB::connection()->getPdo()->exec("CALL sp_load_summary_lettings();");
            echo "Date: " . date('Y-m-d H:i:s', time()) . " DataBase updated correctly...";
        } catch (\Exception $ex) {
            echo 'Date: ' . date('Y-m-d H:i:s', time()) . ' Error: ' . $ex->getMessage() . " Line: " . $ex->getLine() . " File: " . $ex->getFile();
        }
    }

    public function DownLoadPhotos(Request $request) {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $quality = $request->quality === null ? 30 : $request->quality;
        $error = false;
        $notdownloaded = Photo::where('DownLoaded', 0)->get();
        foreach ($notdownloaded as &$photo) {
            try {
                $data = $this->DownLoadPhoto($photo['id']);
                if (strlen($data) > 172) {
                    $f = fopen(sprintf(config('myparametersconfig.pathimgproperty') . "%s.jpg", $photo['id']), "w");
                    $img = imagecreatefromstring($data);
                    imagejpeg($img, $f, $quality);
                    fclose($f);
                    $photo->DownLoaded = true;
                    $photo->save();
                }
            } catch (\Exception $e) {
                $error = true;
            }
        }
        if ($error) {
            echo 'Date: ' . date('Y-m-d H:i:s', time()) . ' Photos updated, but its possible an error has happened, execute process again...';
        } else {
            echo 'Date: ' . date('Y-m-d H:i:s', time()) . ' Photos updated correctly...';
        }
    }

    private function getPostCodeAreasFromFile() {
        if (PostCodeArea::count() === 0) {
            $postcodeareas = [];
            $cont = 0;
            $f = fopen(resource_path() . "/files/postcode_areas.csv", "r");
            if ($f !== false) {
                fgetcsv($f);
                while ($line = fgetcsv($f)) {
                    $postcodeareas[$cont] = [];
                    $postcodeareas[$cont]['area'] = $line[1];
                    $postcodeareas[$cont]['postcode_area'] = $line[0];
                    $cont++;
                }
                fclose($f);
                foreach ($postcodeareas as &$postcodearea) {
                    PostCodeArea::Create($postcodearea);
                }
            } else {
                throw new Exception("The postcode_areas.csv file has not been found...");
            }
        }
    }

    private function DownLoadPhoto($photoid) {
        return $this->photos_service->DownloadPhoto($photoid);
    }

    private function getAreas() {

        $resp = $this->areas_service->getAreas(0, 500000);
        $areas = [];
        $branchids = [];
        $filtered = [];
        if ($resp->Count > 0) {
            foreach ($resp->Data as &$area) {
                $area->id = $area->OID;
                $area->BranchId = $area->Branch;
                $area->ShowInWeb = $area->ShowOnSites;
                $area->Name = trim($area->Name);
                unset($area->OID);
                unset($area->ETag);
                unset($area->Branch);
                unset($area->ShowOnSites);
                $areas[] = (array) $area;
            }
            $aux = Branch::all(['id'])->toArray();
            for ($i = 0; $i < count($aux); $i++) {
                $branchids[] = $aux[$i]['id'];
            }
            $collection = collect($areas);
            $filtered = $collection->whereInStrict('BranchId', $branchids);
            $areas = collect($filtered->values()->all());
            foreach ($areas as &$area) {
                Area::updateOrCreate(['id' => $area['id']], $area);
            }
        }
    }

    private function getProperties() {
        $resp = $this->properties_service->getProperties(0, 500000);
        $properties = [];
        $branchids = [];
        $areaids = [];
        $filtered = [];
        $matches = [];
        if ($resp->Count > 0) {
            foreach ($resp->Data as &$prop) {
                $prop->id = $prop->OID;
                $prop->Etag = $prop->ETag;
                $prop->BranchId = $prop->Branch;
                $prop->AreaId = $prop->Area;
                $prop->PostCode = explode("\n", $prop->FullAddress)[count(explode("\n", $prop->FullAddress)) - 1];
                if (preg_match("/^([A-Z]{1,2})[0-9]{1}[0-9 A-Z]{0,1} [0-9]{1}[A-Z]{2}$/", $prop->PostCode, $matches)) {
                    $prop->PostCodeArea = $matches[1];
                    if (PostCodeArea::where("postcode_area", "=", $prop->PostCodeArea)->count() == 1) {
                        unset($prop->OID);
                        unset($prop->ETag);
                        unset($prop->Branch);
                        unset($prop->Area);
                        $properties[] = (array) $prop;
                    }
                }
            }
            $aux = Branch::all(['id'])->toArray();
            for ($i = 0; $i < count($aux); $i++) {
                $branchids[] = $aux[$i]['id'];
            }
            $aux = Area::all(['id'])->toArray();
            for ($i = 0; $i < count($aux); $i++) {
                $areaids[] = $aux[$i]['id'];
            }
            $collection = collect($properties);
            $filtered = $collection->whereInStrict('BranchId', $branchids);
            $filtered = $filtered->whereInStrict('AreaId', $areaids);
            Schema::table('properties', function (Blueprint $table) {
                $table->dropForeign(['PostCode']);
            });
            $properties = collect($filtered->values()->all());
            foreach ($properties as &$prop) {
                Property::updateOrCreate(['id' => $prop['id']], $prop);
            }
            $properties = Property::leftJoin("postcodes", "properties.PostCode", "=", "postcodes.PostCode")->whereNull("postcodes.id")->select("properties.id")->get()->toArray();
            $ids = [];
            foreach ($properties as &$property) {
                $ids[] = $property['id'];
            }
            Property::whereIn("id", $ids)->delete();
            Schema::table('properties', function (Blueprint $table) {
                $table->foreign('PostCode')->references('PostCode')->on('postcodes');
            });
        }
    }

    private function getBranches() {
        $resp = $this->branches_service->getBranches(0, 500000);
        $branches = [];
        if ($resp->Count > 0) {
            foreach ($resp->Data as &$branch) {
                $branch->Address2 = $branch->Address2 === "" ? null : $branch->Address2;
                $branch->Address3 = $branch->Address3 === "" ? null : $branch->Address3;
                $branch->Address4 = $branch->Address4 === "" ? null : $branch->Address4;
                $branch->WebAddress = $branch->WebAddress === "" ? null : $branch->WebAddress;
                $branch->EMailAddress = $branch->EMailAddress === "" ? null : $branch->EMailAddress;
                $branch->FaxPhone = $branch->FaxPhone === "" ? null : $branch->FaxPhone;
                $branch->id = $branch->OID;
                $branch->Etag = $branch->ETag;
                $branch->PostCode = $branch->Postcode;
                unset($branch->OID);
                unset($branch->ETag);
                unset($branch->Postcode);
                $branches[] = (array) $branch;
            }
            foreach ($branches as &$branch) {
                Branch::updateOrCreate(['id' => $branch['id']], $branch);
            }
        }
    }

    private function getPhotos() {
        $resp = $this->photos_service->getPhotos(0, 500000);
        $photos = [];
        $propertyids = [];
        $filtered = [];
        if ($resp->Count > 0) {
            foreach ($resp->Data as &$photo) {
                if
                (
                        ($photo->Property != "0000-0000-0000-0000") &&
                        (!preg_match("/energy/", strtolower($photo->FileName))) &&
                        (!preg_match("/environmental/", strtolower($photo->FileName))) &&
                        (!preg_match("/floor/", strtolower($photo->FileName))) &&
                        (!preg_match("/floor/", strtolower($photo->PhotoType)))
                ) {
                    $photo->Name = $photo->Name === "" ? null : $photo->Name;
                    $photo->id = $photo->OID;
                    $photo->Etag = $photo->ETag;
                    $photo->PropertyId = $photo->Property;
                    unset($photo->OID);
                    unset($photo->ETag);
                    unset($photo->Property);
                    $photos[] = (array) $photo;
                }
            }
            $aux = Property::all(['id'])->toArray();
            for ($i = 0; $i < count($aux); $i++) {
                $propertyids[] = $aux[$i]['id'];
            }
            $collection = collect($photos);
            $filtered = $collection->whereInStrict('PropertyId', $propertyids);
            $photos = collect($filtered->values()->all());
            foreach ($photos as &$photo) {
                Photo::updateOrCreate(['id' => $photo['id']], $photo);
            }
        }
    }

    private function getRooms() {
        $aux = Property::all(['id'])->toArray();
        $rooms = [];
        for ($i = 0; $i < count($aux); $i++) {
            $resp = $this->properties_service->getRooms($aux[$i]['id'], 0, 500000);
            if ($resp->Count > 0) {
                foreach ($resp->Data as &$room) {
                    $room->id = $room->OID;
                    $room->Etag = $room->ETag;
                    $room->PropertyId = $aux[$i]['id'];
                    unset($room->OID);
                    unset($room->ETag);
                    $rooms[] = (array) $room;
                }
                foreach ($rooms as &$room) {
                    Room::updateOrCreate(['id' => $room['id']], $room);
                }
            }
        }
    }

    private function getLettings() {
        $tenantsystemtypes = [];
        $aux = Branch::all(['id'])->toArray();
        $lettings = [];
        for ($i = 0; $i < count($aux); $i++) {
            $advert = new AdvertModel();
            $advert->branchID = $aux[$i]['id'];
            $resp = $this->lettings_service->getLettings($advert, 0, 500000);
            if ($resp->Count > 0) {
                foreach ($resp->Data as &$letting) {
                    if (count($letting->TenantSystemTypes) > 0) {
                        foreach ($letting->TenantSystemTypes as $tenant) {
                            $tenantsystemtypes[] = $tenant;
                        }
                    }
                    $letting->id = $letting->OID;
                    $letting->Etag = $letting->ETag;
                    $letting->BranchId = $aux[$i]['id'];
                    $letting->PropertyId = $letting->TenancyProperty;
                    unset($letting->OID);
                    unset($letting->ETag);
                    unset($letting->Branch);
                    unset($letting->TenancyProperty);
                    $lettings[] = (array) $letting;
                }
            }
        }
        $aux = Property::all(['id'])->toArray();
        for ($i = 0; $i < count($aux); $i++) {
            $propertyids[] = $aux[$i]['id'];
        }
        $collection = collect($lettings);
        $filtered = $collection->whereInStrict('PropertyId', $propertyids);
        $tenantsystemtypes = array_unique($tenantsystemtypes);
        $lettings = collect($filtered->values()->all());
        foreach ($tenantsystemtypes as &$tenantsystemtype) {
            Tenantsystemtype::updateOrCreate(['Name' => $tenantsystemtype], ['Name' => $tenantsystemtype]);
        }
        foreach ($lettings as &$letting) {
            $model_letting = Letting::updateOrCreate(['id' => $letting['id']], $letting);
            \DB::table('letting_tenantsystemtype')->whereIn('letting_id', [$letting['id']])->delete();
            foreach ($letting['TenantSystemTypes'] as &$tenant) {
                $model_tenant = Tenantsystemtype::where('Name', $tenant)->first();
                $model_letting->getTenantSystemTypes()->save($model_tenant);
            }
        }
    }

}
