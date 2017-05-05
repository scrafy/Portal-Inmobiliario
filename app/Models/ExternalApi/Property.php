<?php

namespace App\Models\ExternalApi;

use App\Models\BaseModel;

class Property extends BaseModel {

    protected $table = 'properties';
    protected $primarykey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id', 'Etag', 'GlobalReference', 'RoomName', 'FullAddress', 'PostCode', 'PostCodeArea', 'AreaId', 'Description',
        'PropertySource', 'MainPhoto', 'PropertyType', 'BranchId'
    ];

    public function getPostCodeArea() {
        return $this->belongsTo('App\Models\ExternalApi\PostCodeArea', 'postcode_area', 'PostCodeArea');
    }

    public function getRooms() {
        return $this->hasMany('App\Models\ExternalApi\Room', 'PropertyId', 'id');
    }

    public function getPhotos() {
        return $this->hasMany('App\Models\ExternalApi\Photo', 'PropertyId', 'id');
    }

    public function getLetting() {
        return $this->hasOne('App\Models\ExternalApi\Letting', 'PropertyId', 'id');
    }

    public function getBranch() {
        return $this->belongsTo('App\Models\ExternalApi\Branch', 'BranchId', 'id');
    }

    public function getArea() {
        return $this->belongsTo('App\Models\ExternalApi\Area', 'AreaId', 'id');
    }

    public function getPostCode() {
        return $this->belongsTo('App\Models\ExternalApi\PostCode', 'PostCode', 'PostCode');
    }

}
