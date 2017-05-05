<?php

namespace App\Models\ExternalApi;

use App\Models\BaseModel;

class Photo extends BaseModel {

    protected $table = 'photos';
    protected $primarykey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id', 'Etag', 'Name', 'FileName', 'Downloaded', 'InspectionItem', 'InterimInspection', 'InventoryItem',
        'Room', 'PhotoNumber', 'PhotoType', 'PropertyId'
    ];

    public function getProperty() {
        return $this->belongsTo('App\Models\ExternalApi\Property', 'PropertyId', 'id');
    }

}
