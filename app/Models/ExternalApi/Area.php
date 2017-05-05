<?php

namespace App\Models\ExternalApi;

use App\Models\BaseModel;

class Area extends BaseModel {

    protected $table = 'areas';
    protected $primarykey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'Name', 'ShowInWeb', 'BranchId'];

    public function getProperties() {
        return $this->hasMany('App\Models\ExternalApi\Property', 'AreaId', 'id');
    }

    public function getBranch() {
        return $this->belongsTo('App\Models\ExternalApi\Branch', 'BranchId', 'id');
    }

}
