<?php

namespace App\Models\ExternalApi;

use App\Models\BaseModel;

class Room extends BaseModel {

    protected $table = 'rooms';
    protected $primarykey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id', 'Etag', 'GlobalReference', 'RoomName', 'Description', 'MainPhoto',
        'RoomFloor', 'HeightCentimeters', 'HeightMeters', 'LengthCentimeters', 'LengthMeters', 'WidthCentiMeters',
        'WidthMeters', 'PropertyId'
    ];

    public function getProperty() {
        return $this->belongsTo('App\Models\ExternalApi\Property', 'PropertyId', 'id');
    }

}
