<?php

namespace App\Models\ExternalApi;

use App\Models\BaseModel;

class Branch extends BaseModel {

    protected $table = 'branches';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id', 'Etag', 'Name', 'CompanyName', 'Address1', 'Address2', 'Address3',
        'Address4', 'PostCode', 'WebAddress', 'EmailAddress', 'LandPhone', 'FaxPhone',
        'County'
    ];

    public function getProperties() {
        return $this->hasMany('App\Models\ExternalApi\Property', 'BranchId', 'id');
    }

    public function getLettings() {
        return $this->hasMany('App\Models\ExternalApi\Letting', 'BranchId', 'id');
    }

    public function getAreas() {
        return $this->hasMany('App\Models\ExternalApi\Area', 'BranchId', 'id');
    }

}
